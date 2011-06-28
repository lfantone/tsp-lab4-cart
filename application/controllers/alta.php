<?php
	class Alta extends CI_Controller {
		public function __construct() {
			parent::__construct();
			$this->load->model('alta_model');
		}
	
		public function index() {
			//$data['proveedores'] = $this->alta_model->get_proveedores();
			//$data['categorias'] = $this->alta_model->get_categorias();
			//$this->load->view('alta_producto', $data);		
			$this->load->view('alta_proveedor');
		}
		
		public function new_producto() {
			$this->form_validation->set_rules('descripcion', 'Descripcion', 'trim|required|min_length[5]|max_length[50]');
			$this->form_validation->set_rules('precio', 'Precio', 'trim|required|float|greater_than[0]');
			$this->form_validation->set_rules('stock', 'Stock', 'trim|required|is_natural');		
			$this->form_validation->set_rules('proveedor', 'Proveedor', 'required');
			$this->form_validation->set_rules('categoria', 'Categoria', 'required');
			
			if ($this->form_validation->run() == FALSE)	{
				$this->index();
			} else {
				$this->load->view('confirmacion_producto');
				//$this->alta_model->insert_productos($this->post->input('descripcion'), $this->post->input('precio'), $this->post->input('stock'), $this->post->input('id_categoria'), $this->post->input('id_proveedor'),$this->post->input('oferta') );
			}
		
		}
		
		public function new_proveedor() {
			$this->form_validation->set_rules('razon_social', 'Raz&iacute;n Social', 'trim|required|min_length[5]|max_length[50]');
			$this->form_validation->set_rules('telefono', 'Tel&eacute;fono', 'trim|required|is_natural|greater_than[0]');
			$this->form_validation->set_rules('nombre_calle', 'Nombre de Calle', 'trim|required|min_length[2]|max_length[50]|alpha_numeric');
			$this->form_validation->set_rules('numero_calle', 'N&uacute;mero', 'trim|required|min_length[1]|max_length[10]|is_natural_no_zero');
			$this->form_validation->set_rules('localidad', 'Localidad', 'trim|required|min_length[2]|max_length[50]|alpha_numeric');
		
			if ($this->form_validation->run() == FALSE)	{
				$this->index();
			} else {
				$this->alta_model->insert_proveedor($this->input->post('razon_social'), $this->input->post('telefono'), $this->input->post('nombre_calle'), $this->input->post('numero_calle'), $this->input->post('localidad'));
				redirect('alta');
			}
		}
	}
?>