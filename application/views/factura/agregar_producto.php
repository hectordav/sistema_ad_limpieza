<body onload="fncSumar()">
<br>
<div class="container">
	<?$correcto = $this->session->flashdata('alerta');
    if (!$correcto)
    {
    }
    else{?>
  <div class="success-message hidden">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span></button>
  <strong>!Advertencia!</strong> El Registro no existe
  <a href="<?php echo $this->config->base_url();?>index.php/cliente" class="alert-link">Agregar Cliente</a>
</div>
    <?php }
    ?>



<form action="<?php echo $this->config->base_url();?>index.php/factura/agregar_producto"method="POST" role="form">
	
	<input type="hidden" name="lbl_descuento" id="lbl_descuento" value="">
	<input type="hidden" name="lbl_sub_total" id="lbl_sub_total" value="">
	<input type="hidden" name="lbl_descuento_2" id="lbl_descuento_2" value="">
	<input type="hidden" name="lbl_iva" id="lbl_iva" value="">
	<input type="hidden" name="lbl_total" id="lbl_total" value="">


<P ALIGN=right><button type="submit"  class="btn btn-primary" onclick = "this.form.action = '<?php echo $this->config->base_url();?>index.php/factura/guardar_factura'">Guardar</button></a>
	<div class="row" style="border-width: 1px; border-style: dashed;border-color: #9E9C9C;">
		<div class="col-md-6" >
		<div class="col-md-12" >

				<div class="form-group">
				<h4><span class="label label-default "><strong>Cliente</strong></span></h4>

				<input type="text" name="" id="input" class="form-control" value="<?echo $nombre_cliente;?>" required="required" pattern="" title="" disabled="true">

				<h4><span class="label label-default"><strong>Direccion</strong></span></h4></span>
				<div class="form-group">
					<textarea name="" id="textarea" class="form-control" rows="3" required="required" disabled="true"><?echo $direccion;?></textarea>

				</div>
				</div>

				</div>
		</div>
<div class="col-md-6">
<div class="col-md-6">
<h4><span class="label label-default "><strong>Fecha de Factura</strong></span></h4>
<input type="date" name="" id="input" class="form-control" value="<?php echo date("Y-m-d");?>" required="required" title="">
<h4><span class="label label-default "><strong>Notas</strong></span></h4>
<textarea name="txt_notas" id="txt_notas" class="form-control" rows="3" placeholder="Ingrese notas"></textarea>
</div>
<div class="col-md-6">
<h4><span class="label label-default "><strong># Factura</strong></span></h4>
<input type="text" name="" id="input" class="form-control" value="<?echo $num_fact;?>" required="required" pattern="" title=""disabled="true">
<h4><span class="label label-default "><strong># Albaran</strong></span></h4>
<input type="text" name="albarran" id="albarran" class="form-control" value="" placeholder="Ingrese numero de Albaran">
</div>
</div>
	</div>
<br>
<div class="row">
	<div style="border-width: 1px; border-style: dashed;border-color: #9E9C9C;  "> <!--el que me da el interlinieado-->
<h3><span class="label label-default">Articulo</span></h3>

					<div class="form-group">
						<div class="input-group">
							<input type="hidden" name="lbl_num_fact" value="<?echo $num_fact;?>">
						<span class="input-group-addon" id="sizing-addon2">Producto</span>
						<input type="text" name="txt_producto"  id="txt_producto"class="form-control"
						placeholder="Ingrese Producto" aria-describedby="sizing-addon2">
						<span class="input-group-addon" id="sizing-addon2">Cantidad</span>
						<input type="text" name="txt_cantidad"  id="txt_cantidad"class="form-control"
						placeholder="Ingrese Cantidad" aria-describedby="sizing-addon2">
						<span class="input-group-btn">
						<button class="btn btn-default "  id="boton_submit" type="submit " disabled="true">Agregar</button></span>
						</div>
					</div>


			</div>
			<br>

