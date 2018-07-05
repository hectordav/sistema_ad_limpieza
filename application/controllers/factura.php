<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Factura extends CI_Controller
 {
function __construct()
	{
		 parent::__construct();
		$this->load->helper('url');
		$this->load->helper('url_helper');
		$this->load->helper('date');
		$this->load->helper('pdf_helper');
		$this->load->database();
	#***************para tomar un valor de una funcion del model (algo personal)**************
		$this->load->library('session');
		$this->load->library('cezpdf');
		$this->load->model('iva_model');
		$this->load->model('factura_model');
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


		redirect('factura/menu_factura');
		}
	public function agregar_factura()
	{
		if($this->session->userdata('logueado')){
		try {
		 /* Creamos el objeto */
		$this->db->select('id','nombre');
		$data['records'] = $this->db->get('t_cliente');
		$this->load->view('../../assets/inc/head_common');
		#$this->load->view('../../assets/inc/menu_principal');
		$this->load->view('../../assets/script/script_cliente');
		$this->load->view('factura/agregar_factura', $data);
		$this->load->view('modal/modal_cliente');

		} catch (Exception $e) {
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
		}
		else{
					redirect('login');
		}
	}
		public function menu_factura()
	{
		if($this->session->userdata('logueado')){
		try {
			$id_usuario=$this->session->userdata('id');
			$id_nivel= $this->session->userdata('id_nivel');
			$buscar= $this->factura_model->buscar_facturas_monto_cero($id_usuario);
			while ($buscar==true)
			{
				foreach ($buscar->result() as $data )
				{
					$id_factura = array(
					'id' => $data->id
					); #fin del array.
				}; #fin del foreach.
				$borrar= $this->factura_model->borrar_factura_en_cero($id_factura);
				$buscar= $this->factura_model->buscar_facturas_monto_cero($id_usuario);
			}
		# paginacion.
		$pages=10; //Número de registros mostrados por páginas
		$config['base_url'] = base_url().'index.php/factura/menu_factura/'; // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
		$config['total_rows'] = $this->factura_model->filas($id_usuario);//calcula el número de filas
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
		$factura['facturas_cargadas']= $this->factura_model->menu_factura($config['per_page'],$this->uri->segment(3), $id_usuario);

			$status_alerta=2;
			$contar_alerta['contar_a']=$this->alerta_model->contar_alerta($status_alerta);
			if ($factura['facturas_cargadas']){
					if ($contar_alerta['contar_a']==true) {
						if ($id_nivel==1 || $id_nivel==2 ){
							$data = array();
			$this->load->view('../../assets/inc/head_common');
			$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
			$this->load->view('../../assets/script/script_buscar');
			$this->load->view('factura/menu_factura', $factura);
			$this->load->view('modal/modal_buscar');
			$this->load->view('modal/modal_menos_8_digitos');
			$this->load->view('../../assets/inc/footer_common');
						}else{
			$data = array();
			$this->load->view('../../assets/inc/head_common');
			$this->load->view('../../assets/inc/menu_principal_n3',$contar_alerta);
			$this->load->view('../../assets/script/script_buscar');
			$this->load->view('factura/menu_factura', $factura);
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
			$this->load->view('factura/menu_factura', $factura);
			$this->load->view('modal/modal_buscar');
			$this->load->view('modal/modal_menos_8_digitos');
			$this->load->view('../../assets/inc/footer_common');
				}else{
			$contar_alerta['contar_a']=0;
				$data = array();
				$this->load->view('../../assets/inc/head_common');
				$this->load->view('../../assets/inc/menu_principal_n3',$contar_alerta);
			$this->load->view('../../assets/script/script_buscar');
			$this->load->view('factura/menu_factura', $factura);
			$this->load->view('modal/modal_buscar');
			$this->load->view('modal/modal_menos_8_digitos');
			$this->load->view('../../assets/inc/footer_common');
				}
				}
			}else{
				if ($contar_alerta['contar_a']==true) {
					if ($id_nivel==1 || $id_nivel==2 ){
							$data = array();
	$this->load->view('../../assets/inc/head_common');
	$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
	$this->load->view('../../assets/script/script_buscar');
	$this->load->view('factura/sin_menu_factura');
	$this->load->view('modal/modal_buscar');
	$this->load->view('modal/modal_menos_8_digitos');
	$this->load->view('../../assets/inc/footer_common');
					}else{
	$data = array();
	$this->load->view('../../assets/inc/head_common');
	$this->load->view('../../assets/inc/menu_principal_n3',$contar_alerta);
	$this->load->view('../../assets/script/script_buscar');
	$this->load->view('factura/sin_menu_factura');
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
	$this->load->view('factura/sin_menu_factura');
	$this->load->view('modal/modal_buscar');
	$this->load->view('modal/modal_menos_8_digitos');
	$this->load->view('../../assets/inc/footer_common');
				}else{
	$contar_alerta['contar_a']=0;
	$data = array();
	$this->load->view('../../assets/inc/head_common');
	$this->load->view('../../assets/inc/menu_principal_n3',$contar_alerta);
	$this->load->view('../../assets/script/script_buscar');
	$this->load->view('factura/sin_menu_factura');
	$this->load->view('modal/modal_buscar');
	$this->load->view('modal/modal_menos_8_digitos');
	$this->load->view('../../assets/inc/footer_common');
				}
				}
			}
		} catch (Exception $e) {
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
		}else{
				redirect('login');
		}
	}
		public function buscar_num_factura_nif_cliente()
	{
			if($this->session->userdata('logueado')){
		try {
			$nif_cliente= $this->input->post('id');

		$factura['facturas_cargadas']= $this->factura_model->buscar_factura_nif_cliente($nif_cliente);
		if ($factura['facturas_cargadas']==false){
		}else{
			$status_alerta=2;
			$contar_alerta['contar_a']=$this->alerta_model->contar_alerta($status_alerta);
					if ($contar_alerta['contar_a']==true) {
						$this->load->view('../../assets/inc/head_common');
						$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
						$this->load->view('../../assets/script/script_buscar');
						$this->load->view('factura/menu_factura', $factura);
						$this->load->view('modal/modal_buscar');
					}else{
			$contar_alerta['contar_a']=0;
						$this->load->view('../../assets/inc/head_common');
						$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
						$this->load->view('../../assets/script/script_buscar');
						$this->load->view('factura/menu_factura', $factura);
						$this->load->view('modal/modal_buscar');
					}


		}

		} catch (Exception $e) {
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
		}else{
			redirect('login');
		}
	}
		public function buscar_num_factura_nombre_cliente()
	{
			if($this->session->userdata('logueado')){
		try {
			$nombre= $this->input->post('id');

		$factura['facturas_cargadas']= $this->factura_model->buscar_factura_nombre_cliente($nombre);
		if ($factura['facturas_cargadas']==false){

		}else{
			$status_alerta=2;
			$contar_alerta['contar_a']=$this->alerta_model->contar_alerta($status_alerta);
					if ($contar_alerta['contar_a']==true) {
						$this->load->view('../../assets/inc/head_common');
						$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
						$this->load->view('../../assets/script/script_buscar');
						$this->load->view('factura/menu_factura', $factura);
						$this->load->view('modal/modal_buscar');
					}else{
			$contar_alerta['contar_a']=0;
						$this->load->view('../../assets/inc/head_common');
						$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
						$this->load->view('../../assets/script/script_buscar');
						$this->load->view('factura/menu_factura', $factura);
						$this->load->view('modal/modal_buscar');
					}
		}

		} catch (Exception $e) {
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
		}else{
			redirect('login');
		}
	}
		public function buscar_num_albarran()
	{
		if($this->session->userdata('logueado')){

		try {
			$num_albarran= $this->input->post('id');

		$factura['facturas_cargadas']= $this->factura_model->buscar_factura_num_albarran($num_albarran);
		if ($factura['facturas_cargadas']==false){

		}else{
			$status_alerta=2;
			$contar_alerta['contar_a']=$this->alerta_model->contar_alerta($status_alerta);
					if ($contar_alerta['contar_a']==true) {
						$this->load->view('../../assets/inc/head_common');
						$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
						$this->load->view('../../assets/script/script_buscar');
						$this->load->view('factura/menu_factura', $factura);
						$this->load->view('modal/modal_buscar');
					}else{
			$contar_alerta['contar_a']=0;
						$this->load->view('../../assets/inc/head_common');
						$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
						$this->load->view('../../assets/script/script_buscar');
						$this->load->view('factura/menu_factura', $factura);
						$this->load->view('modal/modal_buscar');
					}
		}

		} catch (Exception $e) {
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
			}else{
			redirect('login');
		}
	}
		public function buscar_num_factura()
	{
		if($this->session->userdata('logueado')){

		try {
			$num_factura= $this->input->post('id');

		$factura['facturas_cargadas']= $this->factura_model->buscar_factura_num_fact($num_factura);
		if ($factura['facturas_cargadas']==false){

		}else{
			$status_alerta=2;
			$contar_alerta['contar_a']=$this->alerta_model->contar_alerta($status_alerta);
					if ($contar_alerta['contar_a']==true) {
						$this->load->view('../../assets/inc/head_common');
						$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
						$this->load->view('../../assets/script/script_buscar');
						$this->load->view('factura/menu_factura', $factura);
						$this->load->view('modal/modal_buscar');
					}else{
			$contar_alerta['contar_a']=0;
						$this->load->view('../../assets/inc/head_common');
						$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
						$this->load->view('../../assets/script/script_buscar');
						$this->load->view('factura/menu_factura', $factura);
						$this->load->view('modal/modal_buscar');
					}
		}

		} catch (Exception $e) {
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
			}else{
			redirect('login');
		}
	}
	public function get_producto_existe()
	{
			$id_sucursal=$this->session->userdata('id_sucursal');
		$id=$this->input->post('txt_producto');

		$data= $this->producto_terminado_model->get($id, $id_sucursal);
			echo json_encode($data);
	}
	public function get_cliente_existe()
	{
			$id=$this->input->post('txt_id_cliente');
			$data= $this->cliente_model->get($id);
				echo json_encode($data);
	}
	public function get_cliente_autocom()
	{
			$match = $this->input->get('term', TRUE);  # TRUE para hacer un filtrado XSS
			$item = $this->input->get('item', TRUE);
			$data['item'] = $item;
			$data['results']= $this->cliente_model->get_data($item,$match);
			$this->load->view('cliente/data',$data);
	}
	function get_producto_autocom()
	{
			$match = $this->input->get('term', TRUE);  # TRUE para hacer un filtrado XSS
			$item = $this->input->get('item', TRUE);
			$data['item'] = $item;
			$data['results'] = $this->producto_terminado_model->get_data($item,$match);
			$this->load->view('cliente/data',$data);
	}
	public function nueva_factura()
	{
	if($this->session->userdata('logueado')){
		$id_usuario=$this->session->userdata('id');
		date_default_timezone_set("Europe/Madrid");
		$variable = $this->input->post('txt_id_cliente');
		$data['obcliente'] = $this->cliente_model->buscar_cliente($variable);
		if ($data['obcliente']==false){
		$this->session->set_flashdata('alerta', 'No Usuario registrado correctamente!');
		redirect('factura/agregar_factura', 'refresh');
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
				#busca el id de la ultima factura
				$num_fact['numero']= $this->factura_model->buscar_ultima_facturaid();
				foreach ($num_fact['numero']->result() as $data )
				{
				$data_factura = array('id' =>$data->id);
				}
	#******************************************************************************************
				#busca el num de factura y control de la ultima factura
				$num_fact['numero']= $this->factura_model->buscar_num_fact_num_control($data_factura);
				foreach ($num_fact['numero']->result() as $data)
				{
				$numero = array('num_fact' =>$data->num_fact,'num_control' =>$data->num_control);
				}
	#******************************************************************************************
				$a= $numero['num_fact'];
				$a=$a+1;
				if (strlen($a)==1) {
				$num_fact= "0000000" . $a;
				}elseif (strlen($a)==2) {
				$num_fact= "000000" . $a;
				}elseif (strlen($a)==3) {
				$num_fact= "00000" . $a;
				}elseif (strlen($a)==4) {
				$num_fact= "0000" . $a;
				}elseif (strlen($a)==5) {
				$num_fact= "000" . $a;
				}elseif (strlen($a)==6) {
				$num_fact= "00" . $a;
				}elseif (strlen($a)==7) {
				$num_fact= "0" . $a;
				}elseif (strlen($a)==8) {
				$num_fact= $a;
				}
	#******************************************************************************************
				$id_cliente=$datos_cliente['id'];
				$nombre_cliente=$datos_cliente['nombre'];
				$sub_total ='0';
				$big='0';
				$iva ='0';
				$total ='0';
				$fecha = date('Y-m-d');
				$status_factura="1";

				$datos_factura = array('num_fact'=>$num_fact,'nombre_cliente' => $datos_cliente['nombre'],
				'direccion' => $datos_cliente['direccion'],
				'telf' => $datos_cliente['telf'], 'num_fact'=>$num_fact,'sub_total'=>$sub_total,
				'big'=>$big,'iva'=>$iva,'total'=>$total );
				$data_factura = $this->factura_model->nueva_factura($id_cliente,$id_usuario,$status_factura,$num_fact,$sub_total,$total,$fecha);
								#las vistas
	##******************************************************************************************
			$status_alerta=2;
			$contar_alerta['contar_a']=$this->alerta_model->contar_alerta($status_alerta);
				if ($contar_alerta['contar_a']==true) {
						$this->load->view('../../assets/inc/head_common');
				//		$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
						$this->load->view('../../assets/script/script_producto');
						$this->load->view('factura/nueva_factura',$datos_factura,$data);
						$this->load->view('modal/modal_producto');
						$this->load->view('modal/modal_producto_cantidad');
				}else{
			$contar_alerta['contar_a']=0;
						$this->load->view('../../assets/inc/head_common');
					//	$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
						$this->load->view('../../assets/script/script_producto');
						$this->load->view('factura/nueva_factura',$datos_factura,$data);
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
			$id_sucursal=$this->session->userdata('id_sucursal');
			$producto= $this->input->post('txt_producto');
			$num_factura= $this->input->post('lbl_num_fact');
			$cantidad= $this->input->post('txt_cantidad');
			$inv_producto= $this->producto_terminado_model->buscar_producto($producto, $id_sucursal);
			$factura= $this->factura_model->buscar_factura($num_factura);
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
			#los datos de la factura
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
		#toma el dato de la factura(id_cliente) y busca en la tabla cliente.
			$variable=$datos_factura['id_cliente'];
			$id_factura= $datos_factura['id'];
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
				#todos los datos de la factura cargada
			$datos_b_factura = array('id' => $datos_factura['id'],
						'num_fact' => $datos_factura['num_fact'],
						'nombre_cliente' => $datos_cliente['nombre'],
						'direccion' => $datos_cliente['direccion'],
						'telf' => $datos_cliente['telf'],
						'sub_total' => $datos_factura['sub_total'],
						'exento' => $datos_factura['exento'],
						'big' => $datos_factura['big'],
						'iva' => $datos_factura['iva'],
						'total' => $datos_factura['total']
						); #fin del array.
	#******************************************************************************************
			$precio_neto= $datos_producto['precio_neto']*$cantidad;
			$iva= $datos_producto['iva']*$cantidad;
			$total=$precio_neto+$iva;
			#los datos del det_factura
			$data_det_factura = array('id_factura' =>$datos_b_factura['id'],
						'id_inventario_sucursal' =>$datos_producto['id'],
						'descripcion' =>$datos_producto['producto'],
						'cantidad' =>$cantidad,
						'precio_u' =>$datos_producto['precio_neto'],
						'iva' =>$iva,
						'total' =>$precio_neto
						 ); #fin del array.
	#******************************************************************************************
			#guarda los datos en det_factura
			$data_factura = $this->factura_model->insertar_det_factura($data_det_factura);
			#busca los datos guardados
			$datos_det_factura['det_fact']=$this->factura_model->buscar_det_factura($data_det_factura);
			#suma el iva el total y resta  entre esos dos para obtener el precio neto
			$sum_iva_det_factura=$this->factura_model->sumar_iva_det_factura($data_det_factura);
			$sum_total_det_factura=$this->factura_model->sumar_total_det_factura($data_det_factura);
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
			$actualizar= $this->factura_model->actualizar_factura($id_factura,$iva,$precio_neto,$total);
			$cantidad_actualizada= $datos_producto['cantidad']-$cantidad_pag;
			$actualizar_producto=$this->factura_model->actualizar_Cantidad_Inv_Suc($data_det_factura,$cantidad_actualizada);
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
				$status_alerta=2;
			$contar_alerta['contar_a']=$this->alerta_model->contar_alerta($status_alerta);
					if ($contar_alerta['contar_a']==true) {
						$this->load->view('../../assets/inc/head_common');
						$this->load->view('../../assets/script/script_descuento');
					//	$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
						$this->load->view('../../assets/script/script_efectivo');
						$this->load->view('../../assets/script/script_producto');
						$this->load->view('factura/agregar_producto',$datos_t_factura);
						$this->load->view('factura/tabla_det_factura',$datos_det_factura);
						$this->load->view('factura/totales_factura',$datos_t_factura);
						$this->load->view('modal/modal_producto');
						$this->load->view('modal/modal_producto_cantidad');
						$this->load->view('modal/modalpunto');
						$this->load->view('modal/modal_efectivo');
						$this->load->view('modal/modal_cheque');
					}else{
			$contar_alerta['contar_a']=0;
						$this->load->view('../../assets/inc/head_common');
						$this->load->view('../../assets/script/script_descuento');
					//	$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
						$this->load->view('../../assets/script/script_efectivo');
						$this->load->view('../../assets/script/script_producto');
						$this->load->view('factura/agregar_producto',$datos_t_factura);
						$this->load->view('factura/tabla_det_factura',$datos_det_factura);
						$this->load->view('factura/totales_factura',$datos_t_factura);
						$this->load->view('modal/modal_producto');
						$this->load->view('modal/modal_producto_cantidad');
						$this->load->view('modal/modalpunto');
						$this->load->view('modal/modal_efectivo');
						$this->load->view('modal/modal_cheque');
					}

		}
		else{
					redirect('login');
	}
		}
		public function eliminar_registro()
		{			#id det factura
				if($this->session->userdata('logueado')){
				$id_sucursal=$this->session->userdata('id_sucursal');
				$id = $this->uri->segment(3);
				# num_factura
				$num_factura= $this->uri->segment(4);
				#id_inventario_sucursal
				$id_item_producto= $this->uri->segment(5);
				#cantidad
				$cantidad_det_factura= $this->uri->segment(6);
				#id factura
				$id_factura= $this->uri->segment(7);
				#iva el buscar det factura ojo.
				$producto= $this->producto_terminado_model->buscar_producto_id($id_item_producto, $id_sucursal);
					foreach ($producto->result() as $data) {
					$data_producto = array('id' =>$data->id,
					'cantidad' =>$data->cantidad
					);#fin del array.
					}#fin del foreach.
				$data_bd=$data_producto['cantidad'];
				$data_eliminar= $cantidad_det_factura;
				$nueva_cantidad=$data_bd+$data_eliminar;
				$actualizar_producto=$this->factura_model->Actualizar_Cantidad_Suma_Inv_Suc($id_item_producto,$nueva_cantidad);
				$eliminar= $this->factura_model->borrar_reg_det_factura($id);
				$sum_iva_det_factura=$this->factura_model->sumar_iva_det_factura_eliminar_producto($id_factura);
				$sum_total_det_factura=$this->factura_model->sumar_total_det_factura_eliminar_producto($id_factura);
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
				$this->factura_model->actualizar_factura_reg($id_factura,$iva,$precio_neto,$total);
				$factura = $this->factura_model->buscar_factura($num_factura);
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
				$datos_det_factura['det_fact']=$this->factura_model->buscar_det_factura_reg($id_factura);
				if ($datos_det_factura['det_fact']==false){
					$status_alerta=2;
			$contar_alerta['contar_a']=$this->alerta_model->contar_alerta($status_alerta);
					if ($contar_alerta['contar_a']==true) {
						$this->load->view('../../assets/inc/head_common');
						$this->load->view('../../assets/script/script_descuento');
				//		$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
						$this->load->view('../../assets/script/script_efectivo');
						$this->load->view('../../assets/script/script_producto');
						$this->load->view('factura/agregar_producto',$datos_t_factura);
						$this->load->view('factura/totales_factura',$datos_t_factura);
						$this->load->view('modal/modal_producto');
						$this->load->view('modal/modal_producto_cantidad');
					}else{
			$contar_alerta['contar_a']=0;
						$this->load->view('../../assets/inc/head_common');
						$this->load->view('../../assets/script/script_descuento');
					//	$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
						$this->load->view('../../assets/script/script_producto');
						$this->load->view('factura/agregar_producto',$datos_t_factura);
						$this->load->view('factura/totales_factura',$datos_t_factura);
						$this->load->view('modal/modal_producto');
						$this->load->view('modal/modal_producto_cantidad');
					}
				}else{
					$status_alerta=2;
			$contar_alerta['contar_a']=$this->alerta_model->contar_alerta($status_alerta);
					if ($contar_alerta['contar_a']==true) {
						$this->load->view('../../assets/inc/head_common');
						$this->load->view('../../assets/script/script_producto');
				//		$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
						$this->load->view('factura/agregar_producto',$datos_t_factura);
						$this->load->view('factura/tabla_det_factura',$datos_det_factura);
						$this->load->view('factura/totales_factura',$datos_t_factura);
						$this->load->view('modal/modal_producto');
						$this->load->view('modal/modal_producto_cantidad');
						$this->load->view('modal/modal_efectivo');
					}else{
			$contar_alerta['contar_a']=0;
						$this->load->view('../../assets/inc/head_common');
						$this->load->view('../../assets/script/script_producto');
					//	$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
						$this->load->view('../../assets/script/script_producto');
						$this->load->view('factura/agregar_producto',$datos_t_factura);
						$this->load->view('factura/tabla_det_factura',$datos_det_factura);
						$this->load->view('factura/totales_factura',$datos_t_factura);
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
				$factura = $this->factura_model->buscar_factura_id($id_factura);
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
				$datos_det_factura['det_fact']=$this->factura_model->buscar_det_factura_reg($id_factura);
				$contar_det_fact=$this->factura_model->contar_det_factura_reg($id_factura);
				$empresa= $this->empresa_model->buscar_empresa();
				$datos_det_factura['det_fact']=$this->factura_model->buscar_det_factura_reg($id_factura);
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
					$this->load->view('../../assets/inc/head_common');
					$this->load->view('../../assets/inc/menu_principal');
					$this->load->view('factura/impresion/cabecera_ne',$datos_empresa);
					$this->load->view('factura/impresion/num_fact',$datos_factura);
					$this->load->view('factura/impresion/cliente',$datacliente);
					$this->load->view('factura/impresion/det_factura',$datos_det_factura);
					$this->load->view('factura/impresion/pie_mc',$datos_pie);
				}elseif($impresiones['fac_hc_ne']=='si'){
					$this->load->view('../../assets/inc/head_common');
					$this->load->view('../../assets/inc/menu_principal');
					$this->load->view('factura/impresion/cabecera_ne',$datos_empresa);
					$this->load->view('factura/impresion/num_fact',$datos_factura);
					$this->load->view('factura/impresion/cliente',$datacliente);
					$this->load->view('factura/impresion/det_factura',$datos_det_factura);
					$this->load->view('factura/impresion/pie_hc',$datos_pie);

				}elseif($impresiones['fac_mc_sne']=='si'){
					$this->load->view('../../assets/inc/head_common');
					$this->load->view('../../assets/inc/menu_principal');
					$this->load->view('factura/impresion/cabecera_sne',$datos_empresa);
					$this->load->view('factura/impresion/num_fact',$datos_factura);
					$this->load->view('factura/impresion/cliente',$datacliente);
					$this->load->view('factura/impresion/det_factura',$datos_det_factura);
					$this->load->view('factura/impresion/pie_mc',$datos_pie);

				}elseif ($impresiones['fac_hc_sne']=='si') {
					$this->load->view('../../assets/inc/head_common');
					$this->load->view('../../assets/inc/menu_principal');
					$this->load->view('factura/impresion/cabecera_sne',$datos_empresa);
					$this->load->view('factura/impresion/num_fact',$datos_factura);
					$this->load->view('factura/impresion/cliente',$datacliente);
					$this->load->view('factura/impresion/det_factura',$datos_det_factura);
					$this->load->view('factura/impresion/pie_hc',$datos_pie);
				}

		}else{
		redirect('login');
			}
	}

		public function imprimir_x_tabla(){
		if($this->session->userdata('logueado')){
				$id_factura= $this->uri->segment(3);
				$factura = $this->factura_model->buscar_factura_id($id_factura);
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
						'descuento' => $data->descuento,
						'sub_total_descuento' => $data->sub_total_descuento,
						'exento' => $data->exento,
						'big' => $data->big,
						'iva' => $data->iva,
						'total' => $data->total,
						'fecha' => $data->fecha,
						'observaciones' => $data->observaciones
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
				$datos_det_factura['det_fact']=$this->factura_model->buscar_det_factura_reg($id_factura);
				$contar_det_fact=$this->factura_model->contar_det_factura_reg($id_factura);
				$empresa= $this->empresa_model->buscar_empresa();
				$datos_det_factura['det_fact']=$this->factura_model->buscar_det_factura_reg($id_factura);
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

					$this->load->view('factura/impresion/cabecera_ne',$datacliente);
					$this->load->view('factura/impresion/num_fact',$datos_factura);
					$this->load->view('factura/impresion/det_factura',$datos_det_factura);
					$this->load->view('factura/impresion/pie_mc',$datos_pie);
				}elseif($impresiones['fac_hc_ne']=='si'){

					$this->load->view('factura/impresion/cabecera_ne',$datos_empresa);
					$this->load->view('factura/impresion/num_fact',$datos_factura);
					$this->load->view('factura/impresion/det_factura',$datos_det_factura);
					$this->load->view('factura/impresion/pie_hc',$datos_pie);

				}elseif($impresiones['fac_mc_sne']=='si'){

					$this->load->view('factura/impresion/cabecera_sne',$datos_empresa);
					$this->load->view('factura/impresion/num_fact',$datos_factura);
					$this->load->view('factura/impresion/det_factura',$datos_det_factura);
					$this->load->view('factura/impresion/pie_mc',$datos_pie);

				}elseif ($impresiones['fac_hc_sne']=='si') {

					$this->load->view('factura/impresion/cabecera_sne',$datos_empresa);
					$this->load->view('factura/impresion/num_fact',$datos_factura);
					$this->load->view('factura/impresion/det_factura',$datos_det_factura);
					$this->load->view('factura/impresion/pie_hc',$datos_pie);
				}

		}else{
		redirect('login');
			}
		}
		public function guardar_factura(){
			$num_factura= $this->input->post('lbl_num_fact');
			$num_albarran=$this->input->post('albarran');
			$notas= $this->input->post('txt_notas');
			$sub_total=$this->input->post('lbl_sub_total');
			$descuento=$this->input->post('lbl_descuento');
			$descuento_2=$this->input->post('lbl_descuento_2');
			$iva=$this->input->post('lbl_iva');
			$total=$this->input->post('lbl_total');
			$sub_total_descuento=$sub_total-$descuento_2;
			$factura= $this->factura_model->buscar_factura($num_factura);

				foreach ($factura->result() as $data)
				{
						$datos_factura = array('id' => $data->id

				); #fin del array.
				} #fin del foreach.
				$id_factura= $datos_factura['id'];
				$actualizar = array('id' =>$datos_factura['id'],
									'num_control'=>$num_albarran,
									'sub_total'=>$sub_total,
									'descuento'=>$descuento,
									'sub_total_descuento'=>$sub_total_descuento,
									'big'=>$sub_total_descuento,
									'iva'=>$iva,
									'total'=>$total,
									'observaciones'=>$notas
				 );
			$this->factura_model->actualizar_factura_descuento($id_factura,$actualizar);
			redirect('factura/menu_factura');

		}


public function reporte_pdf(){
		if($this->session->userdata('logueado')){
			prep_pdf();

				$id_factura= $this->uri->segment(3);
				$factura = $this->factura_model->buscar_factura_id($id_factura);
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
						'descuento' => $data->descuento,
						'sub_total_descuento' => $data->sub_total_descuento,
						'exento' => $data->exento,
						'big' => $data->big,
						'iva' => $data->iva,
						'total' => $data->total,
						'fecha' => $data->fecha,
						'observaciones' => $data->observaciones
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
				$datos_det_factura['det_fact']=$this->factura_model->buscar_det_factura_reg($id_factura);
				$contar_det_fact=$this->factura_model->contar_det_factura_reg($id_factura);
				$empresa= $this->empresa_model->buscar_empresa();
				$datos_det_factura['det_fact']=$this->factura_model->buscar_det_factura_reg($id_factura);
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

					$this->cezpdf->ezpdf('factura/impresion/cabecera_ne',$datacliente);
					$this->cezpdf->ezpdf('factura/impresion/num_fact',$datos_factura);
					$this->cezpdf->ezpdf('factura/impresion/det_factura',$datos_det_factura);
					$this->cezpdf->ezpdf('factura/impresion/pie_mc',$datos_pie);
				}elseif($impresiones['fac_hc_ne']=='si'){

					$this->cezpdf->ezpdf('factura/impresion/cabecera_ne',$datos_empresa);
					$this->cezpdf->ezpdf('factura/impresion/num_fact',$datos_factura);
					$this->cezpdf->ezpdf('factura/impresion/det_factura',$datos_det_factura);
					$this->cezpdf->ezpdf('factura/impresion/pie_hc',$datos_pie);

				}elseif($impresiones['fac_mc_sne']=='si'){

					$this->cezpdf->ezpdf('factura/impresion/cabecera_sne',$datos_empresa);
					$this->cezpdf->ezpdf('factura/impresion/num_fact',$datos_factura);
					$this->cezpdf->ezpdf('factura/impresion/det_factura',$datos_det_factura);
					$this->cezpdf->ezpdf('factura/impresion/pie_mc',$datos_pie);

				}elseif ($impresiones['fac_hc_sne']=='si') {

					$this->cezpdf->ezpdf('factura/impresion/cabecera_sne',$datos_empresa);
					$this->cezpdf->ezpdf('factura/impresion/num_fact',$datos_factura);
					$this->cezpdf->ezpdf('factura/impresion/det_factura',$datos_det_factura);
					$this->cezpdf->ezpdf('factura/impresion/pie_hc',$datos_pie);
				}

		}else{
		redirect('login');
			}
		}



	}
/* End of file productos.php */
/* Location: ./application/controllers/productos.php */

?>