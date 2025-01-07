<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar Correo</title>
    <link rel="icon" type="image/x-icon" href="../../Vista/Imagenes/Logo.png">
    <link rel="stylesheet" href="ruta_al_archivo_css.css"> <!-- Agrega tu archivo CSS -->
</head>
<body>
    <h2>Recuperar contraseña</h2>
    <form action="../../Controlador/Alumno/enviar_email.php" method="POST">
        <label for="correo">Ingrese su correo:</label>
        <input type="email" name="correo" id="correo" required placeholder="Ingrese su correo electrónico">
        <input type="hidden" name="dni" value="<?php echo $_GET['dni']; ?>">
        <button type="submit">Aceptar</button>
        <a href="login.php">Volver al login</a>
    </form>
</body>
</html>
