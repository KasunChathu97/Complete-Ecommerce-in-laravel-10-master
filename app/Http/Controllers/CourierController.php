<?php

namespace App\Http\Controllers;

use App\Models\Courier;
use Illuminate\Http\Request;

class CourierController extends Controller
{
    public function index()
    {
        $couriers = Courier::orderBy('name')->paginate(10);

        return view('backend.courier.index', compact('couriers'));
    }

    public function create()
    {
        return view('backend.courier.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:120',
            'hotline' => 'required|string|max:50',
        ]);

        $status = Courier::create($validated);

        return redirect()
            ->route('courier.index')
            ->with($status ? 'success' : 'error', $status ? 'Courier successfully added' : 'Error occurred while adding courier');
    }

    public function edit(Courier $courier)
    {
        return view('backend.courier.edit', compact('courier'));
    }

    public function update(Request $request, Courier $courier)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:120',
            'hotline' => 'required|string|max:50',
        ]);

        $status = $courier->fill($validated)->save();

        return redirect()
            ->route('courier.index')
            ->with($status ? 'success' : 'error', $status ? 'Courier successfully updated' : 'Error occurred while updating courier');
    }

    public function destroy(Courier $courier)
    {
        $status = $courier->delete();

        return redirect()
            ->route('courier.index')
            ->with($status ? 'success' : 'error', $status ? 'Courier successfully deleted' : 'Error occurred while deleting courier');
    }
}