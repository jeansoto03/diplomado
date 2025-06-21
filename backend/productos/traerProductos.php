<?php
header('Content-Type: application/json');
require_once '../db/db.php';

// Activar visualización de errores (solo para desarrollo)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        throw new Exception('Método no permitido', 405);
    }

    $db = Database::getInstance();
    
    // Consulta para obtener productos activos
    $stmt = $db->prepare("
        SELECT id, nombre, descripcion, precio, img
        FROM productos 
        ORDER BY nombre
    ");
    
    $stmt->execute();
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($productos as &$producto) {
        $producto['precio'] = number_format($producto['precio'], 2, ',', '.');
    }
    
    echo json_encode([
        'success' => true,
        'productos' => $productos
    ]);

} catch(PDOException $e) {
    // Mostrar el error real para diagnóstico
    echo json_encode([
        'success' => false,
        'message' => 'Error en la base de datos',
        'error_details' => $e->getMessage()  // Solo para desarrollo
    ]);
} catch(Exception $e) {
    http_response_code($e->getCode());
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>