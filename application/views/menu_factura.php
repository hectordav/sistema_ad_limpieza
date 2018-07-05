<br>
<br>
<div class="container" id="paginacion">

    <div class="row">
  <div class="col-lg-9">

 <a href="<?= $this->config->base_url();?>index.php/factura/agregar_factura"><button type="button" class="btn btn-md btn-primary">Nueva Factura</button></a>
  </div>

  <div class="col-lg-3">

    <div class="input-group">

      <input type="text" class="form-control" name="txt_buscar" id="txt_buscar">
      <div class="input-group-btn">
        <button type="button" class="btn btn-default dropdown-toggle glyphicon glyphicon-search"
                data-toggle="dropdown">
           <span class="caret"></span>
        </button>
        <ul class="dropdown-menu pull-right" role="menu">
          <li><a onclick="num_fact()" type href="#"># Factura</a></li>
          <li><a onclick="num_albarran()" type href="#"># Albarran</a></li>
          <li><a onclick="nif_cliente()">Nif Cliente</a></li>
          <li><a onclick="nombre_cliente()">Nombre Cliente</a></li>
        </ul><a href="<?= $this->config->base_url();?>index.php/factura/menu_factura"> <button type ="button" title="Actualizar"class="btn btn-default glyphicon glyphicon-repeat" ></button></a>
      </div>
    </div>
  </div>
            <table class="table table-condensed table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="col-md-1"># Factura</th>
                        <th class="col-md-1"># Albarran</th>
                        <th class="col-md-2">Nif</th>
                        <th class="col-md-2">Cliente</th>
                        <th class="col-md-1">Total</th>
                         <th class="col-md-1">Fecha</th>
                         <th class="col-md-1">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                 <? foreach($facturas_cargadas->result() as $data){?>
                    <tr>

                    <? $total_format= number_format($data->total, 2,".",",");?>
                     <? $fecha2=date("d-m-Y",strtotime($data->fecha));?>
                        <td><?echo $data->num_fact;?></td>
                         <td><?echo $data->num_control;?></td>
                        <td><?echo $data->nif;?></td>
                        <td><?echo $data->nombre;?></td>
                        <td><?echo $total_format;?></td>
                         <td><?echo $fecha2;?></td>
                        <td><a onclick="if(confirma() == false) return false" href="<?=base_url()?>index.php/factura/imprimir_x_tabla/<?=$data->id?>"><button type="button" title="Imprimir" class="btn btn-default glyphicon glyphicon-print" title="Eliminar Registro"></button></a>
            </td>
                    </tr>
                <? }; ?>
                </tbody>
        </table>
<ul class="pager" >
   <?=$this->pagination->create_links()?>
</ul>
    </div>
</div>




