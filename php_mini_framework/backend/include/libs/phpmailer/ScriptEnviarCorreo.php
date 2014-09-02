<?php
require_once ("class.phpmailer.php");
require_once ("class.smtp.php");

function mailer($data,$type){ //$Destinatario,$Asunto,$Body){
	switch($type){

		case 1: //Enviar email del estudiante al docente			
			$Body = $data['msg'].
				   "<h1>Detalles del Estudiante</h1>".$data['extra']; 
		break;

		/*case 1:{	//Registro al sistema
			$Asunto = "Registro al Evento - AGUA2013";
			$Body = "Sr/Sra ".$extra.":<br>Se ha registrado satisfactoriamente al evento Agua2013 ....";			
			break;
		} //termina case 1
		case 2:{ //correo para Admin
			$Asunto = "Sistema de Registro - Agua2013 : Usuario registrado";
			$Body = "Un nuevo usuario se ha registrado en la plataforma: <br><br>
					<h1>Detalles del usuario:</h1><br>
					".$extra."";
			break;
		} //termina case 2
		case 3:{ //correo para notificar a admin que se subió correctamente el comprobante
			$Asunto = "Sistema de Registro - Agua2013 : Comprobante Enviado";
			$Body = "El usuario con identificación ".$extra." ha adjuntado a su registro el comprobante de pago, favor verificar y confirmar en la plataforma.";
			break;
		} 
		case 4:
			$Asunto = "Pago realizado al Evento - AGUA2013";
			$Body = $extra;
		break;*/
		
	} //Termina Switch
	
	//Manda mensaje.
	form_mail(0,0,0,$data['to'],$data['to'],$Body,$data['subject']);
	//form_mail(0,0,0,$Destinatario,$Destinatario,$Body,$Asunto);
}

function form_mail($sFromMail,$sFromMailPassword,$sFromName,$sToMail,$sCopyMail,$TextoMail,$Asunto){


	$sFromMail = "noreply.imcy@gmail.com";
	$sFromMailPassword = "imcynoreply2013yumbo";
	$sFromName = "Estudiante IMCY Plataforma Docentes";
/*
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

	$mail->Subject =  $Asunto;//$_POST['subject'];		//ASUNTO
	$mail->AltBody = $_POST['altbody']; // optional, comment out and test

	$Texto = eregi_replace("[\]","",$TextoMail);
	
	$mail->MsgHTML($Texto);
	$mail->Send();*/
	
	$mail = new PHPMailer();		
	$mail->IsSMTP(); 
	
	$Texto = eregi_replace("[\]","",$TextoMail);
	$mail->AddReplyTo($sFromMail, $sFromName);
	$mail->SetFrom($sFromMail, $sFromName);
	$mail->AddReplyTo($sFromMail, $sFromName);
	$mail->AddAddress($sToMail,'Sr.');
	$mail->Subject = $Asunto;
	$mail->AltBody = 'To view the message, please use an HTML compatible email';

	$mail->MsgHTML($Texto);
	$mail->Send();
}
?>