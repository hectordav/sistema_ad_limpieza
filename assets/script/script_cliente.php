<script>
		$(function(){
			source:
			//esta tomando lo del cliente y lo muestra
			var url = '<?php echo $this->config->base_url();?>index.php/factura/get_cliente_autocom';

			$('#txt_id_cliente').autocomplete({
			source: url+'?item=nif'
			});
			//esta tomando lo del producto y lo muestra
			var botonsubmit = document.getElementById('boton');
			$( '#txt_id_cliente' ).blur( function()
				{

					var tecla_presionada= window.addEventListener('keydown')
					$txt = $( '#txt_id_cliente' ).val(); // Nos devuelve el valor
					// Encapsulamos los datos a enviar en propiedades de un objeto Javascript
					$params = { 'txt_id_cliente' : $txt };
					// Lanzamos los datos al PHP
					$.ajax({
					url : '<?php echo $this->config->base_url();?>index.php/factura/get_cliente_existe',
					type: 'POST',
					data : $params
					}).done( function( data )
					{
						var cliente = $.parseJSON(data);
						if (cliente['0']===undefined) // aqui verifica si los datos existen
						{
								$('#registro').modal('show'); //si no existe, muestra el modal
								document.getElementById('boton_submit').disabled =true;
								console.log(cliente['0']); //si existe, lo muestra en la consola
						}else{

								console.log(cliente['0'].nombre); //si existe, lo muestra en la consola
								document.getElementById('boton_submit').disabled =false;
						};
					});
				});
		});
	</script>




