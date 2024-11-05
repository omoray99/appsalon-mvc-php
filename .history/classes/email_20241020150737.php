<?php

namespace Classes;
use PHPMailer\PHPMailer\PHPMailer;


class Email {

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion(){

        // Crear el objeto de email

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '2de81388e4cc44';
        $mail->Password = 'fee023963b410f';    

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com');
        $mail->Subject = 'Confirma tu cuenta';

        // Set html
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';


        $contenido = "<html>";
        $contenido .= "<p><strong>Hola" . $this->email .  "</strong>  Has creado tu cuenta en App
        Salon, solo debes confirmarla presionando el siguiente enlace</p>";
        $contenido .= "<p> Presiona Aquí:  <a href='http://localhost:3000/confirmar-cuenta?token="
         . $this->token . "'> Confirmar Cuenta</a>";
        $contenido .= "<p> Si no solicitaste esta cuenta, puedes ignorar el mensaje </p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        // ENVIAR EL EMAIL

        $mail->send();
    }

    public function enviarInstrucciones(){

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '2de81388e4cc44';
        $mail->Password = 'fee023963b410f';    

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com');
        $mail->Subject = 'Restablece tu Password';

        // Set html
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';


        $contenido = "<html>";
        $contenido .= "<p><strong>Hola" . $this->nombre .  "</strong>  Has solicitado reetablecer tu 
        password, sigue el siguiente enlace para hacerlo</p>";
        $contenido .= "<p> Presiona Aquí:  <a href='http://localhost:3000/recuperar?token="
         . $this->token . "'> Confirmar Cuenta</a>";
        $contenido .= "<p> Si no solicitaste esta cuenta, puedes ignorar el mensaje </p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        // ENVIAR EL EMAIL

        $mail->send();

    }
}