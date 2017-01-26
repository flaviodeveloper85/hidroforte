<!DOCTYPE html>
<html>
    
	<head>
        <?php 

            // pega a current url
            $url = base_url(uri_string()); 
            
            switch ($url) {
                          // caso a url esteja na index chama o cabeçalho index
                          case 'http://localhost/hidroforte2/';
                            $this->load->view('cab_index');              
                              break;
                          // caso a url esteja nas banheiras individuais chama o cabeçalho banheiras ind.    
                          case 'http://localhost/hidroforte2/products/banheira-individual';
                            $this->load->view('cab_ban_individual');              
                              break;
                          case 'http://localhost/hidroforte2/products/banheira-dupla';
                            $this->load->view('cab_ban_dupla');              
                              break;
                          case 'http://localhost/hidroforte2/products/banheira-redonda';
                            $this->load->view('cab_ban_redonda');              
                              break; 
                          case 'http://localhost/hidroforte2/products/banheira-de-canto';
                            $this->load->view('cab_ban_de_canto');              
                              break; 
                          case 'http://localhost/hidroforte2/products/spa';
                            $this->load->view('cab_spa');              
                              break; 
                          case 'http://localhost/hidroforte2/products/ofuro';
                            $this->load->view('cab_ofuro');              
                              break; 
                          case 'http://localhost/hidroforte2/products/acessorios';
                            $this->load->view('cab_acessorios');              
                              break;
                          case 'http://localhost/hidroforte2/sobre';
                            $this->load->view('cab_sobre');              
                              break;   
                          case 'http://localhost/hidroforte2/contato';
                            $this->load->view('cab_contato');              
                              break;                        
                          
                      }          
        ?>
		
                <link rel="shortcut icon" href="<?php echo base_url();?>img/favicon.ico" type="image/x-icon">
                <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
                <link rel="stylesheet" href="<?php echo base_url('css/style.css');?>" />
                <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css');?>" />
                <link rel="stylesheet" href="<?php echo base_url('css/normalize.css');?>" />
                <link rel="stylesheet" href="<?php echo base_url('css/font-awesome.min.css');?>" />
                <link rel="stylesheet" href="<?php echo base_url('css/my-slider.css');?>" />
                <link rel="stylesheet" href="<?php echo base_url('css/toastr.min.css');?>" />
                <link rel="stylesheet" href="<?php echo base_url('css/jquery-ui.min.css');?>" />
                <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
                <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
                <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
                <script src="<?php echo base_url('js/main.js');?>"></script>
                <script src="<?php echo base_url('js/toastr.min.js');?>"></script>
                <script src="<?php echo base_url('js/jquery.maskedinput.min.js');?>"></script>
                
	</head>
	<body>
        <!-- div container header -->
		<div class="container-fluid">
                        <div class="row">
                                
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 header-black">
                                       <div class="col-lg-1 col-md-1"></div>
                                       <div class="col-lg-5 col-md-1"></div>
                                       <div class="col-lg-6 col-md-10 col-sm-10">
                                       
                                       </div>
                                       
                                       
                                </div>         
                        
                        
                               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 topo">
                                        
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 menu-hor">
                                        <nav>
                                                <ul class="menu-top">
                                                        <li><a href="<?php echo site_url(''); ?>"><i class="fa fa-home"></i> HOME</a></li>
                                                        <li><a href="#"><i class="fa fa-tags"></i> PRODUTOS</a>
                                                            <ul class="submenu">
                                                                <li><a href="<?php echo site_url('products/banheira-individual'); ?>">BANHEIRA INDIVIDUAL</a></li>
                                                                <li><a href="<?php echo site_url('products/banheira-dupla'); ?>">BANHEIRA DUPLA</a></li>
                                                                <li><a href="<?php echo site_url('products/banheira-redonda'); ?>">BANHEIRA REDONDA</a></li>
                                                                <li><a href="<?php echo site_url('products/banheira-de-canto'); ?>">BANHEIRA DE CANTO</a></li>
                                                                <li><a href="<?php echo site_url('products/spa'); ?>">SPA</a></li>
                                                                <li><a href="<?php echo site_url('products/ofuro'); ?>">OFURÔ</a></li>
                                                                <li><a href="<?php echo site_url('products/acessorios'); ?>">ACESSÓRIOS</a></li>
                                                            </ul>
                                                        </li>
                                                        <li><a href="<?php echo site_url('sobre'); ?>"><i class="fa fa-info-circle"></i> SOBRE </a></li>
                                                        <li><a href="<?php echo site_url('contato'); ?>"><i class="fa fa-edit"></i> CONTATO</a></li>
                                                        <li><a href="<?php echo site_url('login'); ?>"><i class="fa fa-user"></i> ADMIN</a></li>
                                                        
                                                </ul>
                                        </nav>
                                </div>
                                
                        </div>
                        <!-- footer -->
                        
                       
        </div>

                

                       
                        

                <!-- fim container header -->
                <script src="<?php echo base_url('js/bootstrap.min.js');?>" type="text/javascript"></script>
                <script src="<?php echo base_url('js/my-slider.min.js');?>" type="text/javascript"></script>
                
                
