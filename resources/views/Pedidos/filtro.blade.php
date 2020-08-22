@extends('adminlte::page')

@section('title', 'Pedidos')

@section('content_header')
    <h1 class="m-0 text-dark">Pedidos</h1>
@stop

@section('content')
<hr>

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
        <th scope="col">Nombre Cliente</th>
        <th scope="col">Fecha realizado</th>
        <th scope="col">Monto </th>
        <th scope="col">Estatus </th>
        <th scope="col">Acciones</th>

      </tr>
    </thead>
    <tbody>
        @foreach($pedidos as $pedido)
        <tr>
            <th scope="row">{{$pedido->id}}</th>
            <td>{{$pedido->name}}</td>
            <td>{{$pedido->created_at}}</td>
            <td>${{$pedido->monto}}</td>
            <td>{{$pedido->estatus}}</td>

         <td>
            <a href="{{route('pedidos.detalle.mostrar', $pedido->id)}}" class="btn btn-primary">Detalles</a>
          <a href="{{route('pagos.pagar.pedido', $pedido->id)}}" class="btn btn-success">Pagar</a>
            
         </td>
           
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection