<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Matprima extends CI_Controller {
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

		redirect('matprima/t_matprima');
		}

		public function t_matprima()
		{
			if($this->session->userdata('logueado')){
				try {
				 /* Creamos el objeto */
		    $crud = new grocery_CRUD();

   			$crud->set_theme('bootstrap');
 		    $crud->set_table('t_materia_prima');

    		$crud->set_subject('Materia Prima');
			$crud->set_language('spanish');
		    $crud->columns(

		    );
		// agrega la caja y decide si el campo es requerido.
			$crud->required_fields('codigo','nombre','cantidad');


	  		 		      /* Generamos la tabla */
    		$output = $crud->render();
    		$status_alerta=2;
					$contar_alerta['contar_a']=$this->alerta_model->contar_alerta($status_alerta);
						if ($contar_alerta['contar_a']==true) {
						$this->load->view('../../assets/inc/head_common');
						$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
						$this->load->view('materia_prima/matprima', $output);
						}else{
						$contar_alerta['contar_a']=0;
						$this->load->view('../../assets/inc/head_common');
						$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
						$this->load->view('materia_prima/matprima', $output);
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