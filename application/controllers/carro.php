<?php
	class Carro extends CI_Controller {
		
		public function __construct() {
			parent::__construct();
			$this->load->model('carro_model');			
            if(!$this->session->userdata('e-mail')) {
            	redirect('login');	
            }
		}
		
		public function index() {
			$data['t'] = $this->session->userdata('cart_contents');
			$data['te'] = $this->carro_model->validar_compra();			
			$this->load->view('test', $data);			
		}
		
		public function agregar_producto() {
			if($this->carro_model->validar_producto_carro($this->input->post('id_producto'), $this->input->post('cantidad'))) {
				if($this->input->post('ajax') != '1') {
					redirect('carro'); 
				} else {  
	           		echo 'true';					
				}				  
	  		}
		}

		public function mostrar_carro() {
			$this->load->view('carro');
		}
		
		public function actualizar_carro() {
			if ($this->input->post('qty') > 0) {
				$this->carro_model->validar_actualizar_carro($this->input->post('rowid'), $this->input->post('qty'), $this->input->post('id'));
				redirect('carro');
			} else {
				redirect('carro');
			}
		}
		
		public function vaciar_carro() {
			$this->cart->destroy();
			redirect('carro');
		}

		public function comprar_carro() {
			$info = $this->carro_model->validar_compra();
			if(! isset($info['error'])) {
				$this->carro_model->insert_carro();
				$data['info'] = 'Gracias por su compra.';
			} else {
				unset($info['error']);
				$data['info'] = $info; 
			}
			$this->load->view('carro', $data); 
		}
	}
	