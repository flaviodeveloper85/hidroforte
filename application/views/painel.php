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
	<div class="row" >
		<div class="col-lg-4 painel-adm">
			
				<h1 class="title"><i class="fa fa-gears fa-2x"></i> PAINEL ADMINISTRATIVO</h1>	
			
		</div>
		<div class="col-lg-5 painel-adm boxes">
			<a href="<?php echo site_url("products/get_prod"); ?>">
			<div class="box-panel">
				<i class="fa fa-shopping-cart fa-2x"></i><br />
				PRODUTOS
			</div>
			</a>
			<a href="<?php echo site_url();?>mensagem/get_depoimentos">
			<div class="box-panel">
				<i class="fa fa-folder-open fa-2x"></i><br />
				MENSAGENS
			</div>
			</a>
			<a href="https://admin.jivosite.com/widgets">
			<div class="box-panel">
				<i class="fa fa-comments-o fa-2x"></i><br />
				CHAT
				
			</div>
			</a>
		</div>
		<div class="col-lg-3 painel-adm">
			<span id="box_notify" style="position:relative;top:50px;right:70px;font-size:11px;font-weight:bold;border:1px solid #9898b8; border-radius: 5px 5px;color:#9898b8; ;width:450px;padding:10px;background:#f3f3fb;"></span>
			<span style="text-align: center;position:relative;top:40px;cursor: pointer;"><a href="<?php echo site_url();?>login/kill_session"><i class="fa fa-close" title="Sair do Painel"></i></a></span>
		</div>
	</div>
</div>