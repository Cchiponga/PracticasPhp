<?php
$conexion = mysqli_connect("localhost", "root", "", "practica") or die("Problemas con la conexión");
session_start();

if (isset($_POST['dni'])) {
    $dni = trim($_POST['dni']);

    if ($dni === '') {
        echo "El campo DNI está vacío";
    } else {
        // Consulta para verificar si el número de DNI (que es el nombre de usuario) existe en la tabla 'usuarios'
        $sql = mysqli_query($conexion, "SELECT * FROM usuarios WHERE Usuario = '$dni'"); // Se verifica el campo Usuario
        $row = mysqli_num_rows($sql);

        if ($row == 1) {
            $usuario = mysqli_fetch_array($sql);
            $_SESSION['dni'] = $dni; // Guarda el DNI en la sesión para usarlo en los próximos pasos
            header("Location: ingresar_correo.php?dni=$dni"); // Pasa el DNI como parámetro
            exit(); // Es buena práctica usar exit después de header
        } else {
            echo "El DNI no está registrado";
        }
    }
}
?>
