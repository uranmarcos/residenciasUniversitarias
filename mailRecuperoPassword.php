<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require "src/Exception.php";
require "src/PHPMailer.php";
require "src/SMTP.php";
$email_user = "pedidosresidenciassi@gmail.com";
$email_password = "PEdiDOS.9731";
$the_subject = "Recupero de contraseña";
$address_to = "marcos_uran@hotmail.com";
//$address_to = "manuel@fundacionsi.org.ar";
$from_name = "Fundación Sí - Pedidos";
$phpmailer = new PHPMailer();
// ———- datos de la cuenta de Gmail ——————————-
$phpmailer->Username = $email_user;
$phpmailer->Password = $email_password; 
//———————————————————————–
$phpmailer->Host = "smtp.gmail.com"; // GMail
$phpmailer->SMTPSecure = 'tls'; 
$phpmailer->CharSet = 'UTF-8';
$phpmailer->Port = 587;
$phpmailer->IsSMTP(); // use SMTP
$phpmailer->SMTPAuth = true;
$phpmailer->setFrom($phpmailer->Username,$from_name);
$phpmailer->AddAddress($address_to); // recipients email
$phpmailer->Subject = $the_subject;	
$phpmailer->Body .="<p>Recibimos una solicitud de recuperación de contraseña. Si no lo hiciste, desestimá este mail.</p>";
$phpmailer->Body .="<p>Si necesitás hacerlo ingresá al siguiente link: http://localhost/proyectos/SiPedidos/residenciasuniversitarias/recuperar.php</p>";
$phpmailer->Body .="<p>Tu código de validación es: " . $token . " y expira a las: " . $horaExpired;
$phpmailer->IsHTML(true);
try {
    $phpmailer->smtpConnect([
            'ssl' => [
                 'verify_peer' => false,
                 'verify_peer_name' => false,
                 'allow_self_signed' => true
             ]
         ]);
} catch (\Throwable $th) {
    setcookie("errorRecuperar", TRUE, time() + (1000), "/");
    echo "<script>location.href='recuperar.php';</script>";
    die;
}
if(!$phpmailer->send()) { 
    setcookie("errorRecuperar", TRUE, time() + (1000), "/");
    echo "<script>location.href='recuperar.php';</script>";
    die;
}
