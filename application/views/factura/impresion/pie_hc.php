    <?  $j=0;
    $i=22-$contar;

    while ( $j<= $i) {?>
    <?$j=$j+1;?>
      <br>
   <? }?>

    <?$sub_total_format= number_format($sub_total, 2,".",",");?>
        <?$big_format= number_format($big, 2,".",",");?>
        <?$iva_format= number_format($iva, 2,".",",");?>
        <? $total_fact= $iva+ $total;?>
        <?$total_format= number_format($total_fact, 2,".",",");?>
<hr>
<table  align="right">

		<TD border="1"ROWSPAN=4 width="70%">Recibi conforme: ________________________________</TD>
	    	<th align="right" width="40%">Sub Total:</th>
            <td align="right" width="10%"><?=$sub_total_format;?></td>
            <tr>
            <th align="right" width="40%">Base Imponible:</th>
            <td align="right" width="10%"><?=$big_format;?></td>
            </tr>
            <th align="right" width="40%">Iva:</th>
            <td align="right" width="10%"><?=$iva_format;?></td>
            <tr>
          <th  align="right"width="40%">Total:</th>
            <td align="right" width="10%"><?=$total_format;?></td>
			</tr>
</table>

<hr>
<h3><STRONG>DOMINGO MORA ROLDAN </STRONG>ESCRIBANOS  34 -CP 28021 MADRID <STRONG>Email: </STRONG> bmlinexinternationalgroup@gmail.com <strong>Telefono: </strong> 633245469-600875396 <strong>CIF/NIF: </strong> 02269008-</h3>
</div> <!--cierra el div de la factura-->
</body>
</html>