
	<table border="1" width="100%">

        <tr>
           <th width="80%">Producto</th>
           <th width="10%">Cantidad</th>
           <th width="10%">Precio U</th>
           <th width="20%">Total</th>
        </tr>
<? foreach ($det_fact->result() as $data) { ?>
        <tr>
         <?$precio_format= number_format($data->precio, 2,".",",");?>
         <?$total_format= number_format($data->total, 2,".",",");?>
	        <td width="80%"><?=$data->descripcion;?></td>
          <td align="center" width="10%"><?=$data->cantidad;?></td>
          <td align="right"width="10%"><?=$precio_format;?></td>
          <td align="right"width="20%"><?=$total_format;?></td>
	    </tr>
<?}?>

</table>
