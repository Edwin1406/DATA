<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class EmailDiseno {

    public $email;
    public $nombre;
    public $turno_id;

    public function __construct($email, $nombre, $turno_id)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->turno_id = $turno_id;
    }

    public function enviarConfirmacion() {

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
         $mail->addAddress($this->email, $this->nombre);
         $mail->Subject = 'Confirma tu Cuenta';

         // Set HTML
         $mail->isHTML(TRUE);
         $mail->CharSet = 'UTF-8';

         $contenido = '<html>';
         $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong>Se realizó un nuevo registro en el sistema.</p>";
         $contenido .= "<p>Presiona aquí: <a href='" . $_ENV['HOST'] . "/confirmar-cuenta?turno_id=" . $this->turno_id . "'>Confirmar Cuenta</a>";
         $contenido .= "<p>Si tu no creaste esta cuenta; puedes ignorar el mensaje</p>";
         $contenido .= '</html>';
         $mail->Body = $contenido;

         //Enviar el mail
         $mail->send();

    }

}