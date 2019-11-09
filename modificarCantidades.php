<?php
session_start();
include 'conexion.php';
$cantidad = $_POST['cantidad'];
$referencia =$_POST['referencia'];
$consulta = $mysqli -> query("select * from producto where referencia = $referencia");
$row = $consulta ->fetch_assoc();
//modificar el sessiones de producto para meter todo menos el elemento que estoy pasando, y luego añadirlo la cantidad de veces que se seleccione.
$arr = [];

//añado a un array todos menos las referencias.
foreach($_SESSION['productos'] as $p){
    if($p!=$referencia){
        array_push($arr,$p);
    }
}
//añado n veces la referencia solo so la cantidad que recibo es superior a 0, sino elimino el producto del array
if($cantidad>0){
    for($i=0 ; $i<$cantidad;$i++){
        array_push($arr,$referencia);
    }
}


//vacio el array
unset($_SESSION['productos']);
//meto el nuevo array productos;
$_SESSION['productos']=$arr;


if($row['stock']<$cantidad){
    $salida = -1;
}else{
    $salida = $cantidad;
}

//actualizo el array de precio total con una consulta
echo $salida;
?>