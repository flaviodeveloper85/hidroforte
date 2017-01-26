<?php

class Sobre extends CI_Controller{

	public function index(){

		$this->load->view('header');
		$this->load->view('sobre');
		$this->load->view('footer');
	}
}