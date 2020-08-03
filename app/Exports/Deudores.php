<?php

namespace App\Exports;

use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Cuentas;

class Deudores implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

   
    public function headings(): array
    {
        return [
            'Id',
            'Nombre',
            'Deuda',
        ];
    }

    public function collection()
    {
        $cuentas = Cuentas::join('clientes', 'clientes.id', '=', 'cuentas.cliente_id')
        ->select('clientes.id', 'clientes.name', 'cuentas.deuda')
        ->where('cuentas.deuda', '>', 0)
        ->orderby('cuentas.deuda','DESC')
        ->get();

         return $cuentas;
        
    }
}
?>

​