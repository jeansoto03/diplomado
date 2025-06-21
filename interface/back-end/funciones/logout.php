<?php
// llamo a la conexion
require_once '../conexion/conexion.php';

// borro las variables de sesion
session_start();
$_SESSION = array();
session_destroy();

// redireccion al inicio de sesion con una alerta en la url
header('Location: ../../front-end/views/index.php?alert=2');
?>