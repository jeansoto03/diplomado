<?php

// require_once '../conexion/conexion.php';


$con = new conexion();
$pdo = $con->conectar();

try {
    $sql = "SELECT id, img, nombre, descripcion, precio, fecha_creacion FROM productos";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Mostrar productos para prueba (puedes adaptarlo según tu frontend)

    // print_r($productos);

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} finally {
    // Cierra la conexión explícitamente
    $pdo = null;
}
