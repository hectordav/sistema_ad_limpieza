
	<table align="left" border="0">
   <thead>
        <tr>
           <td  colspan="2"> <strong>Factura</strong><hr color="red" size=2></td>
        </tr>
        <tr>

            <td><strong>N.°Presupuesto:</strong></td>
            <td ><?=$id; ?></td>
             <td ><br></td>
              <td ><br></td>
               <td ><br></td>
               <td ><br></td>
               <td ><br></td>
               <td ><br></td>
               <td ><br></td>
          
        </tr>
        <tr>
	        <td >FECHA</td>
          <? $fecha2=date("d-m-Y",strtotime($fecha));?>
             <td ><?=$fecha2; ?></td>
	    </tr>
        <tr>
          <td ><strong>Observaciones</strong></td>
          <td ><?=$observaciones; ?></td>
      </tr>

    </thead>
</table>
