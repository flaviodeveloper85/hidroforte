<?php

class Contato extends CI_Controller{

	public function index(){

		$this->load->view('header');
		$this->load->view('contato');
		$this->load->view('footer');
	}

	
}