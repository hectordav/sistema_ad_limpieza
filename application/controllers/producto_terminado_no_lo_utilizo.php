<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Producto_terminado extends CI_Controller {
			function __construct()
			{
			parent::__construct();
			$this->load->database();
			$this->load->model('producto_terminado_model');
			$this->load->library('grocery_crud');
			$this->load->helper('url');
			$this->load->model('alerta_model');

			}
			public function index()
			{
			redirect('/producto_terminado/recargar_grilla');
		    }
			public function recargar_grilla()

			{
				try {
				 /* Creamos el objeto */
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_producto_terminado');
				$crud->columns('producto','precio_neto','IVA');
				$crud->display_as('id_producto_terminado','producto');
				$crud->display_as('id_sucursal','sucursal');
				$crud->set_relation('id','t_producto_terminado','producto');
				$crud->set_relation('id_sucursal','t_sucursal','nombre');
				$crud->set_subject('inventario en almacen');
				$crud->set_language('spanish');
				//    $crud->columns('PRODUCTO','PRECIO_NETO','IVA', 'TOTAL');

				/* Generamos la tabla */
				$output = $crud->render();
    				//***********cargamos las vistas**************
		         $this->load->view('../../assets/inc/head_common');
		         $this->load->view('../../assets/inc/menu_principal');
	    	     $this->load->view('producto_terminado/producto_terminado',$output);

				} catch (Exception $e) {
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
				}
			}


}



/* End of file productos.php */
/* Location: ./application/controllers/productos.php */

?>