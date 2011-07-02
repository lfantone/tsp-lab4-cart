<?php
	class Baja_model extends CI_Model {
	    
	    public function __construct() {
	    	parent::__construct();
	    }
		
		public function get_productos() {
			$this->db->select('productos.id_producto, productos.descripcion, productos.precio, productos.stock, productos.oferta, proveedores.razon_social, categorias.nombre, productos.imagen');
			$this->db->from('productos');
			$this->db->join('proveedores', 'proveedores.id_proveedor = productos.id_proveedor');
			$this->db->join('categorias', 'categorias.id_categoria = productos.id_categoria');			
			$query = $this->db->get();
			return $query->result_array();
		}
		public function baja_producto_id($id) {
			$this->db->where('id_producto', $id);
			$this->db->delete('productos');
			
		}
		public function get_proveedores() {
			$this->db->select('proveedores.id_proveedor, proveedores.razon_social, proveedores.telefono, domicilios.id_domicilio, domicilios.nombre_calle, domicilios.numero_calle, domicilios.localidad');
			$this->db->from('proveedores');
			$this->db->join('domicilios', 'domicilios.id_domicilio = proveedores.id_domicilio');			
			$query = $this->db->get();
    		return $query->result_array();
   		}
		public function get_categorias() {
			
			$query = $this->db->get('categorias');
			return $query->result_array();
		}
		public function baja_proveedor_id($id) {
			$this->db->where('id_proveedor', $id);
			$query = $this->db->get('productos');
			if (! $query->num_rows() > 0) {      
					$this->db->where('id_proveedor', $id);
					$ry = $this->db->get('proveedores');			
					$this->db->where('id_domicilio', $ry->row()->id_domicilio);
					$this->db->delete('domicilios');
					$this->db->where('id_proveedor', $id);
					$this->db->delete('proveedores');
					return TRUE;
			} 
			return FALSE;
		}
		
		
		public function baja_categoria_id($id) {
			$this->db->where('id_categoria', $id);
			$query = $this->db->get('productos');
			if (! $query->num_rows() > 0) {      
				$this->db->where('id_categoria', $id);
				$this->db->delete('categorias');
				return TRUE;
			} else {
				return FALSE;
			}
		}
	}