@extends('adminlte::page')

@section('title', 'Cliente')

@section('content_header')
    <h1 class="m-0 text-dark">Buscar cliente</h1>
@stop


@section('content')
<hr>
@if(session()->has('exito'))
    <div class="alert alert-warning">
        <strong>{{ session()->get('exito') }}</strong>
    </div>
@endif

<form action="{{route('pagos.cliente')}}" method="POST" enctype="multipart/form-data"> 
    <div class="container card">
        
        <div class="car-body">

        
            <h2 class="text-center">Buscar cliente</h2>
            <hr>
            <div class="col-sm-4"></div>
            <div class="col-sm-6">
                
                <label>Número de documento del cliente</label>
                <input type="text" class="form-control" name="doc" placeholder="1234" >
            </div>
            <br>
        </div>
    </div>
<input type="submit" class="btn btn-success" value="Buscar">

</form>
@endsection

