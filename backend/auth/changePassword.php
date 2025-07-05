<?php
require_once '../db/db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    cambiarPassword($_POST);
    exit;
}
function cambiarPassword($data)
{
    $id = $data['id'];
    $token = $data['token'];
    $password = $data['password'];
    $repassword = $data['repassword'];


    if (empty($id) || empty($token) || empty($password) || empty($repassword)) {
        header("location:../../changePassword.php?alert=No se indicó el correo&token=$token&id=$id");
        exit();
    }

    if ($password !== $repassword) {
        header("location:../../changePassword.php?alert=Las constraseñas no coinciden&token=$token&id=$id");
        exit();
    }

    try {
        $db = Database::getInstance();

        $db->beginTransaction();

        $clave_encriptada = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password = :password, token = NULL, password_request = 2 WHERE id = :id AND token = :token";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            'id' => $id,
            'token' => $token,
            'password' => $clave_encriptada
        ]);

        $db->commit();
        header("Location: ../../index.html?alert=Contraseña cambiada");
    } catch (PDOException $e) {
        if (isset($db) && $db->inTransaction()) {
            $db->rollBack();
        }
        header("Location: index.html?alert=Error en el sistema");
        exit();
    } finally {
        $db = null;
    }
}
