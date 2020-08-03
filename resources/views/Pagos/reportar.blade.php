@extends('adminlte::page')

@section('title', 'Producto')

@section('content_header')
    <h1 class="m-0 text-dark">Reportar pago de {{$cliente->name}}</h1>
@stop


@section('content')

<div class="container">
    <div class="col">
        <div class="card">
            
            <div class="card-body">
                <form action="{{route('pagos.registro')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h2 class="text-center">Información de contacto</h2>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">

                            <div style="display:none;"class="form-group">
                                <label> Nombre </label>
                                <input type="text" readonly="readonly" name="cliente_id" class="form-control" value='{{$cliente->id}}' required>
                            </div>
    
                            <div class="form-group">
                                <label> Nombre </label>
                                <input type="text" readonly="readonly" name="name" class="form-control" value='{{$cliente->name}}' required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label> Teléfono  </label>
                                <input type="text" readonly="readonly" value='{{$cliente->telefono}}' name="telefono" class="form-control" placeholder="telefono" required>
                            </div>
                        </div>
                    </div>
                    

                    
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label> Monto pagado  </label>
                            <input type="number"  name="monto" class="form-control" placeholder="Monto pagado" required>
                        </div>
                    </div>

                        
                    </div>
                </div> 
        </div>
        
                    <input class="btn btn-success" type="submit" value="Reportar Pago">

                    
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

