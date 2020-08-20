<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class UsersController extends Controller
{
    public function mostrar(){
        return view('User/mostrar', ['users' => User::all()]);
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
