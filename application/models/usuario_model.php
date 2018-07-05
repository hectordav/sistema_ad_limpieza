<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {

		function __construct()
		{
		parent::__construct();

		}

		public function login($login, $clave)
		{
			$this->db->select('id, id_nivel, id_sucursal, usuario');
			$this->db->from('t_usuario');
			$this->db->where('login', $login);
			$this->db->where('clave', $clave);
			$consulta = $this->db->get();
			$resultado = $consulta->row();
			return $resultado;
		}
		public function id_usuario($usuario)
		{

			$this->db->where('usuario', $usuario);
			$query = $this->db->get('t_usuario');
				if ($query->num_rows()>0) {
				return $query;
				}else{
				return false;
				}
		}
		public function buscar_usuarios()
		{
			$query = $this->db->get('t_usuario');
				if ($query->num_rows()>0) {
				return $query;
				}else{
				return false;
				}
		}


}

/* End of file usuario_model.php */
/* Location: ./application/models/usuario_model.php */