<?php

function verificarToken($id, $token)
{
    $db = Database::getInstance();
    $stmt = $db->prepare("SELECT * FROM users WHERE id = :id AND token = :token");
    $stmt->execute([':id' => $id, ':token' => $token]);

    if ($stmt->rowCount() > 0) {
        return true;
    }
    return false;
}
