<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');

     class Empresa extends CI_Controller
       {
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
				redirect('empresa/cargar_grilla');
			}
			public function cargar_grilla()
			{
					if($this->session->userdata('logueado')){
				try {
					/* Creamos el objeto */
					$crud = new grocery_CRUD();
					/* Seleccionamos el tema */
					$crud->set_theme('bootstrap');
					/* Seleccionmos el nombre de la tabla de nuestra base de datos*/
					$crud->set_table('t_empresa');
					/* Le asignamos un nombre */
					$crud->set_subject('Empresa');
					/* Asignamos el idioma español */
					$crud->set_language('spanish');
					/* Aqui le indicamos que campos deseamos mostrar */
					$crud->set_subject('Empresa');
					$crud->set_language('spanish');
					$crud->columns('nombre','rif','direccion','telef_1', 'telef_2');
					$crud->display_as('nombre','NOMBRE')
					->display_as('rif','NIF')
					->display_as('direccion','DIRECCION')
					->display_as('telef_1','TELEF_1')
					->display_as('telef_2','TELEF_2');
					$crud->required_fields('nombre','rif','direccion','telef_1', 'telef_2');
					$crud->unset_delete();
					$output = $crud->render();
						$status_alerta=2;
					$contar_alerta['contar_a']=$this->alerta_model->contar_alerta($status_alerta);
						if ($contar_alerta['contar_a']==true) {
					$this->load->view('../../assets/inc/head_common');
					$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
					$this->load->view('empresa/empresa', $output);
						}else{
						$contar_alerta['contar_a']=0;
					$this->load->view('../../assets/inc/head_common');
					$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
					$this->load->view('empresa/empresa', $output);
						}

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