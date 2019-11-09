<?php
session_start();
include 'conexion.php';
$user = $_POST["user"];
$pass = $_POST["pass"];
$consulta = $mysqli -> query("select * from usuarios where user='".$user."' and pass='".$pass."'");

if($mysqli ->affected_rows ==0){
    $salida = 0;
}else{
    $salida = $user;
    $_SESSION['usuario'] = $user;
}

echo $salida;
?>