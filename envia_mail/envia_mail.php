<?php
	
 
/* abaixo as veriaveis principais, que devem conter em seu formulario*/
$nome 	 	   = ucfirst($_POST["nome"]);
$sobrenome 	   = ucfirst($_POST["sobrenome"]);
$mail 	 	   = $_POST["email"];
$phone  	   = $_POST["phone"];
$cidade 	   = ucwords($_POST["cidade"]);
$uf 	   	   = $_POST["estado"];
$msg 	   	   = $_POST["contato_msg"];
$datahr = date('d/m/Y H:i:s'); 

// constroi o html do pedido de orçamento com div
$message = "<div style='width:750px;font-family:verdana;font-size:13px;line-height:22px'>";
$message .= "<img src='https://hidroforte.com.br/hhh/img/header_orc.jpg'/><br />";
$message .= "<ul style='list-style:none'>";
$message .= "<li style='font-size:18px;font-family:verdana; font-weight:bold'>".$nome." ".$sobrenome."</li>";
$message .= "<li>".$datahr."</li>";
$message .= "<li>".$phone."</li>";
$message .= "<li>".$mail."</li>";
$message .= "<li>".$cidade." / ".$uf."</li>";
$message .= "<li style='font-size:13px;font-family:verdana;font-weight:bold'>".'"'.$msg.'"'."</li>";
$message .= "</ul>";
$message .= "</div>";

 
/*********************************** A PARTIR DAQUI NAO ALTERAR ************************************/ 
 

require_once('../PHPMailer-master/class.phpmailer.php');
require_once('../PHPMailer-master/PHPMailerAutoload.php');

 
$mail = new PHPMailer();
 
$mail->IsMail();
$mail->SMTPAuth  = true;
$mail->Charset   = 'utf8_decode()';
$mail->Host  = 'smtp.hidroforte.com.br';
$mail->Port  = '587';
$mail->Username  = 'user@user.com.br';
$mail->Password  = '****';
$mail->From = "contato@hidroforte.com.br"; // Seu e-mail
$mail->FromName  = utf8_decode("** $nome - Pedido de Orçamento **");
$mail->IsHTML(true);
$mail->Subject  = utf8_decode('Pedido de Orçamento');
$mail->Body  = utf8_decode($message);
$mail->AddAddress("contato@hidroforte.com.br", "hidro forte");


 
if($mail->Send()){

	$mensagemRetorno = 'Formulário enviado com sucesso!';

}else{

	$mensagemRetorno = 'Erro ao enviar formulário: '. print($mail->ErrorInfo);
} 
 echo $mensagemRetorno; 

?>
 