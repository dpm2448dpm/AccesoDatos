<div class="card">
    <div class="card-header contenedor_principal">
        <h4>Detalle del Carrito</h4>
    </div>
    <div class="contenedor_mispedidos">
        <!--meter una puta tabla -->
        <ul class="list-group margen-top mispedidos">
            <?php
            session_start();
            $consulta1 = ("select distinct fecha from pedidos where usuario ='" . $_SESSION['usuario'] . "'");
            include 'conexion.php';
            $mysqli->query($consulta1);
            if ($mysqli->affected_rows == 0) {
                ?>
                <h2>No hay productos en su carrito</h2>
                <?php
                } else {
                    $datos1 = $mysqli->query($consulta1);

                    while ($row1 = $datos1->fetch_assoc()) {
                        ?><li class="list-group-item bg-black h-personal  border-light letras-blancas"><?php echo $row1['fecha']; ?> <ul id="mispedidos2" class="">

                            <?php
                                    $datos2 = $mysqli->query("select * from pedidos where fecha ='" . $row1['fecha'] . "' and usuario ='" . $_SESSION['usuario'] . "'");
                                    while ($row2 = $datos2->fetch_assoc()) { ?>
                                <li class="list-group-item letras-negras">Pedido <?php echo $row2['id_pedido']; ?> , <?php echo $row2['precio']; ?>€
                                    <details closed>
                                        <summary>Detalles Pedido</summary>
                                        <table id="tabla2">
                                            <tr>
                                                <th>Contador</th>
                                                <th>Referencia</th>
                                                <th>Nombre</th>
                                                <th>Precio</th>
                                                <th>Cantidad</th>
                                                <th>TOTAL</th>
                                            </tr>
                                            <?php
                                                        $datos3 = $mysqli->query("select * from linea_pedido where id_pedido =" . $row2['id_pedido']);
                                                        while ($row3 = $datos3->fetch_assoc()) {
                                                            $total_cantidad += $row3['cantidad'];
                                                            $total_precio += $row3['total_linea'];
                                                            echo '<tr>
                                 <td>' . $row3['id_linea'] . '</td>
                                 <td>' . $row3['id_producto'] . '</td>
                                 <td>' . $row3['nombre'] . '</td>
                                 <td>' . $row3['precio'] . '€</td>
                                 <td>' . $row3['cantidad'] . '</td>
                                 <td>' . $row3['total_linea'] . '€</td></tr>';

                                                            ?>




                                            <?php
                                                        }
                                                        echo '<tr>
                                    <td colspan="3"> Total Cantidad: ' . $total_cantidad . 'UDS</td>
                                    <td colspan="3"> Total Precio : ' . $total_precio . '€</td>
                                    </tr>';
                                                        $total_cantidad=0;
                                                        $total_precio=0;
                                                        ?>
                                        </table>
                                    </details>


                                </li>

                            <?php
                                    } ?>
                        </ul>
                    </li>

            <?php
                }
            }

            ?>

        </ul>

    </div>
</div>
<script>
    $(".mispedidos li").click(function() {

        if ($(this).children('ul').css('display') == 'block') {
            $(this).children('ul').css('display', 'none');
            $("li").not($(this)).children('ul').css('display', 'none');
        } else {
            $(this).children('ul').css('display', 'block');
            $("li").not($(this)).children('ul').css('display', 'none');
        }

    });
    /*$(this).click(function(){
       alert($(this).attr('class'));
      });*/
</script>