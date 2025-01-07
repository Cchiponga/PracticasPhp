<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../../Controlador/Alumno/comprobante_inscripcion.php' ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="../../Vista/Css/comprobanteInscripcion.css">
    <link rel="icon" type="image/x-icon" href="../../Vista/Imagenes/Logo.png">
    <title>Comprobante de Inscripción</title>
   
</head>
<body>
    <div id="comprobante-container">
        <header>
            <h1>Comprobante de Inscripción</h1>
        </header>
        <hr>
        <h2>Detalles del Alumno</h2>
        <p><strong>Nombre de Usuario:</strong> <?php echo htmlspecialchars($nombre_usuario); ?></p>
        <p><strong>Nombre:</strong> <?php echo htmlspecialchars($nombre); ?></p>
        <p><strong>Apellido:</strong> <?php echo htmlspecialchars($apellido); ?></p>
        <p><strong>Fecha:</strong> <?php echo $fecha; ?></p>
        
        <h2>Detalles de la Inscripción</h2>
        <table class="table table-striped">
            <tbody>
                <tr>
                    <td><strong>Práctica:</strong></td>
                    <td><?php echo htmlspecialchars($practica); ?></td>
                </tr>
                <tr>
                    <td><strong>Carrera:</strong></td>
                    <td><?php echo htmlspecialchars($carrera); ?></td>
                </tr>
                <tr>
                    <td><strong>Materia:</strong></td>
                    <td><?php echo htmlspecialchars($materia); ?></td>
                </tr>
                <tr>
                    <td><strong>Año:</strong></td>
                    <td><?php echo htmlspecialchars($ano); ?></td>
                </tr>
                <tr>
                    <td><strong>Fecha de Inscripción:</strong></td>
                    <td><?php echo htmlspecialchars($fecha_inscripcion); ?></td>
                </tr>
            </tbody>
        </table>

        <br>
        <div class="no-print">
            <button class="btn btn-primary" onclick="window.print()">Imprimir Comprobante</button>
            <a href="misInscripciones.php" class="btn btn-secondary">Volver a Mis Inscripciones</a>
        </div>
    </div>

    
</body>
</html>
