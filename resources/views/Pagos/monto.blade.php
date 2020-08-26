@extends('adminlte::page')

@section('title', 'Producto')

@section('content_header')
    <h1 class="m-0 text-dark">Verifique los datos del cliente</h1>
@stop


@section('content')

<div class="container card">
    <div class="car-body">

    
    <h2 class="text-center">Verifique los datos del cliente</h2>
    <hr>
    <div class="row">
        <div class="col-sm-6">
            <input class="form-control" type="text" value="{{$cliente->name}}" readonly>
        </div>
        <div class="col-sm-6">
            <input class="form-control" type="text" value="{{$cliente->email}}" readonly>
        </div>
    </div>
    <form action="{{route('pagos.pago',$cliente->id)}}" method="POST" enctype="multipart/form-data">   
    <div class="row">
            
            <div class="col-sm-6">
                
                <label>Monto a cancelar</label>
                <input type="number" min="0" max="{{$cliente->deuda}}"class="form-control" name="monto" placeholder="1234" >
            </div>

            <div class="col-sm-6">
                
                <label>Deuda total</label>
                <input type="number" class="form-control"  value="{{$cliente->deuda}}" readonly >
            </div>
      

    </div>
    <br>
</div>
</div>
<input type="submit" class="btn btn-success" value="Pagar">

</form>
@endsection

