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
    $phpmailer->Host = 'email-smtp.sa-east-1.amazonaws.com';
    $phpmailer->SMTPAuth = true;
    $phpmailer->Username = 'AKIATGRH2AXZM3UINXMD';
    $phpmailer->Password = 'BOLYvaVZUNIKEmh+kxI/R2cbtLN0CCU0Xf/P0Khao8n8';
    $phpmailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $phpmailer->Port = 587;

    $phpmailer->setFrom('carloseduardobezerradasilva2@gmail.com', 'Eduardo');
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