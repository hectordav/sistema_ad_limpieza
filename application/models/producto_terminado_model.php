<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Producto_terminado_model extends CI_Model {
		function __construct()
		{
			parent::__construct();
			$this->load->database();
		}
			function get_data($item,$match)
			{
				$this->db->like($item, $match);
				$query = $this->db->get('t_producto_terminado');
				return $query->result();
			}
			function Obtener_pt()
			{
				$query =$this->db->get('t_producto_terminado');
				if ($query->num_rows()>0)
				return $query;

				else
				return false;
			}
			function buscar_producto($variable,$id_sucursal)
			{
				$this->db->select('t_inventario_sucursal.id, t_inventario_sucursal.cantidad, t_producto_terminado.producto, t_producto_terminado.precio_neto, t_producto_terminado.iva,t_producto_terminado.total');
				$this->db->from('t_inventario_sucursal');
				$this->db->join('t_producto_terminado',
				't_inventario_sucursal.id_producto_terminado = t_producto_terminado.id','left');
				$this->db->where('t_producto_terminado.producto', $variable);
				$this->db->where('t_inventario_sucursal.id_sucursal', $id_sucursal);
				$query = $this->db->get();
				if ($query->num_rows()>0) {
					return $query;
					}else{
					return false;
					}
			}
				function buscar_producto_id($variable, $id_sucursal)
			{
				$this->db->select('t_inventario_sucursal.id, t_inventario_sucursal.cantidad, t_producto_terminado.producto, t_producto_terminado.precio_neto, t_producto_terminado.iva,t_producto_terminado.total');
				$this->db->from('t_inventario_sucursal');
				$this->db->join('t_producto_terminado',
				't_inventario_sucursal.id_producto_terminado = t_producto_terminado.id','left');
				$this->db->where('t_inventario_sucursal.id', $variable);
				$this->db->where('t_inventario_sucursal.id_sucursal', $id_sucursal);
				$query = $this->db->get();
				if ($query->num_rows()>0) {
					return $query;
					}else{
					return false;
					}
			}
			function get($id, $id_sucursal){
				$this->db->select('*');
				$this->db->from('t_inventario_sucursal');
				$this->db->join('t_producto_terminado',
				't_inventario_sucursal.id_producto_terminado = t_producto_terminado.id');
				$this->db->where('t_producto_terminado.producto', $id);
				$this->db->where('t_inventario_sucursal.id_sucursal', $id_sucursal);
				return $query = $this->db->get()->result();
			}
}

/* End of file empresa_model.php */
/* Location: ./application/models/empresa_model.php */
?>