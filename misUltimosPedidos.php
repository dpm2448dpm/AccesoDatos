<div class="card">
    <div class="card-header contenedor_principal">
        <h4>Mis Pedidos</h4>
    </div>
    <div class="contenedor_mispedidos">
        <!--meter una puta tabla -->
        <ul class="list-group margen-top mispedidos">
            <?php
            include 'conexion.php';
            session_start();
            $queryFecha  = "select pedidos.id_pedido as id, estados.estado as estado, estados_pedidos.fecha as fecha from pedidos,estados,estados_pedidos where pedidos.usuario='" . $_SESSION['usuario'] . "' and pedidos.id_pedido = estados_pedidos.id_pedido and estados_pedidos.id_estado=estados.id_estado and (estados_pedidos.id_estado =1 or (estados_pedidos.id_estado=2 and timediff(estados_pedidos.fecha,CURRENT_TIMESTAMP)<'-24:00:00'))";
            $consulta = $mysqli->query($queryFecha);
            while ($row = $consulta->fetch_assoc()) {
                ?>
                <li class="list-group-item bg-black h-personal  border-light letras-blancas">ID Pedido: <?php echo $row['id'] ?> Estado del Pedido: <?php echo $row['estado']; ?> -> Ultima Actualizacion del pedido: <?php if ($row['fecha'] == NULL) {
                                                                                                                                                                                                                            echo 'Pendiente de Revisión';
                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                            echo $row['fecha'];
                                                                                                                                                                                                                        } ?> </li>

            <?php
            }
            ?>
        </ul>
    </div>
</div>