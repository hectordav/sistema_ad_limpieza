 <? foreach ($cliente->result() as $data) { ?>

	<table border="1" width="100%" height="10%">
   <thead>
        <tr>
           <th width="10%">Nif:</th>
            <td width="80%"><?=$data->nif;?></td>
        </tr>
        <tr>
        <th width="10%"> Cliente:</th>
	        <td width="80%"><?=$data->nombre;?></td>
	    </tr>
        <tr>
        <th width="10%">Direccion:</th>
          <td width="80%"><?=$data->direccion;?></td>
        </tr>
          <tr>
           <th width="10%">Telefono:</th>
            <td width="80%"><?=$data->telf;?> ,<?$data->email;?> </td>
          </tr>
    </thead>
</table>
<br>
<?}?>