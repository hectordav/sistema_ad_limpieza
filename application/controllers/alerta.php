<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alerta extends CI_Controller {
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
redirect('alerta/recibido');
	}
	public function recibido()
	{
		if($this->session->userdata('logueado')){
		try {

			$id_usuario=$this->session->userdata('id');
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->where('ID_STATUS_ALERTA','2');
		$crud->where('ID_USUARIO',$id_usuario);
		$crud->set_table('t_alerta');
		$crud->display_as('ID_USUARIO','USUARIO');
		$crud->display_as('ID_USUARIO_REMITENTE','REMITENTE');
		$crud->display_as('ID_STATUS_ALERTA','STATUS');
		$crud->set_relation('ID_USUARIO','t_usuario','USUARIO');
		$crud->set_relation('ID_USUARIO_REMITENTE','t_usuario','USUARIO');
		$crud->set_relation('ID_STATUS_ALERTA','T_STATUS_ALERTA','DESCRIPCION');
		$crud->set_subject('Alerta');
		$crud->set_language('spanish');
		$crud->columns('ID_USUARIO_REMITENTE','ASUNTO','MENSAJE','FECHA');
		$crud->edit_fields('ID_STATUS_ALERTA');
		$output = $crud->render();
			$status_alerta=2;
			$contar_alerta['contar_a']=$this->alerta_model->contar_alerta($status_alerta);
		    if ($contar_alerta['contar_a']==true) {
		//***********cargamos las vistas**************
			$this->load->view('../../assets/inc/head_common');
			$this->load->view('../../assets/inc/menu_principal', $contar_alerta);
			$this->load->view('alerta/alerta',$output);
			}else{
			$contar_alerta['contar_a']=0;
			$this->load->view('../../assets/inc/head_common');
			$this->load->view('../../assets/inc/menu_principal', $contar_alerta);
			$this->load->view('alerta/alerta',$output);
			}
		}catch (Exception $e) {
		show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}else{
		redirect('login');
		}
	}
public function enviado()
	{
		if($this->session->userdata('logueado')){
		try {
			$id_usuario=$this->session->userdata('id');
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->where('ID_STATUS_ALERTA','1');
		$crud->where('ID_USUARIO',$id_usuario);
		$crud->set_table('t_alerta');
		$crud->display_as('ID_USUARIO','USUARIO');
		$crud->display_as('ID_USUARIO_REMITENTE','REMITENTE');
		$crud->display_as('ID_STATUS_ALERTA','STATUS');
		$crud->set_relation('ID_USUARIO','t_usuario','USUARIO');
		$crud->set_relation('ID_USUARIO_REMITENTE','t_usuario','USUARIO');
		$crud->set_relation('ID_STATUS_ALERTA','T_STATUS_ALERTA','DESCRIPCION');
		$crud->set_subject('Alerta');
		$crud->set_language('spanish');
		$crud->columns('ID_USUARIO_REMITENTE','ASUNTO','MENSAJE','FECHA');
		$crud->edit_fields('ID_STATUS_ALERTA');
		$output = $crud->render();
			$status_alerta=2;
			$contar_alerta['contar_a']=$this->alerta_model->contar_alerta($status_alerta);
		    if ($contar_alerta['contar_a']==true) {
				$this->load->view('../../assets/inc/head_common');
				$this->load->view('../../assets/inc/menu_principal', $contar_alerta);
				$this->load->view('alerta/alerta',$output);
		    }else{
		    	$contar_alerta['contar_a']=0;
				$this->load->view('../../assets/inc/head_common');
				$this->load->view('../../assets/inc/menu_principal', $contar_alerta);
				$this->load->view('alerta/alerta',$output);
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

/* End of file alerta.php */
/* Location: ./application/controllers/alerta.php */