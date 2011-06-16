<?php
	class Cart_model extends CI_Model {
		public function __construct() {
			parent::__construct();
			$this->load->database();
		}
		
		public function get_products() {
			$query = $this->db->where('base_price >', '0');
			$query = $this->db->order_by('collectable_name', 'ASC');
			$query = $this->db->get('collectable', 20);
			return $query->result_array();
		}
		
		public function get_offers() {
			$query = $this->db->where('base_price >', '0');
			//$query = $this->db->where('offer', '1');
			$query = $this->db->order_by(alternator('collectable_name','id_collectable', 'base_price'), 'random');
			$query = $this->db->get('collectable', 8);
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
			$this->db->where('id_collectable', $id);
			$query = $this->db->get('collectable', 1);						
			$row = $query->row();
			if ($query->num_rows > 0) {
				foreach ($this->cart->contents() as $items) {					
					if ($items['id'] == $id) {							
						$data = array(
									'rowid'=>$items['rowid'], 
									'qty'=>$items['qty'] + $qty, 
									'price'=> $this->quantity_price($row->base_price, $items['qty'] + $qty));
						$this->cart->update($data);
						return TRUE;												
					}
				}				
				$data = array(
							'id' => $id,
							'qty' => $qty,
							'price' => $this->quantity_price($row->base_price, $qty),
							'name' => $row->collectable_name);
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
			$this->db->where('id_collectable', $id);
			$query = $this->db->get('collectable', 1);						
			$row = $query->row();			
			if ($query->num_rows > 0) {
				if ($qty >= 5 AND $qty < 10) {
					return $new_price = $row->base_price - $row->base_price * 0.10;
				}
				if ($qty >= 10) {
					return $new_price = $row->base_price - $row->base_price * 0.25;				 
				}
			}				
			return $row->base_price;
		}
	}