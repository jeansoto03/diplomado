<?php
// include_once '../conexion/conexion.php';

$con = new conexion();
$pdo = $con->conectar();

try {
    // Consulta SQL para obtener facturas con el correo del usuario
    $sql = "SELECT f.id, f.user_id, f.rif, f.business_name, f.date, f.total, f.products, f.created_at, u.email
            FROM invoices f
            INNER JOIN users u ON f.user_id = u.id
            ORDER BY f.created_at DESC";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $facturas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    
} catch (Exception $e) {
    echo "<div class='notification is-danger'>Error al obtener las facturas: " . $e->getMessage() . "</div>";
    exit;
}
?>