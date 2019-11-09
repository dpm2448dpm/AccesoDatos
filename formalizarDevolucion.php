<?php
$id = $_POST['id'];
$referencia = $_POST['referencia'];
$cantidad_devolucion = $_POST['cantidad_devolucion'];
$cantidad_pedido = $_POST['cantidad_pedido'];
include 'conexion.php';

if (($cantidad_pedido - $cantidad_devolucion) == 0) {
    //BUSCO REFERENCIA PRODUCTO
    $busqueda = $mysqli -> query("select * from linea_pedido where id_linea ='".$id."'");
    $datoReferencia=$busqueda->fetch_assoc();
    $referencia=$datoReferencia['id_pedido'];
    //EMPIEZO CON LA LINEA
    $mysqli->query("delete from linea_pedido where id_linea='".$id."'");
    $aumentostock = $mysqli->query("select * from producto where referencia='".$referencia."'");
    $dato = $aumentostock->fetch_assoc();
    $stock_actual= $dato['cantidad_devueltos'];
    //aumento las cantidades
    $stock_actual += $cantidad_devolucion;
    $mysqli -> query("update producto set cantidad_devolucion = '".$stock_actual."' where referencia='".$referencia."'");
    $salida = "se ha borrado";
    //BORRO PEDIDO SI HICIESE FALTA
    $mysqli->query("select * from linea_pedido where id_pedido='".$referencia."'");
    if($mysqli ->affected_rows ==0){
        $mysqli ->query("delete from pedidos where id_pedido ='".$referencia."'");
    }

} else {
    $cantidad_actual = $cantidad_pedido-$cantidad_devolucion;
    $mysqli->query("update linea_pedido set cantidad='".$cantidad_actual."' where id_linea='".$id."'");
    //tabla producto
    $aumentostock = $mysqli->query("select * from producto where referencia='".$referencia."'");
    $dato = $aumentostock->fetch_assoc();
    $stock_actual= $dato['cantidad_devueltos'];
    //aumento las cantidades
    $stock_actual += $cantidad_devolucion;
    $mysqli -> query("update producto set cantidad_devueltos ='". $stock_actual."' where referencia='".$referencia."'");
    $salida = "se ha actualizado";
}
echo $salida;
