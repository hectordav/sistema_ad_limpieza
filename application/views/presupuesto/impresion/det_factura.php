

	<table border="0" width="100%">

        <tr>
           <th width="65%">Producto</th>
           <th width="10%">Cantidad</th>
           <th width="10%">Precio U</th>
           <th width="20%">Total</th>
        </tr>
        <tr> <td  colspan="4"><hr color="red" size=2></td></tr>
<? foreach ($det_fact->result() as $data) { ?>
        <tr>
         <?$precio_format= number_format($data->precio, 2,".",",");?>
         <?$total_format= number_format($data->total, 2,".",",");?>
	        <td width="65%"><?=$data->descripcion;?></td>
          <td align="center" width="10%"><?=$data->cantidad;?></td>
          <td align="center"width="10%"><?=$precio_format;?></td>
          <td align="center"width="20%"><?=$total_format;?></td>
	    </tr>
<?}?>

</table>
