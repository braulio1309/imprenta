@extends('adminlte::page')

@section('title', 'Pagos')

@section('content_header')
<h1 class="m-0 text-dark">Ingreso Total: ${{$total}}</h1>
@stop

@section('content')
<hr>


@if(session()->has('exito'))
    <div class="alert alert-success">
        {{ session()->get('exito') }}
    </div>
@endif

  <a href="{{route('pagos.reporte.excel', ['fecha_inicio' => $fecha_inicio, 'fecha_fin' => $fecha_fin])}}" class="btn btn-success">Descargar pagos</a>
  <br>
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col"># pago</th>
        <th scope="col">Nombre del cliente</th>
        <th scope="col">Monto</th>
        <th scope="col">Fecha</th>

      </tr>
    </thead>
    <tbody>
        @foreach($pagos as $pago)
        <tr>
            <th scope="row">{{$pago->id}}</th>
            <td>{{$pago->name}}</td>
            <td>${{$pago->monto}}</td>
            <td>{{$pago->created_at}}</td>
           
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection