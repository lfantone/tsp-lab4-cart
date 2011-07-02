<?php
/**
 * 
 * Modelo correspondiente a toda la parte de las diferentes modificaciones
 * que tiene el sistema.
 * 
 * @author ubuntu
 *
 */
	class Modificacion_model extends CI_Model {
	    /**
	     * 
	     * Constructor de de la clase
	     */
	    public function __construct() {
	    	parent::__construct();
	    }
		/**
		 * 
		 * Metodo que devuelve en un array, todos los productos asociados a una determinada
		 * categoria.
		 */
		public function get_productos() {
			$this->db->select('productos.id_producto, productos.descripcion, productos.precio, productos.stock, productos.oferta, proveedores.razon_social, categorias.nombre, productos.imagen');
			$this->db->from('productos');
			$this->db->join('proveedores', 'proveedores.id_proveedor = productos.id_proveedor');
			$this->db->join('categorias', 'categorias.id_categoria = productos.id_categoria');			
			$query = $this->db->get();
			return $query->result_array();
		}
		/**
		 * 
		 * Metodo que devuelve todos los datos correspondiente a un producto especifico
		 * informado por parametro.
		 * @param unknown_type $id
		 * @return array()
		 */
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
   		/**
   		 * 
   		 * Metodo que devuelve un determinado proveedor informado por parametro
   		 * @param unknown_type $id
   		 * @return array()
   		 */
		public function get_proveedor_id($id) {
			$this->db->where('id_proveedor', $id);
			$query = $this->db->get('proveedores');
			return $query->row_array();
		}
    /**
     * 
     * Metodo que devuelve todas las categorias cargadas en la base de datos.
     * @return array()
     */
		public function get_categorias() {    		
    		$query = $this->db->get('categorias');
    		return $query->result_array();
    	}
    	/**
    	 * 
    	 * Metodo que devuelve una determinada categoria informado por parametro
    	 * @param unknown_type $id
    	 * @return array()
    	 */
		public function get_categoria_id($id) {
			$this->db->where('id_categoria', $id);
			$query = $this->db->get('categorias');
			return $query->row_array();
		}
		
		/**
		 * 
		 * Metodo que devuelve un el nombre y numero de calle segun el id_domicilio
		 * @param unknown_type $id
		 * @return array()
		 */
		public function get_domicilio_id($id) {
			$this->db->where('id_domicilio', $id);
			$query = $this->db->get('domicilios');
			return $query->row_array();
		}
		/**
		 * 
		 * Metodo que devuelve un array de proveedores re-ordenado.
		 * @return array()
		 */
		public function get_proveedores_array() {
			$this->db->select('id_proveedor, razon_social');
			$query = $this->db->get('proveedores');
    		if ($query->num_rows() > 0) {
    			return $this->rearrange_array($query->result_array());
    		}
   		}
    /**
     * 
     * Metodo que devuelve un array de categorias re-ordenado.
     * @return array()
     */
		public function get_categorias_array() {
    		$this->db->select('id_categoria, nombre');
    		$query = $this->db->get('categorias', 3);
    		if ($query->num_rows() > 0) {
    			return $this->rearrange_array($query->result_array());
    		}
    	}
    /**
     * 
     * Reordenamiento de arrays, transformando un array de array 
     * en un solo array.
     * 
     * @param unknown_type $d
     * @param unknown_type $data
     */
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
	    /**
	     * 
	     * Metodo que realiza un update de un determinado producto en la base de datos.
	     * @param unknown_type $id
	     * @param unknown_type $descripcion
	     * @param unknown_type $precio
	     * @param unknown_type $stock
	     * @param unknown_type $oferta
	     * @param unknown_type $proveedor
	     * @param unknown_type $categoria
	     */
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
	    /**
	     * 
	     * Metodo que realiza un update de un determinado proveedor en la base de datos.
	     * @param unknown_type $id
	     * @param unknown_type $razon_social
	     * @param unknown_type $telefono
	     * @param unknown_type $id_domicilio
	     * @param unknown_type $nombre_calle
	     * @param unknown_type $numero_calle
	     * @param unknown_type $localidad
	     */
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
	    /**
	     * 
	     * Metodo que realiza un update de una determinada categoria en la base de datos.
	     * @param unknown_type $id
	     * @param unknown_type $nombre
	     */
		public function update_categoria($id, $nombre) {
	    	$data = array(
	    		'id_categoria' => $id,	    		
	    		'nombre' => $nombre
	    	);
			$this->db->where('id_categoria', $id);
			$this->db->update('categorias', $data);			    	
	    }
	}
	
	