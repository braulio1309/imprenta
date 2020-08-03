@extends('adminlte::page')

@section('title', 'Materiales')

@section('content_header')
<h1 class="m-0 text-dark">Materiales más vendidos</h1>

@stop


@section('content')
<div class="container" id="app">
    <div class="row">
        <div class="col-sm-1">
            <a href="{{route('reporte.material.precio',['fecha_inicio' => $fecha_inicio, 'fecha_fin' => $fecha_fin])}}" class="btn btn-success">Ingresos</a>

        </div>

        <div class="col-sm-6">
            <a href="{{route('reporte.material.cantidad',['fecha_inicio' => $fecha_inicio, 'fecha_fin' => $fecha_fin])}}" class="btn btn-success">Metros</a>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            {!! $chart->container() !!}
        </div>
        <h4 class="m-0 text-dark">Total Metros vendidos: {{$cantidad}} mt2</h4>

        <div class="col-sm-12">
            {!! $grafico->container() !!}

        </div>
        <h4 class="m-0 text-dark">Total Ingresos: ${{$ingreso}}</h4>


       
    </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

</div>

{!! $chart->script() !!}
{!! $grafico->script() !!}

@endsection