<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');
// error_reporting(0);
require_once '../db/db.php';

register_shutdown_function(function () {
    $error = error_get_last();
    if ($error !== null) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Error fatal: ' . $error['message']]);
    }
});

require_once '../db/db.php';

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Método no permitido', 405);
    }

    $data = json_decode(file_get_contents('php://input'), true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception('Formato JSON inválido');
    }

    $email = trim(strtolower($data['email']));

    if (empty($email)) {
        throw new Exception('No se indicó el correo electrónico');
    }

    $db = Database::getInstance();
    $db->beginTransaction(); // <--- Agrega esto

    $stmt = $db->prepare("SELECT id FROM users WHERE email = :email");
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetchColumn();

    if ($user) {
        $token = solicitaPassword($user, $db);
        if ($token) {
            require_once './mailer.php';
            $mailer = new Mailer();
            $url = "http://localhost/diplomado/changePassword.php?token=$token&id=$user";
            $asunto = "Recuperar contraseña";
            $cuerpo = "Enlace para recuperar contraseña: <a href='$url'>Recuperar</a><br>Si no solicitaste esto, ignora este correo";

            if ($mailer->enviarEmail($email, $asunto, $cuerpo)) {
                $db->commit();
                if (ob_get_level()) {
                    ob_end_clean();
                }
                echo json_encode(['success' => true]);
            } else {
                $db->rollBack();
                if (ob_get_level()) {
                    ob_end_clean();
                }
                throw new Exception('error al enviar el correo electrónico');
            }
        } else {
            $db->rollBack();
            throw new Exception('Error al solicitar la contraseña');
        }
    } else {
        throw new Exception('Usuario no encontrado');
    }
} catch (PDOException $e) {
    error_log('Database Error: ' . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Error en el servidor']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}




function solicitaPassword($id, $pdo)
{
    try {
        $token = bin2hex(random_bytes(20));
        $sql = "UPDATE users SET token = :token, password_request = 1 WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id, 'token' => $token]);

        if ($stmt->rowCount() > 0) {
            return $token;
        }
        return false;
    } catch (PDOException $e) {
        error_log("Error en solicitaPassword: " . $e->getMessage());
        return false;
    }
}
