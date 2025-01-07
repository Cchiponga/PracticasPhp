<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
    <link rel="stylesheet" href="ruta_al_archivo_css.css"> <!-- Agrega tu archivo CSS -->
</head>
<body>
    <h2>Restablecer Contraseña</h2>
    <form action="../../Controlador/Alumno/procesar_reset_password.php" method="POST">
        <label for="nueva_contraseña">Ingrese nueva contraseña:</label>
        <input type="password" name="nueva_contraseña" id="nueva_contraseña" required>
        <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
        <button type="submit">Restablecer</button>
        <a href="login.php">Volver al login</a>
    </form>
</body>
</html>
