@extends('adminlte::page')

@section('title', 'Pedidos')

@section('content_header')
    <h1 class="m-0 text-dark">Registrar un pedido</h1>
@stop


@section('content')

<div class="container">
    <div class="col">
        <div class="card">
            
            
            <form action="{{route('pedidos.nuevo.registro', $cuenta_id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
            <div class="card">

        
                <div class="card-body">
                    <h2 class="text-center">Realizar Pedido</h2>
                    <hr>
                    <div class="original_div" id="dv">
                        <div class="row ">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label> Materiales </label>
                                    <select name="material[]" class="form-control" >
                                        @foreach($materiales as $material)
                                            <option value="{{$material->id}}">{{$material->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label> Ancho (cm)</label>
                                    <input type="number" name="ancho[]" class="form-control" placeholder="cm" required>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label> Largo (cm)</label>
                                    <input type="number" name="largo[]" class="form-control" placeholder="cm" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                   <div class="container_div">
                        
                        
                           
                        
                    </div>
                
                    <button type="button" class="btn btn-primary" id="btn"> Agregar material</button>
                    <input class="btn btn-success" type="submit" value="Registrar Pedido">
                </div> 
            </div>        
                   

                    
                </form>
            </div>
        </div>
    </div>
</div>
<script
  src="http://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
<script>
    $(function() {
            $('#btn').on('click', function() {
                var div_copy = $('#dv').clone();
                div_copy.children().val("");//para quitar el valor
                $('.container_div').append(div_copy);
            });
        });
        
</script>
@endsection

