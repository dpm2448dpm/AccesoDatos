$("#pagar").click(function() {
  var tt_precio = $("#t_compra").text();
  //solo cojo el precio tt y le quito el €;
  var tt_precio = tt_precio.split(" ")[4];
  var tt_precio = tt_precio.slice(0, -1);
  var precios = [];
  var fecha = new Date();
  var date =
    fecha.getFullYear() + "/" + Number(fecha.getMonth()+1) + "/" + fecha.getDate();
  
  $("[id*=precios]").each(function() {
    var p = $(this)
      .text()
      .slice(0, -1);
    precios.push(p);
  });
  var cantidades = [];
  $("[type = number]").each(function() {
    cantidades.push(Number($(this).val()));
  });
  var referencias = [];
  $("[id*=referencias]").each(function() {
    
    referencias.push(
      $(this)
        .text()
    );
  });
  var nombres = [];
  $("[id*=nombres]").each(function() {
    nombres.push(
      $(this)
        .text()
    );
  });

  var datos = {
    precios: JSON.stringify(precios),
    cantidades: JSON.stringify(cantidades),
    referencias: JSON.stringify(referencias),
    nombres: JSON.stringify(nombres),
    tt_precio: tt_precio,
    fecha: date
  };
  $.ajax({
    type: "post",
    data: datos,
    url: 'compra.php',
    success: function(vuelta){
        alert(vuelta);
        window.location.href = "/AccesoDatos/index.php";
    }
  });
});
