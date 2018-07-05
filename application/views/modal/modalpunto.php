<div class="modal fade "id="punto">
		        <div class="modal-dialog">
		          <div class="modal-content">
		            <div class="modal-header">
		              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		               <strong><h2><span class ="label label-warning">Punto de Venta</span></h2></strong>
		            </div> <!-- termina el header -->
		         <div class="modal-body">
		          <h3><P ALIGN=center><label for="input-id">Total: <? $total_format= number_format($total, 2,".",""); echo $total_format;?></label></h3>
		           <input type="hidden" name="lbl_num_fact" id="lbl_num_fact" value="<? $total_format= number_format($total, 2,".",""); echo $total_format;?>">


	 				<input type="hidden" name="lbl_id_factura" id="lbl_id_factura" value="<?=$id?>">
				    <form class="form-vertical" role="form">
	          		<div class="form-group">
	          			<label for="input-id">Referencia</label>
					<input type="text" name="txt_referencia" id="txt_referencia" class="form-control" value="" required="required" pattern="" title="" placeholder="Ingrese # de Referencia">
						<label for="input-id">Monto</label>
					<input type="number"step="any" name="txt_monto_2" id="txt_monto_2" class="form-control" value="" required="required" pattern="" title="" placeholder="Ingrese Monto a pagar">
						<label for="input-id">Efectivo</label>
					<input type="number"step="any" name="txt_efectivo_3" id="txt_efectivo_3" class="form-control" value="" required="required" pattern="" title="" placeholder="Ingrese efectivo (si lo requiere)">
	          		</div>
					</form>
						<button type="button" onclick="punto(<?=$id?>)"class="btn btn-default" id="algo" name="algo">Imprimir</button>
					</div></div>

		            <div class="modal-footer">
		             <button type="button" class="btn btn-sm btn-primary"  data-dismiss="modal">Cerrar</button>
		            </div>
		          </div><!-- termina el content -->
		        </div> <!-- termina el modal dialog -->
		    </div> <!-- termina la ventana modal -->
