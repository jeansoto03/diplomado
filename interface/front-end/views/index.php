<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/alertas.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@100..800&display=swap" rel="stylesheet">


    <title>SISTEMA DE INVENTARIO</title>
</head>


<body>
<?php include_once '../components/alerts.php' ?>
    <form action="../../back-end/funciones/login.php" method="post" class="login__section">
        <div class="card__login">
            <h2>Bienvenido</h2>
            <img src="" alt="">
            <input type="email" name="email" placeholder="email">
            <input type="password" name="clave" placeholder="Contrase&ntilde;a">
            <a href="./views/dashboard.html">
                <button type="submit">
                    Iniciar Sesión
                </button>
            </a>
        </div>
    </form>

</body>

</html>