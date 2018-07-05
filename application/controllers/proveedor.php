		<?php
		defined('BASEPATH') OR exit('No direct script access allowed');
		class Proveedor extends CI_Controller {
				function __construct()
			{
				parent::__construct();
				$this->load->helper('url');
				$this->load->database();
				$this->load->library('grocery_crud');
				$this->load->model('alerta_model');
				//***************para tomar un valor de una funcion del model (algo personal)**************
			}
			public function index()
			{
				redirect('proveedor/cargar_grilla');
			}
				public function cargar_grilla()
				{
					if($this->session->userdata('logueado')){
					$id_nivel= $this->session->userdata('id_nivel');
					try {
					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_proveedor');
					$crud->set_subject('Proveedor');
					$crud->set_language('spanish');
					$crud->columns('nif','nombre','direccion','telf', 'email');
					$crud->display_as('nif','NIF')
					->display_as('nombre','NOMBRE')
					->display_as('direccion','DIRECCION')
					->display_as('telf','TELEFONO')
					->display_as('email','EMAIL');
					$output = $crud->render();
					//***********cargamos las vistas**************
					$status_alerta=2;
					$contar_alerta['contar_a']=$this->alerta_model->contar_alerta($status_alerta);
						if ($contar_alerta['contar_a']==true) {
						if ($id_nivel==1 || $id_nivel==2 ){
							$data = array();
				$this->load->view('../../assets/inc/head_common');
				$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
				$this->load->view('proveedor/proveedor',$output);
						}else{
	$data = array();
				$this->load->view('../../assets/inc/head_common');
				$this->load->view('../../assets/inc/menu_principal_n3',$contar_alerta);
				$this->load->view('proveedor/proveedor',$output);
						}
					}else{
				if ($id_nivel==1 || $id_nivel==2 ){
				$contar_alerta['contar_a']=0;
				$data = array();
				$this->load->view('../../assets/inc/head_common');
				$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
				$this->load->view('proveedor/proveedor',$output);
				}else{
			$contar_alerta['contar_a']=0;
				$data = array();
				$this->load->view('../../assets/inc/head_common');
				$this->load->view('../../assets/inc/menu_principal_n3',$contar_alerta);
				$this->load->view('proveedor/proveedor',$output);
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

		/* End of file cliente.php */
		/* Location: ./application/controllers/cliente.php */