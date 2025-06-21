<?php
include_once '../conexion/conexion.php';

$con = new conexion();
$pdo = $con->conectar();

// Verificar que todos los campos requeridos están presentes
if (
    !empty($_POST['id']) &&
    !empty($_POST['nombre']) &&
    !empty($_POST['descripcion']) &&
    !empty($_POST['precio']) &&
    !empty($_POST['imagen_actual'])
) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $imagen_actual = $_POST['imagen_actual'];
    $nueva_imagen = $imagen_actual; // Por defecto, mantenemos la imagen actual

    // Procesar imagen si se subió una nueva
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $imagen = $_FILES['imagen'];

        // Validar tipo de imagen
        $permitidos = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $extension = strtolower(pathinfo($imagen['name'], PATHINFO_EXTENSION));

        if (!in_array($extension, $permitidos)) {
            header("location:../../front-end/views/productos.php?alert=5"); // Tipo de archivo no permitido
            exit;
        }

        // Verificar tamaño (máx 5MB)
        if ($imagen['size'] > 5000000) {
            header("location:../../front-end/views/productos.php?alert=6"); // Archivo muy grande
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
        if (move_uploaded_file($imagen['tmp_name'], $rutaCompleta)) {
            // Eliminar la imagen anterior si existe
            if (file_exists("../../../" . $imagen_actual)) {
                unlink("../../../" . $imagen_actual);
            }
            $nueva_imagen = $rutaBD;
        } else {
            header("location:../../front-end/views/productos.php?alert=7"); // Error al subir archivo
            exit;
        }
    }

    try {
        $pdo->beginTransaction();

        // Actualizar el producto
        $sql_producto = "UPDATE productos SET 
                        nombre = :nombre, 
                        img = :img, 
                        descripcion = :descripcion, 
                        precio = :precio
                        WHERE id = :id";

        $stmt_producto = $pdo->prepare($sql_producto);
        $stmt_producto->execute([
            'nombre' => $nombre,
            'img' => $nueva_imagen,
            'descripcion' => $descripcion,
            'precio' => $precio,
            'id' => $id
        ]);



        $pdo->commit();
        header("location:../../front-end/views/productos.php?alert=3"); // Éxito
        exit;
    } catch (Exception $e) {
        $pdo->rollBack();
        // Eliminar imagen nueva si falla la transacción
        if (isset($rutaCompleta) && file_exists($rutaCompleta)) {
            unlink($rutaCompleta);
        }
        header("location:../../front-end/views/productos.php?alert=4"); // Error en BD
        exit;
    }
} else {
    header("location:../../front-end/views/productos.php?alert=1"); // Campos incompletos
    exit;
}
