$(document).ready(function(){
	
	$("input").change(function(){
		var valor = $(this).val();
		var id = $(this).attr("id");
		//para eliminar el simbolo del €
		var precio =$("#precios"+id).text().slice(0,-1);
		var datos ={
			"cantidad":valor,
			"referencia":id,
			"precio":precio
		};
		
		$.ajax({
			type:'post',
			data:datos,
			url:'modificarCantidades.php',
			success: function(datos){
				
				if(datos==-1){
					
					$("#span"+id).html("No hay suficientes unidades");
				}else{
					if(datos == 0){
						$("#fila"+id).remove();
						$("#t_compra").html("0€");
						$("#precio").html("0");
					}
					else{
						$("#span"+id).html("")
						var precio = $("#precios"+id).text().slice(0,-1);
						var cantidad = datos;
						var total =precio*cantidad;
						$("#total"+id).text(total + "€");
						//alert(total);
						var total_precio=0;
						var total_Cantidad=0;
	
						// coge todos los elementos que contienen en el id la palabra total y suma su valor
						$('[id*=total]').each(function(){
							var p = Number ($(this).text().slice(0,-1));
							total_precio +=p;
						});
						//coge los inputs number para sumarlos
						$('[type = number]').each(function(){
							
							var c = Number ($(this).val());
							total_Cantidad +=  c ;
						});
						
						//meto los valores nuevos en su sitio;   --> en ajax hay que modificar el array de sesiones.
						$('#unidades').html(total_Cantidad);
						$('#precio').html(total_precio);
						$('#t_productos').html("<strong>Total productos:</strong>"+total_Cantidad+"UDS");
						$('#t_compra').html("<strong>Total de la compra:</strong>"+total_precio+"€");
					}
				} 

			}
		});
	});
	
});