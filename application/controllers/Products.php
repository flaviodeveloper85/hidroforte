<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller{

	function __construct(){

		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model("products_model");

	}

	/* public function index(){

		$this->load->view('header');
		$this->load->view('add_product');
		$this->load->view('footer');
	} */

	public function upload() { 


		// resgata os valores do form	
		 $file    = 		$_FILES['uploadimg']['name'];
		 $produto =			$_POST['produto']; 	
		 $tipo	  =			$_POST['tipo']; 	
		 $preco   =			$_POST['preco']; 	
		 @$product_ativo = 	$_POST['product_ativo'];
		 @$show_preco   =   $_POST['show_preco'];
		 $cfg  	  =			nl2br($_POST['config']);
		 $opc 	  =			nl2br($_POST['opc']); 	 

		 //pega a extensao do arquivo e converte para minuscula
		$extensao = pathinfo($file, PATHINFO_EXTENSION);
		$extensao = strtolower($extensao);
	
		//cria um novo nome 'unico' para o arquivo uploaded
		$novoNomeImg = uniqid(time()).".".$extensao;	

         $config['upload_path']   = './img/uploads/'; 
         $config['allowed_types'] = 'jpg|jpeg|png'; 
         $config['max_size']      = 1000; 
         $config['file_name']  	  = $novoNomeImg; 
         //$config['max_width']     = 1024; 
         //$config['max_height']    = 768;  

         // carrega no projeto a library upload
         $this->load->library('upload', $config);

		// salva o nome do arquivo codificado no banco
		$product = $this->products_model->cadastra_product($produto, $tipo, $novoNomeImg, $preco, $cfg, $opc, $product_ativo, $show_preco);

		
		if($this->upload->do_upload('uploadimg')){

			if($product){

				echo "Produto cadastrado com sucesso!";

			}else{

				echo "Falha ao cadastrar produto.";
			}

		}
		else{

			echo "Erro no upload";
			 
		}	
        
    } 


    // resgata todos os produtos cadastrados
    public function get_prod(){

    	$prods = $this->products_model->get_produtos();
    	
    	$get_prods['qtd_reg'] = $prods->row();
    	$get_prods['prod'] = $prods->result();


    	$this->load->view("header");
    	$this->load->view("add_product", $get_prods);
    	$this->load->view("footer");
    }


    // edita produto e atualiza o banco
    public function edit_produto(){

    	// resgata os valores do form	
    	 $id        	=         $_POST['id_prod'];
		 $file    		= 		  $_FILES['edit_uploadimg']['name'];
		 $produto 		=		  $_POST['edit_produto']; 	
		 $tipo	  		=		  $_POST['edit_tipo']; 	
		 $preco   		=		  $_POST['edit_preco']; 	
		 @$product_ativo= 		  $_POST['edit_product_ativo'];
		 @$show_preco   = 		  $_POST['edit_show_preco'];
		 $cfg  	  		=		  $_POST['edit_config'];
		 $opc 	  		=		  $_POST['edit_opc']; 	

		//pega a extensao do arquivo e converte para minuscula
		$extensao = pathinfo($file, PATHINFO_EXTENSION);
		$extensao = strtolower($extensao);
	
		//cria um novo nome 'unico' para o arquivo uploaded
		$novoNomeImg = uniqid(time()).".".$extensao;	


         $config['upload_path']   = './img/uploads/'; 
         $config['allowed_types'] = 'jpg|jpeg|png'; 
         $config['max_size']      = 1000; 
         $config['file_name']  	  = $novoNomeImg; 
         //$config['max_width']     = 1024; 
         //$config['max_height']    = 768;  

         // carrega no metodo a library upload
        $this->load->library('upload', $config);
         
         //retorna o nome da imagem no banco
    	$has_foto = $this->products_model->has_foto_produto($id); 
    	
    	//inicializa variavel que armazena se produto foi editado ou nao
    	$edit_prod = "";

    	if($file == ""){

    		// percorre na array de informaçoes do arquivo de imagem
    		foreach($has_foto as $foto){
			
				// verifica no banco se imagem esta vazia
				if($foto['imagem'] != null){

					$file = $foto['imagem'];
					$edit_prod = $this->products_model->edit_produto($id, $produto, $tipo, $file, $cfg, $opc, $preco, $product_ativo, $show_preco);

				}
				else{

					echo "Por favor, insira uma foto do produto";
					exit;
				}
			}

    	}
    	else{

    		$edit_prod = $this->products_model->edit_produto($id, $produto, $tipo, $novoNomeImg, $cfg, $opc, $preco, $product_ativo, $show_preco);

    		$this->upload->do_upload('edit_uploadimg');		
    	}
		
 		 
    	if($edit_prod){

    		echo "Alterações feita com Sucesso!";
    	}
    	else{

    		echo "Erro ao tentar editar o produto";
    	}
    }

    // popula janela modal para editar informaçoes
    public function popular_modal_edit(){

    	$cod_lista = $this->input->post("cod_item");

    	$item = $this->products_model->get_by($cod_lista);
			
    	$data = array(

    			'id'           => $item->id,
    			'produto'      => $item->produto,
    			'tipo'         => $item->tipo,
    			'imagem'       => $item->imagem,
    			'config'  	   => $item->config,
    			'opcional'     => $item->opcional,
    			'preco'   	   => $item->preco,
    			'ativo'   	   => $item->ativo,	
    			'show_preco'   => $item->show_preco
    			);  

    	
    			echo json_encode($data);
    }

    function banheira_individual(){

    	$data['dados'] = $this->products_model->get_banheira_ind();
    	$this->load->view("header");
    	$this->load->view("banheira-individual", $data);
    	$this->load->view("footer");
    }

    function banheira_dupla(){

    	$data['dados'] = $this->products_model->get_banheira_dupla();
    	$this->load->view("header");
    	$this->load->view("banheira-dupla", $data);
    	$this->load->view("footer");
    }

    function banheira_redonda(){

    	$data['dados'] = $this->products_model->get_banheira_redonda();
    	$this->load->view("header");
    	$this->load->view("banheira-redonda", $data);
    	$this->load->view("footer");
    }

     function banheira_de_Canto(){

    	$data['dados'] = $this->products_model->get_banheira_de_canto();
    	$this->load->view("header");
    	$this->load->view("banheira-de-canto", $data);
    	$this->load->view("footer");
    }

    function spa(){

    	$data['dados'] = $this->products_model->get_spa();
    	$this->load->view("header");
    	$this->load->view("spa", $data);
    	$this->load->view("footer");
    }

    function ofuro(){

    	$data['dados'] = $this->products_model->get_ofuro();
    	$this->load->view("header");
    	$this->load->view("ofuro", $data);
    	$this->load->view("footer");
    }

    function acessorios(){

    	$data['dados'] = $this->products_model->get_acessorios();
    	$this->load->view("header");
    	$this->load->view("acessorios", $data);
    	$this->load->view("footer");
    }
  
}