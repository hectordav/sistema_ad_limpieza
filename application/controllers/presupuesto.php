<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Presupuesto extends CI_Controller {
function __construct()
	{
		 parent::__construct();
		$this->load->helper('url');
		$this->load->helper('url_helper');
		$this->load->helper('date');
		$this->load->database();
	#***************para tomar un valor de una funcion del model (algo personal)**************
		$this->load->library('session');
		$this->load->model('iva_model');
		$this->load->model('presupuesto_model');
		$this->load->model('cliente_model');
		$this->load->model('empresa_model');
		$this->load->model('producto_terminado_model');
		$this->load->model('impresion_model');
		$this->load->model('punto_model');
		$this->load->library('pagination');
		$this->load->model('alerta_model');

	}
		public function index()
		{

		redirect('presupuesto/menu_presupuesto');
		}
		public function agregar_presupuesto()
		{
				if($this->session->userdata('logueado')){
		try {
				/* Creamos el objeto */
				$this->db->select('id','nombre');
				$data['records'] = $this->db->get('t_cliente');
				$this->load->view('../../assets/inc/head_common');
				#$this->load->view('../../assets/inc/menu_principal');
				$this->load->view('../../assets/script/script_cliente');
				$this->load->view('presupuesto/agregar_presupuesto', $data);
				$this->load->view('modal/modal_cliente');

			} catch (Exception $e) {
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
			}else{
		redirect('login');
	}

		}
		public function nuevo_presupuesto()
	{
	if($this->session->userdata('logueado')){
		date_default_timezone_set("Europe/Madrid");
		$variable = $this->input->post('txt_id_cliente');
		$data['obcliente'] = $this->cliente_model->buscar_cliente($variable);
		if ($data['obcliente']==false){
		$this->session->set_flashdata('alerta', 'No Usuario registrado correctamente!');
		redirect('presupuesto/agregar_presupuesto', 'refresh');
		}else{
	#******************************************************************************************
			foreach ($data['obcliente']->result() as $data )
				{
				$datos_cliente = array('id' =>$data->id,
				'nombre' =>$data->nombre,
				'direccion' =>$data->direccion,
				'telf' =>$data->telf,
				'email' =>$data->email
				); #fin del array.
				}; #fin del foreach.
	#******************************************************************************************
				$status_presupuesto='2';
				$sub_total='0';
				$total='0';
				$fecha = date('Y-m-d');
				$data_presupuesto = $this->presupuesto_model->nuevo_presupuesto($datos_cliente, $status_presupuesto, $sub_total, $total, $fecha);
				#busca el id de la ultima presupuesto
				$num_fact['numero']= $this->presupuesto_model->buscar_ultimo_presupuestoid();
				foreach ($num_fact['numero']->result() as $data )
				{
				$data_presupuesto = array('id' =>$data->id);
				}
	#******************************************************************************************

	#******************************************************************************************

	#******************************************************************************************
				$id_cliente=$datos_cliente['id'];
				$nombre_cliente=$datos_cliente['nombre'];
				$sub_total ='0';
				$big='0';
				$iva ='0';
				$total ='0';
				$fecha = date('Y-m-d');
				$status_presupuesto="1";
				$datos_presupuesto = array(
				'id'=>$data_presupuesto['id'],
				'nombre_cliente' => $datos_cliente['nombre'],
				'direccion' => $datos_cliente['direccion'],
				'telf' => $datos_cliente['telf'],'sub_total'=>$sub_total,
				'big'=>$big,'iva'=>$iva,'total'=>$total );
				#las vistas
	#******************************************************************************************
				$status_alerta=2;
					$contar_alerta['contar_a']=$this->alerta_model->contar_alerta($status_alerta);
						if ($contar_alerta['contar_a']==true) {
				$this->load->view('../../assets/inc/head_common');
				$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
				$this->load->view('../../assets/script/script_producto');
				$this->load->view('presupuesto/nuevo_presupuesto',$datos_presupuesto,$data);
				$this->load->view('modal/modal_producto');
				$this->load->view('modal/modal_producto_cantidad');
						}else{
				$contar_alerta['contar_a']=0;
				$this->load->view('../../assets/inc/head_common');
				$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
				$this->load->view('../../assets/script/script_producto');
				$this->load->view('presupuesto/nuevo_presupuesto',$datos_presupuesto,$data);
				$this->load->view('modal/modal_producto');
				$this->load->view('modal/modal_producto_cantidad');
						}


			}
		}else{
				redirect('login');
			}
		}
		public function agregar_producto()
	{
		if($this->session->userdata('logueado')){
			$id_sucursal= $this->session->userdata('id_sucursal');
			$producto= $this->input->post('txt_producto');
			$id= $this->input->post('lbl_num_fact');
			$cantidad= $this->input->post('txt_cantidad');
			$inv_producto= $this->producto_terminado_model->buscar_producto($producto, $id_sucursal);
			$presupuesto= $this->presupuesto_model->buscar_presupuesto($id);
			$cantidad_pag=$cantidad;
	#******************************************************************************************
			#el producto
			foreach ($inv_producto->result() as $data )
			{
						$datos_producto = array(
						'id' => $data->id,
						'producto' => $data->producto,
						'cantidad'=>$data->cantidad,
						'precio_neto' => $data->precio_neto,
						'iva' => $data->iva,
						'total' => $data->total
				); #fin del array.
				}; #fin del foreach.


	#*****************************************************************************************
			#los datos de la presupuesto
			foreach ($presupuesto->result() as $data)
				{
						$datos_presupuesto = array('id' => $data->id,
						'id_cliente' => $data->id_cliente,
						'id_usuario' => $data->id_usuario,
						'sub_total' => $data->sub_total,
						'exento' => $data->exento,
						'big' => $data->big,
						'iva' => $data->iva,
						'total' => $data->total,
						'fecha' => $data->fecha,
						'observaciones' => $data->total

				); #fin del array.
				} #fin del foreach.
		#toma el dato de la presupuesto(id_cliente) y busca en la tabla cliente.
			$variable=$datos_presupuesto['id_cliente'];
			$datacliente = $this->cliente_model->buscar_cliente_id($variable);
	#******************************************************************************************
		#los datos del cliente
			foreach ($datacliente->result() as $data )
			{
			$datos_cliente = array('id' =>$data->id,
						'nombre' =>$data->nombre,
						'direccion' =>$data->direccion,
						'telf' =>$data->telf,
						'email' =>$data->email
					); #fin del array.
					} #fin del foreach.
	#******************************************************************************************
				#todos los datos de la presupuesto cargada
			$datos_b_presupuesto = array('id' => $datos_presupuesto['id'],
						'nombre_cliente' => $datos_cliente['nombre'],
						'direccion' => $datos_cliente['direccion'],
						'telf' => $datos_cliente['telf'],
						'sub_total' => $datos_presupuesto['sub_total'],
						'exento' => $datos_presupuesto['exento'],
						'big' => $datos_presupuesto['big'],
						'iva' => $datos_presupuesto['iva'],
						'total' => $datos_presupuesto['total']
						); #fin del array.
	#******************************************************************************************
			$precio_neto= $datos_producto['precio_neto']*$cantidad;
			$iva= $datos_producto['iva']*$cantidad;
			$total=$precio_neto+$iva;
			#los datos del det_presupuesto
			$data_det_presupuesto = array('id_presupuesto' =>$datos_b_presupuesto['id'],
						'id_inventario_sucursal' =>$datos_producto['id'],
						'descripcion' =>$datos_producto['producto'],
						'cantidad' =>$cantidad,
						'precio_u' =>$datos_producto['precio_neto'],
						'iva' =>$iva,
						'total' =>$precio_neto
						 ); #fin del array.
	#******************************************************************************************
			#guarda los datos en det_presupuesto
			$data_presupuesto = $this->presupuesto_model->insertar_det_presupuesto($data_det_presupuesto);
			#busca los datos guardados
			$datos_det_presupuesto['det_fact']=$this->presupuesto_model->buscar_det_presupuesto($data_det_presupuesto);
			#suma el iva el total y resta  entre esos dos para obtener el precio neto
			$sum_iva_det_presupuesto=$this->presupuesto_model->sumar_iva_det_presupuesto($data_det_presupuesto);
			$sum_total_det_presupuesto=$this->presupuesto_model->sumar_total_det_presupuesto($data_det_presupuesto);
			foreach ($sum_iva_det_presupuesto->result() as $data) {
					$iva = array('iva' =>$data->iva);
			}#fin del foreach.
			foreach ($sum_total_det_presupuesto->result() as $data) {
					$total = array('total' =>$data->total);
			}#fin del foreach.

	#******************************************************************************************
			$total_f= $total['total'];
			$iva_f=$iva['iva'];
			$precio_neto=$total_f;
			$total_presupuesto=$total_f+$iva_f;
	#******************************************************************************************
			$actualizar= $this->presupuesto_model->actualizar_presupuesto($data_det_presupuesto,$iva,$precio_neto,$total);
	#******************************************************************************************
	$datos_t_presupuesto = array('id' => $datos_presupuesto['id'],
						'nombre_cliente' => $datos_cliente['nombre'],
						'direccion' => $datos_cliente['direccion'],
						'telf' => $datos_cliente['telf'],
						'sub_total' => $precio_neto,
						'exento' => $datos_presupuesto['exento'],
						'big' => $precio_neto,
						'iva' => $iva_f,
						'total' => $total_presupuesto
						); #fin del array.
	#******************************************************************************************
			$status_alerta=2;
					$contar_alerta['contar_a']=$this->alerta_model->contar_alerta($status_alerta);
						if ($contar_alerta['contar_a']==true) {
						$this->load->view('../../assets/inc/head_common');
						$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
						$this->load->view('../../assets/script/script_efectivo');
						$this->load->view('../../assets/script/script_producto');
						$this->load->view('presupuesto/agregar_producto',$datos_t_presupuesto);
						$this->load->view('presupuesto/tabla_det_presupuesto',$datos_det_presupuesto);
						$this->load->view('presupuesto/totales_presupuesto',$datos_t_presupuesto);
						$this->load->view('modal/modal_imprimir');
						$this->load->view('modal/modal_producto');
						$this->load->view('modal/modal_producto_cantidad');
						$this->load->view('modal/modalpunto');
						$this->load->view('modal/modal_efectivo');
						$this->load->view('modal/modal_cheque');
						}else{
						$contar_alerta['contar_a']=0;
						$this->load->view('../../assets/inc/head_common');
						$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
						$this->load->view('../../assets/script/script_efectivo');
						$this->load->view('../../assets/script/script_producto');
						$this->load->view('presupuesto/agregar_producto',$datos_t_presupuesto);
						$this->load->view('presupuesto/tabla_det_presupuesto',$datos_det_presupuesto);
							$this->load->view('presupuesto/totales_presupuesto',$datos_t_presupuesto);
						$this->load->view('modal/modal_imprimir');
						$this->load->view('modal/modal_producto');
						$this->load->view('modal/modal_producto_cantidad');
						$this->load->view('modal/modalpunto');
						$this->load->view('modal/modal_efectivo');
						$this->load->view('modal/modal_cheque');
						}


		}else{
				redirect('login');
		}
	}

		public function eliminar_presupuesto()

		{
				$id = $this->uri->segment(3);
				$eliminar= $this->presupuesto_model->borrar_presupuesto($id);
				redirect('presupuesto/menu_presupuesto');

		}


			public function eliminar_registro()
		{
			if($this->session->userdata('logueado')){
			#id det presupuesto
				$id = $this->uri->segment(3);
				#id factura
				$id_factura= $this->uri->segment(4);
				#iva el buscar det factura ojo.
				$eliminar= $this->presupuesto_model->borrar_reg_det_presupuesto($id);
				$id_presupuesto['id_presupuesto']=$id_factura;
				$sum_iva_det_factura=$this->presupuesto_model->sumar_iva_det_presupuesto($id_presupuesto);
				$sum_total_det_factura=$this->presupuesto_model->sumar_total_det_presupuesto($id_presupuesto);
	#******************************************************************************************
					foreach ($sum_iva_det_factura->result() as $data) {
					$iva = array('iva' =>$data->iva);
					}#fin del foreach.
					foreach ($sum_total_det_factura->result() as $data) {
					$total = array('total' =>$data->total);
					}#fin del foreach.
	#******************************************************************************************
				$total_f= $total['total'];
				$iva_f=$iva['iva'];
				$precio_neto=$total_f;
				$total_factura=$total_f+$iva_f;
	#******************************************************************************************
				$this->presupuesto_model->actualizar_presupuesto($id_presupuesto,$iva,$precio_neto,$total);

				$factura = $this->presupuesto_model->buscar_presupuesto($id_factura);
				#los datos de la factura

	#******************************************************************************************
					foreach ($factura->result() as $data)
					{
					$datos_factura = array('id' => $data->id,
					'id_cliente' => $data->id_cliente,
					'id_usuario' => $data->id_usuario,
					'num_fact' => $data->num_fact,
					'num_control' => $data->num_control,
					'sub_total' => $data->sub_total,
					'exento' => $data->exento,
					'big' => $data->big,
					'iva' => $data->iva,
					'total' => $data->total,
					'fecha' => $data->fecha,
					'observaciones' => $data->total
				); #fin del array.
				} #fin del foreach.
	#******************************************************************************************
				$variable= $datos_factura ['id_cliente'];
				$datacliente = $this->cliente_model->buscar_cliente_id($variable);
	#******************************************************************************************
				#los datos del cliente
	#******************************************************************************************
					foreach ($datacliente->result() as $data )
					{
					$datos_cliente = array('id' =>$data->id,
								'nombre' =>$data->nombre,
								'direccion' =>$data->direccion,
								'telf' =>$data->telf,
								'email' =>$data->email
							); #fin del array.
							} #fin del foreach.
	#******************************************************************************************
						$datos_t_factura = array('id' => $datos_factura['id'],
						'num_fact' => $datos_factura['num_fact'],
						'nombre_cliente' => $datos_cliente['nombre'],
						'direccion' => $datos_cliente['direccion'],
						'telf' => $datos_cliente['telf'],
						'sub_total' => $precio_neto,
						'exento' => $datos_factura['exento'],
						'big' => $precio_neto,
						'iva' => $iva_f,
						'total' => $total_factura
						); #fin del array.
	#******************************************************************************************
				$datos_det_factura['det_fact']=$this->presupuesto_model->buscar_det_presupuesto($id_presupuesto);
				if ($datos_det_factura['det_fact']==false){
						$status_alerta=2;
					$contar_alerta['contar_a']=$this->alerta_model->contar_alerta($status_alerta);
						if ($contar_alerta['contar_a']==true) {
					$this->load->view('../../assets/inc/head_common');
					$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
					$this->load->view('../../assets/script/script_producto');
					$this->load->view('presupuesto/agregar_producto',$datos_t_factura);
					$this->load->view('modal/modal_producto');
					$this->load->view('modal/modal_producto_cantidad');
					$this->load->view('modal/modal_imprimir');
						}else{
					$this->load->view('../../assets/inc/head_common');
					$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
					$this->load->view('../../assets/script/script_producto');
					$this->load->view('presupuesto/agregar_producto',$datos_t_factura);
					$this->load->view('modal/modal_producto');
					$this->load->view('modal/modal_producto_cantidad');
					$this->load->view('modal/modal_imprimir');
						}

				}else{
					$status_alerta=2;
					$contar_alerta['contar_a']=$this->alerta_model->contar_alerta($status_alerta);
						if ($contar_alerta['contar_a']==true) {
					$this->load->view('../../assets/inc/head_common');
					$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
					$this->load->view('../../assets/script/script_producto');
					$this->load->view('presupuesto/agregar_producto',$datos_t_factura);
					$this->load->view('presupuesto/tabla_det_presupuesto',$datos_det_factura);
					$this->load->view('presupuesto/totales_presupuesto',$datos_t_factura);
					$this->load->view('modal/modal_imprimir');
					$this->load->view('modal/modal_producto');
					$this->load->view('modal/modal_producto_cantidad');
					$this->load->view('modal/modal_efectivo');
						}else{
					$this->load->view('../../assets/inc/head_common');
					$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
					$this->load->view('../../assets/script/script_producto');
					$this->load->view('presupuesto/agregar_producto',$datos_t_factura);
					$this->load->view('presupuesto/tabla_det_presupuesto',$datos_det_factura);
					$this->load->view('presupuesto/totales_presupuesto',$datos_t_factura);
					$this->load->view('modal/modal_imprimir');
					$this->load->view('modal/modal_producto');
					$this->load->view('modal/modal_producto_cantidad');
					$this->load->view('modal/modal_efectivo');
						}


					}
				}else{
							redirect('login');
					}
		}
		public function imprimir(){
		if($this->session->userdata('logueado')){
				$id_factura= $this->input->post('id');
				$id_presupuesto['id_presupuesto']=$id_factura;
				$presupuesto = $this->presupuesto_model->buscar_presupuesto($id_factura);
				$datos_impresion=$this->impresion_model->buscar_impresion();
	#******************************************************************************************
					foreach ($presupuesto->result() as $data)
						{
						$datos_presupuesto = array('id' => $data->id,
						'id_cliente' => $data->id_cliente,
						'id_usuario' => $data->id_usuario,
						'sub_total' => $data->sub_total,
						'exento' => $data->exento,
						'big' => $data->big,
						'iva' => $data->iva,
						'total' => $data->total,
						'fecha' => $data->fecha,
						'observaciones' => $data->total
					); #fin del array.
					} #fin del foreach.

			foreach ($datos_impresion->result() as $data)
						{
						$impresiones = array(
						'fac_mc_ne' => $data->fac_mc_ne,
						'fac_hc_ne' => $data->fac_hc_ne,
						'fac_mc_sne' => $data->fac_mc_sne,
						'fac_hc_sne' => $data->fac_hc_sne

					); #fin del array.
					} #fin del foreach.

	#******************************************************************************************
				$variable= $datos_presupuesto ['id_cliente'];
				$datacliente['cliente'] = $this->cliente_model->buscar_cliente_id($variable);
				$datos_det_factura['det_fact']=$this->presupuesto_model->buscar_det_presupuesto($id_presupuesto);
				$contar_det_fact=$this->presupuesto_model->contar_det_presupuesto_reg($id_factura);
				$empresa= $this->empresa_model->buscar_empresa();
					foreach ($empresa->result() as $data)
						{
						$datos_empresa = array(
						'nombre' => $data->nombre,
						'rif' => $data->rif,
						'direccion' => $data->direccion,
						'telf_1' => $data->telf_1,
						'telf_2' => $data->telf_2,
						'id_factura' => $id_factura

					); #fin del array.
					} #fin del foreach
	#*****************************************************************************************

		$datos_pie = array('sub_total' => $datos_presupuesto['sub_total'],
							'big' => $datos_presupuesto['big'],
							'iva' => $datos_presupuesto['iva'],
							'total_fact' => $datos_presupuesto['total'],
							'contar' => $contar_det_fact
							 );

				if ($impresiones['fac_mc_ne']=='si') {
					$this->load->view('presupuesto/impresion/cabecera_ne',$datos_empresa);
					$this->load->view('presupuesto/impresion/num_fact',$datos_factura);
					$this->load->view('presupuesto/impresion/cliente',$datacliente);
					$this->load->view('presupuesto/impresion/det_factura',$datos_det_factura);
					$this->load->view('presupuesto/impresion/pie_mc',$datos_pie);
				}elseif($impresiones['fac_hc_ne']=='si'){
					$this->load->view('presupuesto/impresion/cabecera_ne',$datos_empresa);
					$this->load->view('presupuesto/impresion/num_fact',$datos_factura);
					$this->load->view('presupuesto/impresion/cliente',$datacliente);
					$this->load->view('presupuesto/impresion/det_factura',$datos_det_factura);
					$this->load->view('presupuesto/impresion/pie_hc',$datos_pie);

				}elseif($impresiones['fac_mc_sne']=='si'){
					$this->load->view('presupuesto/impresion/cabecera_sne',$datos_empresa);
					$this->load->view('presupuesto/impresion/num_fact',$datos_factura);
					$this->load->view('presupuesto/impresion/cliente',$datacliente);
					$this->load->view('presupuesto/impresion/det_factura',$datos_det_factura);
					$this->load->view('presupuesto/impresion/pie_mc',$datos_pie);

				}elseif ($impresiones['fac_hc_sne']=='si') {
					$this->load->view('presupuesto/impresion/cabecera_sne',$datos_empresa);
					$this->load->view('presupuesto/impresion/num_fact',$datos_factura);
					$this->load->view('presupuesto/impresion/cliente',$datacliente);
					$this->load->view('presupuesto/impresion/det_factura',$datos_det_factura);
					$this->load->view('presupuesto/impresion/pie_hc',$datos_pie);
				}
		}else{
			redirect('login');
		}
	}
		public function menu_presupuesto()
	{
			if($this->session->userdata('logueado')){
		try {
			$id_nivel=$this->session->userdata('id_nivel');
		# paginacion.
		$pages=10; //Número de registros mostrados por páginas
		$config['base_url'] = base_url().'index.php/presupuesto/menu_presupuesto/'; // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
		$config['total_rows'] = $this->presupuesto_model->filas();//calcula el número de filas
		$config['per_page'] = $pages; //Número de registros mostrados por páginas
        $config['num_links'] = 5; //Número de links mostrados en la paginación
 		$config['first_link'] = 'Primera';//primer link
		$config['last_link'] = 'Última';//último link
        $config["uri_segment"] = 3;//el segmento de la paginación
		$config['next_link'] = 'Siguiente';//siguiente link
		$config['prev_link'] = 'Anterior';//anterior link
		$config['full_tag_open'] = '<div id="paginacion">';//el div que debemos maquetar
		$config['full_tag_close'] = '</div>';//el cierre del div de la paginación
		$this->pagination->initialize($config); //inicializamos la paginación
		$factura['facturas_cargadas']= $this->presupuesto_model->menu_presupuesto($config['per_page'],$this->uri->segment(3));
		$status_alerta=2;
					$contar_alerta['contar_a']=$this->alerta_model->contar_alerta($status_alerta);
						if ($contar_alerta['contar_a']==true) {
						if ($id_nivel==1 || $id_nivel==2 ){
							$data = array();
				$this->load->view('../../assets/inc/head_common');
				$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
			$this->load->view('../../assets/script/script_buscar');
			$this->load->view('presupuesto/menu_presupuesto', $factura);
			$this->load->view('modal/modal_buscar');
			$this->load->view('modal/modal_menos_8_digitos');
			$this->load->view('../../assets/inc/footer_common');
						}else{
	$data = array();
			$this->load->view('../../assets/inc/head_common');
			$this->load->view('../../assets/inc/menu_principal_n3',$contar_alerta);
			$this->load->view('../../assets/script/script_buscar');
			$this->load->view('presupuesto/menu_presupuesto', $factura);
			$this->load->view('modal/modal_buscar');
			$this->load->view('modal/modal_menos_8_digitos');
			$this->load->view('../../assets/inc/footer_common');
						}
					}else{
				if ($id_nivel==1 || $id_nivel==2 ){
				$contar_alerta['contar_a']=0;
				$data = array();
				$this->load->view('../../assets/inc/head_common');
				$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
			$this->load->view('../../assets/script/script_buscar');
			$this->load->view('presupuesto/menu_presupuesto', $factura);
			$this->load->view('modal/modal_buscar');
			$this->load->view('modal/modal_menos_8_digitos');
			$this->load->view('../../assets/inc/footer_common');
				}else{
			$contar_alerta['contar_a']=0;
				$data = array();
				$this->load->view('../../assets/inc/head_common');
				$this->load->view('../../assets/inc/menu_principal_n3',$contar_alerta);
			$this->load->view('../../assets/script/script_buscar');
			$this->load->view('presupuesto/menu_presupuesto', $factura);
			$this->load->view('modal/modal_buscar');
			$this->load->view('modal/modal_menos_8_digitos');
			$this->load->view('../../assets/inc/footer_common');
				}
			}

		} catch (Exception $e) {
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
		}else{
					redirect('login');

		}
	}
		public function imprimir_x_tabla(){
	if($this->session->userdata('logueado')){
				$id_factura= $this->uri->segment(3);
				$id_presupuesto['id_presupuesto']=$id_factura;
				$factura = $this->presupuesto_model->buscar_presupuesto($id_factura);
				$datos_impresion=$this->impresion_model->buscar_impresion();
	#******************************************************************************************
					foreach ($factura->result() as $data)
						{
						$datos_factura = array('id' => $data->id,
						'id_cliente' => $data->id_cliente,
						'id_usuario' => $data->id_usuario,
						'num_fact' => $data->num_fact,
						'num_control' => $data->num_control,
						'sub_total' => $data->sub_total,
						'exento' => $data->exento,
						'big' => $data->big,
						'iva' => $data->iva,
						'total' => $data->total,
						'fecha' => $data->fecha,
						'observaciones' => $data->total
					); #fin del array.
					} #fin del foreach.
			foreach ($datos_impresion->result() as $data)
						{
						$impresiones = array(
						'fac_mc_ne' => $data->fac_mc_ne,
						'fac_hc_ne' => $data->fac_hc_ne,
						'fac_mc_sne' => $data->fac_mc_sne,
						'fac_hc_sne' => $data->fac_hc_sne

					); #fin del array.
					} #fin del foreach.


	#******************************************************************************************
				$variable= $datos_factura ['id_cliente'];
				$datacliente['cliente'] = $this->cliente_model->buscar_cliente_id($variable);
				$datos_det_factura['det_fact']=$this->presupuesto_model->buscar_det_presupuesto($id_presupuesto);
				$contar_det_fact=$this->presupuesto_model->contar_det_presupuesto_reg($id_factura);
				$empresa= $this->empresa_model->buscar_empresa();

					foreach ($empresa->result() as $data)
						{
						$datos_empresa = array(
						'nombre' => $data->nombre,
						'rif' => $data->rif,
						'direccion' => $data->direccion,
						'telf_1' => $data->telf_1,
						'telf_2' => $data->telf_2,
						'id_factura' => $id_factura

					); #fin del array.
					} #fin del foreach
	#*****************************************************************************************

		$datos_pie = array('sub_total' => $datos_factura['sub_total'],
							'big' => $datos_factura['big'],
							'iva' => $datos_factura['iva'],
							'total_fact' => $datos_factura['total'],
							'contar' => $contar_det_fact
							 );
				if ($impresiones['fac_mc_ne']=='si') {
					$this->load->view('presupuesto/impresion/cabecera_ne',$datacliente);
					$this->load->view('presupuesto/impresion/num_fact',$datos_factura);
				//	$this->load->view('presupuesto/impresion/cliente',$datacliente);
					$this->load->view('presupuesto/impresion/det_factura',$datos_det_factura);
					$this->load->view('presupuesto/impresion/pie_mc',$datos_pie);
				}elseif($impresiones['fac_hc_ne']=='si'){
					$this->load->view('presupuesto/impresion/cabecera_ne',$datos_empresa);
					$this->load->view('presupuesto/impresion/num_pre',$datos_factura);
					$this->load->view('presupuesto/impresion/cliente',$datacliente);
					$this->load->view('presupuesto/impresion/det_presupuesto',$datos_det_factura);
					$this->load->view('presupuesto/impresion/pie_hc',$datos_pie);

				}elseif($impresiones['fac_mc_sne']=='si'){
					$this->load->view('presupuesto/impresion/cabecera_sne',$datos_empresa);
					$this->load->view('presupuesto/impresion/num_pre',$datos_factura);
					$this->load->view('presupuesto/impresion/cliente',$datacliente);
					$this->load->view('presupuesto/impresion/det_presupuesto',$datos_det_factura);
					$this->load->view('presupuesto/impresion/pie_mc',$datos_pie);

				}elseif ($impresiones['fac_hc_sne']=='si') {
					$this->load->view('presupuesto/impresion/cabecera_sne',$datos_empresa);
					$this->load->view('presupuesto/impresion/num_pre',$datos_factura);
					$this->load->view('presupuesto/impresion/cliente',$datacliente);
					$this->load->view('presupuesto/impresion/det_presupuesto',$datos_det_factura);
					$this->load->view('presupuesto/impresion/pie_hc',$datos_pie);
				}
			}else{
				redirect('login');
			}
		}
}

/* End of file presupuesto.php */
/* Location: ./application/controllers/presupuesto.php */