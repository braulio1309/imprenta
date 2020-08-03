@extends('adminlte::page')

@section('title', 'Ingresos')

@section('content_header')
<h1 class="m-0 text-dark">Pagos pendientes y pagados</h1>

@stop


@section('content')
<div class="container" id="app">
    

    <div class="row">
        <div class="col-sm-12">
            {!! $chart->container() !!}
        </div>

        <div class="col-sm-12">
            {!! $grafico->container() !!}

        </div>


       
    </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

</div>

{!! $chart->script() !!}
{!! $grafico->script() !!}

@endsection