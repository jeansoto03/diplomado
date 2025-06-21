<?php

$con = new conexion();
$pdo = $con->conectar();

try {
    $sql = "SELECT id, name, email, fecha_creacion FROM users";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$resultado = $stmt->fetchALL(PDO::FETCH_ASSOC);

} catch (PDOexception $e) {
    echo "Error en la consulta: " . $e->getMessage();
};

// print_r($resultado);
?>   