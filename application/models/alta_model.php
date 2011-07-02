<?php
/**
* Clase Alta_Model
*
* Esta Clase es usada por la aplicación para la realizar 
* el Alta de Producto, Alta de categoría y Alta Proveedor.
*
* @package MiAplicacion
* @author 
* @version 0.1
*/
class Alta_model extends CI_Model {
    /**
	* Es el constructor de la clase.
	*
	*/ 
    public function __construct() {
    	parent::__construct();
    }  
    /**
	* Esta función nos muestra los proveedores para su posterior enlistado
	*
	* Realizamos las consultas necesarias para obtener los datos de los proveedores
	*
	*
	*/
    public function get_proveedores() {
		$this->db->select('id_proveedor, razon_social');
		$query = $this->db->get('proveedores');
    	if ($query->num_rows() > 0) {
    		return $this->rearrange_array($query->result_array());
    	}
    }
    /**
	* Esta función nos muestra las categorías para su posterior enlistado
	*
	* Realizamos las consultas necesarias para obtener los datos de las categorias
	*
	*/
	public function get_categorias() {
    	$this->db->select('id_categoria, nombre');
    	$query = $this->db->get('categorias');
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
     * La función insert nos insterta todos los datos  
     * de los productos guardando la descripcion del 
     * producto, precio, stock, oferta, que proveedor nos 
     * vendio el producto, en que categoria se encuentra
     * 
     * @param unknown_type $descripcion
     * @param unknown_type $precio
     * @param unknown_type $stock
     * @param unknown_type $id_categoria
     * @param unknown_type $id_proveedor
     * @param unknown_type $oferta
     */
	public function insert_productos($descripcion,$precio,$stock,$id_categoria,$id_proveedor,$oferta) {
        $this->db->where('descripcion', $descripcion);
        $query = $this->db->get('productos');
        if($query->num_rows() > 0) {
        	return false;
        }
        $data = array(
				'descripcion' => $descripcion,
				'precio' => $precio,
				'stock' => $stock,
				'oferta' => $oferta,
				'id_proveedor' => $id_proveedor,
				'id_categoria' => $id_categoria,
				'imagen'=>str_replace (' ','-',$descripcion));
        $this->db->insert('productos', $data);
    	return TRUE;
	}
	
	/**
	* La función nos inserta el nombre de la nueva categoria.
	*
	*
	*
	*/
	
    public function insert_categoria($nombre) {
    	$this->db->where('nombre', $nombre);
        $query = $this->db->get('categorias');
        if($query->num_rows() > 0) {
        	return FALSE;
        }
        $data = array('nombre' => $nombre);
        $this->db->insert('categorias', $data);
    	return TRUE;
    }
	/**
	 * 
	 * Esta función nos inserta todo lo que tiene que ver con los proveedores
	 * @param unknown_type $razon_social
	 * @param unknown_type $telefono
	 * @param unknown_type $nombre_calle
	 * @param unknown_type $numero_calle
	 * @param unknown_type $localidad
	 */
	public function insert_proveedor($razon_social,$telefono,$nombre_calle, $numero_calle,$localidad) {
		$this->db->where('razon_social', $razon_social);
        $query = $this->db->get('proveedores');
        if($query->num_rows() > 0) {
        		return FALSE;
        	}
		$domicilio = array(
				'nombre_calle' => $nombre_calle,
				'numero_calle' => $numero_calle,
				'localidad' => $localidad);
		$this->db->insert('domicilios', $domicilio);
		$this->db->order_by('id_domicilio', 'desc');
		$query = $this->db->get('domicilios', 1);
		$row = $query->row();
		
		$proveedor = array(
				'razon_social' => $razon_social,
				'telefono' => $telefono,
				'id_domicilio' => $row->id_domicilio);
		$this->db->insert('proveedores', $proveedor);		
		return TRUE;
	}
}	
?>