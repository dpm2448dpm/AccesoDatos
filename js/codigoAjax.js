 $(document).ready(function(){
	 $('#provincia').change(function(){

		
		$('#provincia option:selected').each(function(){
			id_provincia = $(this).val();
			
			$.post("getMunicipio.php",{ id_provincia: id_provincia},function(data){
				
				$('#localidad').html(data);
			});
		});
		
		});

 });