<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Role;
class RoleController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $roles = Role::all();
        return view('roles.index',['roles'=>$roles]);
    }

    public function store(Request $request)
    {
        //
        $role              = new Role();
        $role->name        = $request->input('name');
        $role->description = $request->input('description');
        $role->save();
        return Redirect::to('roles');
    }

    public function update(Request $request)
    {
        //
        $role              =  Role::findOrFail($request->id);
        $role->name        = $request->input('name');
        $role->description = $request->input('description');
        $role->save();
        return Redirect::to('roles');
    }

    public function destroy( Request $request  )
    {
        $role =  Role::findOrFail($request->id);
        $role->delete();
        return Redirect::to('roles');
    }
}
