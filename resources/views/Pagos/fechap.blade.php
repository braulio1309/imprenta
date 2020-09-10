@extends('adminlte::page')

@section('title', 'Pagos')

@section('content_header')
    <h1 class="m-0 text-dark">Fechas</h1>
@stop


@section('content')

<div class="container">
    <div class="col">
        <div class="card">
            
            
            <form action="{{route('pagos.particular')}}" method="POST" enctype="multipart/form-data">
                    @csrf
            <div class="card">

        
                <div class="card-body">
                    <h2 class="text-center">Elegir fecha para reporte</h2>
                    <hr>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label> Fecha Inicial </label>
                                <input type="date" name="fecha" class="form-control" required>

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

