<?php
	class Cart_model extends CI_Model {
		public function __construct() {
			parent::__construct();
			$this->load->database();
		}
		
		public function getProducts() {
			$query = $this->db->where('base_price >', '0');
			$query = $this->db->order_by('collectable_name', 'ASC');
			$query = $this->db->get('collectable', 20);
			return $query->result_array();
		}
		
		public function getOffers() {
			$query = $this->db->where('base_price >', '0');
			//$query = $this->db->where('offer', '1');
			$query = $this->db->order_by(alternator('collectable_name','id_collectable', 'base_price'), 'random');
			$query = $this->db->get('collectable', 8);
			return $query->result_array();
		}
		
		public function insertProducts($userid) {
			foreach ($this->cart->contents() as $item) {
				$data = array(
							'collectable_name' => $item['name'],
							'base_price' => $item['price'],
							'quantity' => $item['qty'],
							'id_collectable' => $item['id'],
							'userid' => $userid);
				$this->db->insert('product_sale', $data);
			}
		}
		
		public function validate_add_cart_item($id, $qty) {
			$this->db->where('id_collectable', $id);
			$query = $this->db->get('collectable', 1);
			if ($query->num_rows > 0) {
				foreach ($this->cart->contents() as $item) {
					if ($item['id'] == $id) {						
						$data = array('rowid'=>$item['rowid'], 'qty'=>$item['qty'] + $qty);
						$this->cart->update($data);
						return TRUE;						
					}
				}				
				$row = $query->row();
				if ($qty > 5) {
					if ($qty > 10) {
						$data = array(
								'id' => $id,
								'qty' => $qty,
								'price' => $row->base_price-$row->base_price*0.25,
								'name' => $row->collectable_name);
						$this->cart->insert($data);
						return TRUE;	
					}
					$data = array(
								'id' => $id,
								'qty' => $qty,
								'price' => $row->base_price-$row->base_price*0.10,
								'name' => $row->collectable_name);
					$this->cart->insert($data);
					return TRUE;							
				}
				$data = array(
								'id' => $id,
								'qty' => $qty,
								'price' => $row->base_price,
								'name' => $row->collectable_name);
				$this->cart->insert($data);
				return TRUE;								
			} else {
				return FALSE;
			}
		}
		
		public function validate_update_cart($item, $qty) {
			$total = $this->cart->total_items();			
			
			for ($i=0 ; $i < $total ; $i++) {
				$data = array('rowid'=>$item[$i], 'qty'=>$qty[$i]);
				$this->cart->update($data);
			}
		}
	}