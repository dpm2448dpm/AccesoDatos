<?php
include 'conexion';
$consulta = $mysqli -> query("SELECT sum(cantidad) as suma, id_producto from linea_pedido GROUP by id_producto order by suma");
$resultado = $consulta->fetch_assoc();
$referencia = $resultado['id_producto'];
$consulta2 = $mysqli -> query("select * from producto where referencia ='".$referencia."'");
$producto = $consulta2 ->fetch_assoc();

?>
<div
class="card w-75 ml-3 mt-3 bg-secondary border-info"
style="width: 18rem;"
> <div class="card-header bg-info">
<h6 class="card-title font-weight-bold text-center letras-blancas" >
  PRODUCTO MÁS VENDIDO
</h6>
</div>


<img src="upload/<?php echo $producto['imagen'] ?>" class="card-img-top" alt="..." />
<div class="card-body text-center">
  
  <h6 class="card-title font-weight-bolder text-center">
    <?php echo $producto['nombre'] ?>
  </h6>
  
</div>
</div>