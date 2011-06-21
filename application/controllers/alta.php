<?php

class Alta extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('alta_model');
	}

	public function index() {
		//$data['proveedor'] = $this->alta_model->get_proveedores();
		//$data['categoria'] = $this->alta_model->get_categorias();
		/*Test Array*/
		$data['t'] = $this->alta_model->test_array();
		$this->load->view('test', $data);		
		/*End Test Array*/
	}
	
	public function new_producto() {
		$this->form_validation->set_rules('descripcion', 'Descripcion', 'trim|required|min_length[5]|max_length[50]');
		$this->form_validation->set_rules('precio', 'Precio', 'trim|required|float|greater_than[0]');
		$this->form_validation->set_rules('stock', 'Stock', 'trim|required|is_natural');		
		$this->form_validation->set_rules('proveedor', 'Proveedor', 'required');
		$this->form_validation->set_rules('categoria', 'Categoria', 'required');
		
		if ($this->form_validation->run() == FALSE)	{
			$this->load->view('alta_producto');
		} else {
			$this->load->view('confirmacion_producto');
			//$this->altamodel->insert_productos($this->post->input('descripcion'), $this->post->input('precio'), $this->post->input('stock'), $this->post->input('id_categoria'), $this->post->input('id_proveedor'),$this->post->input('oferta') );
		}
	
	}
}
?>