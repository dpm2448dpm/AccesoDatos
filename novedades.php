<?php 
include 'conexion.php';
$resultado = $mysqli ->query("select * from producto where novedad=true ORDER BY rand() limit 1");
$row = $resultado -> fetch_array();
$nombre = $row['nombre'];
$descripcion = $row['descripcion'];
$imagen = $row['imagen'];
?>
<div class="card text-center mt-2 bg-black border-light">
  <div class="card-header bg-info">
    <a class="nav-link active letras-blancas" href="#">
      <h5>NOVEDADES</h5>
    </a>
  </div>
  <div class="card-body">
    <h5 class="card-title letras-blancas"><?php echo $nombre?></h5>
    <img src="imagenes/<?php echo $imagen;?>" class="card-img-top" alt="..." />
    <p class="card-text letras-blancas">
      <?php echo $descripcion;?>
    </p>

  </div>
</div>