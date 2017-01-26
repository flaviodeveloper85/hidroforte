<?php

class Mensagem extends CI_Controller{

	function __construct(){

		parent::__construct();

		$this->load->model('mensagem_model');
	}

	function index(){

		$this->load->view('header');
		$this->load->view('mensagens');
		$this->load->view('footer');
	}

	function envia_mensagem(){

		$nome			= ucfirst($_POST['nome']);
		$sobrenome		= ucfirst($_POST['sobrenome']);
		$email			= $_POST['email'];
		$telefone		= $_POST['phone']; 
		$tp_msg			= $_POST['tipo_msg'];
		$cidade			= ucwords($_POST['cidade']);
		$estado			= $_POST['estado']; 
		$msg			= ucfirst($_POST['contato_msg']);
		@$news			= $_POST['check_news']; 
		

		$contato_msg = $this->mensagem_model->insert_msg($nome, $sobrenome, $email, $telefone, $news, $cidade, $estado, $tp_msg, $msg);

		if($contato_msg){

			echo "Mensagem enviada com Sucesso!";

		}
		else{

			echo "Erro no envio da Mensagem";
		}

	}


	function get_orcamento(){

		$result['orcamento'] = $this->mensagem_model->get_orcamento();

		$this->load->view('header');
		$this->load->view('mensagens', $result);
		$this->load->view('footer');
	}

	// retorna todos os depoimentos no banco 
	function get_depoimentos(){

		$result['depoimento'] = $this->mensagem_model->get_depoimentos();
		$result['new_dep']  = $this->mensagem_model->check_new_dep();

		$this->load->view('header');
		$this->load->view('mensagens', $result);
		$this->load->view('footer');


	}

	// Usado via ajax para checa de 10 em 10s se existem novos depoimentos
	function refresh_dep(){

		$result = $this->mensagem_model->check_new_dep();
		echo $result->num_rows()." Novo(s) Depoimento(s)"; 
	}

	// salva depoimento no banco para ser exibido no site
	function show_depoimento(){

		// pega o id do depoimento que vem via ajax
		$id_dep = $_POST['id_dep'];	

		$result = $this->mensagem_model->show_depoimento($id_dep);

		if($result){

			echo "true";
		}

	}

	// arquiva depoimentos no banco
	function hide_depoimento(){

		// pega o id do depoimento que vem via ajax
		$id_dep = $_POST['id_dep'];	

		$result = $this->mensagem_model->hide_depoimento($id_dep);

		if($result){

			echo "true";
		}

	}


}