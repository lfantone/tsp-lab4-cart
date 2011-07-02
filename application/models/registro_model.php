<?php
/**
 * Carro_model class
 *
 * Esta clase se encarga de administrar el carrito de comprasa
 *
 * @package		CodeIgniter
 * @subpackage	Models
 * @category	Models
 * 
 */
	class Registro_model extends CI_Model {
		/**
		 * 
		 * Constructor de la clase
		 */
		public function __construct() {
			parent::__construct();			
		}
		/**
		 * Inserta un nuevo usuario en la base
		 * @param string $firstname
		 * @param string $lastname
		 * @param string $pwd
		 * @param string $mail
		 * @param string $addr
		 * @param int $addr_no
		 * @param string $city
		 */
		public function insert_newUser($firstname, $lastname, $pwd, $mail, $addr, $addr_no, $city) {
			$domicilio = array(
							'nombre_calle' => $addr, 
							'numero_calle' => $addr_no, 
							'localidad' => $city);
										
			$this->db->insert('domicilios', $domicilio);
			
			$this->db->order_by('id_domicilio', 'desc');
			$query = $this->db->get('domicilios', 1);
			$row = $query->row();
						
			$usuario = array(
						'nombre' => $firstname,
						'apellido' => $lastname, 
						'mail' => $mail, 
						'password' => $pwd,
						'id_domicilio' => $row->id_domicilio,
						'tipo_usuario' => '2');
			$this->db->insert('usuarios', $usuario);
			
			return TRUE;
		}
		/**
		 * Le hace un update a un usuario, que cambia sus datos personales excepto la password
		 * @param string $mail
		 * @param string $addr
		 * @param string $addr_no
		 * @param string $city
		 */
		public function update_User ($mail, $addr, $addr_no, $city)
		{
			$this->db->select('id_domicilio');
			$this->db->where('mail', $mail);
			$query = $this->db->get('usuarios');
							
			$domicilio = array(
						'nombre_calle' => $addr, 
						'numero_calle' => $addr_no, 
						'localidad' => $city);
			
			$this->db->where('id_domicilio', $query->row()->id_domicilio);
			$this->db->update('domicilios', $domicilio);
		}
		/**
		 * Le hace un update a un usuario, que cambia sus datos personales junto a la password
		 * @param string $pwd
		 * @param string $mail
		 * @param string $addr
		 * @param string $addr_no
		 * @param string $city
		 */
		public function update_User_and_pass ($pwd, $mail, $addr, $addr_no, $city)
		{
			$this->db->select('id_domicilio');
			$this->db->where('mail', $mail);
			$query = $this->db->get('usuarios');
							
			$domicilio = array(
						'nombre_calle' => $addr, 
						'numero_calle' => $addr_no, 
						'localidad' => $city);
			
			$this->db->where('id_domicilio', $query->row()->id_domicilio);
			$this->db->update('domicilios', $domicilio);
			
			
			$usuario = array(
						'password' => $pwd);
			$this->db->where('mail', $mail);
			$this->db->update('usuarios', $usuario);
		}		
         /**
		 * Chequea si existe un usuario buscandolo por su mail en la base
		 * @param string $email
		 */
        public function CheckIfExist($email) {
			$query = $this->db->where('mail',$email);
			$query = $this->db->get('usuarios');
			
			if($query->num_rows > 0)
				return TRUE;
			else
				return FALSE;
		}
	}
?>