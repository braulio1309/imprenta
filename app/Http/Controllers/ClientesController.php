<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Clientes;
use App\Cuentas;

class ClientesController extends Controller
{

    public function registro_vista()
    {
        return view('Clientes/registro');
    }

    public function registro(Request $request)
    {
        $name       = $request->input('name');
        $telefono   = $request->input('telefono');
        $domicilio  = $request->input('domicilio');
        $piso       = $request->input('piso');
        $postal     = $request->input('postal');
        $email      = $request->input('email');
        $provincia  = $request->input('provincia');
        $localidad  = $request->input('localidad');
        $departamento= $request->input('departamento');


        $validar = \Validator::make($request->all(), [
            'email'         => 'required|unique:clientes,email',
        ]);

        

        $cliente = Clientes::create([
            'name'          => $name,
            'telefono'      => $telefono,
            'email'         => $email,
            'provincia'     => $provincia,
            'localidad'     => $localidad,
            'piso'          => $piso,
            'postal'        => $postal,
            'departamento'  => $departamento,
            'domicilio'     => $domicilio    

        ]);

        Cuentas::create([
            'cliente_id'  => $cliente->id,
            'deuda'       => 0, 
            
        ]);

        return redirect()->route('clientes.mostrar')->with('exito', 'Registro exitoso');

 
    }

    public function actualizar_vista($id)
    {
        $cliente = Clientes::where('id', '=', $id)->get();
        
        return view('Clientes/actualizar', [
            'cliente' => $cliente[0]
        ]);
    }

    public function actualizar(Request $request, $id)
    {
        $name       = $request->input('name');
        $telefono   = $request->input('telefono');
        $domicilio  = $request->input('domicilio');
        $piso       = $request->input('piso');
        $postal     = $request->input('postal');
        $email      = $request->input('email');
        $provincia  = $request->input('provincia');
        $localidad  = $request->input('localidad');
        $departamento= $request->input('departamento');


        $validar = \Validator::make($request->all(), [
            'email'         => 'required|unique:clientes,email',
        ]);
        $cliente = Clientes::where('id', '=', $id)->first();;

        $cliente->name = $name;
        $cliente->domicilio = $domicilio;
        $cliente->piso = $piso;
        $cliente->postal = $postal;
        $cliente->email = $email;
        $cliente->localidad = $localidad;
        $cliente->telefono = $telefono;
        $cliente->departamento = $departamento;
        $cliente->save();

        return redirect()->route('clientes.mostrar')->with('exito', 'Actualización exitosa');

    }

    public function AllClientes()
    {
        $clientes = DB::table('clientes')->orderby('created_at','DESC')->get();
        
        return view('Clientes/mostrar', [
            'clientes' => $clientes
        ]);
    }

    public function buscador(Request $request)
    {
        
        $pedidos = Cuentas::join('clientes', 'clientes.id', '=', 'cuentas.cliente_id')
        ->where('clientes.email', 'LIKE', '%'.$request->input('q').'%')
        ->orwhere('clientes.name', 'LIKE', '%'.$request->input('q').'%')
        ->select('clientes.id AS cliente_id', 'clientes.name', 'cuentas.id', 'cuentas.deuda')
        ->orderby('cuentas.created_at','DESC')
        ->distinct()
        ->get();

        return view('Cuentas/mostrar', [
            'cuentas' => $pedidos
        ]);
    }

    
}
