<?php

$con = new conexion();
$pdo = $con->conectar();

$id = $_GET['id'];

try {
    $sql = "SELECT * FROM productos WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    

$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

// print_r($resultado);

} catch (PDOexception $e) {
    echo "Error en la consulta: " . $e->getMessage();
};

// print_r($resultado);
?>   