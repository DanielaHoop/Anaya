<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "db/Contacto.php";
require_once "PHPMailer_5.2.4/class.phpmailer.php";


$obj = new Contacto();
$obj->setNombre($_POST["nombre"]);
$obj->setEmail($_POST["email"]);
$obj->setAsunto($_POST["asunto"]);
$obj->setComentario($_POST["msj"]);
$obj->save();

//PHPMailer Object
$mail = new PHPMailer();
//From email address and name
$mail->From = "contacto@anaya-abogados.com";
$mail->FromName = "Anaya abogados";

//To address and name
$mail->addAddress("contacto@anaya-abogados.com");

//Send HTML or Plain Text email
$mail->isHTML(true);

$mail->Subject = "Nuevo contacto";
$mail->Body = "<i><strong>Nombre:</strong> {$obj->getNombre()}</i><br><i><strong>Email:</strong> {$obj->getEmail()}</i><br><i><strong>Asunto:</strong> {$obj->getAsunto()}</i><br><i><strong>Comentarios:</strong> {$obj->getComentario()}</i>";
$mail->AltBody = "";

/*if(!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}
else {
    echo "Message has been sent successfully";
}

die();*/

if(isset($_POST["lang"]) && $_POST["lang"]=="en"){
    header("Location: thankyou.html");
    die();
}

header("Location: gracias.html");
die();