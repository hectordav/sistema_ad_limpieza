
<div class="row" style="border-width: 1px; border-style: dashed;border-color: #9E9C9C;  ">
			<div class="col-md-12">
			<div class="col-md-9">
				<P ALIGN="right"><label>Sub Total:</label>
				<P ALIGN="right"><label>Descuento:</label>
				<P ALIGN="right"><label>Iva:</label>
				<P ALIGN="right"><label>Total:</label>
			</div>
			<div class="col-md-3">
				<div class="col-md-5">
				<br>
				<br>
				<input onkeyup="fncSumar();"type="number" name="descuento" id="descuento" class="form-control" style="height:30px" value="0">
				</div>
				<div class="col-md-7">
					<P ALIGN="right">
						<input type="text" name="sub_total" id="sub_total" class="form-control" value="<? $big_number=number_format($big, 2, '.', '');echo $big_number;?>" required="required" pattern="" title="" disabled="true">
						<input type="text" name="descuento_2" id="descuento_2" class="form-control" value="0" required="required" pattern="" title="" disabled="true">
						<input type="text" name="iva" id="iva" class="form-control" value="<? $iva_number=number_format($iva, 2, '.', '');echo $iva_number;?>" required="required" pattern="" title="" disabled="true">
						<input type="text" name="total" id="total" class="form-control" value="<?$total_number=number_format($total, 2, '.', ''); echo $total_number;?>" required="required" pattern="" title="" disabled="true">
					</form>
				</div>
			</div>
			</div>
			</div>
</div>
<br>
<br>
<br>
</body>
<script src="<?= $this->config->base_url();?>assets/js/bootstrap.js"></script>