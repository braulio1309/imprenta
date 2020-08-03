@extends('adminlte::page')

@section('title', 'Material')

@section('content_header')
    <h1 class="m-0 text-dark">Registre un material nuevo</h1>
@stop


@section('content')

<div class="container">
    <div class="col">
        <div class="card">
            
            <div class="card-body">
                <form action="{{route('materiales.registro')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h2 class="text-center">Información de contacto</h2>
                    <hr>
                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label> Nombre </label>
                                <input type="text" name="nombre" class="form-control"  placeholder="Nombre material" required>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label> Precio </label>
                                <input type="number" name="precio"  class="form-control" placeholder="precio" required>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
                    <input class="btn btn-success" type="submit" value="Nuevo Material">

                

                    
                </form>
    </div>
</div>
    

@endsection

