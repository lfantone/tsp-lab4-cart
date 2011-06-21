<?php
class Alta_model extends CI_Model {
    
    public function __construct() {
    	parent::__construct();
    }  
    
    public function get_proveedores() {
		$this->db->select('id_proveedor', 'razon_social');
		$query = $this->db->get('proveedores');
		return $query->result_array();
    }
    
	public function get_categorias() {
    	$this->db->select('id_categoria', 'nombre');
    	$query = $this-db-get('categorias');
    	return $query->result_array();
    }
    
    public function test_array() {
    	$this->db->select('id_collectable, collectable_name');
    	$query = $this->db->get('collectable', 5);    	
    	
    	if ($query->num_rows() > 0) {
    		$values = array_values($query->row_array());
    		if (count($values) === 2) {
    			$key = $values[0];
    			$val = $values[1];    				
    			$data = array($key=>$val);
    		}
    		foreach ($query->result_array() as $row) {
    			$values = array_values($row);
    			if (count($values) === 2) {
    				$key = $values[0];
    				$val = $values[1];    				
    				$end = array($key=>$val);
    			}    			
    			$data = array_merge($data, $end);    			
    		}
    	}    	
    	return $data;
    } 
    
   	public function insert_productos($descripcion,$precio,$stock,$id_categoria,$id_proveedor,$oferta) {
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
}

?>