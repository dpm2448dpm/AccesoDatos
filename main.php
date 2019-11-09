<table class="productos">

  <?php
  session_start();
  if (isset($_GET['categoria'])) {
    $categoria = $_GET['categoria'];
    include 'conexion.php';
    if ($categoria == "bstock") {
      $consulta = $mysqli->query("select * from producto where cantidad_devueltos not in (0)");
    } else {
      $consulta = $mysqli->query("select * from producto where id_categoria = $categoria");
    }

    $i = 0;
    while ($resultado = $consulta->fetch_assoc()) {
      if ($i == 0 || $i == 3 || $i == 6) {
        echo '<tr>';
      }
      ?>
      <td>
        <div class="catalogo" id="<?php echo $resultado['referencia']; ?>">
          <figure>
            <img class="imagen-muestra" src="upload/<?php echo $resultado['imagen']; ?>" alt="..." />
          </figure>
          <h1 class="text-center"><?php echo $resultado['nombre']; ?></h1>
          <p>
            <?php echo $resultado['descripcion']; ?>
          </p>
          <p class="precio">
            <?php
                if ($categoria == "bstock") {
                  echo $resultado['precio'] * 60 / 100 . '€';
                } else {
                  echo $resultado['precio'] . '€';
                }
                ?>
          </p>

      <?php
          if ($resultado['novedad'] == true) {
            echo '<img src="179452.svg" alt="" class="iconos" />';
          } else {
            echo '<img src="179452.svg" alt="" class="iconos ocultar" />';
          }
          if ($resultado['oferta'] == true) {
            echo '<img src="17800.svg" alt="" class="iconos " />';
          } else {
            echo '<img src="17800.svg" alt="" class="iconos ocultar" />';
          }

          echo '<br><img src="carrito2.png" alt="" class="iconos" /> </div>
     </td>';
          if ($i == 2 || $i == 5 || $i == 8) {
            echo '</tr>';
          }
          $i++;
        }
      }
      if ($i != 8) {
        while ($i < 9) {

          if ($i == 0 || $i == 3 || $i == 6) {
            echo '<tr>';
          }
          echo '<td>
        <div class="catalogo">
          <figure>
           
          </figure>
          <h2 class="text-center"></h2>
          <p>
        
          </p>
          <p class="precio"></p>
        </div>
      </td>';
          if ($i == 2 || $i == 5 || $i == 8) {
            echo '</tr>';
          }
          $i++;
        }
      }
      ?>
</table>
<script>
  $('.catalogo').click(function() {
    var id = $(this).attr("id");
    var cantidad = Number($('#unidades').html());
    var precio1 = Number($("#precio").html());
    $.post("getValorProducto.php", {
      id: id,
      cantidad: cantidad,
      precio1: precio1
    }, function(data) {
      uds = Number($("#unidades").html());
      uds += 1;
      precio = Number($("#precio").html());
      precio += Number(data);
      $("#unidades").html(uds);
      $("#precio").html(precio);
    });
  });
</script>