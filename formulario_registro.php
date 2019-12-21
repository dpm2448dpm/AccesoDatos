<?php
include 'conexion.php';
$query = "select * from provincias order by provincia asc";
$resultado = $mysqli->query($query);

?>
<script src="js/codigoAjax.js"></script>

<form class="mt-3" method="post" action="">
 
  <h2>Alta Cliente</h2>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="user">Usuario</label>
      <input type="text" class="form-control" id="user" name="user" placeholder="User">
    </div><br>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Contraseña</label>
      <input type="password" class="form-control" name="pass1" id="pass1" placeholder="Contraseña">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Repita Contraseña</label>
      <input type="password" class="form-control" name="pass2" id="pass2" placeholder="Contraseña">
    </div>
    <div class="form-grop col-md-6"></div>
    <div class="form-group col-md-6">
      <label for="nif">NIF</label>
      <input type="number" class="form-control" name="numerodni" id="nif" placeholder="">
    </div>
    <div class="form-group col-md-1">
      <label for="nif">Letra</label>
      <input type="text" class="form-control" readonly="readonly" name="letradni" id="letra" placeholder="">
    </div>
    <div class="form-group col-md-12">
      <label for="nombre">.......................................................................................................................................................................................................................................................</label>

    </div>
    <div class="form-group col-md-6">
      <label for="nombre">Nombre</label>
      <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre">
    </div>
    <div class="form-group col-md-6">
      <label for="apellido1">Primer Apellido</label>
      <input type="text" class="form-control" name="apel1" id="apellido1" placeholder="Apellido">
    </div>
    <div class="form-group col-md-6">
      <label for="apellido2">Segundo Apellido</label>
      <input type="text" class="form-control" name="apel2" id="apellido2" placeholder="Apellido">
    </div>
    <div class="form-group col-md-6">
      <label for="email">Email</label>
      <input type="email" class="form-control" name="email" id="email" placeholder="Email">
    </div>


    <div class="form-group col-md-4">
      <label for="fecha">Fecha de Nacimiento</label>
      <input type="date" class="form-control" name="fecha" id="fecha" placeholder="dd/mm/aaaa">
    </div>

    <div class="form-group col-md-6">
      <label for="direccion">Dirección</label>
      <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Calle...">
    </div>

    <div class="form-group col-md-4">
      <label for="inputState">Provincia</label>
      <select name="provincia" id="provincia" class="form-control" onChange="return provinciaListOnChange()">
        <option>Seleccione su provincia</option>
        <?php
        while ($row = $resultado->fetch_assoc()) { ?>
          <option value="<?php echo $row['id_provincia'] ?>"><?php echo $row['provincia'] ?></option>
        <?php } ?>
      </select>
    </div>

    <div class="form-group col-md-4">
      <label for="inputCity">Localidad</label>
      <select name="localidad" class="form-control" id="localidad">

      </select>
    </div>
    </div>
    <button type="submit" id="enviar" class="btn btn-info">Regístrate</button>
</form>
<script src="js/funciones.js"></script>


<?php
if (isset($_POST)) {
  $user = $_POST['user'];
  $pass = $_POST['pass1'];
  $dni = $_POST['numerodni'] . $_POST['letradni'];
  $nombre = $_POST['nombre'];
  $apel1 = $_POST['apel1'];
  $apel2 = $_POST['apel2'];
  $email = $_POST['email'];
  $fecha = $_POST['fecha'];
  $direccion = $_POST['direccion'];
  $provincia = $_POST['provincia'];
  $localidad = $_POST['localidad'];

  $insert = "insert into usuarios values ('".$user."','".$pass."','".$dni."','".$nombre."','".$apel1."','".$apel2."','".$email."','".$fecha."','".$direccion."','".$provincia."','".$localidad."',0)";
  $mysqli -> query($insert);
  
}
?>