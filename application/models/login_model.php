<?php
/**
 * Login_model class
 *
 * Esta clase se encarga de administrar las cuentas de usuarios
 *
 * @package		CodeIgniter
 * @subpackage	Models
 * @category	Models
 * 
 */

class Login_model extends CI_Model {
	/**
	 * 
	 * Constructor del modelo
	 */
	public function __construct() {
		parent::__construct();		
	}
	/**
	 * Verifica que el usuario ingresado corresponda a su contrasena
	 * @param string $email
	 * @param string $password
	 */
	function CheckUserAndPass($email,$password) { 
		$this->db->where('mail',$email);
		$this->db->where('password',$password);
		$query = $this->db->get('usuarios');
		
		if ($query->num_rows() > 0) {
			return TRUE;
		} 
		return FALSE;		
	}
	/**
	 * Verifica que el usuario ingresado corresponda un usario administrador y a su contrasena 
	 * @param string $mail
	 * @param string $pwd
	 */
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