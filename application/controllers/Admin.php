<?php

class Admin extends CI_Controller{

	public function index(){

		
		$this->load->view('header');
		$this->load->view('painel');
		$this->load->view('footer');
	}
}