<?php

// creamos la clase conexion
class conexion
{
// definimos parametros
    private $hostname = "localhost";
    private $database = "partycolor";
    private $username = "root";
    private $password = "";
    private $charset = "utf8";

    // funcion para la conexion de la base de datos
    function conectar()
    {
        try {
            $conexion = "mysql:host=" . $this->hostname . ";dbname=" . $this->database . "; charset=" . $this->charset;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false
            ];

            $pdo = new PDO($conexion, $this->username, $this->password, $options);

            return $pdo;
        } catch (PDOException $e) {
            echo "Error conexion: " . $e->getMessage();
            exit;
        }
    }
}
