<?php
	class Perfil extends CI_Controller {
	
		public function __construct() {
			parent::__construct();
			$this->load->model('perfil_model');					
			if (!$this->session->userdata('e-mail')) {
				redirect('login');
			}
		}
		
		public function index() {
			$data['usuario'] = $this->perfil_model->GetUser($this->session->userdata('e-mail'));
			$this->load->view('perfil_usuario', $data);			
		}
		
		public function mod_user() {

			$this->form_validation->set_rules('password', 'Contrase&ntilde;a', 'min_length[8]|max_length[30]|md5');
			$this->form_validation->set_rules('passconf', 'Confirme su contrase&ntilde;a', 'matches[password]|md5');
			$this->form_validation->set_rules('direccion', 'Direcci&oacute;n', 'trim|required|min_length[2]|max_length[50]|alpha_numeric_spaces');
			$this->form_validation->set_rules('numero_calle', 'N&uacute;mero de calle', 'trim|required|min_length[1]|max_length[10]|is_natural_no_zero');
			$this->form_validation->set_rules('localidad', 'Localidad', 'trim|required|min_length[2]|max_length[50]|alpha_numeric_spaces');
			
			if ($this->form_validation->run() == FALSE) {
				$this->load->view('perfil_usuario');
			} 
			else {			/* VALIDACIONES */
				if ($this->input->post('password') != "")
				{
					$this->perfil_model->update_User_and_pass($this->input->post('password'), $this->session->userdata('e-mail'), $this->input->post('direccion'), $this->input->post('numero_calle'), $this->input->post('localidad'));
				}
				else 
				{
					$this->perfil_model->update_User($this->session->userdata('e-mail'), $this->input->post('direccion'), $this->input->post('numero_calle'), $this->input->post('localidad'));
				}
				redirect('main');
			}
		}
		
		public function ultimo_carro() {
			if($data['productos'] = $this->perfil_model->get_carro()) {
				$this->load->view('perfil_carro', $data);
			} else {
				$data['error'] = '<p>Nada para mostrar</p>';
				$this->load->view('perfil_carro', $data);
			}			
		}
	}
?>