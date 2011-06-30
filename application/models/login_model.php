<?php
class Login_model extends CI_Model {
	public function __construct() {
		parent::__construct();		
	}
	
	function CheckUserAndPass($email,$password) { 
		$this->db->where('mail',$email);
		$this->db->where('password',$password);
		$query = $this->db->get('usuarios');
		
		if ($query->num_rows() > 0) {
			return TRUE;
		} 
		return FALSE;		
	}
	
	public function check_admin_account($mail, $pwd) {
		$this->db->where('mail',$mail);
		$this->db->where('password',$pwd);
		$query = $this->db->get('usuarios', 1);
		if ($query->num_rows() > 0) {
			if ($query->row(7) == 1) {
				return 1;
			}
			return 2;			
		}
		return 3; 
	}
}
?>