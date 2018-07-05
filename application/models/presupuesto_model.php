<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Presupuesto_model extends CI_Model {

	function __construct()
		{
		parent::__construct();
		$this->load->database();
		$this->load->helper('date');
		}

	 function buscar_ultimo_presupuestoid()
	{
			$this->db->select_max('id');
			$query = $this->db->get('t_pre_factura');
				if ($query->num_rows()>0) {
				return $query;
				}else{
				return false;
				}
	}

	public function borrar_presupuesto($id){
			$this->db->delete('t_pre_factura',array('id'=>$id));
	}
	 function buscar_presupuesto($id)
	{

		$this->db->select('*');
		$this->db->where('id',$id);
			$query = $this->db->get('t_pre_factura');
				if ($query->num_rows()>0) {
				return $query;
				}else{
				return false;
				}
	}

	public function nuevo_presupuesto($id_cliente,$status_presupuesto,$sub_total,$total,$fecha)
	{
			$id_usuario=$this->session->userdata('id');
			$datos_factura = array('id_cliente' =>$id_cliente['id'],
							'id_usuario' =>$id_usuario,
							'id_status_pre_factura' =>$status_presupuesto,
							'sub_total' => $sub_total,
							'total' => $total,
							'fecha' => $fecha);
			$this->db->insert('t_pre_factura', $datos_factura);
		}

		public function insertar_det_presupuesto($data_presupuesto){
		$det_presupuesto = array('id_pre_factura' =>$data_presupuesto['id_presupuesto'],
							'descripcion' =>$data_presupuesto['descripcion'],
							'cantidad' =>$data_presupuesto['cantidad'],
							'precio' =>$data_presupuesto['precio_u'],
							'iva' =>$data_presupuesto['iva'],
							'total' =>$data_presupuesto['total']
							 ); //fin del array.
		$this->db->insert('t_det_pre_factura', $det_presupuesto);
		}

		public function buscar_det_presupuesto($num_presupuesto)
		{
			$this->db->where('id_pre_factura',$num_presupuesto['id_presupuesto']);
			$query = $this->db->get('t_det_pre_factura');
				if ($query->num_rows()>0) {
				return $query;
				}else{
				return false;
				}
		}
		public function sumar_iva_det_presupuesto($data_presupuesto){
		$det_presupuesto = array('id_pre_factura' =>$data_presupuesto['id_presupuesto']
							 ); //fin del array.
			$this->db->select_sum('iva');
			$this->db->where('id_pre_factura',$det_presupuesto['id_pre_factura']);
			$query = $this->db->get('t_det_pre_factura');
				if ($query->num_rows()>0) {
				return $query;
				}else{
				return false;
				}
		}
		public function sumar_total_det_presupuesto($data_presupuesto)
		{
		$det_presupuesto = array('id_pre_factura' =>$data_presupuesto['id_presupuesto']
							 ); //fin del array.
			$this->db->select_sum('total');
			$this->db->where('id_pre_factura',$det_presupuesto['id_pre_factura']);
			$query = $this->db->get('t_det_pre_factura');
				if ($query->num_rows()>0) {
				return $query;
				}else{
				return false;
				}
		}
		public function actualizar_presupuesto($data_presupuesto,$iva,$precio_neto,$total)
		{
			$actualizar = array('sub_total' =>$precio_neto, 'big'=>$precio_neto,'iva'=>$iva['iva'],'total'=>$total['total']); //fin del array.
			$this->db->where('id',$data_presupuesto['id_presupuesto']);
			$query = $this->db->update('t_pre_factura',$actualizar);
		}
			public function borrar_reg_det_presupuesto($id){
			$this->db->delete('t_det_pre_factura',array('id'=>$id));

		}
			public function contar_det_presupuesto_reg($num_factura)
			{
			$this->db->from('t_det_pre_factura');
			$this->db->where('id_pre_factura',$num_factura);
			return $this->db->count_all_results();
			}

			public function menu_presupuesto($por_pagina,$segmento)
		{
			$this->db->select('t_pre_factura.id, t_cliente.nif,t_cliente.nombre, t_pre_factura.num_fact, t_pre_factura.total, t_pre_factura.fecha');
			$this->db->join('t_cliente',
				't_pre_factura.id_cliente = t_cliente.id','left');
			$query = $this->db->get('t_pre_factura',$por_pagina,$segmento);
				if ($query->num_rows()>0) {
				return $query;
				}else{
				return false;
				}
		}
			public function filas()
	{
		$consulta = $this->db->get('t_pre_factura');
		return  $consulta->num_rows() ;
	}
}

/* End of file presupuesto_model */
/* Location: ./application/models/presupuesto_model */

?>