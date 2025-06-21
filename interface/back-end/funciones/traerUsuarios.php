<?php

$con = new conexion();
$pdo = $con->conectar();

try {
    $sql = "SELECT id, usuario, email, tipoUsuario, fecha_creacion FROM user";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$resultado = $stmt->fetchALL(PDO::FETCH_ASSOC);

} catch (PDOexception $e) {
    echo "Error en la consulta: " . $e->getMessage();
};

// print_r($resultado);
?>   