<?php
class Alta_model extends CI_Model {
    
    public function __construct() {
    	parent::__construct();
    }  
    
    public function get_proveedores() {
		$this->db->select('id_proveedor, razon_social');
		$query = $this->db->get('proveedores');
    	if ($query->num_rows() > 0) {
    		return $this->rearrange_array($query->result_array());
    	}
    }
    
	public function get_categorias() {
    	$this->db->select('id_categoria, nombre');
    	$query = $this->db->get('categorias');
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
    }
	
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