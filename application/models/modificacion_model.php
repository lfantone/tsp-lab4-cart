<?php
	class Modificacion_model extends CI_Model {
	    
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
		
		public function get_producto_id($id) {
			$this->db->where('id_producto', $id);
			$query = $this->db->get('productos');
			return $query->row_array();
		}
		
		public function get_proveedores() {
			$this->db->select('proveedores.id_proveedor, proveedores.razon_social, proveedores.telefono, domicilios.id_domicilio, domicilios.nombre_calle, domicilios.numero_calle, domicilios.localidad');
			$this->db->from('proveedores');
			$this->db->join('domicilios', 'domicilios.id_domicilio = proveedores.id_domicilio');			
			$query = $this->db->get();
    		return $query->result_array();
   		}
   		
		public function get_proveedor_id($id) {
			$this->db->where('id_proveedor', $id);
			$query = $this->db->get('proveedores');
			return $query->row_array();
		}
    
		public function get_categorias() {    		
    		$query = $this->db->get('categorias');
    		return $query->result_array();
    	}
    	
		public function get_categoria_id($id) {
			$this->db->where('id_categoria', $id);
			$query = $this->db->get('categorias');
			return $query->row_array();
		}
		
		public function get_domicilio_id($id) {
			$this->db->where('id_domicilio', $id);
			$query = $this->db->get('domicilios');
			return $query->row_array();
		}
		
		public function get_proveedores_array() {
			$this->db->select('id_proveedor, razon_social');
			$query = $this->db->get('proveedores');
    		if ($query->num_rows() > 0) {
    			return $this->rearrange_array($query->result_array());
    		}
   		}
    
		public function get_categorias_array() {
    		$this->db->select('id_categoria, nombre');
    		$query = $this->db->get('categorias', 3);
    		if ($query->num_rows() > 0) {
    			return $this->rearrange_array($query->result_array());
    		}
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
	    
	    public function update_producto($id, $descripcion, $precio, $stock, $oferta, $proveedor, $categoria) {
	    	$data = array(	    		
	    		'descripcion' => $descripcion,
	    		'precio' => $precio,
	    		'stock' => $stock,
	    		'precio' => $precio,
	    		'oferta' => $oferta,
	    		'id_proveedor' => $proveedor,
	    		'id_categoria' => $categoria,
	    		'imagen' => str_replace (' ','-',$descripcion)	    	
            );
			$this->db->where('id_producto', $id);
			$this->db->update('productos', $data);	    	
	    }
	    
		public function update_proveedor($id, $razon_social, $telefono, $id_domicilio, $nombre_calle, $numero_calle, $localidad) {
	    	$data_dom = array(	    		
	    		'nombre_calle' => $nombre_calle,
	    		'numero_calle' => $numero_calle,
	    		'localidad' => $localidad,
	    	);
			$this->db->where('id_domicilio', $id_domicilio);
			$this->db->update('domicilios', $data_dom);
			$data_pro = array(	    		
	    		'razon_social' => $razon_social,
	    		'telefono' => $telefono,
	    		'id_domicilio' => $id_domicilio
			);
			$this->db->where('id_proveedor', $id);
			$this->db->update('proveedores', $data_pro);	    	
	    }
	    
		public function update_categoria($id, $nombre) {
	    	$data = array(
	    		'id_categoria' => $id,	    		
	    		'nombre' => $nombre
	    	);
			$this->db->where('id_categoria', $id);
			$this->db->update('categorias', $data);			    	
	    }
	}
	
	