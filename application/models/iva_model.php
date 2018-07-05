<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Iva_model extends CI_Model {
		function __construct(){
			parent::__construct();
			$this->load->database();
		}
	function Obtener_iva(){
		$this->db->select('IVA');
		$query=$this->db->get('T_IVA');
			if ($query->num_rows()>0)
				return $query;
			else
				return false;

	
	}

}

/* End of file empresa_model.php */
/* Location: ./application/models/empresa_model.php */
?>