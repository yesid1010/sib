<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\RolStoreRequest;
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
        $roles = Role::orderBy('id','desc')->get();
        return view('roles.index',['roles'=>$roles]);
    }

    public function store(RolStoreRequest $request)
    {
        //
        $role              = new Role();
        $role->name        = $request->input('name');
        $role->description = $request->input('description');
        $role->save();
        alert()->success('OK', '!!Rol Agregado con exito!!')->autoclose(3000);
        return back();
    }

    public function update(Request $request)
    {
        //
        $role              =  Role::findOrFail($request->id);
        $role->name        = $request->input('name');
        $role->description = $request->input('description');
        $role->save();
        alert()->success('OK', '!!Rol Actualizado con exito!!')->autoclose(3000);
        return back();
    }

    public function destroy( Request $request  )
    {
        $role =  Role::findOrFail($request->id);
        $role->delete();
        alert()->success('OK', '!!Rol Eliminado con exito!!')->autoclose(3000);
        return back();
    }
}
