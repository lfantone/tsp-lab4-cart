<?php
	class Carro_model extends CI_Model {
		public function __construct() {
			parent::__construct();			
		}
		
		public function get_productos() {
			$this->db->order_by('descripcion', 'ASC');
			$query = $this->db->get('productos');
			if($query->num_rows() > 0) {
				return $query->result_array();	
			}
			return 1;
		}
		
		public function get_productos_categoria($cat) {			
			$this->db->where('id_categoria', $cat);
			$this->db->order_by('descripcion', 'ASC');
			$query = $this->db->get('productos');
			if($query->num_rows() > 0) {
				return $query->result_array();	
			}
			return 1;
		}
		
		public function get_ofertas() {
			$this->db->where('oferta', '1');
			$this->db->order_by(alternator('descripcion','id_producto', 'precio'), 'random');
			$query = $this->db->get('productos');
			if ($query->num_rows() > 0) {
				return $query->result_array();	
			} 
			return 1; 
		}				
		
		public function insert_carro() {
			foreach ($this->cart->contents() as $items) {
				$data = array(
							'id_producto' => $items['id'],
							'precio' => $items['price'],
							'cantidad' => $items['qty']);
				$this->db->insert('carritos_productos', $data);
			}
			$this->db->select('id_carrito');
			$this->db->order_by('id_carrito', 'ASC');
			$query = $this->db->get('carritos_productos');
			$this->db->select('id_usuario');
			$this->db->where('mail', $this->session->userdata('e-mail'));
			$result = $this->db->get('usuarios');
			if ($query->num_rows() > 0 && $result->num_rows() > 0) {
				$data = array(
						'id_carrito' => $query->row()->id_carrito,
						'id_usuario' => $result->row()->id_usuario);
				$this->db->insert('carritos', $data);
				return 	TRUE;
			}
			return FALSE;
		}
		
		public function validar_producto_carro($id, $qty) {
			$this->db->where('id_producto', $id);
			$query = $this->db->get('productos', 1);						
			$row = $query->row();
			if ($query->num_rows > 0) {
				foreach ($this->cart->contents() as $items) {					
					if ($items['id'] == $id) {							
						$data = array(
									'rowid'=>$items['rowid'], 
									'qty'=>$items['qty'] + $qty, 
									'price'=> $this->precio_cantidad($row->precio, $items['qty'] + $qty));
						$this->cart->update($data);
						return TRUE;												
					}
				}				
				$data = array(
							'id' => $id,
							'qty' => $qty,
							'price' => $this->precio_cantidad($row->precio, $qty),
							'name' => $row->descripcion);
				$this->cart->insert($data);
				return TRUE;								
			} else {
				return FALSE;
			}
		}
		
		public function validar_actualizar_carro($rowid, $qty, $id) {
			$total = $this->cart->total_items();			
			for ($i=0 ; $i < $total ; $i++) {
				$data = array(
						'rowid' => $rowid[$i], 
						'qty' => $qty[$i], 
						'price' => $this->precio_cantidad_id($id[$i], $qty[$i]));
				$this->cart->update($data);
			}
		}
		
		public function validar_compra() {
			foreach ($this->cart->contents() as $item) {
				$this->db->select('stock');
				$this->db->where('id_producto', $item['id']);
				$query = $this->db->get('productos', 1);
				if ($query->num_rows() > 0) {
					if ($query->row()->stock >= $item['qty'] ) {
						$data = array('stock' => $query->row()->stock - $item['qty']);
						$this->db->where('id_producto', $item['id']);
						$this->db->update('productos', $data);						
						$i['error'] = TRUE;
					} else {
						$i['error'] = FALSE;
						$i[$item['name']] = 'Stock insuficiente de '.$item['name']; 
					}										
				}				
			}
			return $i;		
		}
		
		private function precio_cantidad($base_price, $qty) {			
			if ($qty >= 5 AND $qty < 10) {
				return $new_price = $base_price - $base_price * 0.10;
			}
			if ($qty >= 10) {
				return $new_price = $base_price - $base_price * 0.25;				 
			}						
			return $base_price;			
		}
		
		private function precio_cantidad_id($id, $qty) {
			$this->db->where('id_producto', $id);
			$query = $this->db->get('productos', 1);						
			$row = $query->row();			
			if ($query->num_rows > 0) {
				if ($qty >= 5 AND $qty < 10) {
					return $new_price = $row->precio - $row->precio * 0.10;
				}
				if ($qty >= 10) {
					return $new_price = $row->precio - $row->precio * 0.25;				 
				}
			}				
			return $row->precio;
		}
	
	public function get_categorias() {
    	$this->db->select('id_categoria, nombre');
    	$query = $this->db->get('categorias', 3);
    	if ($query->num_rows() > 0) {
    		return $this->rearrange_array_default($query->result_array());
    	}
    }
    
    private function rearrange_array($d, $data = array()) {    	  	
    	foreach ($d as $row) {
    			$values = array_values($row);
    			if (count($values) === 2) {
    				$key = $values[0];
    				$val = $values[1];    				
    				$data[$key] = $val;
    			}   			
    	}   	
    	return $data;
    }
    
	 private function rearrange_array_default($d, $data = array()) {    	  	
    	foreach ($d as $row) {
    			$values = array_values($row);
    			if (count($values) === 2) {
    				$key = $values[0];
    				$val = $values[1];    				
    				$data[$key] = $val;
    			}   			
    	}
    	$data['all'] = 'Mostrar todos';   	
    	return $data;
    }
	
	
}