
<?php 
include 'conexion.php';
$consulta = $mysqli -> query("select * from producto where cantidad_devueltos not in (0) ORDER BY rand() limit 3 ");
?>
<div class="card mt-4  mb-3 bg-black">
 <div class="card-header bg-info">
   <h4 class="letras-blancas">B-STOCK</h4>
 </div>
 <ul class="list-group list-group-flush">
   <?php 
   while($resultado = $consulta -> fetch_assoc()){
     ?>
      <li class="list-group-item bg-secondary"><img src="imagenes/<?php echo $resultado['imagen'] ?>" class="pequeña">  <?php echo $resultado['nombre']; ?> </li>
     <?php
   }
   ?>
 </ul>
</div>