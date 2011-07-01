<?php
	class CPanel extends CI_Controller {
		public function __construct() {
			parent::__construct();
                
                        if (!$this->session->userdata('e-mail') || !$this->session->userdata('esadmin'))
				redirect('login');
		}
	
		public function index() {
			$data['link'] = array(
                  	'1' => 'Producto',
                  	'2' => 'Proveedor',
                  	'3' => 'Categor&iacute;a');
			$data['opciones'] = array(                  	
                  	'1' => 'Baja',
                  	'2' => 'Modificaciones');			
			$this->load->view('cpanel', $data);			
		}		
		
		public function redireccion() {			
			if($this->input->post('link')) {
				if($this->input->post('link') == 1) {
					redirect('alta');				
				}
				if($this->input->post('link') == 2) {
					$this->load->view('alta_proveedor');
				}
				if($this->input->post('link') == 3) {			
					$this->load->view('alta_categoria');
				}								
			}
			if ($this->input->post('opciones')) {
				if($this->input->post('opciones') == 1) {
					redirect('baja');				
				}
				if($this->input->post('opciones') == 2) {
					redirect('modificacion');
				}
			}
		}
	}
?>