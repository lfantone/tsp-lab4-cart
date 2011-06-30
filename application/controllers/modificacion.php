<?php
	class Modificacion extends CI_Controller {
		public function __construct() {
			parent::__construct();
			$this->load->model('modificacion_model');
		}
	
		public function index(){
			$data['productos'] = $this->modificacion_model->get_productos();
			$data['proveedores'] = $this->modificacion_model->get_proveedores();
			$data['categorias'] = $this->modificacion_model->get_categorias();
			$this->load->view('modificacion_lista', $data);
		}
		
		public function mod_producto() {			
			$this->form_validation->set_rules('descripcion', 'Descripci&oacute;n', 'trim|required|min_length[5]|max_length[50]|alpha_numeric_spaces');
			$this->form_validation->set_rules('precio', 'Precio', 'trim|required|float|greater_than[0]');
			$this->form_validation->set_rules('stock', 'Stock', 'trim|required|is_natural');		
			$this->form_validation->set_rules('proveedor', 'Proveedor', 'required');
			$this->form_validation->set_rules('categoria', 'Categor&iacute;a', 'required');			
			if ($this->form_validation->run() == FALSE)	{
				$data['proveedores'] = $this->modificacion_model->get_proveedores_array();
				$data['categorias'] = $this->modificacion_model->get_categorias_array();
				$data['producto'] = $this->modificacion_model->get_producto_id($this->input->post('id_producto'));				
				$this->load->view('modificacion_producto', $data);
			} else {
				$this->modificacion_model->update_producto($this->input->post('id_producto'), $this->input->post('descripcion'), $this->input->post('precio'), $this->input->post('stock'), $this->input->post('oferta'), $this->input->post('proveedor'), $this->input->post('categoria'));
				$this->index();
			}			
		}
		
		public function mod_proovedor() {			
			$this->form_validation->set_rules('razon_social', 'Raz&oacute;n Social', 'trim|required|min_length[5]|max_length[50]|alpha_numeric_spaces');
			$this->form_validation->set_rules('telefono', 'Tel&eacute;fono', 'trim|required|is_natural');
			$this->form_validation->set_rules('nombre_calle', 'Direcci&oacute;n', 'trim|required|min_length[2]|max_length[50]|alpha_numeric_spaces');
			$this->form_validation->set_rules('numero_calle', 'N&uacute;mero de Direcci&oacute;n', 'trim|required|min_length[1]|max_length[10]|is_natural_no_zero');
			$this->form_validation->set_rules('localidad', 'Localidad', 'trim|required|min_length[2]|max_length[50]|alpha_numeric_spaces');
			if ($this->form_validation->run() == FALSE)	{
				$data['proveedor'] = $this->modificacion_model->get_proveedor_id($this->input->post('id_proveedor'));
				$data['domicilio'] = $this->modificacion_model->get_domicilio_id($this->input->post('id_domicilio'));
				$this->load->view('modificacion_proveedor', $data);
			} else {
				$this->modificacion_model->update_proveedor($this->input->post('id_proveedor'), $this->input->post('razon_social'), $this->input->post('telefono'), $this->input->post('id_domicilio'), $this->input->post('nombre_calle'), $this->input->post('numero_calle'), $this->input->post('localidad'));
				$this->index();	
			}			
		}
		
		public function mod_categoria() {
			$this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|min_length[5]|max_length[50]|alpha_numeric_spaces');
			if ($this->form_validation->run() == FALSE)	{
				$data['categoria'] = $this->modificacion_model->get_categoria_id($this->input->post('id_categoria'));
				$this->load->view('modificacion_categoria', $data);
			} else {				
				$this->modificacion_model->update_categoria($this->input->post('id_categoria'), $this->input->post('nombre'));
				$this->index();
			}
		}
	}