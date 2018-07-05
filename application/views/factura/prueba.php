	public function alerta_cantidad_producto()
		{
			try {
				variable = $this->input->post('txt_producto');
				$num_factura= $this->input->post('lbl_num_fact');
				$cantidad= $this->input->post('txt_cantidad');
				$producto = $this->producto_terminado_model->buscar_producto($variable);
				$factura= $this->factura_model->buscar_factura($num_factura);

				foreach ($producto->result() as $data ) 
				{
				$datos_producto = array('id' => $data->id,
							'id_producto_terminado' => $data->id_producto_terminado,
							'producto' => $data->producto,	
							'cantidad' => $data->cantidad,	
							'precio_neto' => $data->precio_neto,
							'iva' => $data->iva,
							'total' => $data->total
					); #fin del array.			
				} #fin del foreach.
				foreach ($factura->result() as $data ) 
				{
				$datos_factura = array('id' => $data->id,
							'id_cliente' => $data->id_cliente,
							'id_usuario' => $data->id_usuario,	
							'num_fact' => $data->num_fact,
							'num_control' => $data->num_control,
							'sub_total' => $data->sub_total,
							'exento' => $data->exento,
							'big' => $data->big,
							'iva' => $data->iva,
							'total' => $data->total,
							'fecha' => $data->fecha,
							'observaciones' => $data->total			
					); #fin del array.			
				} #fin del foreach.
				$variable=$datos_factura['id_cliente'];
				$datos_cliente = $this->cliente_model->buscar_cliente($variable);
				foreach ($datos_cliente->result() as $data ) 
					{
					$datos_cliente = array('id' =>$data->id,
						'nombre_cliente' =>$data->nombre,
						'direccion' =>$data->direccion,
						'telf' =>$data->telf,
						'email' =>$data->email
							); #fin del array.			
				} #fin del foreach.
				$todo_datos = array(
				'id' =>$datos_cliente['id'],
				'nombre_cliente' =>$datos_cliente['nombre_cliente'],
				'direccion' =>$datos_cliente['direccion'],
				'telf' =>$datos_cliente['telf'],
				'email' =>$datos_cliente['email'],
				'id' =>$datos_factura['id'],
				'id_usuario' =>$datos_factura['id_usuario'],
				'num_fact' =>$datos_factura['num_fact'],
				'num_control' =>$datos_factura['num_control'],
				'sub_total' =>$datos_factura['sub_total'],
				'exento' =>$datos_factura['exento'],
				'big' =>$datos_factura['big'],
				'iva' =>$datos_factura['iva'],
				'total' =>$datos_factura['total'],
				'fecha' =>$datos_factura['fecha'],
				'observaciones' =>$datos_factura['observaciones']
				 );
			

			} catch (Exception $e){
				
			}			
				$this->load->view('../../assets/inc/head_common');
			
				#$this->load->view('../../assets/inc/menu_principal');
				$this->load->view('factura/nueva_factura',$todo_datos);
				$this->load->view('../../assets/script/script');
		}