<?php
if(isset($_POST['Enviar']) && !empty($_FILES['file']['name'])){

    if(move_uploaded_file($_FILES['file']['tmp_name'],"upload/".$_FILES['file']['na
    me'])){
    echo 'Archivo subido correctamente.';
    }else{
     echo 'Ocurrieron algunos problemas. Inténtelo más tarde.';
    }
    }
    
$fileName= $_FILES['file']['name'];
?>