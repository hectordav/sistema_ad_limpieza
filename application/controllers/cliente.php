		<?php
		defined('BASEPATH') OR exit('No direct script access allowed');
		class Cliente extends CI_Controller {
				function __construct()
			{
				parent::__construct();
				$this->load->helper('url');
				$this->load->database();
				$this->load->library('grocery_crud');
				$this->load->model('alerta_model');
			}
			public function index()
			{
				redirect('cliente/cargar_grilla');
			}
				public function cargar_grilla()
				{
					if($this->session->userdata('logueado')){
					$id_nivel= $this->session->userdata('id_nivel');
					try {
					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_cliente');
					$crud->set_subject('Cliente');
					$crud->set_language('spanish');
					$crud->columns('nif','nombre_comercial','nombre','direccion','codigo_postal','persona_contacto','telf', 'email');
					$crud->display_as('nif','NIF')
					->display_as('nombre','RAZON SOCIAL')
					->display_as('nombre_comercial','NOMBRE COMERCIAL')
					->display_as('direccion','DIRECCION')
					->display_as('codigo_postal','COD POSTAL')
					->display_as('persona_contacto','PERSONA DE CONTACTO')
					->display_as('telf','TELEFONO')
					->display_as('email','EMAIL');
					$output = $crud->render();
					$status_alerta=2;
					$contar_alerta['contar_a']=$this->alerta_model->contar_alerta($status_alerta);
						if ($contar_alerta['contar_a']==true) {
						if ($id_nivel==1 || $id_nivel==2 ){
							$data = array();
				$this->load->view('../../assets/inc/head_common');
				$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
				$this->load->view('usuario/logueado');
						}else{
	$data = array();
				$this->load->view('../../assets/inc/head_common');
				$this->load->view('../../assets/inc/menu_principal_n3',$contar_alerta);
				$this->load->view('usuario/logueado');
						}
					}else{
				if ($id_nivel==1 || $id_nivel==2 ){
				$contar_alerta['contar_a']=0;
				$data = array();
				$this->load->view('../../assets/inc/head_common');
				$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
				$this->load->view('cliente/cliente',$output);
				}else{
			$contar_alerta['contar_a']=0;
				$data = array();
				$this->load->view('../../assets/inc/head_common');
				$this->load->view('../../assets/inc/menu_principal_n3',$contar_alerta);
				$this->load->view('cliente/cliente',$output);
				}
			
					}
					//***********cargamos las vistas**************

					} catch (Exception $e) {
					show_error($e->getMessage().' --- '.$e->getTraceAsString());
					}
				}else{
					redirect('login');
					}
				}

		}

		/* End of file cliente.php */
		/* Location: ./application/controllers/cliente.php */