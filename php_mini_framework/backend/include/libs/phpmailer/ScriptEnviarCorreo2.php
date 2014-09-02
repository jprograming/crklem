<?php
require_once ("class.phpmailer.php");

function form_mail($sFromMail,$sFromMailPassword,$sFromName,$sToMail,$sCopyMail,$TextoMail){
	//Generamos nueva clave
	$mail = new PHPMailer();		
	$mail->IsSMTP();                           // tell the class to use SMTP
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->Port       = 465;                    // set the SMTP server port
	$mail->Host       = "ssl://smtp.gmail.com"; // SMTP server
	$mail->Username   = $sFromMail;     // SMTP server username
	$mail->Password   = $sFromMailPassword;            // SMTP server password
	
	$mail->From     = $sFromMail;
	$mail->FromName = $sFromName;
		
	$mail->AddAddress($sToMail);
	$mail->AddBCC($sCopyMail);

	$mail->Subject = $_POST['subject'];		
	$mail->AltBody = $_POST['altbody']; // optional, comment out and test

	$Texto = eregi_replace("[\]","",$TextoMail);
	$mail->MsgHTML($Texto);
	$mail->Send();
}
?>