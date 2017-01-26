<?php 

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
		<div class="col-lg-6 painel-adm">
			<h1 class="title" id="panel-title"><i class="fa fa-gears fa-2x"></i> PAINEL ADMINISTRATIVO / <i class="fa fa-folder-open"></i> DEPOIMENTOS </h1>
		</div>
		<div class="col-lg-6" style="text-align: right;">
			<span id="box_notify" style="position:relative;top:70px;right:70px;font-size:11px;font-weight:bold;border:1px solid #9898b8; border-radius: 5px 5px;color:#9898b8; ;width:450px;padding:10px;background:#f3f3fb;"></span>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<ul class="nav nav-tabs">
				
				  <li class="active"><a data-toggle="tab" href="#home"><i class="fa fa-edit"></i> Depoimentos</a></li>
				</ul>
				
				<div class="tab-content">
				  <div id="dep" class="tab-pane fade in active">
				  <!-- checa se existe algum depoimento novo -->
				  <?php if($new_dep->num_rows() == 0): ?>
				  	
				  		<div style="text-align: center; font-size: 14px;font-weight: bold"><i class="fa fa-meh-o"></i> SEM NOVOS DEPOIMENTOS</div>
				  	<?php else: ?>
				   <?php foreach($depoimento->result() as $depoimentos): ?>
					    <div class="box-orc" id="<?php echo $depoimentos->id; ?>" style="display:<?php if($depoimentos->show == 's' || $depoimentos->show == 'n'){echo 'none';} ?>">
					    	<span class="bt-close-box" id="bt_close_box"><span class="date-dep"><?php echo date('d/m/Y H:i:s', strtotime($depoimentos->dt_hr));  ?></span> <a id="mostrar_dep" onclick="mostrar_dep(<?php echo $depoimentos->id; ?>);" title="Será exibido no site periodicamente"><i class="fa fa-star"></i> Mostrar no site</a> | <a id="n_mostrar_dep" onclick="hide_dep(<?php echo $depoimentos->id; ?>);" title="Não será exibido no site" ><i class="fa fa-times"></i> Não mostrar</a></span>
					    	<span class="dep-nome"><i class="fa fa-user fa-2x"></i> <?php echo $depoimentos->nome; ?> <?php echo $depoimentos->sobrenome; ?> </span>
					    	<ul class="dep-data">
					    		
					    		<li><?php echo $depoimentos->telefone; ?></li>
					    		<li><?php echo $depoimentos->email; ?></li>
					    		<li><?php echo $depoimentos->cidade; ?> / <?php echo $depoimentos->estado; ?></li>
					    		<li><?php echo '"'.$depoimentos->mensagem.'"'; ?> </li>
					    		
					    	</ul>
					    </div>
					    <!-- fim div box orc -->
				    <?php endforeach; ?>
					<?php endif; ?>
				  </div>
				  <div class="arrow-voltar">
				  	<a href="<?php echo site_url('admin'); ?>"><i class="fa fa-arrow-circle-left fa-2x" aria-hidden="true"></i><br />voltar</a>
				  </div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>



		// cadastra depoimento no banco para ser exibido no site
		function mostrar_dep(id){

			var dep = id;

			$.ajax({
              url: "<?php echo site_url(); ?>mensagem/show_depoimento",
              type: "POST",
              data: { id_dep: dep },
              dataType: "html",
              success: function(result){
              	  
                  if(result){

                  	// pega o box correspondente a que sera fechada
              	  	$('#<?php echo $depoimentos->id; ?>').hide();
                  	setTimeout(location.reload());
                  	
                  } 
              	} 
	        }); 
		}

		// cadastra apenas depoimento no banco sem exibir no site
		function hide_dep(id){

			var dep = id;

			$.ajax({
              url: "<?php echo site_url(); ?>mensagem/hide_depoimento",
              type: "POST",
              data: { id_dep: dep },
              dataType: "html",
              success: function(result){
              	  
                  if(result){

                  	// pega o box correspondente a que sera fechada
              	  	$('#<?php echo $depoimentos->id; ?>').hide();
                  	setTimeout(location.reload(), 100);
                  	
                  } 
              	} 
	        }); 
		}
			

</script>
