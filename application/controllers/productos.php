<?php
	Class Productos extends CI_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->model('carro_model');
		}
		
		public function index(){
			$data['categoria'] = $this->carro_model->get_categorias();			
			if($this->input->post('categoria')) {
				$data['productos'] = $this->carro_model->get_productos_categoria($this->input->post('categoria'));
				if ($data['productos'] == 1) {
					$data['error'] = 'No hay productos registrados en esa categor&iacute;a';
					$data['productos'] = $this->carro_model->get_productos();
				}					
			} else {
				$data['productos'] = $this->carro_model->get_productos();
			}			
			$this->load->view('productos', $data);
		}
		
		public function carro_productos(){
			$this->load->view('carro_mostrar');
		}
	}