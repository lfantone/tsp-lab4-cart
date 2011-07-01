<?php
	Class Main extends CI_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->model('carro_model');						
            if(!$this->session->userdata('e-mail')) {
            	redirect('login');	
            }            
		}
		
		public function index(){
			$data['ofertas'] = $this->carro_model->get_ofertas();
			$this->load->view('ofertas', $data);			
		}		
		
		public function carro_ofertas(){
			$this->load->view('carro_mostrar');
		}
	}