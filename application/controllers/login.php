<?php
	class Login extends CI_Controller {
		
		public function __construct() {
			parent::__construct();		
			$this->load->model('login_model');
		}
	
		public function index() {
			if($this->session->userdata('e-mail')) {
				redirect('cart');
			} else {
				$this->load->view('login');
			}			       
		}
		
		public function user() {
			/* SETEO VALIDACIONES */
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[50]');
			$this->form_validation->set_rules('password', 'Contrase&ntilde;a', 'required|min_length[5]|max_length[30]|md5');
			/* SI NO PASA LAS VALIDACIONES */			
			if(($this->form_validation->run() == FALSE)) {
				$this->index();
				/* SI PASA LAS VALIDACIONES */
			} else {
				$Valido = $this->login_model->CheckUserAndPass($this->input->post('email'),$this->input->post('password'));				
				if($Valido) {
					$this->load->library('session');
                    $this->session->set_userdata('e-mail', $this->input->post('email'));                    
					redirect('main');
				} else {
					$data['error']="Email o contrase&ntilde;a incorrecto, por favor vuelva a intentar";	
					$this->load->view('login',$data);   //   Lo regresamos a la pantalla de login y pasamos como parámetro el mensaje de error a presentar en pantalla
				}
			}
		}
		
		public function admin() {
			$this->form_validation->set_rules('emailcp', 'e-mail', 'required|valid_email|max_length[50]');
			$this->form_validation->set_rules('passwordcp', 'Contrase&ntilde;a', 'required|min_length[5]|max_length[30]|md5');				
			if(($this->form_validation->run() == FALSE)) {         
				$this->index();			
			} else {			
				$v = $this->login_model->check_admin_account($this->input->post('emailcp'),$this->input->post('passwordcp'));			
				if($v == 1) {
					$this->load->library('session');
                    $this->session->set_userdata('e-mail', $this->input->post('emailcp'));
					$this->session->set_userdata('esadmin', TRUE);
					redirect('cpanel');				
				}
				if ($v == 2) {
					$data['errorcp']="Sos administrador ?";	
					$this->load->view('login',$data);
				}
				if ($v == 3) {
					$data['errorcp']="Email o contrase&ntilde;a inv&aacute;lido";
					$this->load->view('login',$data);
				}
			}
		}
	}
?>