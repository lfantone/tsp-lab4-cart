<?php
class Login_model extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->database();		
	}
	
	function CheckUserAndPass($email,$password) { 
		$query = $this->db->where('mail',$email);
		$query = $this->db->where('password',$password);
		$query = $this->db->get('usuarios');
		if ($query->num_rows > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}
?>