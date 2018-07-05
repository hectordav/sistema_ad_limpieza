<div class="row" style="border-width: 1px; border-style: dashed;border-color: #9E9C9C;  ">
			<div class="col-md-12">
			<div class="col-md-8"></div>
			<div class="col-md-4">
				<div class="col-md-4">
				<P ALIGN="right"><label>Sub Total:</label>
				<P ALIGN="right"><label>Iva:</label>
				<P ALIGN="right"><label>Total:</label>
				</div>
				<div class="col-md-8">
					<P ALIGN="right"><label><? $big_number=number_format($big, 2, '.', '');echo $big_number;?></label>
					<P ALIGN="right"><label><? $iva_number=number_format($iva, 2, '.', '');echo $iva_number;?></label>
					<P ALIGN="right"><label><?$total_number=number_format($total, 2, '.', ''); echo $total_number;?></label>
				</div>
			</div>
			</div>
			</div>
</div>
<br>
<br>
<br>
<script src="<?= $this->config->base_url();?>assets/js/bootstrap.js"></script>