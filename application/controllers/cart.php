<?php
	class Cart extends CI_Controller {
		
		public function __construct() {
			parent::__construct();
			$this->load->model('cart_model');
			
                if (!$this->session->userdata('e-mail'))
				redirect('login');
		}
		
		public function index() {
			$data['offers'] = $this->cart_model->get_offers();
			$data['content_offers'] = 'offers';
			$data['categoria'] = $this->cart_model->get_categorias();
			$cat = $this->input->post('categoria');
			if(isset($cat)) {
				$data['collectable'] = $this->cart_model->get_productos_categoria($cat);	
			} else {
				$data['collectable'] = $this->cart_model->get_products();
			}			
			$data['content_collectable'] = 'collectable';
			$this->load->view('index', $data);
			
		}
		
		public function add_cart_item() {
			if($this->cart_model->validate_add_cart_item($this->input->post('id_producto'), $this->input->post('quantity'))) {
				if($this->input->post('ajax') != '1') {
					redirect('cart'); 
				} else {  
	           		echo 'true';
					//$this->cart_model->insertProducts($this->session->userdata('session_id'));
				}				  
	  		}
		}

		public function show_cart() {
			$this->load->view('cart');
		}
		
		public function update_cart() {
			if ($this->input->post('qty') > 0) {
				$this->cart_model->validate_update_cart($this->input->post('rowid'), $this->input->post('qty'), $this->input->post('id'));
				redirect('cart');
			} else {
				redirect('cart');
			}
		}
		
		public function empty_cart() {
			$this->cart->destroy();
			redirect('cart');
		}		
	}
	