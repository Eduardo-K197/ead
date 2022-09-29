<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function enviar_email($destinatario, $assunto, $mensagemHTML, $nome_detino)
{

    require_once('vendor/phpmailer/phpmailer/src/PHPMailer.php');
    require_once('vendor/phpmailer/phpmailer/src/SMTP.php');
    require_once('vendor/phpmailer/phpmailer/src/Exception.php');
    require ('vendor/autoload.php');

    $phpmailer = new PHPMailer(true);
    $phpmailer->SMTPDebug = 0;
    $phpmailer->isSMTP();
    $phpmailer->Host = '$host';
    $phpmailer->SMTPAuth = true;
    $phpmailer->Username = '$user';
    $phpmailer->Password = '$password';
    $phpmailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $phpmailer->Port = 587;

    $phpmailer->setFrom('email', 'Eduardo');
    $phpmailer->addAddress($destinatario, $nome_detino);

    $phpmailer->isHTML(true);
    $phpmailer->Subject = $assunto;
    $phpmailer->Body = $mensagemHTML;
    $phpmailer->AltBody = 'Novo E-mail do sistema';

    if($phpmailer->send()) {
        return true;
    } else {
        return false;
    }

}
?>
