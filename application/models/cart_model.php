<?php
	class Cart_model extends CI_Model {
		public function __construct() {
			parent::__construct();			
		}
		
		public function get_products() {
			$this->db->where('precio >', '0');
			$this->db->order_by('descripcion', 'ASC');
			$query = $this->db->get('productos');
			return $query->result_array();
		}
		
		public function get_productos_categoria($cat) {
			$this->db->where('precio >', '0');
			$this->db->where('id_categoria', $cat);
			$this->db->order_by('descripcion', 'ASC');
			$query = $this->db->get('productos');
			return $query->result_array();
		}
		
		public function get_offers() {
			$this->db->where('precio >', '0');
			//$query = $this->db->where('offer', '1');
			$this->db->order_by(alternator('descripcion','id_producto', 'precio'), 'random');
			$query = $this->db->get('productos', 8);
			return $query->result_array();
		}
		// Falta definir la tabla para este tipo de insert.
		public function insert_products($userid) {
			foreach ($this->cart->contents() as $items) {
				$data = array(
							'collectable_name' => $items['name'],
							'base_price' => $items['price'],
							'quantity' => $items['qty'],
							'id_collectable' => $items['id'],
							'userid' => $userid);
				$this->db->insert('product_sale', $data);
			}
		}
		
		public function validate_add_cart_item($id, $qty) {
			$this->db->where('id_producto', $id);
			$query = $this->db->get('productos', 1);						
			$row = $query->row();
			if ($query->num_rows > 0) {
				foreach ($this->cart->contents() as $items) {					
					if ($items['id'] == $id) {							
						$data = array(
									'rowid'=>$items['rowid'], 
									'qty'=>$items['qty'] + $qty, 
									'price'=> $this->quantity_price($row->precio, $items['qty'] + $qty));
						$this->cart->update($data);
						return TRUE;												
					}
				}				
				$data = array(
							'id' => $id,
							'qty' => $qty,
							'price' => $this->quantity_price($row->precio, $qty),
							'name' => $row->descripcion);
				$this->cart->insert($data);
				return TRUE;								
			} else {
				return FALSE;
			}
		}
		
		public function validate_update_cart($rowid, $qty, $id) {
			$total = $this->cart->total_items();			
			for ($i=0 ; $i < $total ; $i++) {
				$data = array(
						'rowid' => $rowid[$i], 
						'qty' => $qty[$i], 
						'price' => $this->quantity_price_id($id[$i], $qty[$i]));
				$this->cart->update($data);
			}
		}
		
		private function quantity_price($base_price, $qty) {			
			if ($qty >= 5 AND $qty < 10) {
				return $new_price = $base_price - $base_price * 0.10;
			}
			if ($qty >= 10) {
				return $new_price = $base_price - $base_price * 0.25;				 
			}						
			return $base_price;			
		}
		
		private function quantity_price_id($id, $qty) {
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
    		return $this->rearrange_array($query->result_array());
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
	
	
	}