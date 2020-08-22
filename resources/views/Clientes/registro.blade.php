@extends('adminlte::page')

@section('title', 'Producto')

@section('content_header')
    <h1 class="m-0 text-dark">Registre un cliente</h1>
@stop


@section('content')

<div class="container">
    <div class="col">
        <div class="card">
            
            <div class="card-body">
                <form action="{{route('clientes.registro')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h2 class="text-center">Información de contacto</h2>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <label>Documento</label>
                            <select name="tipo_doc" class="form-control">
                                <option value="Cuit">CUIT</option>
                                <option value="DNI">DNI</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label>Número</label>
                            <input type="text" class="form-control" name="numero_doc" placeholder="000000">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label> Email  </label>
                                <input type="text" name="email" autofocus class="form-control" placeholder="email" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label> Teléfono  </label>
                                <input type="text" name="telefono" class="form-control" placeholder="telefono" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label> Nombre </label>
                                <input type="text" name="name" class="form-control" placeholder="Nombre y Apellidos/Nombre Empresa" required>
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
                                <input type="text" name="localidad" class="form-control" placeholder="Localidad" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label> Código Postal </label>
                                <input type="text" name="postal" class="form-control" placeholder="Código Postal" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <label> Domicilio </label>
                            <input type="text" name="Domicilio" class="form-control" placeholder="Domicilio" >
                        </div>

                        <div class="col-sm-2">
                            <label> Número </label>
                            <input type="text" name="numero" class="form-control" placeholder="Número" >
                        </div>

                        <div class="col-sm-2">
                            <label> Depto </label>
                            <input type="text" name="departamento" class="form-control" placeholder="Depto" >
                        </div>

                        <div class="col-sm-2">
                            <label> Piso </label>
                            <input type="text" name="piso" class="form-control" placeholder="Piso" >
                        </div>
                    </div>
                    
<br>
                    <input class="btn btn-success" type="submit" value="Nuevo Cliente">

                
                </div> 
            </div>        
                   

                    
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

