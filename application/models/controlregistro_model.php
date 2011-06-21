<?php
	class Controlregistro_model extends CI_Model {
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
						'password' => $this->encrypt->decode($pwd),
						'id_domicilio' => $row->id_domicilio,
						'tipo_usuario' => '2');
			$this->db->insert('usuarios', $usuario);
			
			return TRUE;
		}
                
                public function CheckIfExist($email){
			$query = $this->db->where('mail',$email);
			$query = $this->db->get('usuarios');
			
			if($query->num_rows > 0)
				return TRUE;
			else
				return FALSE;
		}
	}
?>