<script>
		$(function()
{
			source:
			//esta tomando lo del cliente y lo muestra
			var url = '<?php echo $this->config->base_url();?>index.php/factura/get_producto_autocom';
			$('#txt_producto').autocomplete({
			source: url+'?item=producto'
			});
			$( '#txt_producto' ).blur( function()
				{
					var botonsubmit = document.getElementById('boton');
					var tecla_presionada= window.addEventListener('keydown')
					$txt = $( '#txt_producto' ).val(); // Nos devuelve el valor
					// Encapsulamos los datos a enviar en propiedades de un objeto Javascript
					$params = { 'txt_producto' : $txt };
					// Lanzamos los datos al PHP
					$.ajax({
					url : '<?php echo $this->config->base_url();?>index.php/factura/get_producto_existe',
					type: 'POST',
					data : $params
					}).done( function( data )
					{
						var producto = $.parseJSON(data);
						if (producto['0']===undefined) // aqui verifica si los datos existen
						{
							document.getElementById('boton_submit').disabled =true;
							$('#producto_existe').modal('show'); //si no existe, muestra el modal

							console.log(producto.producto['0']);
						}else{
							console.log(producto[0].cantidad); //si existe, lo muestra en la consola
						};
			$( '#txt_cantidad' ).blur( function(){
					var cantidad_pag=document.getElementById("txt_cantidad").value;
					var cantidad_bd =producto[0].cantidad;
					var resultado= cantidad_bd-cantidad_pag
				if (resultado<0)
				{
					document.getElementById('boton_submit').disabled =true;
					$('#alerta_cantidad_producto').modal('show'); //si no existe, muestra el modal
				}else{
					document.getElementById('boton_submit').disabled =false;

				};
			});
		});
	});
});
	</script>



