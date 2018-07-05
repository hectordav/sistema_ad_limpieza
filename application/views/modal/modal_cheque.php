<div class="modal fade "id="cheque">
		        <div class="modal-dialog">
		          <div class="modal-content">
		            <div class="modal-header">
		              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		               <strong><h2><span class ="label label-warning">Cheque</span></h2></strong>
		            </div> <!-- termina el header -->
		         <div class="modal-body">
		     <input type="hidden" name="lbl_num_fact" id="lbl_num_fact" value="<? $total_format= number_format($total, 2,".",""); echo $total_format;?>">
		          <h3><label for="input-id">Total: <? $total_format= number_format($total, 2,".",""); echo $total_format;?></label></h3>
		          <form class="form-vertical" role="form">
		          		<div class="form-group">
		          			<label for="input-id">Referencia</label>
						<input type="text" name="txt_referencia" id="txt_referencia" class="form-control" value="" required="required" pattern="" title="" placeholder="Ingrese # de Referencia">
							<label for="input-id">Monto Cheque</label>
						<input type="number"step="any" name="txt_monto" id="txt_monto" class="form-control" value="" required="required" pattern="" title="" placeholder="Ingrese Monto a pagar">
							<label for="input-id">Efectivo</label>
						<input type="number"step="any" name="txt_efectivo_2" id="txt_efectivo_2" class="form-control" value="" required="required" pattern="" title="" placeholder="Ingrese efectivo (si lo requiere)">
		          		</div>
					</form>
					<button type="button" onclick="cheque(<?=$id?>)"class="btn btn-default"  id="cheque_2" name="cheque_2">Imprimir</button>
		            <div class="modal-footer">
		             <button type="button" class="btn btn-sm btn-primary"  data-dismiss="modal">Cerrar</button>
		            </div>
		          </div><!-- termina el content -->
		        </div> <!-- termina el modal dialog -->
		    </div> <!-- termina la ventana modal -->
