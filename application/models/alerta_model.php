<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Alerta_model extends CI_Model
		{

		function __construct()
		{
		parent::__construct();

		}
		public function contar_alerta($status){
			$this->db->from('t_alerta');
			$this->db->where('id_status_alerta',$status);
			return $this->db->count_all_results();
		}
	}
