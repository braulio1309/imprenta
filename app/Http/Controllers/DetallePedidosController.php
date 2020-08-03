<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Charts\materiales;
use App\Exports\MaterialesPrecio;
use App\Exports\MaterialesCantidad;

use Maatwebsite\Excel\Facades\Excel;


class DetallePedidosController extends Controller
{
    public function detalle($id)
    {
        
        $detalles = DB::table('detalle_pedidos')
        ->where('detalle_pedidos.pedido_id', '=', $id)
        ->join('materiales', 'detalle_pedidos.material_id','=', 'materiales.id')
        ->select('materiales.id', 'materiales.nombre', 'detalle_pedidos.precio', 'detalle_pedidos.cantidad', 'detalle_pedidos.created_at')
        ->orderby('detalle_pedidos.created_at','DESC')->get();
        
        return view('Detalles/mostrar', [
            'detalles' => $detalles,
            'pedido_id'=> $id
        ]);
    }

    public function ReporteMaterialVista()
    {
        return view('Reportes/fechasMaterial');
    }

    public function ReporteMaterialPrecio($fecha_inicio, $fecha_fin)
    {
        return Excel::download(new MaterialesPrecio($fecha_inicio, $fecha_fin), 'MaterialesPrecio.XLSX');

    }

    public function ReporteMaterialCantidad($fecha_inicio, $fecha_fin)
    {
        return Excel::download(new MaterialesCantidad($fecha_inicio, $fecha_fin), 'MaterialesCantidad.xlsx');

    }

    public function ReporteMaterial(Request $request)
    {

        $fecha_inicio = $request->input('fecha_inicio');
        $fecha_fin = $request->input('fecha_fin');

        // Instanciamos el objeto gráfico 
        $chart = new materiales();
                            
        $chart->title("Material Vendido", 18); // titulo y tamaño
        $registros = DB::table('detalle_pedidos')
            ->join('materiales', 'materiales.id', '=', 'detalle_pedidos.material_id')
            ->select('detalle_pedidos.id', 'materiales.nombre', 'detalle_pedidos.cantidad')
            ->groupBy('materiales.id')
            ->where('detalle_pedidos.created_at', '>=', $fecha_inicio)
            ->where('detalle_pedidos.created_at', '<=', $fecha_fin)
            ->selectRaw('sum(detalle_pedidos.cantidad) as cantidad' )
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


        // Instanciamos 2
       $grafico = new materiales();
        $ingresoTotal = 0;                  
        $grafico->title("Ingresos", 18); // titulo y tamaño
        $registros = DB::table('detalle_pedidos')
            ->join('materiales', 'materiales.id', '=', 'detalle_pedidos.material_id')
            ->select('detalle_pedidos.id', 'materiales.nombre', 'detalle_pedidos.cantidad')
            ->groupBy('materiales.id')
            ->where('detalle_pedidos.created_at', '>=', $fecha_inicio)
            ->where('detalle_pedidos.created_at', '<=', $fecha_fin)
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
        foreach ($registros as $registro) 
        {
            if ($cont == 5){
                $cont = 0;
            }
            $labels->push($registro->nombre);
            $valores->push($registro->cantidad);
            $coloresFondo->push($colores[$cont]);
            $cont++;
            $ingresoTotal += $registro->cantidad;
        }

        $grafico->labels($labels);
        $dataset = $grafico->dataset('Conjunto', 'doughnut', $valores); // ‘pie’ es el tipo de gráfico
        $dataset->backgroundColor($coloresFondo);


        return view('Reportes/materiales', [
            'chart'     => $chart,
            'grafico'   => $grafico,
            'ingreso'   => $ingresoTotal,
            'cantidad'  => $cantidadTotal,
            'fecha_inicio' => $fecha_inicio,
            'fecha_fin'    => $fecha_fin
        ]);
    }
}
