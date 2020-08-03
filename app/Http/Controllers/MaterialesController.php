<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Materiales;

class MaterialesController extends Controller
{

    public function registro_vista()
    {
        return view('Materiales/registro');
    }

    public function registro(Request $request)
    {
        $nombre       = $request->input('nombre');
        $precio   = $request->input('precio');        

        $validar = \Validator::make($request->all(), [
            'nombre'         => 'required|unique:materiales,nombre',
        ]);

        Materiales::create([
            'nombre'      => $nombre,
            'precio'      => $precio,
        ]);

        return redirect()->route('materiales.mostrar')->with('exito', 'Registro exitoso');

 
    }

    public function actualizar_vista($id)
    {
        $materiales = Materiales::where('id', '=', $id)->get();
        
        return view('Materiales/actualizar', [
            'material' => $materiales[0]
        ]);
    }

    public function actualizar(Request $request, $id)
    {
        $nombre   = $request->input('name');
        $precio   = $request->input('precio');  

        $validar = \Validator::make($request->all(), [
            'nombre'         => 'required|unique:materiales,nombre',
        ]);

        $materiales = Materiales::where('id', '=', $id)->first();;

        $materiales->nombre = $nombre;
        $materiales->precio = $precio;
        $materiales->save();

        return redirect()->route('materiales.mostrar')->with('exito', 'Actualización exitosa');

    }

    public function AllMateriales()
    {
        $materiales = DB::table('materiales')->orderby('created_at','DESC')->get();
        
        return view('Materiales/mostrar', [
            'materiales' => $materiales
        ]);
    }

    
}
