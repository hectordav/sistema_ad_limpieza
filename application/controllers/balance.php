<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Balance extends CI_Controller
 {
	function __construct()
		{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('iva_model');
		$this->load->model('factura_model');
		$this->load->model('usuario_model');
		$this->load->model('alerta_model');
		$this->load->library('pagination');
		}
	public function index()
	{
		if($this->session->userdata('logueado'))
		{
			try
			{
			redirect('balance/menu');
			}catch (Exception $e) {
					show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}

		}else{
		redirect('login');

		}
	}
	public function menu()
	{
		$usuario['data_usuario']=$this->usuario_model->buscar_usuarios();
		$status_alerta=2;
		$contar_alerta['contar_a']=$this->alerta_model->contar_alerta($status_alerta);
			if ($contar_alerta['contar_a']==true) {
				$this->load->view('../../assets/inc/head_common');
				$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
				$this->load->view('balance/balance_x',$usuario);
				$this->load->view('../../assets/inc/footer_common');
			}else{
				$this->load->view('../../assets/inc/head_common');
				$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
				$this->load->view('balance/balance_x',$usuario);
				$this->load->view('../../assets/inc/footer_common');
			}


	}
	public function corte_x(){
		if($this->session->userdata('logueado'))
		{
			$id_nivel= $this->session->userdata('id_nivel');
			try
			{
			$usuario= $this->input->post('cb_usuario');
			$fecha_inicio= $this->input->post('dt_fecha_inicio');
			$fecha_fin= $this->input->post('dt_fecha_fin');
			$id_usuario=$this->usuario_model->id_usuario($usuario);
			foreach ($id_usuario->result() as $data)
				{
				$usuario_2= array('id' =>$data->id,
				'usuario' =>$data->usuario
				); #fin del array.
				}; #fin del foreach.
				$id= $usuario_2['id'];
				$contar_facturas=$this->factura_model->contar_factura_x_usuario($id,$fecha_inicio,$fecha_fin);
				$sumar_facturas=$this->factura_model->sumar_factura_x_usuario($id,$fecha_inicio, $fecha_fin);

				foreach ($sumar_facturas->result() as $data)
				{
				$suma_factura = array('suma' =>$data->total);
				}
			$datos_corte_x = array('usuario' => $usuario,
								   'facturas_contadas' => $contar_facturas,
								   'sumar_facturas' => $suma_factura['suma']
								   );
			$status_alerta=2;
			$contar_alerta['contar_a']=$this->alerta_model->contar_alerta($status_alerta);

	# paginacion.
		$pages=10; //Número de registros mostrados por páginas
		$config['base_url'] = base_url().'index.php/factura/menu_factura/'; // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
		$config['total_rows'] = $this->factura_model->balance_filas($id, $fecha_inicio, $fecha_fin);//calcula el número de filas
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
		$factura['facturas_cargadas']= $this->factura_model->balance_factura($config['per_page'],$this->uri->segment(3),$id, $fecha_inicio, $fecha_fin);
			$status_alerta=2;
			$contar_alerta['contar_a']=$this->alerta_model->contar_alerta($status_alerta);
			if ($factura['facturas_cargadas']){
					if ($contar_alerta['contar_a']==true) {
						if ($id_nivel==1 || $id_nivel==2 ){
							$data = array();
			$this->load->view('../../assets/inc/head_common');
			$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
			$this->load->view('balance/total_balance_x_x_usuario',$datos_corte_x);
			$this->load->view('balance/menu_balance',$factura);
			$this->load->view('../../assets/inc/footer_common');
						}else{
			$data = array();
			$this->load->view('../../assets/inc/head_common');
			$this->load->view('../../assets/inc/menu_principal_n3',$contar_alerta);
			$this->load->view('balance/total_balance_x_x_usuario',$datos_corte_x);
			$this->load->view('../../assets/inc/footer_common');
						}
					}else{
				if ($id_nivel==1 || $id_nivel==2 ){
			$contar_alerta['contar_a']=0;
			$data = array();
			$this->load->view('../../assets/inc/head_common');
			$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
			$this->load->view('../../assets/script/script_buscar');
			$this->load->view('balance/total_balance_x_x_usuario',$datos_corte_x);
			$this->load->view('balance/menu_balance',$factura);
			$this->load->view('../../assets/inc/footer_common');
				}else{
			$contar_alerta['contar_a']=0;
				$data = array();
				$this->load->view('../../assets/inc/head_common');
				$this->load->view('../../assets/inc/menu_principal_n3',$contar_alerta);
				$this->load->view('balance/total_balance_x_x_usuario',$datos_corte_x);
				$this->load->view('balance/menu_balance',$factura);
			$this->load->view('../../assets/inc/footer_common');
				}
				}
			}else{
				if ($contar_alerta['contar_a']==true) {
					if ($id_nivel==1 || $id_nivel==2 ){
							$data = array();
	$this->load->view('../../assets/inc/head_common');
	$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
	$this->load->view('balance/total_balance_x_x_usuario',$datos_corte_x);
	//$this->load->view('balance/menu_balance',$factura);
	$this->load->view('../../assets/inc/footer_common');
					}else{
	$data = array();
	$this->load->view('../../assets/inc/head_common');
	$this->load->view('../../assets/inc/menu_principal_n3',$contar_alerta);
	$this->load->view('balance/total_balance_x_x_usuario',$datos_corte_x);
//	$this->load->view('balance/menu_balance',$factura);
	$this->load->view('../../assets/inc/footer_common');
						}
				}else{
				if ($id_nivel==1 || $id_nivel==2 ){
	$contar_alerta['contar_a']=0;
	$data = array();
	$this->load->view('../../assets/inc/head_common');
	$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
	$this->load->view('balance/total_balance_x_x_usuario',$datos_corte_x);
	//$this->load->view('balance/menu_balance',$factura);
	$this->load->view('../../assets/inc/footer_common');
				}else{
	$contar_alerta['contar_a']=0;
	$data = array();
	$this->load->view('../../assets/inc/head_common');
	$this->load->view('../../assets/inc/menu_principal_n3',$contar_alerta);
	$this->load->view('balance/total_balance_x_x_usuario',$datos_corte_x);
	//$this->load->view('balance/menu_balance',$factura);
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




  }