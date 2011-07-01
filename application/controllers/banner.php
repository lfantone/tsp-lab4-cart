<?php
	Class Banner extends CI_Controller {
		public function __construct() {
			parent::__construct();
			$this->load->model('banner_model');
		}
		
		public function index() {
			$data['user'] = $this->banner_model->get_nombre($this->session->userdata['e-mail']);
			$this->load->view('banner', $data);
		}
	}