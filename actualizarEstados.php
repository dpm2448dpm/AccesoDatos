<?php
$ids = json_decode($_POST['id']);
include 'conexion.php';
foreach($ids as $id){
    $mysqli ->query("update estados_pedidos set id_estado = 2, fecha = now() where id_pedido = ".$id);
}
$salida = "Se ha actualizado con exito el estado de los pedidos";
echo $salida;
?>