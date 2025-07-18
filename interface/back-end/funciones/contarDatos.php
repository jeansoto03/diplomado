<?php
// Llamar a la conexión

$con = new conexion();
$pdo = $con->conectar();

try {

    // Contar usuarios
    $sql_usuarios = "SELECT COUNT(*) AS total_usuarios FROM user";
    $stmt_usuarios = $pdo->prepare($sql_usuarios);
    $stmt_usuarios->execute();
    $total_usuarios = $stmt_usuarios->fetch(PDO::FETCH_ASSOC)['total_usuarios'];

     // Contar usuarios
    $sql_producto = "SELECT COUNT(*) AS total_productos FROM productos";
    $stmt_productos = $pdo->prepare($sql_producto);
    $stmt_productos->execute();
    $total_productos = $stmt_productos->fetch(PDO::FETCH_ASSOC)['total_productos'];

     // Contar usuarios
    $sql_factura = "SELECT COUNT(*) AS total_facturas FROM invoices";
    $stmt_facturas = $pdo->prepare($sql_factura);
    $stmt_facturas->execute();
    $total_facturas = $stmt_facturas->fetch(PDO::FETCH_ASSOC)['total_facturas'];

    // Mostrar resultados
    // echo "Total de productos: " . $total_productos . "<br>";
    // echo "Total de usuarios: " . $total_usuarios . "<br>";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} finally {
    // Cerrar la conexión
    $pdo = null;
}
