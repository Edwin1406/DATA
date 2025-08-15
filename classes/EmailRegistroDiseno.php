<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class EmailRegistroDiseno {

    public $emaildefault;
    public $nombre;
    public $token;
    public $estado;


    public function __construct($emaildefault, $nombre, $token, $estado)
    {
        $this->emaildefault = $emaildefault;
        $this->nombre = $nombre;
        $this->token = $token;
        $this->estado = $estado;
    }

    public function enviarConfirmacion2() {

         // create a new object
         $mail = new PHPMailer();
         $mail->isSMTP();
         $mail->Host = $_ENV['EMAIL_HOST'];
         $mail->SMTPAuth = true;
         $mail->Port = $_ENV['EMAIL_PORT'];
         $mail->Username = $_ENV['EMAIL_USER'];
         $mail->Password = $_ENV['EMAIL_PASS'];
         $mail->SMTPSecure = 'ssl';

     
         $mail->setFrom('sistemas@logmegaecuador.com', 'MEGASTOCK S.A.');
         $mail->addAddress($this->emaildefault, $this->nombre);
         $mail->Subject = 'Confirma tu Cuenta';

         // Set HTML
         $mail->isHTML(TRUE);
         $mail->CharSet = 'UTF-8';

         $contenido = '<html>';
         $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong> haz hecho un registro de un diseño que el estado es " . $this->estado . "</p>";
         $contenido .= "<p>Tu codigo de diseño es: <strong>" . $this->token . "</strong></p>";
            // fecha de creacion
         $contenido .= "<p>Fecha de creación: <strong>" . date('Y-m-d H:i:s') . "</strong></p>";
         $contenido .= "<p>Si tu no creaste esta cuenta; puedes ignorar el mensaje</p>";
         $contenido .= '</html>';
         $mail->Body = $contenido;

         //Enviar el mail
         $mail->send();

    }

}