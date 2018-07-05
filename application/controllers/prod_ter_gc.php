<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prod_ter_gc extends CI_Controller {
	function __construct()
			{
					parent::__construct();
					$this->load->helper('url');
					$this->load->database();
					$this->load->library('grocery_crud');
					//***************para tomar un valor de una funcion del model (algo personal)**************
					$this->load->model('iva_model');
					$this->load->model('alerta_model');
					}
					public function index()
					{

					redirect('prod_ter_gc/prodgc');
			}

		public function prodgc()
		{
				if($this->session->userdata('logueado')){
					try {
					/* Creamos el objeto */
					$crud = new grocery_CRUD();

					$crud->set_theme('bootstrap');
					$crud->set_table('t_producto_terminado');

					$crud->set_subject('producto terminado');
					$crud->set_language('spanish');
					$crud->columns('producto','precio_neto','iva', 'total');
					$crud->display_as('producto','PRODUCTO','precio_neto','PRECIO_NETO','iva','IVA','total','TOTAL');
					//***************para cambiar los inputs por defecto en add**************
					$crud->callback_add_field('precio_compra',array($this,'add_field_callback_1'));
					$crud->callback_add_field('ganancia',array($this,'add_field_callback_2'));
					$crud->callback_add_field('precio_neto',array($this,'add_field_callback_3'));
					$crud->callback_add_field('iva',array($this,'add_field_callback_4'));
					$crud->callback_add_field('total',array($this,'add_field_callback_5'));
					/***********************************fin**********************************/
					//***************para cambiar los inputs por defecto en edit**************
					$crud->callback_edit_field('precio_compra',array($this,'edit_field_callback_1'));
					$crud->callback_edit_field('ganancia',array($this,'edit_field_callback_2'));
					$crud->callback_edit_field('precio_neto',array($this,'edit_field_callback_3'));
					$crud->callback_edit_field('iva',array($this,'edit_field_callback_4'));
					$crud->callback_edit_field('total',array($this,'edit_field_callback_5'));

					$crud->required_fields('producto','precio_compra','ganancia','precio_neto','iva','total');

											/* Generamos la tabla */
					$output = $crud->render();
					$status_alerta=2;
					$contar_alerta['contar_a']=$this->alerta_model->contar_alerta($status_alerta);
						if ($contar_alerta['contar_a']==true) {
					$this->load->view('../../assets/inc/head_common');
					$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
					$this->load->view('producto_terminado/producto_terminado',$output);
						}else{
					$contar_alerta['contar_a']=0;
					$this->load->view('../../assets/inc/head_common');
					$this->load->view('../../assets/inc/menu_principal',$contar_alerta);
					$this->load->view('producto_terminado/producto_terminado',$output);
						}


					} catch (Exception $e) {
					show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
		}else{
			redirect('login');
		}

		}
			// los cambios de los imput para sumarlos (en agregar)
					function add_field_callback_1() //PRECIO COMPRA
					{
					return  ' <input name="precio_compra" type="text" class="form-control">';
					}
					function add_field_callback_2() //GANANCIA
					{

					return ' <input onkeyup="this.form.precio_neto.value = ((parseInt(this.form.precio_compra.value)*
					(parseInt(this.value)))/100+parseInt(this.form.precio_compra.value))" name="ganancia"
					class="form-control" >';
					}

					function add_field_callback_3() //PRECIO_NETO
					{
					$dato= $this->iva_model->Obtener_iva();
					return ' <input onkeyup="this.form.iva.value = ((((parseInt(this.value))*
					('.$dato->result()[0]->IVA.'))/100))" name="precio_neto" class="form-control" readonly>';
					}

					function add_field_callback_4() //IVA
					{

					return '<input onkeyup="this.form.total.value = parseFloat(this.value)+
					parseFloat(this.form.precio_neto.value)" name="iva" class="form-control" readonly>';
					}

					function add_field_callback_5()//TOTAL
					{

					return ' <input name="total" type="text" readonly class="form-control" >';

					}
					//******************************FIN_DE_AGREGAR***************************************************//

					//*************************************EDITAR***************************************************//
					function edit_field_callback_1($value, $primary_key)
					{
					return  ' <input name="precio_compra" type="text" class="form-control" value="'.$value.'">';

					}
					function edit_field_callback_2($value, $primary_key)
					{

					return ' <input onkeyup="this.form.precio_neto.value = ((parseInt(this.form.precio_compra.value)*
					(parseInt(this.value)))/100+parseInt(this.form.precio_compra.value))" name="ganancia"
					class="form-control" value="'.$value.'" >';
					}
					function edit_field_callback_3($value, $primary_key)
					{
					$dato= $this->iva_model->Obtener_iva();
					return ' <input onkeyup="this.form.iva.value = ((((parseInt(this.value))*
					('.$dato->result()[0]->IVA.'))/100))" name="precio_neto" class="form-control" readonly  value="'.$value.'">';
					}
					function edit_field_callback_4($value, $primary_key)
					{
					return '<input onkeyup="this.form.TOTAL.value = parseFloat(this.value)+
					parseFloat(this.form.precio_neto.value)" name="iva" class="form-control" readonly value="'.$value.'">';
					}
					function edit_field_callback_5($value, $primary_key)
					{
					return ' <input name="total" type="text" readonly class="form-control" value="'.$value.'">';
					}
//******************************FIN_EDITAR*********************************************************//
}

/* End of file productos.php */
/* Location: ./application/controllers/productos.php */

?>