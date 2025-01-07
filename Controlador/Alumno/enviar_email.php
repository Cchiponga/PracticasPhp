<?php
$conexion = mysqli_connect("localhost", "root", "", "practica") or die("Problemas con la conexión");
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dni = $_POST['dni']; // El DNI se ingresa como el nombre de usuario
    $correo = $_POST['correo']; // El correo ingresado por el usuario

    // Verificar si el usuario (DNI) existe y el correo corresponde
    $query = "SELECT * FROM usuarios WHERE Usuario = '$dni' AND Email = '$correo'";
    $resultado = mysqli_query($conexion, $query);

    if (mysqli_num_rows($resultado) > 0) {
        // Configurar el asunto y el mensaje del correo
        $asunto = 'Recuperación de contraseña';
        $mensaje = "Se ha solicitado la recuperación de su contraseña. Si no ha solicitado esto, por favor ignore este mensaje.";
        $headers = "From: tuemail@tudominio.com"; // Cambia esto por tu dirección de correo

        // Enviar el correo
        if (mail($correo, $asunto, $mensaje, $headers)) {
            echo 'Se ha enviado un mensaje a su correo para la recuperación de su contraseña.';
        } else {
            echo 'Error al enviar el mensaje.';
        }
    } else {
        echo 'El DNI o el correo no coinciden.';
    }
}
?>
