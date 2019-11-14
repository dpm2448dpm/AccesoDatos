<form class="mt-3" method="POST" action="altaproducto.php" enctype="multipart/form-data" id="altaproducto">
  <h2>Alta de Productos</h2>

  <?php
session_start();
if(isset($_SESSION['admin'])){
  if($_SESSION['admin']==TRUE){

  

  include "conexion.php";

  $query1 = $mysqli->query("select referencia from producto order by referencia desc");

  if ($mysqli->affected_rows != 0) {
    $resul1 = $query1->fetch_assoc();
    $referencia = $resul1['referencia'] + 1;
  } else {
    $referencia = 1;
  }

  echo '<br>
  <h3>Referencia:' . $referencia . '</h3>';
  ?>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="nombre">Nombre del Producto</label>
      <input type="text" class="form-control" id="nombre" name="nombre" required />
    </div>
    <?php
    $consulta = $mysqli->query("select * from categorias where id_padre is not null");
    ?>
    <div class="form-group col-md-6">
      <label for="inputState">Categoria</label>
      <select name="categoria" id="categoria" class="form-control">
        <option>Seleccione categoria</option>
        <?php

        while ($row2 = $consulta->fetch_assoc()) {

          $categoria_padre = $mysqli->query("select nombre_categoria from categorias where id_categoria =" . $row2['id_padre']);
          $categoria = $categoria_padre->fetch_assoc() ?>

          <option value="<?php echo $row2['id_categoria'] ?>"><?php echo $categoria['nombre_categoria'] . " " . $row2['nombre_categoria'] ?></option>
        <?php } ?>
      </select>
    </div>
    <div class="form-group col-md-6">
      <label for="descripcion">Descripción:</label>
      <textarea class="form-control " id="descripcion" name="descripcion" required></textarea>
    </div>
    <div class="form-group col-md-6">
      <label for="precio">Precio</label>
      <input type="number" class="form-control" id="precio" name="precio" step="any" required />
    </div>
    <div class="form-check m-4">
      <input class="form-check-input" name="oferta" type="checkbox" value="1" id="oferta" />
      <label class="form-check-label" for="oferta">
        Oferta
      </label>
    </div>
    <div class="form-check m-4">
      <input class="form-check-input" name="novedad" type="checkbox" value="1" id="novedad" />
      <label class="form-check-label" for="novedad">
        Novedad
      </label>
    </div>
    <div class="form-group" id="p_oferta" style="display:none">
      <label for="precio_oferta">Precio Oferta</label>
      <input type="number" step="any" class="form-control" id="precio_oferta" name="precio_oferta" placeholder="" />
    </div>
    <div class="form-group">
      <label for="direccion">Fecha Fabricación</label>
      <input type="date" class="form-control" id="fecha" name="fecha" placeholder="dd/mm/aaaa" />
    </div>

    <div class="form-group col-md-6">
      <label for="stock">Stock</label>
      <input type="number" name="stock" class="form-control" id="stock" required />
    </div>
    <div class="form-group ml-4">

      <div class="card-body">
        <input type="file" class="btn btn-info" id="imgInp" name="file" />
        <img id="imagen" src="#" alt="your image" name="img" class="card-img-top size-img ml-4 mt-4" alt="" />
        <script src="js/preview.js"></script>
      </div>
    </div>
  </div>

  <input type="submit" class="btn btn-info" name="Enviar" value="Guardar Producto">
</form>
<script>
$("#oferta").change(function(){
  if($("#oferta").is(":checked")){
    $("#p_oferta").css("display","block");
  }else{
    $("#p_oferta").css("display","none");
  }
});
</script>
<?php


if ($_POST) {

  //tratamiento imagen

  if (isset($_POST['Enviar']) && !empty($_FILES['file']['name'])) {
    $fileName = strtolower($_FILES['file']['name']);
    if (move_uploaded_file($_FILES['file']['tmp_name'], "upload/" . $fileName)) {
      echo 'Archivo subido correctamente.';
    } else {
      echo 'Ocurrió algunos problemas. Inténtelo más tarde.';
    }
  }
  //recortar imagen

  $file = "upload/$fileName";
  $source_properties = getimagesize($file);
  $image_type = $source_properties[2];
  if ($image_type == IMAGETYPE_JPEG) {
    $image_resource_id = imagecreatefromjpeg($file);
  } elseif ($image_type == IMAGETYPE_GIF) {
    $image_resource_id = imagecreatefromgif($file);
  } elseif ($image_type == IMAGETYPE_PNG) {
    $image_resource_id = imagecreatefrompng($file);
  }

  $target_width = 250;
  $target_height = 250;
  $target_layer = imagecreatetruecolor($target_width, $target_height);

  imagecopyresampled($target_layer, $image_resource_id, 0, 0, 0, 0, $target_width, $target_height, $source_properties[0], $source_properties[1]);

  imagejpeg($target_layer, "upload/$fileName");


  //base de datos

  $nombre = $_POST['nombre'];
  $descripcion = $_POST['descripcion'];
  $precio = $_POST['precio'];
  $stock = $_POST['stock'];
  $categoria = $_POST['categoria'];
  $fabricacion = date('Y/m/d',  $_POST['fecha']);
  $actual = date('Y/m/d', time());
  $percio_oferta = $_POST['precio_oferta'];

  if (isset($_POST['oferta']) && $_POST['oferta'] == 1) {
    $oferta = TRUE;
  } else {
    $oferta = FALSE;
  }

  if (isset($_POST['novedad']) && $_POST['novedad'] == 1) {
    $novedad =  TRUE;
  } else {
    $novedad = FALSE;
  }
  $imagen = strval($fileName);
  $id_categoria = $_POST['categoria'];
  echo $imagen;


  $mysqli->query("insert into producto values ('" . $referencia . "','" . $nombre . "','" . $stock . "','" . $precio . "','" . $oferta . "','" . $novedad . "','" . $actual . "','" . $fabricacion . "','" . $descripcion . "','" . $imagen . "'," . $categoria . "," . $percio_oferta . ")");
  header('location: http://localhost/DarioPerezMartinPHP/index.php?registro=2');
}
  }else{
    echo "No puede acceder a este sitio sin ser administrador";
  }

}else{
  echo "No puede acceder a este sitio sin ser administrador";
}

?>