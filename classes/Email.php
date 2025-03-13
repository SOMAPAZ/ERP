<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{
    public $email;
    public $nombre;
    public $apellido;
    public $token;

    public function __construct(
        $email,
        $nombre,
        $apellido,
        $token  
    ) {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->token = $token;
    }

    public function enviarEmailInstruciones()
    {
        $mail = new PHPMailer();

        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('soapamz.tech@soapamz.xyz', 'Sistema Operador de Agua Potable y Alcantarillado del Municipio de Zacapoaxtla');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Reestablecer password';

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $template = file_get_contents(__DIR__ . '/../views/email/olvide-password.php');
        $template = str_replace('{{nombre}}', $this->nombre. ' ' . $this->apellido, $template);
        $template = str_replace('{{link}}', $_ENV['APP_URL'] . "/reestablecer-password?token=$this->token", $template);
        $mail->Body = $template;
        $mail->send();
    }
}
