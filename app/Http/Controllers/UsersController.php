<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::orderBy('id','ASC')->paginate(10);
        return view('backend.users.index')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $existingAdminId = User::where('role', 'admin')->value('id');
        return view('backend.users.create', [
            'existingAdminId' => $existingAdminId,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
        [
            'name'=>'string|required|max:30',
            'email'=>'string|required|unique:users',
            'phone'=>'nullable|string|max:50',
            'password'=>'string|required',
            'role'=>'required|in:admin,user,sales_admin',
            'status'=>'required|in:active,inactive',
            'photo'=>'nullable|string',
        ]);
        // dd($request->all());
        $data=$request->all();

        if (!array_key_exists('phone', $data) || $data['phone'] === null) {
            $data['phone'] = '';
        }

        // Only one full admin is allowed in the system.
        if (($data['role'] ?? null) === 'admin') {
            $existingAdminId = User::where('role', 'admin')->value('id');
            if (!empty($existingAdminId)) {
                return back()->withInput()->withErrors([
                    'role' => 'Only one admin is allowed. Create a Sales Admin instead.',
                ]);
            }
        }

        $data['password']=Hash::make($request->password);

        if (isset($data['role']) && in_array($data['role'], ['sales_admin'], true)) {
            $data['is_sales_staff'] = 1;
        } else {
            $data['is_sales_staff'] = $data['is_sales_staff'] ?? 0;
        }
        // dd($data);
        $status=User::create($data);
        // dd($status);
        if($status){
            request()->session()->flash('success','Successfully added user');
        }
        else{
            request()->session()->flash('error','Error occurred while adding user');
        }
        return redirect()->route('users.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::findOrFail($id);
        $existingAdminId = User::where('role', 'admin')->value('id');
        return view('backend.users.edit', [
            'user' => $user,
            'existingAdminId' => $existingAdminId,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user=User::findOrFail($id);
        $this->validate($request,
        [
            'name'=>'string|required|max:30',
            'email'=>'string|required',
            'phone'=>'nullable|string|max:50',
            'role'=>'required|in:admin,user,sales_admin',
            'status'=>'required|in:active,inactive',
            'photo'=>'nullable|string',
        ]);
        // dd($request->all());
        $data=$request->all();

        if (!array_key_exists('phone', $data) || $data['phone'] === null) {
            $data['phone'] = '';
        }

        // Only one full admin is allowed in the system.
        if (($data['role'] ?? null) === 'admin') {
            $existingAdminId = User::where('role', 'admin')->where('id', '!=', $user->id)->value('id');
            if (!empty($existingAdminId)) {
                return back()->withInput()->withErrors([
                    'role' => 'Only one admin is allowed. Promote to Sales Admin instead.',
                ]);
            }
        }

        if (isset($data['role']) && in_array($data['role'], ['sales_admin'], true)) {
            $data['is_sales_staff'] = 1;
        } else {
            $data['is_sales_staff'] = $data['is_sales_staff'] ?? 0;
        }
        // dd($data);
        
        $status=$user->fill($data)->save();
        if($status){
            request()->session()->flash('success','Successfully updated');
        }
        else{
            request()->session()->flash('error','Error occured while updating');
        }
        return redirect()->route('users.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete=User::findorFail($id);
        $status=$delete->delete();
        if($status){
            request()->session()->flash('success','User Successfully deleted');
        }
        else{
            request()->session()->flash('error','There is an error while deleting users');
        }
        return redirect()->route('users.index');
    }
}
