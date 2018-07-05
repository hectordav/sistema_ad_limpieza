<div class="modal fade "id="login">
		        <div class="modal-dialog">
		          <div class="modal-content">
		            <div class="modal-header">
		              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		               <strong><h4><span class ="label label-warning">Iniciar sesion</span></h4></strong>
		            </div> <!-- termina el header -->
					<div class="container">
						<div class="row">
						<form action="<?php echo $this->config->base_url();?>index.php/login/iniciar_sesion_post" method="POST" accept-charset="utf-8">
							<div class="col-sm-6">
								<div class="input-group">
					  				<span class="input-group-addon" id="basic-addon1">Login</span>
					  				<input type="text" class="form-control" name="txt_login" id="txt_login"placeholder="Ingrese login" aria-describedby="basic-addon1" required="required">
								</div>
								<br>
								<div class="input-group">
					  				<span class="input-group-addon" id="basic-addon1">Clave</span>
					  				<input type="password" name="txt_pass" id="txt_pass" class="form-control" placeholder="Ingrese clave" aria-describedby="basic-addon1" required="required">
								</div>
								<center><button type="submit" class="btn btn-info">Ingresar</button></center>
								</form>

							</div>
						</div>
					</div>
		            <div class="modal-footer">
		            </div>
		          </div><!-- termina el content -->
		        </div> <!-- termina el modal dialog -->
		    </div> <!-- termina la ventana modal -->