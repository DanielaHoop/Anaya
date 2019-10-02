<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "db/Contacto.php";
require_once "PHPMailer_5.2.4/class.phpmailer.php";
require_once "recaptchalib.php";


// your secret key
$secret = "6Lc0kbsUAAAAAP_S-s5gy4MA_wt4NPnHjTjd31pi";
// empty response
$response = null;
// check secret key
$reCaptcha = new ReCaptcha($secret);

// if submitted check response
if ($_POST["g-recaptcha-response"]) {
    $response = $reCaptcha->verifyResponse(
        $_SERVER["REMOTE_ADDR"],
        $_POST["g-recaptcha-response"]
    );
}

if ($response == null || !$response->success) {
    die("completa el captcha");
}

$obj = new Contacto();
$obj->setNombre($_POST["nombre"]);
$obj->setEmail($_POST["email"]);
$obj->setAsunto($_POST["asunto"]);
$obj->setComentario($_POST["msj"]);
$obj->save();

//PHPMailer Object
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPDebug = 2;
$mail->SMTPAuth = true;
$mail->SMTPAutoTLS = true;
$mail->Host = "smtpout.secureserver.net";
$mail->Username = "contacto@anaya-abogados.com";
$mail->Password = "cont@2019@AA";
$mail->Port = 80;

//From email address and name
$mail->From = "contacto@anaya-abogados.com";
$mail->FromName = "Anaya abogados";

//To address and name
$mail->addAddress("contacto@anaya-abogados.com");
//$mail->addAddress("jrmurillom@gmail.com");

//Send HTML or Plain Text email
$mail->isHTML(true);

$mail->Subject = "Nuevo contacto";
$mail->Body = "<i><strong>Nombre:</strong> {$obj->getNombre()}</i><br><i><strong>Email:</strong> {$obj->getEmail()}</i><br><i><strong>Asunto:</strong> {$obj->getAsunto()}</i><br><i><strong>Comentarios:</strong> {$obj->getComentario()}</i>";
$mail->AltBody = "";

if(!$mail->send()) {
    //echo "Mailer Error: " . $mail->ErrorInfo;
}
else {
    //echo "Message has been sent successfully";
}


if(isset($_POST["lang"]) && $_POST["lang"]=="en"){
    header("Location: thankyou.html");
    die();
}

header("Location: gracias.html");
die();