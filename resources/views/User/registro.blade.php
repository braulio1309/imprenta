@extends('adminlte::page')

@section('title', 'Producto')

@section('content_header')
    <h1 class="m-0 text-dark">Registre un usuario</h1>
@stop


@section('content')

<div class="container">
    <div class="col">
        <div class="card">
            
            <div class="card-body">
                <form action="{{route('user.registro')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h2 class="text-center">Información de contacto</h2>
                    <hr>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label> Nombre  </label>
                                <input type="text" name="nombre" autofocus class="form-control" placeholder="Nombre y apellido" required>
                            </div>
                        </div> 
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label> Email  </label>
                                <input type="email" name="email" class="form-control" placeholder="Ejemplo@ejemplo.com" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label> Contraseña </label>
                                <input type="password" name="password" class="form-control" placeholder="****" required>
                            </div>
                        </div>
                    </div>
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

