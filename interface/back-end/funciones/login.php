<?php

// llamo a la conexion
include_once '../conexion/conexion.php';

// inicio una nueva conexion y ejecuto la funcion conectar()
$con = new conexion();
$pdo = $con->conectar();

$email = $_POST['email'];
$clave = $_POST['clave'];

try {
    // Buscar al usuario solo por el correo
    $sql = "SELECT * FROM user WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);

    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($resultado && password_verify($clave, $resultado['clave'])) {
        // Si la contraseña es correcta, iniciar sesión
        session_start();
        $_SESSION['id'] = $resultado['id'];
        $_SESSION['name'] = $resultado['usuario'];
        $_SESSION['email'] = $resultado['email'];
        $_SESSION['rol'] = $resultado['tipoUsuario'];
        
        header('location:../../front-end/views/dashboard.php');
        exit();
    } else {
        // Redirigir si el usuario no existe o la contraseña es incorrecta
        header("location:../../front-end/views/index.php?alert=1");
        exit();
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
