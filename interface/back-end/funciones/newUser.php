<?php

// Llamo a la conexión
include_once '../conexion/conexion.php';

// Inicio una nueva conexión y ejecuto la función conectar()
$con = new conexion();
$pdo = $con->conectar();

// Guardar los valores que envío del formulario por el método POST en las variables
$usuario = $_POST['usuario'];
$email = $_POST['email'];
$clave = $_POST['clave'];
$reclave = $_POST['reclave'];
$tipoUsuario = $_POST['tipoUsuario'];
$usuario_id = 1; // Cambia esto por el ID real del usuario que está realizando la acción

// Verifico que la clave y la reclave sean iguales para verificar que el usuario sabe que clave está poniendo
if ($clave === $reclave) {
    try {
        // Verificar si el correo ya existe
        $sql_verificar = "SELECT COUNT(*) FROM user WHERE email = :email";
        $stmt_verificar = $pdo->prepare($sql_verificar);
        $stmt_verificar->execute(['email' => $email]);
        $existe = $stmt_verificar->fetchColumn();

        if ($existe > 0) {
            // Redirigir o mostrar mensaje de error si el correo ya existe
            header("location:../../front-end/views/newUser.php?alert=email_exists");
            exit();
        }

        // Encriptar la clave antes de guardarla en la base de datos
        $clave_encriptada = password_hash($clave, PASSWORD_DEFAULT);

        // Si el correo no existe, proceder con el registro
        $pdo->beginTransaction();
        
        $sql_producto = "INSERT INTO user (usuario, email, clave, tipoUsuario) VALUES (:usuario, :email, :clave, :tipoUsuario)";
        $stmt_producto = $pdo->prepare($sql_producto);
        $stmt_producto->execute([
            'usuario' => $usuario,
            'email' => $email,
            'clave' => $clave_encriptada,  // Guardar la clave encriptada
            'tipoUsuario' => $tipoUsuario
        ]);

       

        $pdo->commit();
        header("location:../../front-end/views/dashboard.php?alert=4");
    } catch (Exception $e) {
        $pdo->rollBack();
        echo "Error: " . $e->getMessage();
    }
} else {
    header("location:../../front-end/views/newUser.php?alert=password_mismatch");
}

?>