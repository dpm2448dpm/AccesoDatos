<div class="card mt-2">
  <div class="card-header bg-info">
    <h4 class="letras-blancas">OFERTAS</h4>
  </div>
  <ul class="list-group list-group-flush">
  <?php
  include 'conexion.php';
  $consulta = $mysqli -> query("select * from producto where oferta=true ORDER BY rand() limit 3 ");
  while($result = $consulta -> fetch_assoc()){
    $porcentaje =100-( $result['precio_oferta']*100/$result['precio']);
    $porcentaje = number_format((float)$porcentaje, 2, '.', '');
    
    ?>
    <li class="list-group-item"><strong><?php echo $porcentaje?>% </strong><?php echo $result['nombre']?><img src="imagenes/<?php echo $result['imagen'] ?>" class="pequeña"> </li>
  
  <?php
  }
  ?>
  </ul>
</div>