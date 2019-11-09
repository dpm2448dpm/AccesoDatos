<?php

include 'conexion.php';
 $id_provincia=$_POST['id_provincia'];
 $queryMunicipio = "select id_municipio, nombre from municipios where id_provincia ='".$id_provincia."' order by nombre asc";
 $resultadoMunicipio = $mysqli -> query($queryMunicipio);
  
 $html = "<option value='0'>Seleccione Localidad </option> ";

 while($rowM = $resultadoMunicipio -> fetch_assoc()){
    $html .= "<option value='".$rowM['id_municipio']."'>".$rowM['nombre']."</option>";
 }
 echo $html;
?>