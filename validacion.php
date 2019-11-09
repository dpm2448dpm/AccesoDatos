<?php 
session_start();
$valor = $_SESSION['productos'];
$tt="";
foreach($valor as $val){
    $tt.=$val.",";
}
echo $tt;
?>