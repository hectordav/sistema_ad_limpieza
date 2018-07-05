<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Iva extends CI_Controller {
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

		redirect('iva/T_IVA');
		}

		public function T_IVA()
		{
				if($this->session->userdata('logueado')){
				try {
				 /* Creamos el objeto */
		    $crud = new grocery_CRUD();

   			$crud->set_theme('bootstrap');
 		    $crud->set_table('t_iva');

    		$crud->set_subject('Iva');
			$crud->set_language('spanish');
		    $crud->columns('iva');
		// agrega la caja y decide si el campo es requerido.
			$crud->required_fields('Iva');
			$crud->unset_add();
			$crud->unset_print();
			$crud->unset_export();
			$crud->unset_delete();
	  		 		      /* Generamos la tabla */
    		$output = $crud->render();

		    $status_alerta=2;
					$contar_alerta['contar_a']=$this->alerta_model->contar_alerta($status_alerta);
						if ($contar_alerta['contar_a']==true) {
						$this->load->view('../../assets/inc/head_common');
						$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
						$this->load->view('iva/iva', $output);
						}else{
							$contar_alerta['contar_a']=0;
						$this->load->view('../../assets/inc/head_common');
						$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
						$this->load->view('iva/iva', $output);
						}

	    //   	      $this->load->view('../../assets/inc/footer_common');


    	} catch (Exception $e) {
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
			}else{
		redirect('login');
	}


		}
				public function valor_iva(){
				  $dato['iva']= $this->producto_terminado_model->Obtener_pt();
    			  $this->load->view('../../assets/inc/head_common');
		          $this->load->view('../../assets/inc/menu_principal');
	    	      $this->load->view('producto_terminado/producto_terminado',$dato);
			}



}



/* End of file productos.php */
/* Location: ./application/controllers/productos.php */

?>