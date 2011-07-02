<?php
	class Perfil extends CI_Controller {
	
		public function __construct() {
			parent::__construct();
			$this->load->model('registro_model');		
					
			if (!$this->session->userdata('e-mail'))
				redirect('login');
		}
		
		public function index() {
			$data['usuario'] = $this->registro_model->GetUser($this->session->userdata('e-mail'));
			$this->load->view('perfil_usuario', $data);			
		}
		
		public function new_user() {
							
			$this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|min_length[2]|max_length[30]|alpha|xss_clean');
			$this->form_validation->set_rules('apellido', 'Apellido', 'trim|required|min_length[2]|max_length[30]|alpha');
			$this->form_validation->set_rules('password', 'Contrase&ntilde;a', 'required|min_length[8]|max_length[30]|md5');
			$this->form_validation->set_rules('passconf', 'Confirme su contrase&ntilde;a', 'required|matches[password]|md5');
			$this->form_validation->set_rules('email', 'E-Mail', 'trim|required|valid_email|max_length[50]|callback_username_check');
			$this->form_validation->set_rules('direccion', 'Direcci&oacute;n', 'trim|required|min_length[2]|max_length[50]|alpha_numeric_spaces');
			$this->form_validation->set_rules('numero_calle', 'N&uacute;mero de calle', 'trim|required|min_length[1]|max_length[10]|is_natural_no_zero');
			$this->form_validation->set_rules('localidad', 'Localidad', 'trim|required|min_length[2]|max_length[50]|alpha_numeric_spaces');
			
			if ($this->form_validation->run() == FALSE) {
				$this->load->view('perfil_usuario');
			} else {			/* VALIDACIONES */
				if ($this->registro_model->insert_newUser($this->input->post('nombre'), $this->input->post('apellido'), $this->input->post('password'), $this->input->post('email'), $this->input->post('direccion'), $this->input->post('numero_calle'), $this->input->post('localidad'))) {
					$this->load->view('registro_correcto');
					$this->load->library('session');
				} else {
					$this->load->view('registroErr');
				}	
			}
		}
		
		// COMPROBACION DE E-MAIL, QUE NO SE DUPLIQUE EN LA BASE
		public function username_check($str) {
			$exist = $this->registro_model->CheckIfExist($this->input->post('email'));
			
			if ($exist) {
				$this->form_validation->set_message('username_check', 'El %s ya se encuentra en uso');
				return FALSE;
			}
			else
				return TRUE;
		}
	}
?>