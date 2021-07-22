<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require "src/Exception.php";
require "src/PHPMailer.php";
require "src/SMTP.php";
$email_user = "pedidosresidenciassi@gmail.com";
$email_password = "PEdiDOS.9731";
//$email_password = "PEdiDOS.973";
$the_subject = "Nuevo pedido de ". $_SESSION["sede"];
$address_to = "marcos_uran@hotmail.com";
$from_name = "Residencia: " . $_SESSION["sede"];
$phpmailer = new PHPMailer();
// ———- datos de la cuenta de Gmail ——————————-
$phpmailer->Username = $email_user;
$phpmailer->Password = $email_password; 
//———————————————————————–
// $phpmailer->SMTPDebug = 1;
// $phpmailer->SMTPSecure = 'ssl';
$phpmailer->Host = "smtp.gmail.com"; // GMail
// $phpmailer->Port = 465;
//agregado por mi linea de abajo
// $phpmailer->Mailer = "smtp";
$phpmailer->SMTPSecure = 'tls'; 
$phpmailer->Port = 587;
$phpmailer->IsSMTP(); // use SMTP
$phpmailer->SMTPAuth = true;
$phpmailer->setFrom($phpmailer->Username,$from_name);
$phpmailer->AddAddress($address_to); // recipients email
$phpmailer->Subject = $the_subject;	
$phpmailer->Body .=$_SESSION["pedidoMail"];
// $phpmailer->Body .= "<p>Mensaje personalizado</p>";
$phpmailer->Body .= "<p>Fecha y Hora: ".date("d-m-Y h:i:s")."</p>";
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
    echo "<script>location.href='errorMail.php';</script>";
    die;
}
if(!$phpmailer->send()) { 
    echo "<script>location.href='errorMail.php';</script>";
    die;
}
