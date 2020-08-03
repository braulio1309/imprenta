@extends('adminlte::page')

@section('title', 'Cuentas')

@section('content_header')
    <h1 class="m-0 text-dark">Cuentas</h1>
@stop

@section('content')
<hr>


@if(session()->has('exito'))
    <div class="alert alert-success">
        {{ session()->get('exito') }}
    </div>
@endif

  <a href="{{route('reporte.deudores')}}" class="btn btn-success">Descargar deudores</a>
  <br>
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col"># Pedido</th>
        <th scope="col">Nombre del cliente</th>
        <th scope="col">Deuda pendiente</th>
        <th scope="col">Acciones</th>

      </tr>
    </thead>
    <tbody>
        @foreach($cuentas as $cuenta)
        <tr>
            <th scope="row">{{$cuenta->id}}</th>
            <td>{{$cuenta->name}}</td>
            <td>${{$cuenta->deuda}}</td>

         <td>
            <a href="{{route('pedidos.pedidos.mostrar', $cuenta->id)}}" class=""><i class="fa fa-lg fa-list-alt"></i></a>
           
            
         </td>
           
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection