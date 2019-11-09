<?php
session_start();
//evitar problemas con los sessiones cuando se borra la sesion.
if(!isset($_SESSION['productos'])){
    $_SESSION['productos'] = [];
  }
  if(!isset($_SESSION['cantidad'])){
    $_SESSION['cantidad']=0;
  }
  if(!isset($_SESSION['precio'])){
    $_SESSION['precio']=0;
  }
$id=$_POST['id'];
include 'conexion.php';
array_push($_SESSION['productos'],$id);
$query = "select precio from producto where referencia = $id ";
$consulta = $mysqli->query($query);
$row= $consulta ->fetch_assoc();
$precio = $row['precio'];
$_SESSION['cantidad']=$_POST['cantidad']+1;
$_SESSION['precio']=$precio+$_POST['precio1'];

echo $precio;

?>
