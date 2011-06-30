<?php
	class Login extends CI_Controller {
		
		public function __construct() {
			parent::__construct();		
			$this->load->model('login_model');
		}
	
		public function index() {
			$this->load->view('login');       
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
					redirect('cart');
				} else {
					$data['error']="Email o contrase&ntilde;a incorrecto, por favor vuelva a intentar";	
					$this->load->view('login',$data);   //   Lo regresamos a la pantalla de login y pasamos como parámetro el mensaje de error a presentar en pantalla
				}
			}
		}
		
		public function admin() {
			$this->form_validation->set_rules('email-cp', 'e-mail', 'required|valid_email|max_length[50]');
			$this->form_validation->set_rules('password-cp', 'Contrase&ntilde;a', 'required|min_length[5]|max_length[30]|md5');				
			if(($this->form_validation->run() == FALSE)) {         
				$this->index();			
			} else {			
				$v = $this->login_model->check_admin_account($this->input->post('email-cp'),$this->input->post('password-cp'));			
				if($v == 1) {
					$this->load->library('session');
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