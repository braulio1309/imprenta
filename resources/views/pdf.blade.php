<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        
    

    <!-- CSS only -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

<!-- JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    </head>
    <body>
        <h1 class="text-center">Cliente: {{$pedido->name}}</h1>
        <h2 class="text-center">Fecha realizado: {{$pedido->created_at}}</h2>
        <hr>

    <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col"># Pedido</th>
        <th scope="col">Material</th>
        <th scope="col">Ancho</th>
        <th scope="col">Largo</th>
        <th scope="col">Unidades</th>
        <th scope="col">Cantidad</th>
        <th scope="col">Precio</th>
        <th scope="col">Fecha</th>

      </tr>
    </thead>
    <tbody>
        @foreach($detalles as $detalle)
        <tr>
            <th scope="row">{{$detalle->id}}</th>
            <td>{{$detalle->nombre}}</td>
            <td>{{$detalle->ancho}} mt</td>
            <td>{{$detalle->largo}} mt</td>
            <td>{{$detalle->unidades}} </td>
            <td>{{$detalle->cantidad}}Mt2 </td>
            <td>${{$detalle->precio}}</td>
            <td>{{$detalle->created_at}}</td>
           
        </tr>
        <?php $acu += $detalle->precio; ?>
      @endforeach
        </form>
    </tbody>
  </table>

  <h3>Total: ${{$acu}}</h3>
  <h4>Estatus: {{$pedido->estatus}}</h3>
    </body>
</html>