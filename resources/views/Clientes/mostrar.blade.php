@extends('adminlte::page')

@section('title', 'Ventas')

@section('content_header')
    <h1 class="m-0 text-dark">Clientes</h1>
@stop

@section('content')
<hr>


@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('exito') }}
    </div>
@endif

<div class="row">
    <div class="col-sm-4">
        <a href="{{route('clientes.registro.vista')}}" class="btn btn-success">Nuevo Cliente</a>
    </div>
</div>


<br>
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nombre</th>
        <th scope="col">Telefono</th>
        <th scope="col">Email</th>
        <th scope="col">Acciones</th>

      </tr>
    </thead>
    <tbody>
        @foreach($clientes as $cliente)
        <tr>
            <th scope="row">{{$cliente->id}}</th>
            <td>{{$cliente->name}}</td>
            <td>{{$cliente->telefono}}</td>
            <td>{{$cliente->email}}</td>

         <td>
            <a href="{{route('clientes.actualizar.vista', $cliente->id)}}" class=""><i class="fa fa-lg fa-list-alt "></i></a>
            <a href="{{route('clientes.eliminar', $cliente->id)}}" class="btn btn-danger">Eliminar</a>
         </td>
           
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection