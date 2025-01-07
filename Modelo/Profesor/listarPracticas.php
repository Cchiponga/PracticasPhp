<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Prácticas</title>
    <link rel="icon" type="image/x-icon" href="../../Vista/Imagenes/Logo.png">
    <link rel="stylesheet" type="text/css" href="../../Vista/Css/listarPracticas.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <script src="../../Controlador/Profesor/JS/confirmarBorradoPractica.js"></script>
</head>    
        
<body class="bodyPractica">
    <div id="container">
        <header>
            <h1 class="titulo">Lista de Prácticas</h1>
        </header>
        <br> 
        <div class="botonera"> <!-- Contenedor de botones -->
            <a class="btnpractica" href="./altasPracticas.php" role="button">Nueva Práctica</a>
            <a class="btnvolver" href="../../Vista/html/indexProfesor.html" role="button">Volver</a>
        </div>       

        <table class="tablaAdmin">
            <tbody>
                <?php
                // Incluir la tabla generada por PHP
                include '../../Controlador/Profesor/listar_practica.php'; // Asegúrate de que esta ruta sea correcta
                ?>
            </tbody>
        </table>
        <br>
    </div>
</body>
</html>
