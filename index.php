<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
  <link rel="stylesheet" href="estilos.css" />
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

  <title>Pagina</title>
</head>

<body>
  <?php
  session_start();
  if (!isset($_SESSION['productos'])) {
    $_SESSION['productos'] = [];
  }
  if (!isset($_SESSION['cantidad'])) {
    $_SESSION['cantidad'] = 0;
  }
  if (!isset($_SESSION['precio'])) {
    $_SESSION['precio'] = 0;
  }

  include 'navbar.php';
  ?>

  <div class="container-fluid">
    <div class="row">
      <div class="col-2 bg-dark">
        <?php
        include 'menu.php';
        include 'mas_vendido.php';
        include 'b_stock.php';
        ?>
      </div>
      <div class="col-8 bg-secondary fa-align-center">
        <?php
        if (isset($_GET['registro'])) {
          if ($_GET['registro'] == 1) {
            include 'formulario_registro.php';
          } elseif ($_GET['registro'] == 2) {
            include 'altaproducto.php';
          } elseif ($_GET['registro'] == 3) {
            include 'detalle_compra.php';
          } elseif ($_GET['registro'] == 4) {
            include 'misPedidos.php';
          } elseif ($_GET['registro'] == 5) {
            include 'devoluciones.php';
          } else {
            include 'main.php';
          }
        } else {
          include 'main.php';
        }


        ?>
      </div>
      <div class="col-2 bg-dark">
        <?php
        include 'login.php';
        include 'novedades.php';
        include 'ofertas.php';

        ?>
      </div>
    </div>
  </div>
  <?php
  include 'footer.php';
  ?>
</body>

</html>
<!--modificar para que solo lo tire una vez-->
<?php
if (isset($_SESSION['admin'])) {
?>
<script>
$.alert({
  title: 'Estado Pedidos',
  content: '<input type="text">',
});
</script>
<?php
}
?>