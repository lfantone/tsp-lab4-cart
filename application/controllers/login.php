<?php

class Login extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');				
		$this->load->helper('security');
	}

   function index($idioma=null) {
		
		$mail = $this->input->post('email');
        if(!isset($mail)) {// Primer ingreso   
			$this->load->view('login');
        } else {
			/* SETEO VALIDACIONES */
			$this->form_validation->set_rules('email', 'e-mail', 'required|valid_email|max_length[50]');
		    $this->form_validation->set_rules('password', 'Contraseña', 'required|min_length[5]|max_length[30]');

			/* SI NO PASA LAS VALIDACIONES */			
			if(($this->form_validation->run() == FALSE)) {         
				$this->load->view('login');	

			/* SI PASA LAS VALIDACIONES */
			} else {     
				$this->load->model('login_model');
				$Valido = $this->login_model->CheckUserAndPass($mail,do_hash($this->input->post('password')));
				
				if($Valido) {
				   redirect('cart');
				} else {
				   $data['error']="E-mail o password incorrecto, por favor vuelva a intentar";	
				   $this->load->view('login',$data);   //   Lo regresamos a la pantalla de login y pasamos como parámetro el mensaje de error a presentar en pantalla
				}
			}
		}
	}
}
?>