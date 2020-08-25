<?php

namespace App\Exports;

use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Pagos implements FromCollection,WithHeadings
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

    public function headings(): array
    {
        return [
            'Id',
            'Nombre',
            'Monto',
            'Fecha'
        ];
    }

    public function collection()
    {
        $pagos = DB::table('pagos')
        ->join('clientes', 'clientes.id', '=', 'pagos.cliente_id')
        ->select('pagos.id', 'clientes.name', 'pagos.monto')
        ->where('pagos.created_at', '>=', $this->fecha_inicio)
        ->where('pagos.created_at', '<=', $this->fecha_fin)
        ->orderby('pagos.created_at','DESC')
        ->get();

         return $pagos;
        
    }
}
?>

​