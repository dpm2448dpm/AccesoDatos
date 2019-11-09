<?php
session_start();
$var = $_SESSION['usuario'];
session_destroy();
echo "Hasta la vista $var";

?>