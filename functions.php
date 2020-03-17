<?php
use Mainclass\Models\Rol;
use Mainclass\Models\Usuario;
use Mainclass\Models\Indumentaria;
use Mainclass\Models\Tipo;


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require getcwd().'/vendor/phpmailer/phpmailer/src/Exception.php';
require getcwd().'/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require getcwd().'/vendor/phpmailer/phpmailer/src/SMTP.php';

function traducirRol($id){
	$rol = new Rol();
	$rol = $rol->find($id);
	return $rol->nombre;
}	
function traducirUsuario($id){
	$usuario = new Usuario();
	$usuario = $usuario->find($id);
	return $usuario->nombre;
}
function traducirIndumentaria($id){
	$indumentaria = new Indumentaria();
	$indumentaria = $indumentaria->find($id);
	return $indumentaria->nombre;
}	
function traducirTipo($id){
	$tipo = new Tipo();
	$tipo = $tipo->find($id);
	return $tipo->nombre;
}	

function traducirMes($mes){
	switch ($mes) {
		case '1':
			return "Enero";
		break;
		case '2':
			return "Febrero";
		break;
		case '3':
			return "Marzo";
		break;
		case '4':
			return "Abril";
		break;
		case '5':
			return "Mayo";
		break;
		case '6':
			return "Junio";
		break;
		case '7':
			return "Julio";
		break;
		case '8':
			return "Agosto";
		break;
		case '9':
			return "Septiembre";
		break;
		case '10':
			return "Octubre";
		break;
		case '11':
			return "Noviembre";
		break;
		case '12å':
			return "Diciembre";
		break;
	}
}	

function cropAlign($image, $cropWidth, $cropHeight, $horizontalAlign = 'center', $verticalAlign = 'middle') {
	$width = imagesx($image);
	$height = imagesy($image);
	$horizontalAlignPixels = calculatePixelsForAlign($width, $cropWidth, $horizontalAlign);
	$verticalAlignPixels = calculatePixelsForAlign($height, $cropHeight, $verticalAlign);
	return imageCrop($image, [
		'x' => $horizontalAlignPixels[0],
		'y' => $verticalAlignPixels[0],
		'width' => $horizontalAlignPixels[1],
		'height' => $verticalAlignPixels[1]
	]);
}

function calculatePixelsForAlign($imageSize, $cropSize, $align) {
	switch ($align) {
		case 'left':
		case 'top':
		return [0, min($cropSize, $imageSize)];
		case 'right':
		case 'bottom':
		return [max(0, $imageSize - $cropSize), min($cropSize, $imageSize)];
		case 'center':
		case 'middle':
		return [
			max(0, floor(($imageSize / 2) - ($cropSize / 2))),
			min($cropSize, $imageSize),
		];
		default: return [0, $imageSize];
	}
}


function enviarCorreo($id_usuario, $subject ,$html){


	$mail = new PHPMailer();
	$mail->IsSMTP();

	$mail->SMTPDebug  = 0;  
	$mail->SMTPAuth   = TRUE;
	$mail->SMTPSecure = "tls";
	$mail->Port       = 587;
	$mail->Host       = "mail.taktikdata.com";
	$mail->Username   = "jose.becerra@taktikdata.com";
	$mail->Password   = ("JsBcrr/11");

	$mail->IsHTML(true);
	$mail->AddAddress("jbecerraromero@gmail.com", "Pepe Becerra");
	$mail->SetFrom("jose.becerra@taktikdata.com", "Pepe Becerra");
	$mail->Subject = $subject;
	$content = $html;

	$mail->MsgHTML($content); 
	if(!$mail->Send()) {
		echo "Error while sending Email.";
		echo "<pre>";
		var_dump($mail);
	} else {
		echo "Email sent successfully";
	}
}
