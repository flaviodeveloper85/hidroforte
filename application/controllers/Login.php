<?php

class Login extends CI_Controller{

	function __construct(){

		parent::__construct();

		$this->load->model('admin_model');
		$this->load->library('session');
	}

	
	public function index(){

		$this->load->view('header');
		$this->load->view('login_form');
		$this->load->view('footer');
	}

	public function verificar_login(){

		$user = $this->input->post('username');
		$pass = $this->input->post('pass');

		$user = $this->admin_model->autenticar($user, $pass); // verifica user no bd
		
		if($user){

			$_SESSION['usuario'] = $user;
			$_SESSION['pass'] = $pass;

			redirect('admin');

		}else{

			$msg['msg_neg'] = "Acesso negado"; 
			$this->load->view('header');
			$this->load->view('login_form', $msg);
			$this->load->view('footer');
		}
		
	}

	// mata a session e finaliza a sessao no painel adm
	function kill_session(){

		session_unset();
		redirect('login');
	}


}