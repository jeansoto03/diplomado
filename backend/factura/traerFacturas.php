<?php
header('Content-Type: application/json');
require_once '../db/db.php';

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        throw new Exception('Método no permitido', 405);
    }

    if (!isset($_GET['user_id'])) {
        throw new Exception('Parámetro user_id requerido', 400);
    }

    $user_id = filter_var($_GET['user_id'], FILTER_VALIDATE_INT);
    if (!$user_id) {
        throw new Exception('user_id inválido', 400);
    }

    $db = Database::getInstance();
    
    $stmt = $db->prepare("
        SELECT id, rif, business_name, date, total, products 
        FROM invoices 
        WHERE user_id = :user_id 
        ORDER BY date DESC
    ");
    
    $stmt->execute([':user_id' => $user_id]);
    $facturas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode([
        'success' => true,
        'facturas' => $facturas
    ]);

} catch(PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error en base de datos']);
} catch(Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>