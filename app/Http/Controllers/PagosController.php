<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Exports\PagosE;
use App\Pedidos;
use App\Clientes;
use App\Cuentas;
use App\Pagos;


use Maatwebsite\Excel\Facades\Excel;


class PagosController extends Controller
{
    public function AllPagos()
    {
        $pagos = DB::table('pagos')
        ->join('clientes', 'clientes.id', '=', 'pagos.cliente_id')
        ->select('pagos.id','clientes.name', 'pagos.monto', 'pagos.created_at')
        ->get();

        return view('Pagos/mostrar', [
            'pagos'  => $pagos
        ]);
    }

    public function registro_vista($id)
    {
        $cliente = Clientes::where('id', '=', $id)->get();
       
        return view('Pagos/reportar',[
            'cliente' => $cliente[0]
        ]);
    }

    public function registro(Request $request)
    {
        $cliente_id = $request->input('cliente_id');
        $monto = $request->input('monto');
        DB::table('pagos')->create([
            'cliente_id' => $cliente_id
        ]);
        
        $pedido = Pedidos::where('cliente_id', '=', $id)->first();
        $pedido = $pedido[0];
        $pedido->deuda = $pedido->deuda - $monto;

        return redirect()->route('pagos.mostrar')->with('exito', 'Pago exitoso');
    }

    public function pagos(Request $request)
    {
        $fecha_inicio = $request->input('fecha_inicio');
        $fecha_fin = $request->input('fecha_fin');

        
        $pagos = DB::table('pagos')
        ->join('clientes', 'clientes.id', '=', 'pagos.cliente_id')
        ->select('pagos.id', 'clientes.name', 'pagos.monto', 'pagos.created_at')
        ->where('pagos.created_at', '>=', $fecha_inicio)
        ->where('pagos.created_at', '<=', $fecha_fin)
        ->orderby('pagos.created_at','DESC')
        ->get();

        $pago = DB::table('pagos')
        ->where('pagos.created_at', '>=', $fecha_inicio)
        ->where('pagos.created_at', '<=', $fecha_fin)
        ->selectRaw('sum(pagos.monto) as cantidad' )
        ->get();
        
        
        return view('Pagos/mostrar', [
            'pagos' => $pagos,
            'fecha_inicio' => $fecha_inicio,
            'fecha_fin' => $fecha_fin,
            'total' => $pago[0]->cantidad
        ]);
    }

    public function pagosFecha()
    {
        return view('Pagos/Fecha');
    }

    public function pagosExcel($fecha_inicio, $fecha_fin)
    {
        return Excel::download(new Pagos($fecha_inicio, $fecha_fin), 'Pagos.xlsx');

    }

    public function pagar($pedido_id)
    {
        //var_dump($pedido_id);die();
        $pedido = Pedidos::where('id', '=', $pedido_id)->first();
        $total = DB::table('pedidos')
            ->join('detalle_pedidos', 'pedidos.id', '=', 'detalle_pedidos.pedido_id')
            ->join('cuentas', 'cuentas.id', '=', 'pedidos.cuenta_id')
            ->select('cuentas.cliente_id')
            ->where('pedidos.id', '=', $pedido_id)
            ->selectRaw('sum(detalle_pedidos.precio) as precio' )
            ->get();
        $total = $total[0];

        DB::table('pagos')->insert([
            'cliente_id' => $total->cliente_id,
            'monto'      => $total->precio,
            "created_at" =>  \Carbon\Carbon::now(), 
            "updated_at" => \Carbon\Carbon::now(), 
        ]);

        $pedido->estatus = "Pagado";
        $pedido->save();

        $cuenta = Cuentas::where('cliente_id', '=', $total->cliente_id)->first();
        $cuenta->deuda = $cuenta->deuda - $total->precio;
        $cuenta->save();

        return redirect()->route('pedidos.pedidos.mostrar', $cuenta->id);
    }

    public function cliente_vista(){
        return view('Pagos/cliente');
    }

    public function cliente(Request $req){
        $documento = $req->input('doc');

        $cliente = Clientes::where('numero_doc', '=', $documento)
        ->join('cuentas', 'cuentas.cliente_id', '=', 'clientes.id')
        ->select('clientes.id', 'clientes.name', 'clientes.email', 'cuentas.deuda')->get();

       if(!isset($cliente[0])){
        return redirect()->route('pagos.cliente.vista')->with('exito', 'Cliente inexistente');
       }
        return view('Pagos/monto', [
            'cliente' => $cliente[0],
        ]);
    }

    public function nuevoPago(Request $request, $cliente_id){
        $monto = $request->input('monto');

        Pagos::create([
            'cliente_id' => $cliente_id,
            'monto'      => $monto
        ]);

        $cuenta = Cuentas::where('cliente_id', '=', $cliente_id)->first();
       

        $cuenta->deuda = $cuenta->deuda - $monto;
        $cuenta->save();
        return redirect()->route('pedidos.mostrar')->with('exito', 'Pago exitoso');

    }

    public function recientes(){
        $pagos = Pagos::join('clientes', 'clientes.id', '=', 'pagos.cliente_id')
        ->orderby('id', 'DESC')
        ->select('pagos.id', 'clientes.name', 'pagos.monto', 'pagos.created_at')
        ->get();

        return view('Pagos/recientes', ['pagos' => $pagos]);
    }

    public function fecha(){
        return view('Pagos/fechap');
    }

    public function diario(){
        $today = date('Y-m-d');
        
        $pagos = Pagos::join('clientes', 'clientes.id', '=', 'pagos.cliente_id')
        ->where('pagos.created_at', 'LIKE', $today.'%')
        ->orderby('id', 'DESC')
        ->select('pagos.id', 'clientes.name', 'pagos.monto', 'pagos.created_at' )
        ->get();

        $monto = 0;
       foreach($pagos AS $pago){
           $monto += $pago->monto;
       }
        return view('Pagos/recientes', [
            'pagos' => $pagos,
            'monto' => $monto,
            'fecha' => $today
        ]); 
    }

    public function particular(Request $req){
        
        $fecha = $req->input('fecha');
        
        $pagos = Pagos::join('clientes', 'clientes.id', '=', 'pagos.cliente_id')
        ->where('pagos.created_at', 'LIKE', $fecha.'%')
        ->orderby('id', 'DESC')
        ->select('pagos.id', 'clientes.name', 'pagos.monto', 'pagos.created_at' )
        ->get();

        $monto = 0;
       foreach($pagos AS $pago){
           $monto += $pago->monto;
       }
        return view('Pagos/recientes', [
            'pagos' => $pagos,
            'monto' => $monto,
            'fecha' => $fecha
        ]); 
    }

    public function eliminar($id){
        $pago = Pagos::where('id', '=', $id)->first();
        $pago = $pago[0];

        $cuenta = Cuentas::where('cliente_id', '=', $pago->cliente_id)->first();
        $cuenta = $cuenta[0];

        $cuenta->deuda += $pago->monto;
        
        $pago->delete();

        return redirect()->route('pagos.diario');
    }
}
