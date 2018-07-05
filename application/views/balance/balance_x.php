
<div class="container">
    <div class="row">
    <br>
    <br>

 <div class="col-lg-4">
 <strong><label class="col-lg-2">Desde</label></strong>
 <form action="<?php echo $this->config->base_url();?>index.php/balance/corte_x" method="post">
  <input type="date" value="<?php echo date("Y-m-d");?>" name="dt_fecha_inicio" id="input" class="form-control" value="" required="required" title="">
  <strong><label class="col-lg-2">Hasta</label></strong>
  <input type="date" value="<?php echo date("Y-m-d");?>" name="dt_fecha_fin" id="input" class="form-control" value="" required="required" title="">
    <div class="input-group">
     <select class="form-control" id="cb_usuario" name="cb_usuario" placeholder="Ingrese Nif">
    <? foreach($data_usuario->result() as $data){?>
  <option><?echo $data->usuario;?></option>
  <?}?>
</select>
      <div class="input-group-btn">
        <button class="btn btn-default "  name="boton_submit" id="boton_submit"type="submit">Balance</button>
        </div>
        </div>
          </form>
      </div><!-- /btn-group -->
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->

    </div>
</div>
