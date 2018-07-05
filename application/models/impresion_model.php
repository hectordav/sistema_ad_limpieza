<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Impresion_model extends CI_Model {

		function __construct(){
			parent::__construct();
			$this->load->database();
		}


			function buscar_impresion(){
		$query=$this->db->get('t_impresion');
			if ($query->num_rows()>0) {
				return $query;
				}else{
				return false;
				}
		}

}

/* End of file impresion_model.php */
/* Location: ./application/models/impresion_model.php */