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
        $numero = $request->input('numero');
        $numero_doc = $request->input('numero_doc');
        $tipo_doc = $request->input('tipo_doc');
        

        $validar = \Validator::make($request->all(), [
            'email'         => 'required|unique:clientes,email',
        ]);
        
        $cliente = Clientes::create([
            'name'          => $name,
            'telefono'      => $telefono,
            'tipo_doc'      => $tipo_doc,
            'numero_doc'    => $numero_doc,
            'email'         => $email,
            'provincia'     => $provincia,
            'localidad'     => $localidad,
            'piso'          => $piso,
            'postal'        => $postal,
            'departamento'  => $departamento,
            'domicilio'     => $domicilio ,
            'numero'        => $numero   

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
        $numero = $request->input('numero');
        $numero_doc = $request->input('numero_doc');
        $tipo_doc = $request->input('tipo_doc');


        $validar = \Validator::make($request->all(), [
            'email'         => 'required|unique:clientes,email',
        ]);
        $cliente = Clientes::where('id', '=', $id)->first();

        $cliente->name      = $name;
        $cliente->domicilio = $domicilio;
        $cliente->piso      = $piso;
        $cliente->postal    = $postal;
        $cliente->email     = $email;
        $cliente->localidad = $localidad;
        $cliente->telefono  = $telefono;
        $cliente->numero    = $numero;
        $cliente->departamento = $departamento;
        $cliente->numero_doc = $numero_doc;
        $cliente->tipo_doc = $tipo_doc;

        $cliente->save();

        return redirect()->route('clientes.mostrar')->with('exito', 'Actualización exitosa');

    }

    public function AllClientes()
    {
        $clientes = DB::table('clientes')
        ->where('estado', '=', null )
        ->orderby('created_at','DESC')->get();
        
        return view('Clientes/mostrar', [
            'clientes' => $clientes
        ]);
    }

    public function buscador(Request $request)
    {
        $consulta = $request->input('q');
        if($consulta[0] == 'p' || $consulta[0] == 'P'){
            $consulta = substr($request->input('q'), 1);
           
            $pedidos = Cuentas::join('clientes', 'clientes.id', '=', 'cuentas.cliente_id')
            ->join('pedidos', 'pedidos.cuenta_id', '=', 'cuentas.id')
            ->join('detalle_pedidos', 'detalle_pedidos.pedido_id', '=', 'pedidos.id')
            ->where('clientes.email', 'LIKE', '%'.$consulta.'%')
            ->orwhere('clientes.name', 'LIKE', '%'.$consulta.'%')
            ->orWhere('pedidos.created_at', '=', $consulta)
            ->orWhere('pedidos.id', '=', $consulta)
            ->select('pedidos.id AS id', 'clientes.name', DB::raw('SUM(detalle_pedidos.precio) AS monto'), 'pedidos.estatus', 'pedidos.created_at')
            ->groupby('detalle_pedidos.pedido_id')
            ->orderby('pedidos.created_at','DESC')
            
            ->get();

            return view('pedidos/filtro', [
                'pedidos' => $pedidos
            ]);

        }else{
            
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

    public function eliminar($id){
        $cliente = Clientes::where('id', '=', $id)->first();
        //$cliente = $cliente[0];

        $cliente->estado = 'E';
        $cuenta = Cuentas::where('cliente_id', '=', $cliente->id)->first();
        $cuenta->delete();
        $cuenta->save();
        $cliente->save();

        return redirect()->route('clientes.mostrar');
    }

    
}
