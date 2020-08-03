@extends('adminlte::page')

@section('title', 'Detalles')

@section('content_header')
    <h1 class="m-0 text-dark">Detalles</h1>
@stop

@section('content')
<hr>


@if(session()->has('exito'))
    <div class="alert alert-success">
        {{ session()->get('exito') }}
    </div>
@endif
<div class="row">
        <div class="col-sm-4">
        <a class="btn btn-success" href="{{route('pedidos.pdf', $pedido_id)}}" >Descargar detalles</a>
        </div>
    </div>

<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col"># Pedido</th>
        <th scope="col">Material</th>
        <th scope="col">Cantidad</th>
        <th scope="col">Precio</th>
        <th scope="col">Fecha</th>

      </tr>
    </thead>
    <tbody>
        @foreach($detalles as $detalle)
        <tr>
            <th scope="row">{{$detalle->id}}</th>
            <td>{{$detalle->nombre}}</td>
            <td>{{$detalle->cantidad}}</td>
            <td>${{$detalle->precio}}</td>
            <td>{{$detalle->created_at}}</td>
           
        </tr>
      @endforeach
        </form>
    </tbody>
  </table>
@endsection