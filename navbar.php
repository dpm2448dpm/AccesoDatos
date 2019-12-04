<?php
session_start();
include 'conexion.php';
if (isset($_SESSION['productos'])) {
  $_SESSION['cantidad'] = sizeof($_SESSION['productos']);
  foreach ($_SESSION['productos'] as $prod) {
    $consulta_total = $mysqli->query("Select * from producto where referencia = $prod");
    $datos = $consulta_total->fetch_assoc();
    $total += $datos['precio'];
  }
  $_SESSION['precio'] = $total;
}

?>
<nav class="navbar navbar-dark bg-black">
  <a class="navbar-brand" href="http://localhost/AccesoDatos/index.php">
    <img src="imagenes/tienda.jpg" width="40" height="40" class="d-inline-block align-top" alt="" />
    MCStore
  </a>
  <div class=" navbar">
    <a href="" class="nav-item nav-link">Contacto</a>
    <a href="" class="nav-item nav-link">Devoluciones </a>
    <a href="" class="nav-item nav-link">Información</a>
    <a class="navbar-brand ml-2" href="#">
      <img src="carrito.png" width="25" height="25" class="d-inline-block align-top" alt="" />
    </a>
    <a href="" class="nav-item nav-link">UDS: <strong id="unidades"><?php echo $_SESSION['cantidad']; ?></strong></a>
    <a href="" class="nav-item nav-link letras-blancas"><strong id="precio"><?php echo $_SESSION['precio']; ?></strong>€</a>
    <a href="index.php?registro=3" class="nav-item nav-link">Detalle</a>
    <button id="vaciar" class="btn btn-outline-info my-2 my-sm-0">Vaciar</button>

  </div>

  <form class="form-inline my-2 my-lg-0">
    <input id="cuadro_busqueda" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" autocomplete = "off" />
    <input id="buscar" class="btn btn-outline-info my-2 my-sm-0" type="button" value="Buscar">
    <div id="sugerencias" class="bg-light">
     
    </div>
  </form>

</nav>
<script>
  /*$('button').click(function(e) {
    e.preventDefault();
    $.post("validacion.php", null, function(datos) {

      array = datos.split(",");
      $.each(array, function(v, i) {
        alert(v + " - " + i);
      });

    });
  });*/
  $("#buscar").click(function(e) {
    if ($('#cuadro_busqueda').val() == "") {
      alert("No hay nada escrito");
    } else {
      var buscar = $('#cuadro_busqueda').val();
      window.location.href = "index.php?categoria=busqueda&valor=" + buscar;
    }
  });


  $("#cuadro_busqueda").on("keyup", function() {

    if ($(this).val().length == 0) {
      $('#sugerencias').hide();
    } else {
      var valor = $(this).val();
      var datos = {
        'valor':valor
      }
      $.ajax({
        type: "post",
        url: "sugerenciaBusqueda.php",
        data: datos,
        success: function(response) {
          $("#sugerencias").html(response);
          
        }
      });

      $('#sugerencias').css("display", "block");
    }
  });

  //va a eliminar la sesion en un archivo a parte: si se hace en el mismo da problemas
  $("#vaciar").click(function() {

    var i = {
      "valor": 0
    }
    $.ajax({
      type: 'post',
      data: i,
      url: 'cerrarSession.php',
      success: function(datos) {
        alert(datos);
      }
    });
  });
</script>