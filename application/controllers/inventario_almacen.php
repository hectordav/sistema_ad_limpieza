<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inventario_almacen extends CI_Controller {
			function __construct()
			{
			parent::__construct();
			$this->load->helper('url');
			$this->load->database();
			$this->load->library('grocery_crud');
			$this->load->model('iva_model');
			$this->load->model('alerta_model');
			}
			public function index()
			{
			redirect('inventario_almacen/inv_almacen');
			}
		    public function inv_almacen()
		    {
		    		if($this->session->userdata('logueado')){
					try {
					 /* Creamos el objeto */
					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_inventario_sucursal');
					$crud->display_as('id_producto_terminado','producto');
					$crud->display_as('id_sucursal','sucursal');
					$crud->set_relation('id_producto_terminado','t_producto_terminado','producto');
					$crud->set_relation('id_sucursal','t_sucursal','nombre');
					$crud->set_subject('inventario en almacen');
					$crud->set_language('spanish');
					//    $crud->columns('PRODUCTO','PRECIO_NETO','IVA', 'TOTAL');

					/* Generamos la tabla */
					$output = $crud->render();
					$status_alerta=2;
					$contar_alerta['contar_a']=$this->alerta_model->contar_alerta($status_alerta);
						if ($contar_alerta['contar_a']==true) {
						$this->load->view('../../assets/inc/head_common');
						$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
						$this->load->view('inventario_almacen/inventario_almacen',$output);

						}else{
						$contar_alerta['contar_a']=0;
						$this->load->view('../../assets/inc/head_common');
						$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
						$this->load->view('inventario_almacen/inventario_almacen',$output);

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

/* End of file productos.php */
/* Location: ./application/controllers/productos.php */

?>