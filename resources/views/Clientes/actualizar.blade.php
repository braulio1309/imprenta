@extends('adminlte::page')

@section('title', 'Producto')

@section('content_header')
    <h1 class="m-0 text-dark">Actualice los datos de {{$cliente->name}}</h1>
@stop


@section('content')

<div class="container">
    <div class="col">
        <div class="card">
            
            <div class="card-body">
                <form action="{{route('clientes.actualizar', $cliente->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h2 class="text-center">Información de contacto</h2>
                    <hr>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label> Email  </label>
                                <input type="text" name="email" autofocus class="form-control" value="{{$cliente->email}}" placeholder="email" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label> Teléfono  </label>
                                <input type="text" name="telefono" class="form-control" value="{{$cliente->telefono}}" placeholder="telefono" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label> Nombre </label>
                                <input type="text" name="name" class="form-control" value="{{$cliente->name}}" placeholder="Nombre y Apellidos/Nombre Empresa" required>
                            </div>
                        </div>
                    </div>
                </div> 
        </div>
        <div class="card">

        
                <div class="card-body">
                    <h2 class="text-center">Residencia</h2>
                    <hr>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label> Provincia </label>
                                <select name="provincia" class="form-control" >
                                    <option value="Misiones">Misiones</option>
                                    <option value="Buenos Aires">Buenos Aires</option>
                                    <option value="Cordoba">Cordoba</option>
                                    <option value="Corrientes">Corrientes</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label> Localidad </label>
                                <input type="text" name="localidad" class="form-control" value="{{$cliente->localidad}}" placeholder="Localidad" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label> Código Postal </label>
                                <input type="text" name="postal" class="form-control" value="{{$cliente->postal}}" placeholder="Código Postal" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <label> Domicilio </label>
                            <input type="text" name="domicilio" class="form-control" value="{{$cliente->domicilio}}" placeholder="Domicilio" required>
                        </div>

                        <div class="col-sm-2">
                            <label> Número </label>
                            <input type="text" name="numero" class="form-control" value="{{$cliente->numero}}" placeholder="Número" >
                        </div>

                        <div class="col-sm-2">
                            <label> Depto </label>
                            <input type="text" name="departamento" class="form-control" value="{{$cliente->departamento}}" placeholder="Depto" >
                        </div>

                        <div class="col-sm-2">
                            <label> Piso </label>
                            <input type="text" name="piso" class="form-control" value="{{$cliente->piso}}" placeholder="Piso" >
                        </div>
                    </div>
                    
<br>
                    <input class="btn btn-success" type="submit" value="Actualizar">

                
                </div> 
            </div>        
                   

                    
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

