@extends('adminlte::page')

@section('title', 'Pedidos')

@section('content_header')
    <h1 class="m-0 text-dark">Cuentas</h1>
@stop

@section('content')
<hr>

    <div class="row">
        <div class="col-sm-4">
        <a class="btn btn-success" href="{{route('pedidos.pedidos.registro',$cuenta_id)}}" >Nuevo Pedido</a>
        </div>
    </div>

<br>
@if(session()->has('exito'))
    <div class="alert alert-success">
        {{ session()->get('exito') }}
    </div>
@endif

<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col"># Pedido</th>
        <th scope="col">Fecha realizado</th>
        <th scope="col">Ultima entrada</th>
        <th scope="col">Monto </th>
        <th scope="col">Estatus </th>
        <th scope="col">Acciones</th>

      </tr>
    </thead>
    <tbody>
        @foreach($pedidos as $pedido)
        <tr>
            <th scope="row">{{$pedido->id}}</th>
            <td>{{$pedido->created_at}}</td>
            <td>{{$pedido->created_at}}</td>
            <td>${{$pedido->monto}}</td>
            <td>{{$pedido->estatus}}</td>

         <td>
            <a href="{{route('pedidos.detalle.mostrar', $pedido->id)}}" class="btn btn-primary">Detalles</a>
            
         </td>
           
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection