<?php

//con este vale para los dos

include 'conexion.php';


$consulta2 = $mysqli->query("select * from categorias where id_padre is NULL");



?>

<ul class="list-group margen-top barra">

  <?php
  //voy a pasar la funcion a jquery con el parametro.

  while ($resultado2 = $consulta2->fetch_assoc()) {
    echo '<li class="list-group-item bg-black h-personal  border-light letras-blancas">
        <strong class="indice">▸</strong>' . $resultado2['nombre_categoria'] . '<ul class="barra">';
    $consulta1 = $mysqli->query('select * from categorias where id_padre =' . $resultado2['id_categoria']);
    while ($resultado1 = $consulta1->fetch_assoc()) {
      echo '<a href="index.php?categoria=' . $resultado1['id_categoria'] . '"><li class="list-group-item bg-black h-personal submenu border-info minimo letras-blancas">
          <strong class="indice">-</strong>' . $resultado1['nombre_categoria'] . '</li></a>';
    }

    echo '</ul></li>';
  }
  ?>
  <a href="index.php?categoria=bstock">
    <li class="list-group-item bg-black h-personal submenu border-info minimo letras-blancas">
      <strong class="indice">▸</strong>Reacondicionados</li>
  </a>
</ul>
<script>
  $(".barra li").click(function() {

    if ($(this).children('ul').css('display') == 'block') {
      $(this).children('ul').css('display', 'none');
      $("li").not($(this)).children('ul').css('display', 'none');
    } else {
      $(this).children('ul').css('display', 'block');
      $("li").not($(this)).children('ul').css('display', 'none');
    }

  });
  /*$(this).click(function(){
     alert($(this).attr('class'));
    });*/
</script>