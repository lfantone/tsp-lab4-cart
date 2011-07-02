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
		
		public function GetUser ($email)
		{
			$this->db->select('*');
			$this->db->where('mail', $email);
			$this->db->join('domicilios', 'usuarios.id_domicilio = domicilios.id_domicilio');
			$query = $this->db->get('usuarios');
			//$this->db->join('comments', 'comments.id = blogs.id');
			return $query->result_array();
		}
                
        public function CheckIfExist($email) {
			$query = $this->db->where('mail',$email);
			$query = $this->db->get('usuarios');
			
			if($query->num_rows > 0)
				return TRUE;
			else
				return FALSE;
		}
		
		private function rearrange_array($d, $data = array()) {    	  	
	    	foreach ($d as $row) {
	    			$values = array_values($row);
	    			if (count($values) === 2) {
	    				$key = $values[0];
	    				$val = $values[1];    				
	    				$data[$key] = $val;
	    			}   			
	    	}   	
	    	return $data;
	    }
	}
?>