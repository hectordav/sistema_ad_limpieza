<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sucursal extends CI_Controller {
			function __construct()
			{
			parent::__construct();
			$this->load->database();
			$this->load->library('grocery_crud');
			$this->load->helper('url');
			$this->load->model('alerta_model');
			}
	public function index()
		{
			if($this->session->userdata('logueado')){
				try {
					/* Creamos el objeto */
					$crud = new grocery_CRUD();
					/* Seleccionamos el tema */
					$crud->set_theme('bootstrap');
					/* Seleccionmos el nombre de la tabla de nuestra base de datos*/
					$crud->set_table('t_sucursal');
					/* Le asignamos un nombre */
					$crud->set_subject('Sucursal');
					/* Asignamos el idioma español */
					$crud->set_language('spanish');
					/* Aqui le indicamos que campos deseamos mostrar */
					$crud->columns(
					'nombre',
					'direccion'
					);
					// agrega la caja y decide si el campo es requerido.
					$crud->required_fields('nombre', 'direccion');
					$crud->display_as('nombre','NOMBRE','direccion','DIRECCION');
	  		 		/* Generamos la tabla */
    		        $output = $crud->render();
				  /* La cargamos en la vista situada en
				  /applications/views/productos/administracion.php */
				  $status_alerta=2;
					$contar_alerta['contar_a']=$this->alerta_model->contar_alerta($status_alerta);
						if ($contar_alerta['contar_a']==true) {
						$this->load->view('../../assets/inc/head_common');
						$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
						$this->load->view('sucursal/sucursal', $output);
	    	    }else{
					$contar_alerta['contar_a']=0;
					$this->load->view('../../assets/inc/head_common');
					$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
					$this->load->view('sucursal/sucursal', $output);
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