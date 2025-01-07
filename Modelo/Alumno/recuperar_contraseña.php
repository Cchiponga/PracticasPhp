<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="ruta_al_archivo_css.css"> <!-- Agrega tu archivo CSS -->
</head>
<body>
    <h2>Recuperar contraseña</h2>
    <form action="../../Controlador/Alumno/verificar_dni.php" method="POST">
        <label for="dni">Ingrese DNI:</label>
        <input type="text" name="dni" id="dni" required placeholder="Ingrese su DNI">
        <button type="submit">Aceptar</button>
        <a href="login.php">Volver al login</a>
    </form>
</body>
</html>
