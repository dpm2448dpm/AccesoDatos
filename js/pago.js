$("#pagar").click(function(e) {
  e.preventDefault();

  //Aqui se calculaba el total pero al final decido hacerlo directamente en php por problemas al a hora de coger datos
  /*var tt_precio = $("#t_compra").text();
  //solo cojo el precio tt y le quito el €;
  
  var tt_precio = tt_precio.split(" ")[4];
  var tt_precio = tt_precio.slice(0, -1);*/
  var precios = [];
 
  var fecha = new Date();
  
  var date =
    fecha.getFullYear() +
    "/" +
    Number(fecha.getMonth() + 1) +
    "/" +
    fecha.getDate();
   
    
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
    referencias.push($(this).text());
  });
  var nombres = [];
  $("[id*=nombres]").each(function() {
    nombres.push($(this).text());
  });

  var datos = {
    precios: JSON.stringify(precios),
    cantidades: JSON.stringify(cantidades),
    referencias: JSON.stringify(referencias),
    nombres: JSON.stringify(nombres),
    fecha: date
  };
  $.ajax({
    type: "post",
    data: datos,
    url: "compra.php",
    success: function(vuelta) {
      alert(vuelta);
      window.location.href = "/AccesoDatos/index.php";
    }
  });
});

$("#seguir").click(function(e){
  e.preventDefault();
window.location.href = "/AccesoDatos/index.php";
});

//cambiar precios
$("input").change(function(e) {
  var valor = $(this).val();
  var id = $(this).attr("id");
  //para eliminar el simbolo del €
  var precio = $("#precios" + id)
    .text()
    .slice(0, -1);
  var datos = {
    cantidad: valor,
    referencia: id,
    precio: precio
  };

  $.ajax({
    type: "post",
    data: datos,
    url: "modificarCantidades.php",
    success: function(datos) {
      if (datos == -1) {
        $("#span" + id).html("No hay suficientes unidades");
      } else {
        if (datos == 0) {
          $("#fila" + id).remove();
          $("#t_compra").html("0€");
          $("#precio").html("0");
        } else {
         
          $("#span" + id).html("");
          var precio = $("#precios" + id)
            .text()
            .slice(0, -1);
          var cantidad = datos;
          var total = precio * cantidad;
          $("#total" + id).text(total + "€");
          //alert(total);
          var total_precio = 0;
          var total_Cantidad = 0;

          // coge todos los elementos que contienen en el id la palabra total y suma su valor
          $("[id*=total]").each(function() {
            var p = Number(
              $(this)
                .text()
                .slice(0, -1)
            );
            total_precio += p;
          });
          //coge los inputs number para sumarlos
          $("[type = number]").each(function() {
            var c = Number($(this).val());
            total_Cantidad += c;
          });

          //meto los valores nuevos en su sitio;   --> en ajax hay que modificar el array de sesiones.
          $("#unidades").html(total_Cantidad);
          $("#precio").html(total_precio);
          $("#t_productos").html(
            "<strong>Total productos:</strong>" + total_Cantidad + "UDS"
          );
          $("#t_compra").html(
            "<strong>Total de la compra:</strong>" + total_precio + "€"
          );
        }
      }
    }
  });
});
