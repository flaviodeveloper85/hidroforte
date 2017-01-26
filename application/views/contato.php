<div class="container-fluid contato">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 formulario">
				<h1 class="title"><i class="fa fa-edit fa-2x"></i> FALE CONOSCO OU SOLICITE SEU ORÇAMENTO!</h1>
				<form id="form_contato">
					<div class="col-lg-6">
						<label for="nome">Nome:</label>
						<input type="text" required id="nome" tabindex="1" name="nome" placeholder="Primeiro Nome" class="form-control" />
						<br />
						<label for="email">Email:</label>
						<input type="email" id="email" required tabindex="3" name="email" placeholder="Email Válido" class="form-control" />
						<br />
						<label for="tipo_msg">Tipo de Mensagem:</label>
						<select name="tipo_msg" id="tipo_msg" required class="form-control" tabindex="5">
							<option value="0">Selecione o tipo de mensagem</option>
							<option value="orc">Orçamento</option>
							<option value="dep">Depoimento</option>
						</select>
						<br />
						<label for="cidade">Cidade:</label>
						<input type="text" id="cidade" name="cidade" required tabindex="6" placeholder="Sua cidade" class="form-control" />
						<br />
						<label for="estado">Estado:</label>
						<select name="estado" id="estado" class="form-control" required tabindex="7">
							<option value="0">Selecione o Estado</option>
							<option value="AC">Acre</option>
							<option value="AL">Alagoas</option>
							<option value="AP">Amapá</option>
							<option value="AM">Amazonas</option>
							<option value="BA">Bahia</option>
							<option value="CE">Ceará</option>
							<option value="DF">Distrito Federal</option>
							<option value="ES">Espiríto Santo</option>
							<option value="GO">Goiás</option>
							<option value="MA">Maranhão</option>
							<option value="MT">Mato Grosso</option>
							<option value="MS">Mato Grosso do Sul</option>
							<option value="MG">Minas Gerais</option>
							<option value="PA">Pará</option>
							<option value="PB">Paraíba</option>
							<option value="PR">Paraná</option>
							<option value="PE">Pernambuco</option>
							<option value="PI">Piauí</option>
							<option value="RJ">Rio de Janeiro</option>
							<option value="RN">Rio Grande do Norte</option>
							<option value="RS">Rio Grande do Sul</option>
							<option value="RO">Rondônia</option>
							<option value="RR">Roraima</option>
							<option value="SC">Santa Catarina</option>
							<option value="SP">São Paulo</option>
							<option value="SE">Sergipe</option>
							<option value="TO">Tocantins</option>
						</select>
					</div>
					<div class="col-lg-6">
						<label for="sobrenome">Sobrenome:</label>
						<input type="text" id="sobrenome" tabindex="2" required name="sobrenome" placeholder="Segundo Nome" class="form-control" />
						<br />
						<label for="phone">Telefone:</label>
						<input type="phone" id="phone" name="phone" required tabindex="4" placeholder="Telefone" class="form-control" />
						<br />
						<label for="contato_msg">Deixe sua mensagem:</label>
						<textarea name="contato_msg" id="contato_msg" required rows="10" tabindex="8" class="form-control" placeholder="Para orçamento, informe o produto"></textarea>
						<p class="hidro-news"><input type="checkbox" id="check_news" value="s" name="check_news" tabindex="9" /> Desejo receber novidades da Hidro Forte</p>
						<input type="submit" name="bt_envia_contato" id="bt_envia_contato" value="Enviar mensagem" class="btn btn-primary" />
					</div>
				</form>	
			</div>
		</div>
	</div>
</div>
<script>
	
	$(function(){

		// envia form contato
		$('#form_contato').on('submit', function(e){
			
			if($('#tipo_msg').val() == '0'){
				toastr.error('Por favor, selecione o tipo de mensagem');
				return false;
			}
			else if($('#estado').val() == '0'){
				toastr.error('Por favor, selecione o Estado');
				return false;
			}
			else{

				if($('#tipo_msg').val() == 'orc'){

					$.ajax({  
					     url:"<?php echo site_url(); ?>envia_mail/envia_mail.php",   
					     method:"POST",  
					     data:new FormData(this),  
					     contentType: false,  
					     cache: false,  
					     processData:false,  

					});	

				}

				e.preventDefault();

				// se o campo tipo de msg for depoimento entao eh gravado no banco senao eh enviado um email pois eh orçamento

				$.ajax({  
				     url:"<?php echo site_url(); ?>mensagem/envia_mensagem",   
				     method:"POST",  
				     data:new FormData(this),  
				     contentType: false,  
				     cache: false,  
				     processData:false,  
				     success:function(data)  
				     {  
				     	  if(data == "Mensagem enviada com Sucesso!"){
								
								toastr.success(data).css({'font-weight':'bold', 'font-size':'13px'}); 
								$('#form_contato').trigger('reset');
								
							}
							else{

								toastr.error(data).css({'font-weight':'bold', 'font-size':'13px'});		
							}
				     	  
				     }  
				});
			}
			
			
			
		}); 	

			
		$('#phone').mask('(99)9999-9999');
	})

	
</script>

