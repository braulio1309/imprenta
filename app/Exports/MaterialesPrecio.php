<?php

namespace App\Exports;

use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MaterialesPrecio implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public $fecha_inicio;
    public $fecha_fin;

    public function __construct($fecha_inicio, $fecha_fin)
    {
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin    = $fecha_fin;
    }
    /*public function headings(): array
    {
        return [
            'Id',
            'Nombre',
            'Cantidad',
        ];
    }

    public function collection()
    {
         $materiales = DB::table('detalle_pedidos')
         ->join('materiales', 'materiales.id', '=', 'detalle_pedidos.material_id')
         ->select('detalle_pedidos.id', 'materiales.nombre', 'detalle_pedidos.cantidad')
         ->groupBy('materiales.id')
         ->where('detalle_pedidos.created_at', '>=', $this->fecha_inicio)
         ->where('detalle_pedidos.created_at', '<=', $this->fecha_fin)
         ->selectRaw('sum(detalle_pedidos.precio) as cantidad' )
         ->get();
         
         return $materiales;
        
    }*/

    public function headings(): array
    {
        return [
            'Id',
            'Nombre',
            'Cantidad',
        ];
    }

    public function collection()
    {
         $materiales = DB::table('detalle_pedidos')
         ->join('materiales', 'materiales.id', '=', 'detalle_pedidos.material_id')
         ->select('detalle_pedidos.id', 'materiales.nombre', 'detalle_pedidos.cantidad')
         ->groupBy('materiales.id')
         ->where('detalle_pedidos.created_at', '>=', $this->fecha_inicio)
         ->where('detalle_pedidos.created_at', '<=', $this->fecha_fin)
         ->selectRaw('sum(detalle_pedidos.cantidad) as cantidad' )
         ->get();

         return $materiales;
        
    }
}
?>

​