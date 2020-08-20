@extends('adminlte::page')

@section('title', 'Producto')

@section('content_header')
    <h1 class="m-0 text-dark">Actualice los datos de {{$user->name}}</h1>
@stop


@section('content')

<div class="container">
    <div class="col">
        <div class="card">
            
            <div class="card-body">
                <form action="{{route('user.actualizar', $user->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h2 class="text-center">Información de contacto</h2>
                    <hr>

                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label> Nombre </label>
                                <input type="text" name="nombre" class="form-control" value="{{$user->name}}" placeholder="Nombre y Apellidos/Nombre Empresa" required>
                            </div>
                        </div>
                    </div>
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

