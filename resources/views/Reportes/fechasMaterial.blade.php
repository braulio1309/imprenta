@extends('adminlte::page')

@section('title', 'Pedidos')

@section('content_header')
    <h1 class="m-0 text-dark">Fechas</h1>
@stop


@section('content')

<div class="container">
    <div class="col">
        <div class="card">
            
            
            <form action="{{route('reporte.material')}}" method="POST" enctype="multipart/form-data">
                    @csrf
            <div class="card">

        
                <div class="card-body">
                    <h2 class="text-center">Rango de fechas del reporte</h2>
                    <hr>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label> Fecha Inicial </label>
                                <input type="date" name="fecha_inicio" class="form-control" placeholder="cm" required>

                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label> Fecha final </label>
                                <input type="date" name="fecha_fin" class="form-control" placeholder="cm" required>
                            </div>
                        </div>
                    </div>
                    <br>
                    <input class="btn btn-success" type="submit" value="Generar Reporte">
                </div> 
            </div>        
                   

                    
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

