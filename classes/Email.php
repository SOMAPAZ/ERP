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
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('somapaz.zaca@gmail.com');
        $mail->addAddress('somapaz.zaca@gmail.com', 'somapaz-admin-services.xyz');
        $mail->Subject = 'Reestablecer password';

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p>Hola <strong>$this->nombre $this->apellido</strong> Tu correo ha sido confirmado. ";
        $contenido .= "Para reestablecer tu password, haz click en el siguiente enlace: ";
        $contenido .= "<a href='" . $_ENV['APP_URL'] . "/reestablecer-password?token=$this->token'>";
        $contenido .= "Click aquí para reestablecer tu password</a></p>";
        $contenido .= "<p>Si tú no seleccionaste esta cuenta puedes ignorar el mensaje</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        $mail->send();
    }
}
