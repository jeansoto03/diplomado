<?php
require_once '../conexion/conexion.php';
require_once '../auditoria/auditoria.php'; 

$con = new conexion();
$pdo = $con->conectar();

$id = $_GET['id_delete'];
$usuario_id = 1; // Cambia esto por el ID real del usuario que está realizando la acción

try {
    // Primero, obtenemos los datos del producto que se va a eliminar
    $sql = "SELECT * FROM productos WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    $producto = $stmt->fetch(PDO::FETCH_ASSOC);

    // Ahora procedemos a eliminar el producto
    $sql = "DELETE FROM productos WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);

    // Registrar la acción de auditoría
   

    header("location:../../front-end/views/dashboard.php?alert=producto_eliminado");

} catch (PDOException $e) {
    echo "Error en la consulta: " . $e->getMessage();
}
?>