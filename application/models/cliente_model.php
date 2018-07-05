<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

		class Cliente_model extends CI_Model
		{

				function __construct()
				{
				parent::__construct();

				}

			function get_data($item,$match) {

				$this->db->like($item, $match);
				$query = $this->db->get('T_CLIENTE');

				return $query->result();
			}
			function buscar_cliente($id) {

				$this->db->where('nif',$id);
				$query = $this->db->get('t_cliente');
					if ($query->num_rows()>0) {
					return $query;
					}else{
					return false;
					}
			}
				function buscar_cliente_id($id)
				{
				$this->db->where('id',$id);
				$query = $this->db->get('t_cliente');
					if ($query->num_rows()>0) {
					return $query;
					}else{
					return false;
					}
			}
			function get($id){

				$this->db->where('nif',$id);
				return $this->db->get('t_cliente')->result();
			}
		}

  /*
     CONSULTA 2

     $sql = "SELECT * FROM framework WHERE ".$item." LIKE '%".
     $this->db->escape_like_str($match)."%'";
	 $query = $this->db->query($sql);

*****************************************************************
    CONSULTA 3

	if($item==='framework'){
		 $sql = "SELECT * FROM framework WHERE framework like ? ";
	   }else{
			$sql = "SELECT * FROM framework WHERE cms like ? ";
		}

	$query = $this->db->query($sql, array('%'.$match.'%'));

******************************************************************

	return $query->result();

 */