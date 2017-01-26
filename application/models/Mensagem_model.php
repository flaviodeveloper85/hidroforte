<?php

class Mensagem_model extends CI_Model{

	function __construct(){

		parent::__construct();
	}

	// salva dados do form contato no banco
	function insert_msg($nome, $sobrenome, $email, $telefone, $news, $cidade, $estado, $tp_msg, $message){

		// verifica se cliente ja é cadastrado no sistema
		$result = $this->db->query("select id, email from tb_cliente where email = '$email'")->row();
		
		if($result){

			// pega id do cliente que ja existe e inseri a msg junto com o id do cliente
			$id_cliente = $result->id;
			$has_cliente = $this->db->query("INSERT INTO tb_mensagem (id_cliente, tipo, mensagem) values ('$id_cliente', '$tp_msg', '$message')");

			return $has_cliente;
		}
		else{

			$cliente = array(

				'nome'		 => $nome,
				'sobrenome'  => $sobrenome,
				'email'      => $email,
				'telefone'	 => $telefone,
				'news'		 => $news,
				'cidade'	 => $cidade,
				'estado'	 => $estado
				
				); 

			//inseri cliente no banco
			$has_cliente = $this->db->insert('tb_cliente', $cliente);

			// inseri mensagem do cliente na tabela cliente no banco
			$this->db->query("INSERT INTO tb_mensagem (id_cliente, tipo, mensagem) values (last_insert_id(), '$tp_msg', '$message')");

			return $has_cliente;
		}
			
	}	

	// Busca todos os orçamentos armazenados no banco
	function get_orcamento(){

		$this->db->where('tipo', 'orc');
		$this->db->order_by('dt_hr', 'DESC');
		$this->db->join('tb_cliente', 'tb_cliente.id = tb_mensagem.id_cliente');
		return $this->db->get('tb_mensagem')->result();

	}

	// Busca todos os depoimentos por ordem de chegada armazenados no banco
	function get_depoimentos(){

		$this->db->where('tipo', 'dep');
		$this->db->order_by('dt_hr', 'DESC');
		$this->db->join('tb_mensagem', 'tb_mensagem.id_cliente = tb_cliente.id');
		return $this->db->get('tb_cliente');

	}

	//checa se tem novos depoimentos
	function check_new_dep(){

		$this->db->where('show', '');
		$this->db->where('tipo', 'dep');
		$this->db->order_by('dt_hr', 'DESC');
		return $this->db->get('tb_mensagem');
	}

	// funçao para mostrar depoimentos no site
	function show_depoimento($id){

		$this->db->set('show', 's');
		$this->db->where('id', $id);
		return $this->db->update('tb_mensagem');

	}

	// funçao para arquivar depoimentos no banco
	function hide_depoimento($id){

		$this->db->set('show', 'n');
		$this->db->where('id', $id);
		return $this->db->update('tb_mensagem');

	}

	function refresh_dep(){

		$this->db->where('tipo', 'dep');
		$this->db->where('show', 's');
		$this->db->limit('1');
		$this->db->order_by('RAND()');
		$this->db->join('tb_mensagem', 'tb_mensagem.id_cliente = tb_cliente.id');
		return $this->db->get('tb_cliente')->result();

	} 

}