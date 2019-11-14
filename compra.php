<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    $salida = "No se ha iniciado sesión";
    echo $salida;
 } else {
    include 'conexion.php';
    $user = $_SESSION['usuario'];
    $nombres = json_decode($_POST['nombres']);
    $precios = json_decode($_POST['precios']);
    $cantidades = json_decode($_POST['cantidades']);
    $referencias = json_decode($_POST['referencias']);
    $fecha = $_POST['fecha'];
    $total = $_POST['tt_precio'];
   //hasta aqui se hace el insert de pedidos.
    $insertarpedido = "insert into pedidos values ('','".$fecha."',$total,'".$user."')";
    $mysqli -> query("$insertarpedido");
    

    //inserto el estado del pedido como un pedido nuevo
    $mysqli -> query("insert into p");
    //ahora se hacen los inserts de cada linea sabiendo el ultimo id_pedido;
    $datospedido = $mysqli -> query("select * from pedidos order by id_pedido desc limit 1");
    $row = $datospedido -> fetch_assoc();
    $id_pedido = $row['id_pedido'];

    //inserto el estado del pedido como un pedido nuevo
    $mysqli -> query("insert into estados_pedidos values ($id_pedido,1,null)");

    for($i=0; $i< sizeof($precios); $i++){
        $precio_total = $cantidades[$i]*$precios[$i];
       //actualizar stock
        $consultaStock = $mysqli -> query("select * from producto where referencia =".$referencias[$i]);
        $resultado = $consultaStock ->fetch_assoc();
        $stock = $resultado['stock'];
        $stock = $stock - $cantidades[$i];
        $mysqli -> query("update producto set stock =".$stock." where referencia =".$referencias[$i]);

        $mysqli -> query("insert into linea_pedido values ('','".$referencias[$i]."','".$nombres[$i]."','".$cantidades[$i]."','".$precios[$i]."','".$precio_total."','".$id_pedido."')");
    }
    

    
    $salida = "Compra realizada con exito";
    echo $salida;

}
