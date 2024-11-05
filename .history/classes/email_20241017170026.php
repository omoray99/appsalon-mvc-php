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
        $mail->addAddres('cuentas@appsalon.com', 'AppSalon.com');
        $mail->Subject = 'Confirma tu cuenta';


        $contenido = "<html>";
        $contenido .= "<p><strong>Hola" . $this->nombre . "</strong>  Has creado tu cuenta en App
        Salon, solo debes confirmarla presionando el siguiente enlace</p>";
        $contenido .= "<p> Presiona Aquí:  <a href='http://localhost:3000/confirmar-cuenta'?token=" . $this->token ."'> Confirmar Cuenta
        </a></p>"
    }
}