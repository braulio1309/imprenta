<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Exports\Pagos;
use App\Pedidos;
use App\Clientes;
use App\Cuentas;

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
//var_dump($total->cliente_id);die();
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
}
