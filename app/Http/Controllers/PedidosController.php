<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Cuentas;
//use App\Materiales;
use App\Pedidos;
use App\DetallePedidos;
use App\Charts\materiales;

class PedidosController extends Controller
{
    public function pedidos($id)
    {
        $pedidos = DB::table('pedidos')
        ->where('pedidos.cuenta_id', '=', $id)
        ->join('detalle_pedidos', 'pedidos.id', '=', 'detalle_pedidos.pedido_id')
        ->groupBy('pedidos.id')
        ->select('pedidos.id', 'pedidos.created_at', 'pedidos.updated_at', 'pedidos.estatus')
        ->selectRaw('sum(detalle_pedidos.precio) as monto' )
        ->orderby('pedidos.created_at','DESC')
        ->get();
        
        return view('Pedidos/mostrar', [
            'pedidos' => $pedidos,
            'cuenta_id' => $id
        ]);
    }

    public function registro($cuenta_id)
    {
        $materiales = DB::table('materiales')->get();

        return view('Detalles/registro', [
            'materiales' => $materiales,
            'cuenta_id'  => $cuenta_id
        ]);
    }

    public function new_registro(Request $request,$cuenta_id)
    {
        $materiales    = $request->input('material');
        $ancho       = $request->input('ancho');
        $largo       = $request->input('largo');
        $unidades = $request->input('unidades');
        $i = 0;

        $pedido = Pedidos::create([
            'cuenta_id' => $cuenta_id,
            'estatus'     => 'Pendiente'
        ]);
        
        $acumulador = 0;
        foreach($materiales as $material)
        {
            $anch = $ancho[$i]/100; 
            $larg = $largo[$i]/100; 

            $mt2 = $anch * $larg;

            $material_precio = DB::table('materiales')->where('id', '=', $material)->get();
            $material_precio = $material_precio[0];

            $precio_final = $mt2*$material_precio->precio*$unidades[$i];
            $acumulador += $precio_final;
          
            DetallePedidos::Create([
                'pedido_id'     => $pedido->id,
                'material_id'   => $material,
                'precio'        => $precio_final,
                'ancho'         => $ancho[$i],
                'largo'         => $largo[$i],
                'cantidad'      => $mt2*$unidades[$i],
                'unidades'      => $unidades[$i]
            ]);

            $i++;
        }
       
        $cuenta = Cuentas::where('id', '=', $cuenta_id)->first();
        
        $cuenta->deuda = $cuenta->deuda + $acumulador;
        $cuenta->save();

        return redirect()->route('pedidos.detalle.mostrar', $pedido->id);

    }

    public function pendientes($id)
    {
        $pedidos = Pedidos::where('estatus', '=', 'Pendiente')
        ->where('cliente_id', '=', $id)
        ->get();

         
    }

    public function PedidosFecha()
    {
        return view('Reportes/fechaspedidos');
    }

    public function PedidosFechaReporte(Request $request)
    {
        $fecha_inicio = $request->input('fecha_inicio');
        $fecha_fin = $request->input('fecha_fin');

        // Instanciamos el objeto gráfico 
        $chart = new materiales();
                            
        $chart->title("Estatus monetario de pedidos", 18); // titulo y tamaño
        $registros = DB::table('pedidos')
            ->join('detalle_pedidos', 'pedidos.id', '=', 'detalle_pedidos.pedido_id')
            ->select('detalle_pedidos.id', 'pedidos.estatus AS nombre','detalle_pedidos.cantidad')
            ->groupBy('pedidos.estatus')
            ->where('pedidos.created_at', '>=', $fecha_inicio)
            ->where('pedidos.created_at', '<=', $fecha_fin)
            ->selectRaw('sum(detalle_pedidos.precio) as cantidad' )
            ->get();
        
        $labels = collect();
        $valores = collect();
        $coloresFondo = collect();
        $totales = collect();

        $cont = 0;
        $colores = [
            'blue',
            'pink',
            'yellow',
            'red',
            'green',
            'black',
            
        ];
        $cantidadTotal = 0;
        foreach ($registros as $registro) 
        {
            if ($cont == 5){
                $cont = 0;
            }
            $labels->push($registro->nombre);
            $valores->push($registro->cantidad);
            $coloresFondo->push($colores[$cont]);
            $cont++;
            $cantidadTotal += $registro->cantidad;
        }

        $chart->labels($labels);
        $dataset = $chart->dataset('Conjunto', 'doughnut', $valores); // ‘pie’ es el tipo de gráfico
        $dataset->backgroundColor($coloresFondo);

        // Instanciamos el objeto gráfico 
        $grafico = new materiales();
                            
        $grafico->title("Estatus de pedidos", 18); // titulo y tamaño
        $registros = DB::table('pedidos')
            ->select('pedidos.id', 'pedidos.estatus AS nombre')
            ->groupBy('pedidos.estatus')
            ->where('pedidos.created_at', '>=', $fecha_inicio)
            ->where('pedidos.created_at', '<=', $fecha_fin)
            ->selectRaw('count(pedidos.id) as cantidad' )
            ->get();
        
        $labels = collect();
        $valores = collect();
        $coloresFondo = collect();
        $totales = collect();

        $cont = 0;
        $colores = [
            'blue',
            'pink',
            'yellow',
            'red',
            'green',
            'black',
            
        ];
        $cantidadTotal = 0;
        foreach ($registros as $registro) 
        {
            if ($cont == 5){
                $cont = 0;
            }
            $labels->push($registro->nombre);
            $valores->push($registro->cantidad);
            $coloresFondo->push($colores[$cont]);
            $cont++;
            $cantidadTotal += $registro->cantidad;
        }

        $grafico->labels($labels);
        $dataset = $grafico->dataset('Conjunto', 'doughnut', $valores); // ‘pie’ es el tipo de gráfico
        $dataset->backgroundColor($coloresFondo);

        return view('Reportes/pedidos', [
            'chart' => $chart,
            'grafico' => $grafico
        ]);

    }

    public function imprimir($id){
        
        $pedido = Pedidos::where('pedidos.id', '=', $id)
        ->join('cuentas', 'cuentas.id', '=', 'pedidos.cuenta_id')
        ->join('clientes', 'clientes.id', '=', 'cuentas.cliente_id')
        ->select('clientes.name', 'pedidos.created_at', 'pedidos.estatus')
        ->get();

        $detalle = DB::table('detalle_pedidos')
        ->where('detalle_pedidos.pedido_id', '=', $id)
        ->join('materiales', 'detalle_pedidos.material_id','=', 'materiales.id')
        ->select('materiales.id', 'materiales.nombre', 'detalle_pedidos.precio', 'detalle_pedidos.cantidad', 'detalle_pedidos.created_at', 'detalle_pedidos.ancho', 'detalle_pedidos.largo', 'detalle_pedidos.unidades')
        ->orderby('detalle_pedidos.created_at','DESC')->get();
        
        $pdf = \PDF::loadView('pdf', ['pedido' => $pedido[0], 'detalles' => $detalle, 'acu' => 0]);
        return $pdf->download('pedido.pdf');
      }

      public function eliminar($id){
        $pedidos = DB::table('pedidos')
        ->where('pedidos.id', '=', $id)
        ->join('detalle_pedidos', 'pedidos.id', '=', 'detalle_pedidos.pedido_id')
        ->groupBy('pedidos.id')
        ->select('detalle_pedidos.id AS detalle_id', 'pedidos.id', 'pedidos.created_at', 'pedidos.updated_at', 'pedidos.estatus', 'pedidos.cuenta_id')
        ->selectRaw('sum(detalle_pedidos.precio) as monto' )
        ->orderby('pedidos.created_at','DESC')
        ->get();

        $monto = $pedidos[0]->monto;
        foreach($pedidos as $pedido){
           
            $detalle = DB::table('detalle_pedidos')->where('id', '=', $pedido->detalle_id)->first();
            $detalle = $detalle[0];
            $detalle->delete();
        }
        $cuentas = Cuentas::where('id', '=', $pedidos[0]->cuenta_id)->first();
        $cuenta = $cuenta[0];

        $cuenta->deuda -= $pedidos[0]->monto;

        return redirect()->route('pedidos.mostrar');
      }
}
