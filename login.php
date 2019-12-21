<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  ?>

  <!--esto va a mostrar el cuadro de loggin si no se ah iniciado sesion sino se mostrara un boton para desloguearte.-->

  <div class="card p-3 mt-2 bg-secondary border-info">
    <form>
      <div class="form-group">
        <label for="exampleInputEmail1">User</label>
        <input type="text" class="form-control" id="user" aria-describedby="emailHelp" autocomplete = "off" placeholder="Enter Username" />
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Contraseña</label>
        <input type="password" class="form-control" autocomplete = "off" id="pass_user" placeholder="Password" />
      </div>
      <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1" />
        <label class="form-check-label" for="exampleCheck1">Recordar</label>
      </div>
      <button id="login" type="submit" class="btn btn-info">Inicie Sesión</button>
      <a href="index.php?registro=1" class="registro"> Registrate</a>
    </form>
  </div>
  <script src="js/logearPersona.js"></script>
  <?php
  } else {
    if (isset($_SESSION['admin'])) {
      ?>
    <div class="card p-3 mt-2 bg-secondary border-info">
      <h4>Bienvenido <?php echo $_SESSION['usuario']; ?></h4>
      <br>
      <a href="index.php?registro=4" class="mb-2"><button id="mispedidos" type="button" class="btn btn-info">Mis pedidos</button></a>
      <a href="index.php?registro=5" class="mb-2"><button id="devoluciones" type="button" class="btn btn-dark">Devoluciones</button></a>
      <a href="index.php?registro=6" class="mb-2"><button id="ultimosPedidos" type="button" class="btn btn-light">Mis Ultimos Pedidos</button></a>
      <a href="index.php?registro=2" class="mb-2"><button id="ultimosPedidos" type="button" class="btn btn-warning">Agregar Productos</button></a>
      <button id="logout" type="submit" class="btn btn-secondary">Cerrar Sesion </button>
    </div>
  <?php
    } else {
      ?>
    <div class="card p-3 mt-2 bg-secondary border-info">
      <h4>Bienvenido <?php echo $_SESSION['usuario']; ?></h4>
      <br>
      <a href="index.php?registro=4" class="mb-2"><button id="mispedidos" type="button" class="btn btn-info">Mis pedidos</button></a>
      <a href="index.php?registro=5" class="mb-2"><button id="devoluciones" type="button" class="btn btn-dark">Devoluciones</button></a>
      <a href="index.php?registro=6" class="mb-2"><button id="ultimosPedidos" type="button" class="btn btn-light">Mis Ultimos Pedidos</button></a>
      <button id="logout" type="submit" class="btn btn-secondary">Cerrar Sesion </button>
    </div>
<?php
  }
}
?>
<script src="js/cerrarSesion.js"></script>