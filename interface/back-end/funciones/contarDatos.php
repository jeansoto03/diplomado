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

    // Mostrar resultados
    // echo "Total de productos: " . $total_productos . "<br>";
    // echo "Total de usuarios: " . $total_usuarios . "<br>";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} finally {
    // Cerrar la conexión
    $pdo = null;
}
