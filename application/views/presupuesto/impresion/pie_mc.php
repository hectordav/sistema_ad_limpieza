    <?  $j=0;
    $i=15-$contar;

    while ( $j<= $i) {?>
    <?$j=$j+1;?>
      <br>
   <? }?>

    <?$sub_total_format= number_format($sub_total, 2,".",",");?>
        <?$big_format= number_format($big, 2,".",",");?>
        <?$iva_format= number_format($iva, 2,".",",");?>
        <? $total_fact= $iva+ $sub_total;?>
        <?$total_format= number_format($total_fact, 2,".",",");?>
      

<hr>
<table  align="right">

		<TD border="1"ROWSPAN=4 width="70%">Recibi conforme: ________________________________</TD>
	    	<th align="right" width="40%"><strong>Sub Total sin IVA:</strong></th>
            <td align="right" width="10%"><?=$sub_total_format;?></td>
            <tr>
           </tr>
            <th align="right" width="30%"><strong>Iva:</strong></th>
            <td align="right" width="10%"><?=$iva_format;?></td>
            <tr>
          <th  align="right"width="40%"><h3><strong>Total EUR.</strong></th></h3>
            <td align="right" width="10%"><h3><?=$total_format;?></td></h3>
			</tr>
</table>
<hr>
<h6><P ALIGN="CENTER"><STRONG>PROFESSIONAL HIGH SUPPLIES S.L </STRONG>ESCRIBANOS  34 -CP 28021 MADRID <STRONG>Email: </STRONG> bmlinexinternationalgroup@gmail.com <strong>Telefono: </strong> 633245469-600875396 <strong>CIF/NIF: </strong> 02269008-N</P></h6>    
</div> <!--cierra el div de la factura-->

</body>
</html>