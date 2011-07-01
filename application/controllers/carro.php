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
			$data['categoria'] = $this->carro_model->get_categorias();			
			if($this->input->post('categoria')) {
				$data['collectable'] = $this->carro_model->get_productos_categoria($this->input->post('categoria'));
				//ERROR NO HAY PRODUCTOS DE DICHA CATEGORIA !				
				$this->load->view('test', $data);	
			} else {
				$data['collectable'] = $this->carro_model->get_productos();
			}			
			$data['content_collectable'] = 'collectable';
			$this->load->view('carro', $data);
			
		}
		
		public function agregar_producto() {
			if($this->carro_model->validar_producto_carro($this->input->post('id_producto'), $this->input->post('cantidad'))) {
				if($this->input->post('ajax') != '1') {
					redirect('carro'); 
				} else {  
	           		echo 'true';
					//$this->cart_model->insertProducts($this->session->userdata('session_id'));
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
	}
	