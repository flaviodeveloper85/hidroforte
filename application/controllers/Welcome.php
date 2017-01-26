<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	
	function __construct(){

		parent::__construct();
		$this->load->model("products_model");
		$this->load->model("mensagem_model");
	}

	public function index()
	{

    	$prod['produtos_home'] = $this->products_model->get_prod_destaque();
    	$prod['deps'] = $this->mensagem_model->refresh_dep();

		$this->load->view('header');
		$this->load->view('index', $prod);
		$this->load->view('footer');
	}

	
}
