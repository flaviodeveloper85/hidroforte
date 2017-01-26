<?php

class Products_model extends CI_Model{

	function __construct(){

		parent::__construct();
	}

	public function cadastra_product($product, $tipo, $img, $preco, $config, $opc, $ativo, $s_preco){

		$data = array(
			"produto" 	=> $product,
			"tipo" 		=> $tipo,
			"imagem" 	=> $img,
			"preco" 	=> $preco,
			"config" 	=> $config,
			"opcional" 	=> $opc,
			"ativo" 	=> $ativo,
			"show_preco"=> $s_preco
			);

		$insert = $this->db->insert("tb_produto", $data);

		return $insert;
	}

	public function get_produtos(){

		$query_get = $this->db->get("tb_produto");
		return $query_get;
	}

	// popular modal para editar um produto pelo seu id
	public function get_by($id){

		$my_prod = $this->db->get_where("tb_produto", array("id" => $id))->row();

    	return $my_prod;

	}

	public function edit_produto($id, $produto, $tipo, $img, $config, $opc, $preco, $ativo, $show_p){

			$data = array(

				"produto"      => $produto,
				"tipo" 	       => $tipo,
				"imagem"       => $img,
				"config"       => $config,
				"opcional"     => $opc,
				"preco"        => $preco,
				"ativo"   	   => $ativo,
				"show_preco"   => $show_p

				);
			
			$this->db->where("id", $id);
			return $this->db->update("tb_produto", $data);
			
			 
			 
	} 

	public function has_foto_produto($id){

		return $this->db->get_where("tb_produto", array("id" => $id))->result_array();
	}

	// retorna produtos no bd para a pagina inicial
	function get_prod_destaque(){

		return $this->db->query("SELECT * from tb_produto where ativo = 's' and tipo <> 'acessorio' order by rand() limit 8")->result();

	}

	// retorna banheiras individuais
	function get_banheira_ind(){

		$query = $this->db->query("SELECT * from tb_produto where ativo = 's' and tipo = 'banheira individual' ");
		return $query->result();
	}

	// retorna banheiras dupla
	function get_banheira_dupla(){

		$query = $this->db->query("SELECT * from tb_produto where ativo = 's' and tipo = 'banheira dupla' ");
		return $query->result();
	}

	// retorna banheiras redondas
	function get_banheira_redonda(){

		$query = $this->db->query("SELECT * from tb_produto where ativo = 's' and tipo = 'banheira redonda' ");
		return $query->result();
	}

	// retorna banheiras de canto
	function get_banheira_de_canto(){

		$query = $this->db->query("SELECT * from tb_produto where ativo = 's' and tipo = 'banheira de canto' ");
		return $query->result();
	}

	// retorna spas
	function get_spa(){

		$query = $this->db->query("SELECT * from tb_produto where ativo = 's' and tipo = 'spa' ");
		return $query->result();
	}

	// retorna ofuros
	function get_ofuro(){

		$query = $this->db->query("SELECT * from tb_produto where ativo = 's' and tipo = 'ofuro' ");
		return $query->result();
	}	

	// retorna ofuros
	function get_acessorios(){

		$query = $this->db->query("select * from tb_produto where ativo = 's' and tipo = 'acessorio' ");
		return $query->result();
	}	
}