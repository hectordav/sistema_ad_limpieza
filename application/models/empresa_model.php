<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Empresa_model extends CI_Model {
		function __construct(){
			parent::__construct();
			$this->load->database();
		}
	function obtener_pt($data){
		$query-$this->db->get('t_producto_terminado');
		if ($query->num_rows()>0) {
			return($query); }  else{
				return false;
			}
		}

		function buscar_empresa(){
		$query=$this->db->get('t_empresa');
			if ($query->num_rows()>0) {
				return $query;
				}else{
				return false;
				}
		}






	}





/* End of file empresa_model.php */
/* Location: ./application/models/empresa_model.php */
?>