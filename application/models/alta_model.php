<?php
class Alta_model extends CI_Model {
    
    public function __construct() {
    	parent::__construct();
    }  
    
    public function get_proveedores() {
		$this->db->select('id_collectable, collectable_name');
		$query = $this->db->get('collectable', 3);
    	if ($query->num_rows() > 0) {
    		return $this->rearrange_array($query->result_array());
    	}
    }
    
	public function get_categorias() {
    	$this->db->select('id_city, city_name');
    	$query = $this->db->get('city', 3);
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