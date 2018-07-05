 <script type="text/javascript">

 function num_fact()

    {
        var buscar= document.getElementById('txt_buscar').value;
        if (buscar=='') {
        	$('#buscar').modal('show'); //si no escribe nada, muestra el modal
        }else{
        	if(buscar.length<8 || buscar.length>8 ){
        			$('#menos_8').modal('show'); //mayor o menor muestra el modal
        	}else{
        		$("#paginacion").load("<?php echo $this->config->base_url();?>index.php/factura/buscar_num_factura/", { id: buscar });
        	}

       };
    }
    function num_albarran()

    {
        var buscar= document.getElementById('txt_buscar').value;
        if (buscar=='') {
            $('#buscar').modal('show'); //si no escribe nada, muestra el modal
       
            }else{
                $("#paginacion").load("<?php echo $this->config->base_url();?>index.php/factura/buscar_num_albarran/", { id: buscar });
            };

     
    }
     function nif_cliente()
    {
        var buscar= document.getElementById('txt_buscar').value;
        if (buscar=='') {
        	$('#buscar').modal('show'); //si no escribe nada, muestra el modal
        }else{

			$("#paginacion").load("<?php echo $this->config->base_url();?>index.php/factura/buscar_num_factura_nif_cliente/", { id: buscar });
        	};
    }
       function nombre_cliente()
    {
        var buscar= document.getElementById('txt_buscar').value;
        if (buscar=='') {
        	$('#buscar').modal('show'); //si no escribe nada, muestra el modal
        }else{

			$("#paginacion").load("<?php echo $this->config->base_url();?>index.php/factura/buscar_num_factura_nombre_cliente/", { id: buscar });
        	};
    }



 </script>