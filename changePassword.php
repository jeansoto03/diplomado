<?php
require_once './backend/db/db.php';
require_once './backend/auth/verificarToken.php';

$id = $_GET['id'] ?? $_POST['id'] ?? '';
$token = $_GET['token'] ?? $_POST['token'] ?? '';

if ($id == '' || $token == '') {
    header("location: index.html?alert=Informacion invalida");
    exit;
}

if (!verificarToken($id, $token)) {
    header("location: index.html?alert=Token inválido");
    exit;
    }
    
    // print_r(verificarToken($id, $token));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/modals.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <title>Celis-Horse</title>
</head>
<style>
    
</style>
<body>

    

    <div class="ubicacionRegistro">
        <div class="IniciarSesion">
            <h2 class="recuperarTitulo">Recuperar contraseña</h2>
            <form class="row g-3" action="./backend/auth/changePassword.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="token" value="<?php echo $token; ?>">
                <div class="col-md-12">
                    <label for="inputAddress" class="form-label">Nueva contraseña</label>
                    <input type="text" name="password" class="form-control" id="password" required>
                </div>
                <div class="col-md-12">
                    <label for="inputAddress" class="form-label">Confirmar Nueva contraseña</label>
                    <input type="text" name="repassword" class="form-control" id="repassword" required>
                </div>
                <div class="d-grid gap-2 col-6 mx-auto">
                    <button type="submit" class="btn btn-primary">Continuar</button>
                </div>
            </form>
            
        </div>
    </div>

    

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>

</html>