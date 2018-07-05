<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Punto_model extends CI_Model {
	function __construct()
				{
				parent::__construct();

				}
	public function guardar_punto($data){
		$datos_punto = array('id_factura' =>$data['id_factura'],
						'referencia' =>$data['referencia'],
						'monto' =>$data['monto'],
						'efectivo' =>$data['efectivo'],
						'fecha' =>$data['fecha']);
		$this->db->insert('t_punto', $datos_punto);
	}


}

/* End of file punto_model.php */
/* Location: ./application/models/punto_model.php */