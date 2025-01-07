<?php
function conexion() {
    $host = "localhost";
    $db = "practica";
    $usr = "root";
    $pass = ""; // Sin contraseña

    // Crear una nueva conexión MySQLi
    $mysqli = new mysqli($host, $usr, $pass, $db);

    // Comprobar si hay algún error en la conexión
    if ($mysqli->connect_errno) {
        die("Fallo la conexion: " . $mysqli->connect_errno);
    }

    // Devolver la instancia mysqli si la conexión es exitosa
    return $mysqli;
}
?>
