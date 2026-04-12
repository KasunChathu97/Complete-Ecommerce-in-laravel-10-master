<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SalesAdminController extends Controller
{
    public function index()
    {
        $salesAdmins = User::query()
            ->where('role', 'sales_admin')
            ->orderBy('id', 'ASC')
            ->paginate(10);

        return view('backend.sales_admins.index', [
            'salesAdmins' => $salesAdmins,
        ]);
    }

    public function create()
    {
        return view('backend.sales_admins.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'string|required|max:30',
            'email' => 'string|required|email|unique:users,email',
            'phone' => 'nullable|string|max:50',
            'password' => 'string|required|min:6',
            'status' => 'required|in:active,inactive',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:4096',
        ]);

        $data = $request->only(['name', 'email', 'phone', 'status']);
        $data['role'] = 'sales_admin';
        $data['is_sales_staff'] = 1;
        $data['password'] = Hash::make($request->password);

        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $path = $request->file('photo')->store('profiles', 'public');
            $data['photo'] = '/storage/' . $path;
        }

        // Some DBs have users.phone as NOT NULL with no default.
        if (!array_key_exists('phone', $data) || $data['phone'] === null) {
            $data['phone'] = '';
        }

        $status = User::create($data);

        if ($status) {
            request()->session()->flash('success', 'Sales Admin successfully added');
        } else {
            request()->session()->flash('error', 'Error occurred while adding Sales Admin');
        }

        return redirect()->route('sales-admins.index');
    }

    public function edit($id)
    {
        $salesAdmin = User::where('role', 'sales_admin')->findOrFail($id);
        return view('backend.sales_admins.edit', [
            'salesAdmin' => $salesAdmin,
        ]);
    }

    public function update(Request $request, $id)
    {
        $salesAdmin = User::where('role', 'sales_admin')->findOrFail($id);

        $this->validate($request, [
            'name' => 'string|required|max:30',
            'email' => 'string|required|email|unique:users,email,' . $salesAdmin->id,
            'phone' => 'nullable|string|max:50',
            'status' => 'required|in:active,inactive',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:4096',
            'password' => 'nullable|string|min:6',
        ]);

        $data = $request->only(['name', 'email', 'phone', 'status']);
        $data['role'] = 'sales_admin';
        $data['is_sales_staff'] = 1;

        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $path = $request->file('photo')->store('profiles', 'public');
            $data['photo'] = '/storage/' . $path;
        }

        if (!array_key_exists('phone', $data) || $data['phone'] === null) {
            $data['phone'] = '';
        }

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $status = $salesAdmin->fill($data)->save();

        if ($status) {
            request()->session()->flash('success', 'Sales Admin successfully updated');
        } else {
            request()->session()->flash('error', 'Error occurred while updating Sales Admin');
        }

        return redirect()->route('sales-admins.index');
    }

    public function destroy($id)
    {
        $salesAdmin = User::where('role', 'sales_admin')->findOrFail($id);
        $status = $salesAdmin->delete();

        if ($status) {
            request()->session()->flash('success', 'Sales Admin successfully deleted');
        } else {
            request()->session()->flash('error', 'There is an error while deleting Sales Admin');
        }

        return redirect()->route('sales-admins.index');
    }
}
