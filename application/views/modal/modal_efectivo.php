<div class="modal fade "id="efectivo">
		        <div class="modal-dialog">
		          <div class="modal-content">
		            <div class="modal-header">
		              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		               <strong><h2><span class ="label label-warning">Efectivo</span></h2></strong>
		            </div> <!-- termina el header -->
		         <div class="modal-body">
		          <h3><P ALIGN=center><label for="input-id">Total: <? $total_format= number_format($total, 2,".",""); echo $total_format;?></label></h3>
		           <input type="hidden" name="lbl_num_fact" id="lbl_num_fact" value="<? $total_format= number_format($total, 2,".",""); echo $total_format;?>">
					<div class="input-group">
						<input type="number" step="any" type="text" name="txt_efectivo"  id="txt_efectivo"
						class="form-control" placeholder="Ingrese Monto a pagar" aria-describedby="sizing-addon2" required>
						<span class="input-group-btn">

						<button type="button" onclick="efectivo(<?=$id?>)"class="btn btn-default"  id="efectivo_2" name="efectivo_2">Imprimir</button>
					</div></div>

		            <div class="modal-footer">
		             <button type="button" class="btn btn-sm btn-primary"  data-dismiss="modal">Cerrar</button>
		            </div>
		          </div><!-- termina el content -->
		        </div> <!-- termina el modal dialog -->
		    </div> <!-- termina la ventana modal -->
