<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailDiseno {

    public $email;     // destinatario
    public $nombre;

    public function __construct($email, $nombre)
    {
        $this->email = $email;
        $this->nombre = $nombre;

    }

    public function enviarConfirmacion() {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = $_ENV['EMAIL_HOST'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $_ENV['EMAIL_USER'];
            $mail->Password   = $_ENV['EMAIL_PASS'];

            // Ajusta esto según tu servidor:
            if ((int)$_ENV['EMAIL_PORT'] === 465) {
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            } else {
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            }
            $mail->Port = (int)$_ENV['EMAIL_PORT'];

            // El remitente debe pertenecer al dominio del SMTP
            $mail->setFrom($_ENV['EMAIL_FROM'] ?? $_ENV['EMAIL_USER'], 'MEGASTOCK S.A.');
            $mail->addAddress($this->email, $this->nombre);

            $mail->Subject = 'Turno editado';
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            $host = rtrim($_ENV['HOST'] ?? '', '/');
            $contenido  = '<html>';
            $contenido .= "<p><strong>Hola {$this->nombre},</strong> se editó el turno #{$this->email}.</p>";
            $contenido .= "<p>Ver detalle: <a href='{$host}/admin/turnoDiseno/ver?turno_id={$this->email}'>Abrir turno</a></p>";
            $contenido .= '</html>';

            $mail->Body    = $contenido;
            $mail->AltBody = "Se editó el turno #{$this->email}. Ver: {$host}/admin/turnoDiseno/ver?turno_id={$this->email}";

            $mail->SMTPDebug = 2; // o 3
        $mail->Debugoutput = 'error_log';
            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log('PHPMailer error: ' . $mail->ErrorInfo);
            throw $e;
        }

        
    }
}
