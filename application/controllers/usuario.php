		<?php
		defined('BASEPATH') OR exit('No direct script access allowed');
		class Usuario extends CI_Controller {
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
				redirect('usuario/cargar_grilla');
			}
				public function cargar_grilla()
				{
					if($this->session->userdata('logueado')){
					try {
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_usuario');
				$crud->set_subject('Usuario');
				$crud->set_language('spanish');
				$crud->display_as('id_nivel','NIVEL')
				->display_as('usuario','USUARIO')
				->display_as('login','LOGIN')
				->display_as('id_sucursal','SUCURSAL');
				$crud->set_relation('id_nivel','t_nivel','descripcion');
				$crud->set_relation('id_sucursal','t_sucursal','nombre');
				$crud->columns('usuario','login','id_nivel','id_sucursal');
				$crud->fields('USUARIO','LOGIN','clave','id_nivel', 'id_sucursal');
		
				$crud->callback_insert(array($this,'encrypt_password_and_insert_callback'));
				$output = $crud->render();
				$status_alerta=2;
				$contar_alerta['contar_a']=$this->alerta_model->contar_alerta($status_alerta);
					if ($contar_alerta['contar_a']==true) {
				$this->load->view('../../assets/inc/head_common');
				$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
				$this->load->view('usuario/usuario',$output);
					}else{
				$contar_alerta['contar_a']=0;
				$this->load->view('../../assets/inc/head_common');
				$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
				$this->load->view('usuario/usuario',$output);
						}
					//***********cargamos las vistas**************

					} catch (Exception $e) {
					show_error($e->getMessage().' --- '.$e->getTraceAsString());
					}
				}else{
					redirect('login');
					}
				}
				function encrypt_password_and_insert_callback($post_array)
			 {
				$this->load->library('encrypt');
				$post_array['clave'] =md5($post_array['clave']);
				return $this->db->insert('t_usuario',$post_array);
			}

		}

		/* End of file cliente.php */
		/* Location: ./application/controllers/cliente.php */