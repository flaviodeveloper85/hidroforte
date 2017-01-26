<?php 
	
	// checa se existe sessao inicializada
	if(!isset($_SESSION['user']) && !isset($_SESSION['pass'])){
		session_unset();
		redirect('login');
	}
?>
<script>
	$(function(){
		// quando todo o DOM estiver carregado chama funçao que checa se ha novos depoimentos
		check_dep();
		
	});


	function check_dep(){

		// requisiçao ajax para verificar se tem novos depoimentos no banco
		$.ajax({  
           url:"<?php echo site_url(); ?>mensagem/refresh_dep",   
           method:"POST",  
           data:new FormData(this),  
           contentType: "html",  
           cache: false,  
           processData:false,  
           success:function(data)  
           {  
           		
           		$('#box_notify').html(data);
              	
           }  
	    });
	}

	setInterval(function(){check_dep();}, 10000);

</script>
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12 painel-adm">
				<div class="row">
					<div class="col-lg-5">
						<h1 class="title" id="panel-title"><i class="fa fa-gears fa-2x"></i> PAINEL ADMINISTRATIVO / <i class="fa fa-shopping-cart"></i> PRODUTOS </h1>
						</div>
						<div class="col-lg-7" style="text-align: right">
							<span id="box_notify" style="position:relative;top:50px;right:70px;font-size:11px;font-weight:bold;border:1px solid #9898b8; border-radius: 5px 5px;color:#9898b8; ;width:450px;padding:10px;background:#f3f3fb;"></span>
				</div>
				</div>
				
				<?php if($qtd_reg == null): ?>
					 <p style="text-align: center; font-size: 14px;font-weight: bold">NÃO HA PRODUTOS CADASTRADO</p>
				<?php else: ?>	 
				<table class="table table-striped" >
				    <thead>
				      <tr>
				        <th>Produto</th>
				        <th>Tipo</th>
				        <th>R$ Preço</th>
				        <th></th>
				      </tr>
				    </thead>
				    <tbody>
				      <tr>
				      <?php foreach($prod as $get_prods): ?>
				        <td><?php echo $get_prods->produto; ?></td>
				        <td><?php echo $get_prods->tipo; ?></td>
				        <td><?php echo number_format($get_prods->preco, 2, ',', '.'); ?></td>
				        <td><button href="#box-editar" class="btn btn-default btn-sm" onclick="modal_edit(<?php echo $get_prods->id;?>);"><i class="fa fa-pencil "></i> Editar</button></td>
				      </tr>
				      <?php endforeach; ?>
				    </tbody>
				  </table>
				<?php endif; ?>
				  <br />
				  <script> 

				   // popula os campos na janela modal para editar produto  
				  	function modal_edit(id){ 

				  		var cod_item = id;

				  		$.ajax({
		                  url: "<?php echo site_url(); ?>products/popular_modal_edit",
		                  type: "POST",
		                  data: { cod_item: cod_item},
		                  dataType: "html",
		                  success: function(result){
		                  		
		                       $("#modal_edit input").empty(); // limpa a input
		                       var data = JSON.parse(result);
 								
 							   $("#id_prod").val(data.id);
 	                           $("#edit_produto").val(data.produto);
 	                           $("#edit_tipo").val(data.tipo);
 	                           var path_img = "<?php echo base_url('img/uploads/'); ?>" + data.imagem;
 	                           $("#edit_thumbnail").attr('src', path_img);
 	                           $("#edit_config").val(data.config);
 	                           $("#edit_uploadimg").val('');
 	                           $("#edit_opc").val(data.opcional);
 	                           $("#edit_preco").val(data.preco);
 	                           if(data.ativo == null){

 	                           		$("#edit_product_ativo").attr('checked', false);	
 	                           }else{
 	                           		$("#edit_product_ativo").attr('checked', true);	
 	                           }
 	                           	
 	                           if(data.show_preco == null){
 	                           		$("#edit_show_preco").attr('checked', false);
 	                           }else{
 	                           		$("#edit_show_preco").attr('checked', true);
 	                           }
	                           $("#box-editar").modal("show");
		                  	} 
				        }); 
				  	} 

				  	

				  </script>
			<!-- Modal editar -->
			<div class="modal fade" id="box-editar" tabindex="-1" role="dialog" aria-labelledby="boxLabel" aria-hidden="true">
			  <div class="modal-dialog modal-md">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="boxLabel"><i class="fa fa-pencil fa-2x"></i> Editar Produto</h4>
			      </div>
			      <div class="modal-body">
			      	
			      	<div class="row">
					  	<div class="col-lg-6">
					  	<form id="form_edit_prod" enctype="multipart/form-data">
					  	 <img  src="" id="edit_thumbnail" width="270" height="250" alt="thumbnail" />	
					  	 <br />
				         <label for="edit_produto">Produto:</label>
				         <input type="text" name="edit_produto" required id="edit_produto" class="form-control" placeholder="Ex. Banheira de Canto C1" />
				         <br />
				         <label for="edit_tipo">Tipo:</label>
				         <select name="edit_tipo" id="edit_tipo" class="form-control">
				         	<option value="0">Escolha o tipo de produto</option>
				         	<option value="Banheira Individual">Banheira Individual</option>
				         	<option value="Banheira Dupla">Banheira Dupla</option>
				         	<option value="Banheira de Canto">Banheira de Canto</option>
				         	<option value="Banheira Redonda">Banheira Redonda</option>
				         	<option value="Spa">Spa</option>
				         	<option value="Ofurô">Ofurô</option>
				         	<option value="Acessório">Acessório</option>
				         	
				         </select>
				         <br />
				         <label for="edit_preco">R$ Preço:</label>
				         <input type="text" id="edit_preco" required name="edit_preco" class="form-control" placeholder="Ex. 1500" />
				         <br />
				         
					  	</div>
					  	<div class="col-lg-6">
					  		<label for="edit_config">Configuração: <span class="label label-primary help-br">  após cada item insira &lt;br /></span></label><br />
				         <textarea name="edit_config" rows="10" required id="edit_config" style="font-size:12px" placeholder="Um item por linha" class="form-control txt-add-product"></textarea>
				         <br />
				         <label for="edit_opc">Opcionais: <span class="label label-primary help-br">  após cada item insira &lt;br /></span></label><br />
				         <textarea name="edit_opc" id="edit_opc" required rows="6" style="font-size:12px" placeholder="Um item por linha" class="form-control txt-add-product"></textarea>
				         <br />
				         <input type="checkbox" id="edit_product_ativo" name="edit_product_ativo" value="s" > Mostrar Produto no Site
				         <br />
				         <input type="checkbox" class="" id="edit_show_preco" name="edit_show_preco" value="s" > Mostrar Preço no Site
				         
				         <br /><br />
				         <label for="">Alterar foto:</label>
				         <input type="file" id="edit_uploadimg" name="edit_uploadimg" size="20" />
				         <input type="hidden" id="id_prod" name="id_prod"  />
					  	</div>
					 </div>				      
			      </div>
			      <div class="modal-footer">
			        <button type="submit" id="bt_edit_prod" class="btn btn-primary">Salvar alterações</button>
			        </form>
			      </div>
			    </div>
			  </div>
			</div>
			<!-- fim modal editar -->

			<!-- Modal add -->
			<div class="modal fade" id="box-add" tabindex="-1" role="dialog" aria-labelledby="boxLabel" aria-hidden="true">
			  <div class="modal-dialog modal-md">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="boxLabel cadastrar-title"><i class="fa fa-plus-square fa-2x"></i> Cadastrar Novo Produto</h4>
			      </div>
			      
			      <div class="modal-body">
				      <div class="alert alert-warning">
					  	<strong>Importante!</strong> Para que o site se mantenha profissional e o cliente tenha uma ótima experiência, ao colocar fotos dos produtos certifique-se que as fotos estejam em ótima resolução.
					  </div>
					  <div class="row">
					  	<div class="col-lg-6">
					  		
					  	<form id="form_add_prod" enctype="multipart/form-data">
				         <label for="produto">Produto:</label>
				         <input type="text" name="produto" required id="produto" class="form-control" placeholder="Ex. Banheira de Canto C1" />
				         <br />
				         <label for="tipo">Tipo:</label>
				         <select name="tipo" id="tipo" class="form-control">
				         	<option value="0">Escolha o tipo de produto</option>
				         	<option value="Banheira Individual">Banheira Individual</option>
				         	<option value="Banheira Dupla">Banheira Dupla</option>
				         	<option value="Banheira de Canto">Banheira de Canto</option>
				         	<option value="Banheira Redonda">Banheira Redonda</option>
				         	<option value="Spa">Spa</option>
				         	<option value="Ofurô">Ofurô</option>
				         	<option value="Acessório">Acessório</option>
				         	
				         </select>
				         <br />
				         <label for="preco">R$ Preço:</label>
				         <input type="text" id="preco" required name="preco" class="form-control" placeholder="Ex. 1500" />
				         <br />
				         <input type="checkbox" id="product_ativo" name="product_ativo" value="s" > Mostrar Produto no Site
				         <br />
				         <input type="checkbox" id="show_preco" name="show_preco" value ="s" /> Mostrar Preço no Site				         
				         <br /><br />
				         <label for="">Adicionar foto:</label>
				         <input type="file" id="uploadimg" name="uploadimg" size="20"  />
				         
				         
					  	</div>
					  	<div class="col-lg-6">
					  		<label for="config">Configuração:</label><br />
				         <textarea name="config" required rows="10" id="config" placeholder="Um item por linha" class="form-control txt-add-product" style="font-size:12px"></textarea>
				         <br />
				         <label for="opc">Opcionais:</label><br />
				         <textarea name="opc" required id="opc" rows="6" placeholder="Um item por linha" style="font-size:12px" class="form-control txt-add-product"></textarea>
					  	</div>
					 </div>	
			    </div>
			    <div class="modal-footer">
			        <button type="submit" id="bt_add_prod" class="btn btn-primary">Cadastrar Produto</button>
			        </form>
			      </div>
			    </div>
			  </div>
			</div>
			<!-- fim modal add -->
			<p class="bt-add-produto"><button class="btn btn-primary" id="new_prod" data-toggle="modal" data-target="#box-add"><i class="fa fa-plus-square"></i> Cadastrar Novo Produto</button></p>
				  <div class="arrow-voltar">
				  	<a href="<?php echo site_url('admin'); ?>"><i class="fa fa-arrow-circle-left fa-2x" aria-hidden="true"></i><br />voltar</a>
				  </div>
		</div>
	</div>
</div>
<script>
	
	$(function(){

		//$("#product_ativo").attr('checked', true);

		// submite form e cadastra novo produto e 'upa' uma foto
		$('#form_add_prod').on('submit', function(e){  
           e.preventDefault(); 

           if($('#tipo').val() == 0){

           		toastr.error("Por favor, selecione o tipo de produto").css({'font-weight':'bold', 'font-size':'13px'});  
           }


           if($('#uploadimg').val() == '')  
           {  
                toastr.error("Por favor, insira uma foto do produto").css({'font-weight':'bold', 'font-size':'13px'});  
           }  
           else  
           {  


                $.ajax({  
                     url:"<?php echo site_url(); ?>products/upload",   
                     method:"POST",  
                     data:new FormData(this),  
                     contentType: false,  
                     cache: false,  
                     processData:false,  
                     success:function(data)  
                     {  
                     	if(data = "Produto cadastrado com sucesso!"){
	                 	  	toastr.success(data).css({'font-weight':'bold', 'font-size':'13px'});
	                      	$("#box-edit").modal("hide");
							setTimeout('location.reload();', 2000); 
						}
						else{
							toastr.error(data).css({'font-weight':'bold', 'font-size':'13px'});
	                      	$("#box-edit").modal("hide");
							setTimeout('location.reload();', 2000); 	
						}
                          $("#form_add_prod input textarea").empty(); // limpa os campos
							
                     }  
                });  
            }  
      	});

		// salva alteraçoes de um produto
      	$('#form_edit_prod').on('submit', function(e){  
           e.preventDefault(); 

           if($('#edit_tipo').val() == 0){

           		toastr.error("Por favor, selecione o tipo de produto").css({'font-weight':'bold', 'font-size':'13px'});
           		exit;
           } 
           
            $.ajax({  
                 url:"<?php echo site_url(); ?>products/edit_produto",   
                 method:"POST",  
                 data:new FormData(this),  
                 contentType: false,  
                 cache: false,  
                 processData:false,  
                 success:function(data)  
                 {  
                 	  if(data = "Alterações feita com sucesso!"){
                 	  	toastr.success(data).css({'font-weight':'bold', 'font-size':'13px'});
                      	$("#box-edit").modal("hide");
						setTimeout('location.reload();', 2000); 	
                 	  }
                 	  else{
                 	  	toastr.error(data).css({'font-weight':'bold', 'font-size':'13px'});
                 	  	setTimeout('location.reload();', 2000);
                 	  }
                 	  
                 }  
            });      
      	}); 


      	
	});

</script>