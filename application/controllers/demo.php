<?php

class Demo extends CI_Controller {
	
function __construct()
{
		parent::__construct();
	    $this->load->library('table');
		$this->load->model('demo_model');		
}
	
function index()
{    
		$this->table->set_heading('descripcion');
		$tmpl = array ( 'table_open'  => '<table border="1">' );
		//$this->table->set_template($tmpl); 
		
		$data['title'] = '.: Autocompletado con CI :.';
	// Seleccionamos la tabla con los campos que queremos mostrar; excluimos el id
			$this->db->select('nombre');
			$data['records'] = $this->db->get('t_cliente'); 
			$this->load->view('../../assets/inc/head_common');
			$this->load->view('../../assets/script/script');
			$this->load->view('../../assets/inc/menu_principal');
			$this->load->view('cliente/demo_view', $data);		
}

function get_data() 
{ 
    $match = $this->input->get('term', TRUE);  // TRUE para hacer un filtrado XSS  
    $item = $this->input->get('item', TRUE); 
	$data['item'] = $item;
	$data['results'] = $this->demo_model->get_data($item,$match);
    $this->load->view('cliente/data',$data);	
}
	
}