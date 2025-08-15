<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailDiseno {

    public $email;     // destinatario
    public $nombre;
    public $codigo;
    public $detalle;
    public $fecha_creacion;
    public $fecha_entrega;
    public $estado;

    public function __construct($email, $nombre, $codigo, $detalle, $fecha_creacion, $fecha_entrega, $estado)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->codigo = $codigo;
        $this->detalle = $detalle;
        $this->fecha_creacion = $fecha_creacion;
        $this->fecha_entrega = $fecha_entrega;
        $this->estado = $estado;

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
            $contenido .= "<p><strong>HOLA TE SALUDA CLAUDIO. QUE TAL  {$this->nombre},</strong> SE EDITO EL TURNO #{$this->codigo}.</p>";
            $contenido .= "<p>DETALLE: {$this->detalle}</p>";
            $contenido .= "<p>FECHA DE CREACIÓN: {$this->fecha_creacion}</p>";
            $contenido .= "<p>FECHA DE ENTREGA: {$this->fecha_entrega}</p>";
            $contenido .= "<p>ESTADO: {$this->estado}</p>";
            $contenido .= '</html>';

            $mail->Body    = $contenido;
            $mail->AltBody = "Se editó el turno #{$this->codigo}. Ver: {$host}/admin/turnoDiseno/ver?turno_id={$this->codigo}";

            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log('PHPMailer error: ' . $mail->ErrorInfo);
            throw $e;
        }

        
    }
}
