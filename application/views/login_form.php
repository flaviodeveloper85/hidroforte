<div class="container-fluid login">
	<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-1 col-xs-1"></div>
		<div class="col-lg-4 col-md-4 col-sm-10 col-xs-10">
			
			<div class="box-login">
				<img src="<?php echo base_url(); ?>img/login.png" width="50" height="50" />
				<span class="area-restrita">Area Restrita</span>
				<?php echo form_open('login/verificar_login'); ?>
					<label class="lab-login" for="username">Usuário<br />
					<input type="text" class="form-control" name="username" id="username" /></label><br /><br />
					<label class="lab-login" for="pass">Senha<br />
					<input type="password" class="form-control"  name="pass" id="pass" /><br />
					<button type="submit" class="btn btn-primary" name=""><i class="fa fa-lock"></i> Entrar</button>	<br /><br />
				<?php echo form_close(); ?>

				<?php if(isset($msg_neg)){ echo "<p style='color:red;text-align:center'>- $msg_neg -</p>";} ?>
					
			</div>
			<span style="position: absolute; top:365px; left:169px; color:white; font-size: 10px"><i class="fa fa-copyright"></i> Hidro Forte <?php echo date('Y'); ?></span>
			
		</div>
		<div class="col-lg-4 col-md-4 col-sm-1 col-xs-1"></div>
		
	</div>
</div>