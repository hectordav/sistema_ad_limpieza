<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
	<script type="text/javascript">
function imprSelec(factura)
        {
          var ficha=document.getElementById(factura);var ventimp=window.open(' ','popimpr');ventimp.document.write(ficha.innerHTML);ventimp.document.close();ventimp.print();ventimp.close();
          window.open("<?php echo $this->config->base_url();?>index.php/factura/menu_factura/","_self")
        }

</script>
</head>
<body>
<a href="javascript:imprSelec('factura')"><button type="button" class="btn btn-sm btn-info">Imprimir Factura</button></a>
<div id="factura">
 <?  $j=0;

    while ( $j<= 5) {?>
    <?$j=$j+1;?>
      <br>
   <? }?>
   <hr>
