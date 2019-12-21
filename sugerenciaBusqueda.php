<?php
$valor = $_POST['valor'];
include 'conexion.php';

$con = $mysqli ->query("select * from producto where nombre like '%%$valor%%' limit 9");

echo '<table>';
while($resultado = $con ->fetch_assoc()){
    echo '<tr><td><img src="upload/'.$resultado['imagen'].'" class="pequeña">'.$resultado['nombre'].'<td></tr>';
}
echo '</table>';


?>