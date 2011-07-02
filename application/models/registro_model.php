<?php
	class Registro_model extends CI_Model {
		public function __construct() {
			parent::__construct();
			$this->load->database();
		}
		
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