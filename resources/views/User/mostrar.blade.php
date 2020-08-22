@extends('adminlte::page')

@section('title', 'Ventas')

@section('content_header')
    <h1 class="m-0 text-dark">Usuarios</h1>
@stop

@section('content')
<hr>


@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('exito') }}
    </div>
@endif


  <a href="{{route('user.registro.vista')}}" class="btn btn-success">Nuevo</a>

<br>
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nombre</th>
        
      </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <th scope="row">{{$user->id}}</th>
            <td>{{$user->name}}</td>

         <td>
            <a class="btn btn-success" href="{{route('user.actualizar.vista', $user->id)}}" class="">Actualizar</a>
            <a class="btn btn-danger" href="{{route('user.eliminar', $user->id)}}" class="">Borrar</i></a>

         </td>
           
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection