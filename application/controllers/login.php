<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
	{
	public function __construct()
	    {
	        parent::__construct();
			$this->load->helper('security');
			$this->load->model('usuario_model');
			$this->load->model('alerta_model');
	    }
		public function index()
		{

			$this->load->view('../../assets/inc/head_common');
			$this->load->view('usuario/login');
			$this->load->view('modal/modal_login');
			$this->load->view('../../assets/inc/footer_common');

		}
	 public function iniciar_sesion_post()
	 {
			if ($this->input->post()) {
				$nombre = $this->input->post('txt_login');
				$contrasena = $this->input->post('txt_pass');
				$con_md5= md5($contrasena);
				$usuario = $this->usuario_model->login($nombre, $con_md5);
		         if ($usuario) {
		            $usuario_data = array(
		               'id' => $usuario->id,
		               'usuario' => $usuario->usuario,
		               'id_nivel' => $usuario->id_nivel,
		               'id_sucursal' => $usuario->id_sucursal,
		               'logueado' => TRUE
		            );
		            $this->session->set_userdata($usuario_data);
		            redirect('login/logueado');
	        	 } else {
	           		 redirect('login');
	       		  }
		      }else{
		         $this->index();
     	 }
  	 }
  	   public function logueado() {

			if($this->session->userdata('logueado')){
				$id_nivel= $this->session->userdata('id_nivel');
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
				$this->load->view('usuario/logueado');
				}else{
			$contar_alerta['contar_a']=0;
				$data = array();
				$this->load->view('../../assets/inc/head_common');
				$this->load->view('../../assets/inc/menu_principal_n3',$contar_alerta);
				$this->load->view('usuario/logueado');
				}
			
					}

			}else{
				redirect('login/index');
			}
   }
   	   public function cerrar_sesion() {
      $usuario_data = array(
         'logueado' => FALSE
      );
     $this->session->sess_destroy();
      redirect('login');
   }



	}

/* End of file login.php */
/* Location: ./application/controllers/login.php */

?>