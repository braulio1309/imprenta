<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function mostrar(){
        return view('User/mostrar', ['users' => User::all()]);
    }

    public function registro_vista(){
        return view('User/registro');
    }

    public function registro(Request $request){
        $nombre = $request->input('nombre');
        $email = $request->input('email');
        $password = $request->input('password');

        User::create([
            'name' => $nombre,
            'email'=> $email,
            'password' => Hash::make($password)
        ]);

        return redirect()->route('user.mostrar')->with('exito', 'Usuario registrado');

    }

    public function actualizar(Request $req, $id){
        $name = $req->input('nombre');
        

        $user = User::find($id);
        $user->name = $name;
        $user->update;

        return redirect()->route('user.mostrar');

    }
    public function actualizar_vista($id)
    {
        $user = User::where('id', '=', $id)->get();
        
        return view('User/actualizar', [
            'user' => $user[0]
        ]);
    }

    public function eliminar($id){
        $user = User::find($id);
        
        $user->delete();
        return redirect()->route('user.mostrar');

    }
}
