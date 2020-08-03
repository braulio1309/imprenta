@extends('adminlte::page')

@section('title', 'Pedidos')

@section('content_header')
    <h1 class="m-0 text-dark">Registrar un pedido</h1>
@stop


@section('content')

<div class="container">
    <div class="col">
        <div class="card">
            
            
            <form action="{{route('pedidos.registro')}}" method="POST" enctype="multipart/form-data">
                    @csrf
            <div class="card">

        
                <div class="card-body">
                    <h2 class="text-center">Realizar Pedido</h2>
                    <hr>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label> Materiales </label>
                                <select name="material" class="form-control" >
                                    @foreach($materiales as $material)
                                        <option value="{{$material->id}}">{{$material->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label> Cantidad (cm) </label>
                                <input type="number" name="centimetros" class="form-control" placeholder="cm" required>
                            </div>
                        </div>
                    </div>
                    <br>
                    <input class="btn btn-success" type="submit" value="Registrar Pedido">
                </div> 
            </div>        
                   

                    
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

