<?php
/**
 * 
 * Modelo perteneciente al controlador perfil.php.
 * Existen dos metodos GetUser, get_carro. El primero de ellos,
 * devuelve los datos necesarios para completar el perfil del usuario.
 * El segundo, devuelve toda la ultima compra realizada por el usuario.
 *
 * @author lfantone
 *
 */
	Class Perfil_model extends CI_Model {
		/**
		 * 
		 * Constructor del modelo.
		 */
		public function __construct() {
			parent::__construct();
		}
		
		/**
		 * 
		 * Recibe por parametro el mail del usuario para luego buscar todos los demas\
		 * datos necesarios para el perfil (nombre, apellido, mail, direccion, numero, calle y localidad)
		 * @param unknown_type $email
		 */
		public function GetUser ($email) {
			$this->db->where('mail', $email);
			$this->db->join('domicilios', 'usuarios.id_domicilio = domicilios.id_domicilio');
			$query = $this->db->get('usuarios');
			if( $query->num_rows() > 0) {
				return $query->result_array();	
			}			
		}
		
		/**
		 * 
		 * Utilizando los datos de sesion del usuario, devuelvo todos los productos involucrados en la
		 * ultima compra que se realizo. Si no existe un carro de compras asociado al usuario, se devuelve FALSE.
		 */
		public function get_carro() {
			$this->db->select('carritos.id_carrito');
			$this->db->join('carritos', 'carritos.id_usuario = usuarios.id_usuario');
			$this->db->where('usuarios.mail', $this->session->userdata('e-mail'));
			$this->db->order_by('carritos.id_carrito', 'DESC');
			$query = $this->db->get('usuarios', 1);			
			if($query->num_rows() > 0) {
				$this->db->select('productos.descripcion, carritos_productos.cantidad, carritos_productos.precio');	
				$this->db->join('productos', 'productos.id_producto = carritos_productos.id_producto');
				$this->db->where('carritos_productos.id_carrito', $query->row()->id_carrito);
				$result = $this->db->get('carritos_productos');
				if($result->num_rows() > 0) {
					return $result->result_array();
				}
			}
			return FALSE;
		}			
	}