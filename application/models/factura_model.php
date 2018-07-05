<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Factura_model extends CI_Model
 {

		function __construct()
		{
		parent::__construct();
		$this->load->database();
		$this->load->helper('date');
		}
		public function buscar_ultima_facturaid() {
			$this->db->select_max('id');
			$query = $this->db->get('t_factura');
				if ($query->num_rows()>0) {
				return $query;
				}else{
				return false;
				}
		}
		public function buscar_num_fact_num_control($data_factura){

			$this->db->where($data_factura);
			$query = $this->db->get('t_factura');
				if ($query->num_rows()>0) {
				return $query;
				}else{
				return false;
				}
		}

		public function buscar_facturas_monto_cero($id_usuario){
			$this->db->where('total','0');
			$this->db->where('id_usuario',$id_usuario);
			$query = $this->db->get('t_factura');
				if ($query->num_rows()>0) {
				return $query;
				}else{
				return false;
				}
		}
		public function nueva_factura($id_cliente, $id_usuario, $status_factura,$num_fact,$sub_total,$total,$fecha){
			$datos_factura = array('id_cliente' =>$id_cliente,
							'id_usuario'=>$id_usuario,
							'id_status_factura' =>$status_factura,
							'num_fact' =>$num_fact,
							'num_control' =>$num_fact,
							'sub_total' => $sub_total,
							'total' => $total,
							'fecha' => $fecha);
			$this->db->insert('t_factura', $datos_factura);
		}

		public function buscar_factura($num_factura){
			$this->db->where('num_fact',$num_factura);
			$query = $this->db->get('t_factura');
				if ($query->num_rows()>0) {
				return $query;
				}else{
				return false;
				}
		}
		public function buscar_factura_num_fact($num_factura)
		{
			$this->db->select('t_factura.id, t_cliente.nif,t_cliente.nombre, t_factura.num_fact, t_factura.num_control, t_factura.total, t_factura.fecha');
			$this->db->from('t_factura');
			$this->db->join('t_cliente','t_factura.id_cliente = t_cliente.id','left');
			$this->db->where('t_factura.num_fact',$num_factura);
			$query = $this->db->get();
				if ($query->num_rows()>0) {
				return $query;
				}else{
				return false;
				}
			}
		public function buscar_factura_num_albarran($num_albarran)
		{
			$this->db->select('t_factura.id, t_cliente.nif,t_cliente.nombre, t_factura.num_fact, t_factura.num_control, t_factura.total, t_factura.fecha');
			$this->db->from('t_factura');
			$this->db->join('t_cliente','t_factura.id_cliente = t_cliente.id','left');
			$this->db->where('t_factura.num_control',$num_albarran);
			$query = $this->db->get();
				if ($query->num_rows()>0) {
				return $query;
				}else{
				return false;
				}
		}
		public function buscar_factura_nif_cliente($nif_cliente)
		{
			$this->db->select('t_factura.id, t_cliente.nif,t_cliente.nombre, t_factura.num_fact,t_factura.num_control, t_factura.total, t_factura.fecha');
			$this->db->from('t_factura');
			$this->db->join('t_cliente','t_factura.id_cliente = t_cliente.id','left');
			$this->db->where('t_cliente.nif',$nif_cliente);
			$query = $this->db->get();
				if ($query->num_rows()>0) {
				return $query;
				}else{
				return false;
				}
		}
		public function buscar_factura_nombre_cliente($nombre)
		{
			$this->db->select('t_factura.id, t_cliente.nif,t_cliente.nombre, t_factura.num_fact, t_factura.num_control, t_factura.total, t_factura.fecha');
			$this->db->from('t_factura');
			$this->db->join('t_cliente','t_factura.id_cliente = t_cliente.id','left');
			$this->db->like('t_cliente.nombre',$nombre);
			$query = $this->db->get();
				if ($query->num_rows()>0) {
				return $query;
				}else{
				return false;
				}
		}
		public function insertar_det_factura($data_factura){
		$det_factura = array('id_factura' =>$data_factura['id_factura'],
							'id_inventario_sucursal' =>$data_factura['id_inventario_sucursal'],
							'descripcion' =>$data_factura['descripcion'],
							'cantidad' =>$data_factura['cantidad'],
							'precio' =>$data_factura['precio_u'],
							'iva' =>$data_factura['iva'],
							'total' =>$data_factura['total']
							 ); //fin del array.
		$this->db->insert('t_det_factura', $det_factura);
		}

		public function actualizar_factura($id_factura,$iva,$precio_neto,$total)
		{

			$actualizar = array('sub_total' =>$precio_neto, 'big'=>$precio_neto,'iva'=>$iva['iva'],
			'total'=>$total['total']); //fin del array.
			$this->db->where('id',$id_factura);
			$query = $this->db->update('t_factura',$actualizar);
		}
		public function actualizar_factura_reg($data_factura,$iva,$precio_neto,$total)
		{

			$actualizar = array('sub_total' =>$precio_neto, 'big'=>$precio_neto,'iva'=>$iva['iva'],
			'total'=>$total['total']); //fin del array.
			$this->db->where('id',$data_factura);
			$query = $this->db->update('t_factura',$actualizar);
		}

		public function actualizar_factura_descuento($id_factura,$actualizar)
		{

			$this->db->where('id',$id_factura);
			$query = $this->db->update('t_factura',$actualizar);
		}

		public function buscar_det_factura($num_factura){
			$this->db->where('id_factura',$num_factura['id_factura']);
			$query = $this->db->get('t_det_factura');
				if ($query->num_rows()>0) {
				return $query;
				}else{
				return false;
				}
		}
			public function buscar_det_factura_reg($num_factura){
			$this->db->where('id_factura',$num_factura);
			$query = $this->db->get('t_det_factura');
				if ($query->num_rows()>0) {
				return $query;
				}else{
				return false;
				}
		}
			public function contar_factura_x_usuario($id_usuario,$fecha_inicio, $fecha_fin){
			$this->db->from('t_factura');
			$this->db->where('id_usuario',$id_usuario);
			$this->db->where('fecha >=',$fecha_inicio);
			$this->db->where('fecha <=',$fecha_fin);

			return $this->db->count_all_results();
		}
		public function contar_det_factura_reg($num_factura){
			$this->db->from('t_det_factura');
			$this->db->where('id_factura',$num_factura);
			return $this->db->count_all_results();
		}
		public function actualizar_Cantidad_Inv_Suc($datos_producto,$cantidad)
		{
			$actualizar = array('cantidad'=>$cantidad); //fin del array.
			$this->db->where('id',$datos_producto['id_inventario_sucursal']);
			$query = $this->db->update('t_inventario_sucursal',$actualizar);
		}
		public function borrar_reg_det_factura($id){
			$this->db->delete('t_det_factura',array('id'=>$id));

		}
		public function borrar_factura_en_cero($id){
			$this->db->delete('t_factura',($id));

		}
		public function buscar_item_det_factura($num_factura){
			$this->db->where('id',$num_factura);
			$query = $this->db->get('t_det_factura');
				if ($query->num_rows()>0) {
				return $query;
				}else{
				return false;
				}
		}

		public function Actualizar_Cantidad_Suma_Inv_Suc($datos_producto,$cantidad)
		{
			$actualizar = array('cantidad'=>$cantidad); //fin del array.
			$this->db->where('id',$datos_producto);
			$query = $this->db->update('t_inventario_sucursal',$actualizar);
		}
		public function sumar_iva_det_factura($data_factura){
		$det_factura = array('id_factura' =>$data_factura['id_factura']
							 ); //fin del array.
			$this->db->select_sum('iva');
			$this->db->where('id_factura',$det_factura['id_factura']);
			$query = $this->db->get('t_det_factura');
				if ($query->num_rows()>0) {
				return $query;
				}else{
				return false;
				}
		}
		public function sumar_total_det_factura($data_factura){
		$det_factura = array('id_factura' =>$data_factura['id_factura']
							 ); //fin del array.
			$this->db->select_sum('total');
			$this->db->where('id_factura',$det_factura['id_factura']);
			$query = $this->db->get('t_det_factura');
				if ($query->num_rows()>0) {
				return $query;
				}else{
				return false;
				}
		}
			public function sumar_factura_x_usuario($id_usuario,$fecha_inicio, $fecha_fin){
			$this->db->select_sum('total');
			$this->db->where('id_usuario',$id_usuario);
			$this->db->where('fecha >=',$fecha_inicio);
			$this->db->where('fecha <=',$fecha_fin);

			$query= $this->db->get('t_factura');

				if ($query->num_rows()>0) {
				return $query;
				}else{
				return false;
				}
		}
		public function sumar_iva_det_factura_eliminar_producto($data_factura){
		$det_factura = array('id_factura' =>$data_factura
							 ); //fin del array.
			$this->db->select_sum('iva');
			$this->db->where('id_factura',$det_factura['id_factura']);
			$query = $this->db->get('t_det_factura');
				if ($query->num_rows()>0) {
				return $query;
				}else{
				return false;
				}
		}
		public function sumar_total_det_factura_eliminar_producto($data_factura){
		$det_factura = array('id_factura' =>$data_factura
							 ); //fin del array.
			$this->db->select_sum('total');
			$this->db->where('id_factura',$det_factura['id_factura']);
			$query = $this->db->get('t_det_factura');
				if ($query->num_rows()>0) {
				return $query;
				}else{
				return false;
				}
		}

			public function buscar_factura_id($id)
		{
			$this->db->where('id',$id);
			$query = $this->db->get('t_factura');
				if ($query->num_rows()>0) {
				return $query;
				}else{
				return false;
				}
		}
		public function menu_factura($por_pagina,$segmento,$id_usuario)
		{
			$this->db->select('t_factura.id, t_cliente.nif,t_cliente.nombre, t_factura.num_fact, t_factura.num_control, t_factura.total, t_factura.fecha');
			$this->db->join('t_cliente',
				't_factura.id_cliente = t_cliente.id','left');
			$this->db->where('id_usuario',$id_usuario);
			$query = $this->db->get('t_factura',$por_pagina,$segmento);
				if ($query->num_rows()>0) {
				return $query;
				}else{
				return false;
				}
		}
		public function filas($id_usuario)
	{
		$this->db->where('id_usuario',$id_usuario);
		$consulta = $this->db->get('t_factura');
		return  $consulta->num_rows() ;
	}


	public function balance_factura($por_pagina,$segmento,$id_usuario, $fecha_inicio,$fecha_fin)
		{
			$this->db->select('t_factura.id, t_cliente.nif,t_cliente.nombre, t_factura.num_fact, t_factura.num_control, t_factura.total, t_factura.fecha');
			$this->db->join('t_cliente',
				't_factura.id_cliente = t_cliente.id','left');
				$this->db->where('id_usuario',$id_usuario);
				$this->db->where('fecha >=',$fecha_inicio);
				$this->db->where('fecha <=',$fecha_fin);
			$query = $this->db->get('t_factura',$por_pagina,$segmento);
				if ($query->num_rows()>0) {
				return $query;
				}else{
				return false;
				}
		}
		public function balance_filas($id_usuario, $fecha_inicio,$fecha_fin)
	{
			$this->db->where('id_usuario',$id_usuario);
			$this->db->where('fecha >=',$fecha_inicio);
			$this->db->where('fecha <=',$fecha_fin);

		$consulta = $this->db->get('t_factura');
		return  $consulta->num_rows() ;
	}


}

/* End of file factura_model.php */
/* Location: ./application/models/factura_model.php */

?>