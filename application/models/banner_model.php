<?php
	Class Banner_model extends CI_Model {
		public function __construct() {
			parent::__construct();
		}
		
		public function get_nombre($mail) {
			$this->db->select('nombre');
			$this->db->where('mail', $mail);
			$query = $this->db->get('usuarios', 1);
			$row = $query->row();
			if ($query->num_rows() > 0) {
				return $row->nombre;
			}
			return 1;
		}
	}