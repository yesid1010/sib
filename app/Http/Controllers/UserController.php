<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\UserStoreRequest;
use App\Role;
use App\User;


class UserController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    //mostrar todos los usuarios
    public function index(){
        $roles = Role::all();
        $users = User::where('role_id','!=','1')->orderBy('id','desc')->get();
        return view('users.index',['users'=>$users,'roles'=>$roles]);
    }
    
    //agregar un usuario
    public function store(UserStoreRequest $request){

        $user = new User();


        $user->identification = $request->input('identification');
        $user->names = $request->input('names');
        $user->surnames = $request->input('surnames');
        $user->email = $request->input('email');
        $user->role_id = $request->input('role_id');
        
        $user->save();
        alert()->success('OK', '!!Usuario Agregado con exito!!')->autoclose(3000);
        return back();
    }

    //editar un usuario
    public function update(Request $request){

        $user                 = User::findOrFail($request->id);;
        $user->identification = $request->input('identification');
        $user->names          = $request->input('names');
        $user->surnames       = $request->input('surnames');
        $user->email          = $request->input('email');
        $user->role_id         = $request->input('role_id');

        if($request->input('role_id')!=3){
            $user->password = bcrypt($user->password);
        }
        
        $user->save();
        alert()->success('OK', '!!Usuario Actualizado con exito!!')->autoclose(3000);
        return back();
    }

    //eliminar un usuario
    public function destroy(Request $request){
        $user =  User::findOrFail($request->id);
        $user->delete();
        alert()->success('OK', '!!Usuario Eliminado con exito!!')->autoclose(3000);
        return back();
    }

    // agregar contraseña a un usuario por parte del superadmin
    public function addPassword(Request $request){
        $user                 = User::findOrFail($request->id);
        $user->password       = bcrypt($request->input('password'));
        $user->save();
        alert()->success('OK', '!!Contraseña Agregada con exito!!')->autoclose(3000);
        return back();
    }

    // ver perfil del  usuario autenticado 
    public function profile(){
        $user           = Auth::user();
        return view('profile.index',['user'=>$user]);
    }

    // actualizar la contraseña de un usuario autenticado
    public function updatePassword(Request $request){
        $user  = Auth::user();
        $oldpassword = $request->input('oldpassword');

        if (Hash::check($oldpassword,$user->password)){
            $user->password = bcrypt($request->input('newpassword'));
            $user->save();
            alert()->success('OK', '!!Contraseña Actualizada con exito!!')->autoclose(3000);
            return back();
        }
        else{
            alert()->error('OK', '!!Error al cambiar contraseña!!')->autoclose(3000);
            return back();
        }
    }


    public function State($id){
        $user = User::findOrFail($id);

        if($user->status == 'ENABLED'){

            $user->status = 'DISABLED';

        }else{

            $user->status = 'ENABLED';
            
        }
        $user->save();
        alert()->success('OK', '!!Estado Actualizado con exito!!')->autoclose(3000);
        return back();
    }

    public function barmans(){
        $roles = Role::all();
        $users = User::where('role_id','=','3')->orderBy('id','desc')->get();
        return view('users.barmans.barmans',['users'=>$users,'roles'=>$roles]);
    }
}
