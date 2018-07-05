<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
	<script type="text/javascript" media="print">

function imprSelec(factura)
  
        {
      var ficha=document.getElementById(factura);
          var ventimp=window.open(' ','_blank');
          ventimp.document.write(ficha.innerHTML);
          ventimp.document.close();
          ventimp.print();
          ventimp.close();

          window.open("<?php echo $this->config->base_url();?>index.php/factura/menu_factura/","_self")
        }

</script>
</head>
<body>
<a href="javascript:imprSelec('factura')"><button type="button" class="btn btn-sm btn-default">Imprimir Factura</button></a>
<div id="factura">
<table width="100%" height="0%" border="0">
  <tbody>
    <tr>
      <td rowspan="8"> <LEFT> <IMG SRC="<?php echo $this->config->base_url();?>/assets/img/LOGO.png" WIDTH=370 HEIGHT=270 BORDER=0
</LEFT></td>
 <? foreach ($cliente->result() as $data) { ?>
    <tr>
      <td><br><br><br><br><br><br><br><br><br><br><strong>Razon Social: </strong><?=$data->nombre;?></td>
    </tr>
    <tr>
   <td><strong>Direccion: </strong><?=$data->direccion;?></td>
    </tr>
        <tr>
   <td><strong>Codigo Postal: </strong><?=$data->codigo_postal;?></td>
    </tr>
    <tr>
      <td><strong> Nif/Cif: </strong><?=$data->nif;?></td>
    </tr>

     <tr>
      <td><?=$data->telf;?> ,<?=$data->email;?></td>
    </tr>
         <tr>
      <td><strong>P.Contacto:</strong><?=$data->persona_contacto;?></td>
    </tr>

  </tbody>
</table>
<?}?>


