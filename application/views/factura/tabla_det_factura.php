<table class="table table-condensed table-bordered table-hover">
    <thead>
        <tr>
            <th class="col-md-6">Producto</th>
            <th class="col-md-2">Cantidad</th>
            <th class="col-md-2">Precio U</th>
            <th class="col-md-1">Total</th>
            <th class="col-md-1">Acciones</th>
        </tr>
    </thead>
    <tbody>
<? foreach($det_fact->result() as $data){?>
		<tr>

			<td><?echo $data->descripcion;?></td>
			<td><?echo $data->cantidad;?></td>
			<td><?echo $data->precio;?></td>
			<td><?echo $data->total;?></td>
            <td><a onclick="if(confirma() == false) return false" href="<?=base_url()?>index.php/factura/eliminar_registro/<?=$data->id?>/<?=$num_fact?>/<?=$data->id_inventario_sucursal?>/<?=$data->cantidad?>/<?=$id?>"><button type="button" class="btn btn-default glyphicon glyphicon-trash" title="Eliminar Registro"></button></a>
            </td>
        </tr>
  <? }; ?>

    </tbody>
</table>
	</div>

