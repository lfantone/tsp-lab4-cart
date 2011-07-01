<?php
	class Alta extends CI_Controller {
		public function __construct() {
			parent::__construct();
			$this->load->model('alta_model');                       
			if(!$this->session->userdata('e-mail') || !$this->session->userdata('esadmin')) {
				redirect('login');	
			}
		}
		
		public function index() {
			$data['proveedores'] = $this->alta_model->get_proveedores();
			$data['categorias'] = $this->alta_model->get_categorias();
			$this->load->view('alta_producto', $data);
		}
		
		public function new_producto() {
			$this->form_validation->set_rules('descripcion', 'Descripci&oacute;n', 'trim|required|min_length[5]|max_length[50]|alpha_numeric_spaces');
			$this->form_validation->set_rules('precio', 'Precio', 'trim|required|float|greater_than[0]');
			$this->form_validation->set_rules('stock', 'Stock', 'trim|required|is_natural');		
			$this->form_validation->set_rules('proveedor', 'Proveedor', 'required');
			$this->form_validation->set_rules('categoria', 'Categor&iacute;a', 'required');
		
			if ($this->form_validation->run() == FALSE)	{
				$this->index();
			} else {
				$this->alta_model->insert_productos($this->input->post('descripcion'), $this->input->post('precio'), $this->input->post('stock'), $this->input->post('categoria'), $this->input->post('proveedor'),$this->input->post('oferta') );
				$this->index();
			}
		}
		
		public function new_categoria() {
			$this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|min_length[5]|max_length[50]|alpha_numeric_spaces');
			if ($this->form_validation->run() == FALSE)	{
				$this->load->view('alta_categoria');
			} else {				
				$this->alta_model->insert_categoria($this->input->post('nombre'));
				$this->load->view('alta_categoria');
			}
		}
	
		public function new_proveedor() {		
			$this->form_validation->set_rules('razon_social', 'Raz&oacute;n Social', 'trim|required|min_length[5]|max_length[50]|alpha_numeric_spaces');
			$this->form_validation->set_rules('telefono', 'Tel&eacute;fono', 'trim|required|is_natural');
			$this->form_validation->set_rules('nombre_calle', 'Direcci&oacute;n', 'trim|required|min_length[2]|max_length[50]|alpha_numeric_spaces');
			$this->form_validation->set_rules('numero_calle', 'N&uacute;mero de Direcci&oacute;n', 'trim|required|min_length[1]|max_length[10]|is_natural_no_zero');
			$this->form_validation->set_rules('localidad', 'Localidad', 'trim|required|min_length[2]|max_length[50]|alpha_numeric_spaces');
			if ($this->form_validation->run() == FALSE)	{
				$this->load->view('alta_proveedor');
			} else {
				$this->alta_model->insert_proveedor($this->input->post('razon_social'),$this->input->post('telefono'),$this->input->post('nombre_calle'),$this->input->post('numero_calle'),$this->input->post('localidad'));
				$this->load->view('alta_proveedor');				
			}
		}	
	}