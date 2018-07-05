<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Impresion extends CI_Controller {
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

		redirect('impresion/cargar_grilla');
		}

		public function cargar_grilla()
		{
		if($this->session->userdata('logueado')){
				try {
				 /* Creamos el objeto */
		    $crud = new grocery_CRUD();
   			$crud->set_theme('bootstrap');
 		    $crud->set_table('t_impresion');
    		$crud->set_subject('Configurar Impresion');
			$crud->set_language('spanish');

		// agrega la caja y decide si el campo es requerido.

			$crud->display_as('fac_mc_ne','Fact MEDIA CARTA. con N.E');
			$crud->display_as('fac_hc_ne','Fact HOJA COMPLETA con N.E');
			$crud->display_as('pre_mc_ne','Pres MEDIA CARTA con N.E');
			$crud->display_as('pre_hc_ne','Pres HOJA COMPLETA con N.E');
			$crud->required_fields('fac_mc_ne','fac_hc_ne','pre_mc_ne','pre_hc_ne');
			$crud->unset_add();
			$crud->unset_read();
			$crud->unset_print();
			$crud->unset_export();
			$crud->unset_delete();
	  		 		      /* Generamos la tabla */
    		$output = $crud->render();
    		 /* La cargamos en la vista situada en
		    /applications/views/productos/administracion.php */
		    $status_alerta=2;
					$contar_alerta['contar_a']=$this->alerta_model->contar_alerta($status_alerta);
						if ($contar_alerta['contar_a']==true) {
					$this->load->view('../../assets/inc/head_common');
					$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
					$this->load->view('impresion/impresion', $output);
						}else{
					$this->load->view('../../assets/inc/head_common');
					$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
					$this->load->view('impresion/impresion', $output);
						}

	    //   	      $this->load->view('../../assets/inc/footer_common');


    	} catch (Exception $e) {
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
		}else{
				redirect('login');
		}

		}


   }



/* End of file productos.php */
/* Location: ./application/controllers/productos.php */

?>