<?php

use PHPMailer\PHPMailer\{PHPMailer, SMTP, Exception};


class Mailer {
    function enviarEmail($email, $asunto, $cuerpo) {
        require_once '../config/config.php'; 
        require __DIR__ . '/../phpmailer/src/PHPMailer.php';
        require __DIR__ . '/../phpmailer/src/SMTP.php';
        require __DIR__ . '/../phpmailer/src/Exception.php';

        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Debug (eliminar después)
            $mail->isSMTP();
            $mail->Host       = MAIL_HOST;
            $mail->SMTPAuth   = true;
            $mail->Username   = MAIL_USER;
            $mail->Password   = MAIL_PASS;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Clave
            $mail->Port       = MAIL_PORT;

            // Configuración SSL para testing
            $mail->SMTPOptions = [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                ]
            ];

            $mail->setFrom(MAIL_USER, 'PartyColor');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = $asunto;
            $mail->Body = $cuerpo;
            $mail->setLanguage('es', '../phpmailer/language/phpmailer.lang-es.php');

            return $mail->send();

        } catch (Exception $e) {
            error_log("Error al enviar correo: " . $mail->ErrorInfo);
            return false;
        }
    }
}

?>