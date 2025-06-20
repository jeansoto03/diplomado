<?php
header('Content-Type: application/json');
error_reporting(0);
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
    $password = $data['password'];

    if (empty($email) || empty($password)) {
        throw new Exception('Todos los campos son requeridos');
    }

    $db = Database::getInstance();
    
    // Buscar usuario
    $stmt = $db->prepare("SELECT id, name, email, password FROM users WHERE email = :email");
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user || !password_verify($password, $user['password'])) {
        throw new Exception('Credenciales inválidas');
    }

    // Eliminar password del response
    unset($user['password']);
    
    $response = [
        'success' => true,
        'user' => $user,
        ];

    echo json_encode($response);

} catch(PDOException $e) {
    error_log('Database Error: ' . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Error en el servidor']);
} catch(Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>