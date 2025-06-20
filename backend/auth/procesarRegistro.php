<?php
header('Content-Type: application/json');
error_reporting(0);
require_once '../db/db.php';

try {
    // Verificar método POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Método no permitido', 405);
    }

    $data = json_decode(file_get_contents('php://input'), true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception('Formato JSON inválido');
    }
    // Validación
    if (empty($data['name']) || empty($data['email']) || empty($data['password'])) {
        throw new Exception('Todos los campos son requeridos');
    }

    $name = trim($data['name']);
    $email = trim(strtolower($data['email']));

    // Validar formato de email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Formato de email inválido');
    }

    // Validar contraseña
    if (strlen($data['password']) < 8) {
        throw new Exception('La contraseña debe tener al menos 8 caracteres');
    }

    // Generar hash seguro (esto SÍ está incluido)
    $password = password_hash($data['password'], PASSWORD_DEFAULT);

    $db = Database::getInstance();

    // Verificar email 
    $checkQuery = $db->prepare("SELECT email FROM users WHERE email = :email");
    $checkQuery->execute([':email' => $email]);

    if ($checkQuery->rowCount() > 0) {
        throw new Exception('El correo ya está registrado');
    }

    // Insertar usuario
    $insertQuery = $db->prepare("
        INSERT INTO users (name, email, password) 
        VALUES (:name, :email, :password)
    ");

    $insertQuery->execute([
        ':name' => $name,
        ':email' => $email,
        ':password' => $password
    ]);

    echo json_encode([
        'success' => true,
        'message' => 'Registro exitoso'
    ]);
} catch (PDOException $e) {
    error_log('Database Error: ' . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Error en el servidor']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
