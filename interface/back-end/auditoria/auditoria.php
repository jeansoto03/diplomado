<?php
// auditoria.php

// Conexión a la base de datos (puedes incluir tu archivo de conexión aquí)
require_once '../conexion/conexion.php'; // Asegúrate de que esta ruta sea correcta

function registrarAuditoria($pdo, $usuario_id, $accion, $entidad, $detalles) {
    $sql = "INSERT INTO auditoria (usuario_id, accion, entidad, detalles) VALUES (:usuario_id, :accion, :entidad, :detalles)";
    $stmt = $pdo->prepare($sql);
    
    $stmt->execute([
        ':usuario_id' => $usuario_id,
        ':accion' => $accion,
        ':entidad' => $entidad,
        ':detalles' => $detalles
    ]);
}
?>