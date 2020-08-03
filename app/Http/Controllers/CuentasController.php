<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cuentas;
use App\Materiales;
use App\Exports\Deudores;
use Maatwebsite\Excel\Facades\Excel;


class CuentasController extends Controller
{
    public function AllCuentas()
    {
        $cuentas = Cuentas::join('clientes', 'clientes.id', '=', 'cuentas.cliente_id')
        ->select('clientes.id AS cliente_id', 'clientes.name', 'cuentas.id', 'cuentas.deuda')
        ->orderby('cuentas.created_at','DESC')
        ->get();

        return view('Cuentas/mostrar', [
            'cuentas' => $cuentas
        ]);
    }

    public function pendientes()
    {
        $cuentas = Cuentas::join('clientes', 'clientes.id', '=', 'cuentas.cliente_id')
        ->where('deuda', '>', 0)
        ->orderby('cuentas.deuda','DESC')

        ->get();

        return view('Cuentas/mostrar', [
            'cuentas' => $cuentas
        ]);
    }

    public function deudores()
    {
        return Excel::download(new Deudores, 'Deudores.xlsx');

    }


    


}
