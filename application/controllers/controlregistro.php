<?php

class Controlregistro extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('controlregistro_model');
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'url', 'security'));		
	}
	
	public function index() {		
		$this->load->view('registrousuario');	
	}
	
	public function new_user() {
		$this->form_validation->set_rules('firstname', 'Nombre', 'required|min_length[2]|max_length[30]');
		$this->form_validation->set_rules('lastname', 'Apellido', 'required|min_length[2]|max_length[30]');
		$this->form_validation->set_rules('password', 'Contraseña', 'required|min_length[8]|max_length[30]');
		$this->form_validation->set_rules('passconf', 'Confirme Contraseña', 'required|matches[password]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[50]|callback_username_check');
		$this->form_validation->set_rules('address', 'Dirección', 'required|min_length[2]|max_length[50]');
		$this->form_validation->set_rules('address_number', 'Número de Dirección', 'required|min_length[1]|max_length[10]|numeric');
		$this->form_validation->set_rules('city', 'Localidad', 'required|min_length[2]|max_length[50]|');
		
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('registrousuario');
		} else {			/* VALIDACIONES */
			if ($this->controlregistro_model->insert_newUser($this->input->post('firstname'), $this->input->post('lastname'), $this->encrypt->encode($this->input->post('password')), $this->input->post('email'), $this->input->post('address'), $this->input->post('address_number'), $this->input->post('city'))) {
				$this->load->view('registrocorrecto');
			} else {
				$this->load->view('registroErr');
			}	
		}
	}
	
	// COMPROBACION DE E-MAIL, QUE NO SE DUPLIQUE EN LA BASE
	function username_check($str)
	{
		$exist = $this->controlregistro_model->CheckIfExist($this->input->post('email'));
		
		if ($exist){
			$this->form_validation->set_message('username_check', 'El %s ya se encuentra en uso');
			return FALSE;
		}
		else
			return TRUE;
	}
}
?>