<br>
<br>
<div class="container" id="paginacion">

    <div class="row">


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

 </div>


