<?php
session_start();
//error_reporting(0);
//evitar problemas con los sessiones cuando se borra la sesion.

$tipo = $_SESSION['tipo'];
if (!isset($_SESSION['productos'])) {
  $_SESSION['productos'] = [];
}
if (!isset($_SESSION['cantidad'])) {
  $_SESSION['cantidad'] = 0;
}
if (!isset($_SESSION['precio'])) {
  $_SESSION['precio'] = 0;
}
$id = $_POST['id'];
include 'conexion.php';


//cuento la cantidad de veces que hay ese producto
$cant=0;
foreach($_SESSION ['productos'] as $pr){
  if($id == $pr){
    $cant++;
  }
}





$query = "select precio from producto where referencia = $id ";
$consulta = $mysqli->query($query);
$row = $consulta->fetch_assoc();
$precio = $row['precio'];

/*miro a ver si hay stock*/
if ($tipo == "bstock") {
  $consulta_cantidad = $mysqli->query("select cantidad_devueltos as result from producto where referencia = '$id'");
 
} else {
  $consulta_cantidad = $mysqli->query("select stock as result from producto where referencia = '$id'");
}

$salida = $consulta_cantidad->fetch_assoc();
$disponible = $salida['result'];

if (($cant + 1) > $disponible) {
  $respuesta = -1;
} else {
  array_push($_SESSION['productos'], $id);
  $_SESSION['cantidad'] = $_POST['cantidad'] + 1;
  $_SESSION['precio'] = $precio + $_POST['precio1'];
  $respuesta = $precio;
}
echo $respuesta;
