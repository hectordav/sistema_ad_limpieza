		<div class="container">
			<div class="row">

				<div class="col-xs-9">

					<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="container">
      <div class="row">

<a class="navbar-brand " href="<?php echo $this->config->base_url();?>index.php/alerta/recibido">Alertas:<span class="badge">
             <?=$contar_a;?></span></a>
          <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">

            <a class="navbar-brand " href="<?php echo $this->config->base_url();?>index.php/login/logueado">Menu Principal</a>

            <ul class="nav navbar-nav">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Transacciones <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                 <li><a href="<?php echo $this->config->base_url();?>index.php/cliente">Clientes</a></li>
                 <li class="disabled"><a  href="#">Proveedor</a></li>
                  <li><a href="<?php echo $this->config->base_url();?>index.php/factura">Facturas</a></li>
                  <li><a href="<?php echo $this->config->base_url();?>index.php/presupuesto">Presupuestos</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a  class="disabled" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Productos <span class="caret" </span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="<?php echo $this->config->base_url();?>index.php/prod_ter_gc">Producto</a></li>
                  <li><a href="<?php echo $this->config->base_url();?>index.php/inventario_almacen">Inventario en almacenes</a></li>
                </ul>
              </li>
               <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Alertas<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="<?php echo $this->config->base_url();?>index.php/alerta/recibido">Recibidas</a></li>
                  <li><a href="<?php echo $this->config->base_url();?>index.php/alerta/enviado">Enviadas</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a class="disabled" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Balance <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                 <li ><a href="<?php echo $this->config->base_url();?>index.php/balance">Balance</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Configuracion <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li class="disabled"><a href="#">Configuracion de empresa</a></li>
                  <li class="disabled"><a href="#">Usuarios</a></li>
                  <li class="disabled"><a href="#">Configuracion de Impresion</a></li>
                  <li class="disabled"><a href="#">Iva</a></li>
                  <li class="disabled"><a href="#">Sucursales</a></li>
                   <li><a href="<?php echo $this->config->base_url();?>index.php/login/cerrar_sesion">Cerrar Sesion</a></li>
                </ul>
              </li>
            </ul>

          </div><!-- /.navbar-collapse -->
      </div>
    </div>
  </div><!-- /.container-fluid -->
</nav>

				</div>
		</div>
       <hr>
		</div>

