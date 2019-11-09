<div class="card">
  <div class="card-header">
    <h4>Detalle del Carrito</h4>
  </div>
  <div class="card-body">
    <!--meter una puta tabla -->
    <table id="tabla_productos">
      <tr>
        <th>Contador</th>
        <th>Referencia</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Cantidad</th>
        <th>TOTAL</th>
      </tr>


      <?php
      session_start();
      include 'conexion.php';
      $i = 1;

      //
      $valores = array_count_values($_SESSION['productos']);

      //Crea un array a partir de otro pero solo con sus elementos unicos.
      $unico = array_unique($_SESSION['productos']);
      //recorro el array unico
      foreach ($unico as $producto) {
        $consulta = $mysqli->query("select * from producto where referencia = $producto");
        $row = $consulta->fetch_assoc();
        $p = $row['precio'];
        $u = $valores[$producto];
        $precio_linea = $p * $u;
        ?>
        <tr id="fila<?php echo $row['referencia']; ?>">
          <td style="width:20%"><strong>Producto <?php echo $i; ?></strong> </td>
          <td id="referencias<?php echo $row['referencia']; ?>" style="width:10%"><?php echo $row['referencia']; ?></td>
          <td id="nombres<?php echo $row['referencia']; ?>" style="width:15%"><?php echo $row['nombre']; ?></td>
          <td id="precios<?php echo $row['referencia']; ?>" style="width:20%"> <?php echo $row['precio']; ?> €</td>
          <td style="width:20%"><input id="<?php echo $row['referencia']; ?>" class="<?php echo $i; ?>" style="width:50px" type="number" value="<?php echo $valores[$producto]; ?>"><br><span id="span<?php echo $row['referencia']; ?>" style="color:red"></span></td>
          <td id="total<?php echo $row['referencia']; ?>" style="width:15%"><?php echo $precio_linea; ?> €</td>
        </tr>
      <?php

        $i++;
      } ?>
      <tr>
        <td colspan="3" id="t_productos"><strong> Total productos:</strong> <?php echo $_SESSION['cantidad']; ?>UDS</td>
        <td colspan="3" id="t_compra"><strong>Total de la compra: </strong><?php echo $_SESSION['precio']; ?>€</td>

      </tr>
    </table>
    <button type="button" class="btn btn-light"><strong>Seguir Comprando</strong></button>
    <button id="pagar" type="button" class="btn btn-info">Pagar</button>
    <script src="js/ajaxCantidades.js">
    </script>
    <script src="js/pago.js"></script>
  </div>
</div>