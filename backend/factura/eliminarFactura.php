<?php
header('Content-Type: application/json');
error_reporting(0);
require_once '../db/db.php';

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Método no permitido', 405);
    }

    $db = Database::getInstance();

    // Obtener ID desde la URL
    if (!isset($_GET['id'])) {
        throw new Exception('ID de factura no proporcionado', 400);
    }
    $id = $_GET['id'];

    $db = Database::getInstance();

    // Query corregido (sin asterisco)
    $stmt = $db->prepare("DELETE FROM invoices WHERE id = :id");
    $stmt->execute([':id' => $id]);

    // Verificar si se eliminó algún registro
    if ($stmt->rowCount() === 0) {
        throw new Exception('La factura no existe', 404);
    }

    echo json_encode([
        'success' => true,
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
