<?php
header('Content-Type: application/json');
error_reporting(0);
require_once '../db/db.php';

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Método no permitido', 405);
    }

    $data = json_decode(file_get_contents('php://input'), true);

    // Validación
    $requiredFields = ['rif', 'business_name', 'date', 'total', 'products'];
    foreach ($requiredFields as $field) {
        if (empty($data[$field])) {
            throw new Exception("Campo requerido faltante: $field", 400);
        }
    }

    // Validar estructura de productos
    if (!is_array($data['products']) || count($data['products']) === 0) {
        throw new Exception("Formato inválido para productos", 400);
    }

    $db = Database::getInstance();

    // Insertar en única tabla
    $stmt = $db->prepare("
        INSERT INTO invoices 
        (user_id, rif, business_name, date, total, products) 
        VALUES (:user_id, :rif, :business_name, :date, :total, :products)
    ");

    $stmt->execute([
        ':user_id' => $data['user_id'],
        ':rif' => $data['rif'],
        ':business_name' => $data['business_name'],
        ':date' => $data['date'],
        ':total' => $data['total'],
        ':products' => json_encode($data['products']) // Guardar como JSON
    ]);

    echo json_encode([
        'success' => true,
        'invoice_id' => $db->lastInsertId(),
        'message' => 'Pedido registrado exitosamente'
    ]);
} catch (PDOException $e) {
    error_log('Database Error: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error en base de datos']);
} catch (Exception $e) {
    http_response_code($e->getCode() ?: 400);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
