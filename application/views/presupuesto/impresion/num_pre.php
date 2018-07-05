	<table align="right">
   <thead>
        <tr>
            <td ># Factura:</td>
            <td ><?=$num_fact; ?></td>
        </tr>
        <tr>
	        <td >FECHA</td>
          <? $fecha2=date("d-m-Y",strtotime($fecha));?>
             <td ><?=$fecha2; ?></td>
	    </tr>

    </thead>
</table>
