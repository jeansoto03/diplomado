<?php
include_once '../conexion/conexion.php';

$con = new conexion();
$pdo = $con->conectar();

if (
    !empty($_POST["nombre"]) &&
    !empty($_POST["descripcion"]) &&
    !empty($_POST["precio"]) &&
    isset($_FILES["imagen"])  // Cambiado a $_FILES para manejar la subida
) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $imagen = $_FILES['imagen'];

    // Validar y procesar la imagen
    $permitidos = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $extension = strtolower(pathinfo($imagen['name'], PATHINFO_EXTENSION));
    
    // Verificar tipo de archivo
    if (!in_array($extension, $permitidos)) {
        header("location:../../front-end/views/dashboard.php?alert=5"); // Error: tipo de archivo no permitido
        exit;
    }
    
    // Verificar tamaño (máx 5MB)
    if ($imagen['size'] > 5000000) {
        header("location:../../front-end/views/dashboard.php?alert=6"); // Error: archivo muy grande
        exit;
    }

    // Crear directorio si no existe
    $directorio = "../../../img_Productos/";
    if (!is_dir($directorio)) {
        mkdir($directorio, 0777, true);
    }

    // Generar nombre único para la imagen
    $nombreImagen = uniqid() . '.' . $extension;
    $rutaCompleta = $directorio . $nombreImagen;
    $rutaBD = 'img_Productos/' . $nombreImagen; // Ruta para guardar en BD

    // Mover el archivo subido
    if (!move_uploaded_file($imagen['tmp_name'], $rutaCompleta)) {
        header("location:../../front-end/views/dashboard.php?alert=7"); // Error: subida fallida
        exit;
    }

    try {
        $pdo->beginTransaction();

        // Insertar producto con ruta de la imagen
        $sql_producto = "INSERT INTO productos (nombre, img, descripcion, precio) 
                         VALUES (:nombre, :img, :descripcion, :precio)";
        $stmt_producto = $pdo->prepare($sql_producto);
        $stmt_producto->execute([
            'nombre' => $nombre,
            'img' => $rutaBD,
            'descripcion' => $descripcion,
            'precio' => $precio
        ]);


        $pdo->commit();
        header("location:../../front-end/views/dashboard.php?alert=3"); // Éxito
        exit;
        
    } catch (Exception $e) {
        $pdo->rollBack();
        // Eliminar imagen si falla la transacción
        if (file_exists($rutaCompleta)) {
            unlink($rutaCompleta);
        }
        header("location:../../front-end/views/dashboard.php?alert=4"); // Error en BD
        exit;
    }
} else {
    header("location:../../front-end/views/dashboard.php?alert=1"); // Campos incompletos
    exit;
}