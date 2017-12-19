<?php
require_once __DIR__ . "/vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    protected $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.mail.ru';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'lsphp@mail.ru';
        $this->mail->Password = 'qwe123qwe123';
        $this->mail->SMTPSecure = 'ssl';
        $this->mail->Port = 465;
        $this->mail->setFrom('lsphp@mail.ru', 'Бургер');
        $this->mail->CharSet = 'Utf-8';
    }

    public function setMessage($to, $subject, $message)
    {
        $this->mail->isHTML(true);
        $this->mail->addAddress($to);
        $this->mail->Subject = $subject;
        $this->mail->Body = $message;
        $this->mail->AltBody = "Ваш почтовый клиент не поддерживает html.";
    }

    public function setAttachment($path)
    {
        $this->mail->addAttachment($path);
    }

    public function send()
    {
        $this->mail->send();
    }
}

$mailer = new Mailer();
$mailer->setMessage('pitasam@yandex.ru', 'Ваш заказ', '<h1>Ваш заказ:</h1> <p style="color: red">Бургер за 500р. Спасибо за заказ</p>');
$mailer->send();
