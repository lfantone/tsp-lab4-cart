<?php
/**
 * Carro_model class
 *
 * Esta clase se encarga de administrar el carrito de comprasa
 *
 * @package		CodeIgniter
 * @subpackage	Models
 * @category	Models
 * 
 * 
 */
	class Carro_model extends CI_Model {
		
		/**
		 * 
		 * Contructor del modelo
		 */
		public function __construct() {
			parent::__construct();			
		}
		
		/**
		 * Trae todos los productos en forma ordenada, devolviendo 1 en 
		 * caso de error. 
		 */
		public function get_productos() {
			$this->db->order_by('descripcion', 'ASC');
			$query = $this->db->get('productos');
			if($query->num_rows() > 0) {
				return $query->result_array();	
			}
			return 1;
		}
		
		/**
		 * Trae todos los productos de una categoria, devolviendo 1 
		 * en caso de error.
		 * @param unknown_type $cat Categoria
		 * @return number en caso de error
		 */
		public function get_productos_categoria($cat) {			
			$this->db->where('id_categoria', $cat);
			$this->db->order_by('descripcion', 'ASC');
			$query = $this->db->get('productos');
			if($query->num_rows() > 0) {
				return $query->result_array();	
			}
			return 1;
		}
		
		/**
		 * Trae todos los productos que tengan, devolviendo 1 
		 * en caso de error. 
		 */
		public function get_ofertas() {
			$this->db->where('oferta', '1');
			$this->db->order_by(alternator('descripcion','id_producto', 'precio'), 'random');
			$query = $this->db->get('productos');
			if ($query->num_rows() > 0) {
				return $query->result_array();	
			} 
			return 1; 
		}				
		
		/**
		 * 
		 * En base al userdata('e-mail') setteado en el inicio de la sesion
		 * inserta en la base de datos todos los productos correspondiente a la
		 * ultima compra que realizo el usuario. Devolviendo, TRUE en caso positivo
		 * y FALSE en caso negativo.
		 */
		public function insert_carro() {
			$this->db->select('id_usuario');
			$this->db->where('mail',$this->session->userdata('e-mail'));
			$result = $this->db->get('usuarios');
			if ($result->num_rows > 0) {
				$data = array(
					'id_usuario' => $result->row()->id_usuario);
				$this->db->insert('carritos', $data);
				$this->db->select('id_carrito');
				$this->db->order_by('id_carrito', 'DESC');
				$query = $this->db->get('carritos', 1);	
				if ($query->num_rows > 0) {
					foreach ($this->cart->contents() as $items) {
						$data = array(
							'id_carrito' => $query->row()->id_carrito,
							'id_producto' => $items['id'],
							'precio' => $items['price'],
							'cantidad' => $items['qty']);
						$this->db->insert('carritos_productos', $data);				
					}
				} else {
					return FALSE;		
				}
				return TRUE;
			}						
			return FALSE;
		}
		
		/**
		 * 
		 * Valida la insercion de productos al carro de compras, tomando por parametro
		 * el id del producto y la cantidad a insertar en el carro. Si dicho
		 * producto ya existe en el carro, se actualizo la cantidad y el precio. Caso
		 * contrario, se agrega.
		 * 
		 * @param unknown_type $id
		 * @param unknown_type $qty
		 */
		public function validar_producto_carro($id, $qty) {
			$this->db->where('id_producto', $id);
			$query = $this->db->get('productos', 1);						
			$row = $query->row();
			if ($query->num_rows > 0) {
				foreach ($this->cart->contents() as $items) {					
					if ($items['id'] == $id) {							
						$data = array(
									'rowid'=>$items['rowid'], 
									'qty'=>$items['qty'] + $qty, 
									'price'=> $this->precio_cantidad($row->precio, $items['qty'] + $qty));
						$this->cart->update($data);
						return TRUE;												
					}
				}				
				$data = array(
							'id' => $id,
							'qty' => $qty,
							'price' => $this->precio_cantidad($row->precio, $qty),
							'name' => $row->descripcion);
				$this->cart->insert($data);
				return TRUE;								
			} else {
				return FALSE;
			}
		}
		/**
		 * 
		 * Actualiza el contenido existente en el carro, buscandolo por la variable
		 * de sesion rowid.
		 * @param $rowid
		 * @param $qty
		 * @param $id
		 */
		public function validar_actualizar_carro($rowid, $qty, $id) {
			$total = $this->cart->total_items();			
			for ($i=0 ; $i < $total ; $i++) {
				$data = array(
						'rowid' => $rowid[$i], 
						'qty' => $qty[$i], 
						'price' => $this->precio_cantidad_id($id[$i], $qty[$i]));
				$this->cart->update($data);
			}
		}
		
		/**
		 * Valida que haya stock suficiente al confirmar la compra, devolviendo
		 * en caso de error, los productos que no hay en stock. 
		 *
		 */
		public function validar_compra() {
			foreach ($this->cart->contents() as $item) {
				$this->db->select('stock');
				$this->db->where('id_producto', $item['id']);
				$query = $this->db->get('productos', 1);
				if ($query->num_rows() > 0) {
					if ($query->row()->stock >= $item['qty'] ) {
						$data = array('stock' => $query->row()->stock - $item['qty']);
						$this->db->where('id_producto', $item['id']);
						$this->db->update('productos', $data);						
						$i['error'] = TRUE;
					} else {
						$i['error'] = FALSE;
						$i[$item['name']] = 'Stock insuficiente de '.$item['name']; 
					}										
				}				
			}
			return $i;		
		}
		/**
		 * Valida la cantidad de productos comprados para hacer un descuento por cantidad
		 * @param unknown_type $base_price
		 * @param unknown_type $qty
		 */
		private function precio_cantidad($base_price, $qty) {			
			if ($qty >= 5 AND $qty < 10) {
				return $new_price = $base_price - $base_price * 0.10;
			}
			if ($qty >= 10) {
				return $new_price = $base_price - $base_price * 0.25;				 
			}						
			return $base_price;			
		}
		/**
		 * 
		 * Retorna el nuevo precio de un determinado producto acorde a la cantidad de productos que
		 * se agregan al carro de compras
		 * 
		 * @param unknown_type $id
		 * @param unknown_type $qty
		 */
		private function precio_cantidad_id($id, $qty) {
			$this->db->where('id_producto', $id);
			$query = $this->db->get('productos', 1);						
			$row = $query->row();			
			if ($query->num_rows > 0) {
				if ($qty >= 5 AND $qty < 10) {
					return $new_price = $row->precio - $row->precio * 0.10;
				}
				if ($qty >= 10) {
					return $new_price = $row->precio - $row->precio * 0.25;				 
				}
			}				
			return $row->precio;
		}
	
		/**
		* Trae las categorias 
		*/
		public function get_categorias() {
	    	$this->db->select('id_categoria, nombre');
	    	$query = $this->db->get('categorias', 3);
	    	if ($query->num_rows() > 0) {
	    		return $this->rearrange_array_default($query->result_array());
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
     * Reordenamiento de arrays, transformando un array de array 
     * en un solo array. Agregando un valor por defecto al array devuelto.
     * 
     * @param unknown_type $d
     * @param unknown_type $data
     */ 
		 private function rearrange_array_default($d, $data = array()) {    	  	
	    	foreach ($d as $row) {
	    			$values = array_values($row);
	    			if (count($values) === 2) {
	    				$key = $values[0];
	    				$val = $values[1];    				
	    				$data[$key] = $val;
	    			}   			
	    	}
	    	$data['all'] = 'Mostrar todos';   	
	    	return $data;
	    }
		
	
}