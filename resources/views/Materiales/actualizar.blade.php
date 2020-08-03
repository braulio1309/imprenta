@extends('adminlte::page')

@section('title', 'Materiales')

@section('content_header')
    <h1 class="m-0 text-dark">Actualizar información de {{$material->nombre}}</h1>
@stop


@section('content')

<div class="container">
    <div class="col">
        <div class="card">
            
            <div class="card-body">
                <form action="{{route('materiales.actualizar',$material->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h2 class="text-center">Actualizar {{$material->nombre}}</h2>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label> Nombre </label>
                                <input type="text" name="name" class="form-control" value="{{$material->nombre}}" placeholder="Nombre" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label> Precio  </label>
                                <input type="number" name="precio" class="form-control" value="{{$material->precio}}" placeholder="Telefono" required>
                            </div>
                        </div>

                        
                    </div>
                </div>
                <br>
                <input type="submit" class="btn btn-success" value="Actualizar">
        </div>
       

                    
    </form>
            
    </div>
</div>

@endsection

