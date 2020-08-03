@extends('adminlte::page')

@section('title', 'Ventas')

@section('content_header')
    <h1 class="m-0 text-dark">Materiales</h1>
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
        <a href="{{route('materiales.registro.vista')}}" class="btn btn-success">Nuevo Material</a>
    </div>
</div>


<br>
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nombre</th>
        <th scope="col">Precio</th>
        <th scope="col">Acciones</th>

      </tr>
    </thead>
    <tbody>
        @foreach($materiales as $material)
        <tr>
            <th scope="row">{{$material->id}}</th>
            <td>{{$material->nombre}}</td>
            <td>${{$material->precio}}</td>

         <td>
            <a href="{{route('materiales.actualizar.vista', $material->id)}}" class="btn btn-success">Detalle</a>
         </td>
           
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection