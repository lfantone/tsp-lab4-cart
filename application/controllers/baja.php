<?php
	class Baja extends CI_Controller {
		public function __construct() {
			parent::__construct();
			$this->load->model('baja_model');
		}
	
		public function index(){
			$data['productos'] = $this->baja_model->get_productos();
			$data['proveedores'] = $this->baja_model->get_proveedores();
			$data['categorias'] = $this->baja_model->get_categorias();
			$this->load->view('baja_lista', $data);
		}
		
		public function baja_producto() {
			
				$data['producto'] = $this->baja_model->baja_producto_id($this->input->post('id_producto'));
				$this->load->view('informe_de_baja', $data);
			
		}
		public function baja_proveedor(){
			if($this->baja_model->baja_proveedor_id($this->input->post('id_proveedor'))){				
				$this->load->view('informe_de_baja');
				}else{
				$data['error'] = 'Existen productos que dependen de Proveedores';				
				$this->load->view('informe_de_baja', $data);
				}
		}
		public function baja_categoria(){
			if($this->baja_model->baja_categoria_id($this->input->post('id_categoria'))){
				$data['categoria'] = $this->baja_model->baja_categoria_id($this->input->post('id_categoria'));
				$this->load->view('informe_de_baja', $data);
			}else{
				$data['error'] = 'Existen productos que dependen de la categor&iacute;a';				
				$this->load->view('informe_de_baja', $data);
			}
		}
	}
?>