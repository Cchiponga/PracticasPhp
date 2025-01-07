<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumnos Inscriptos</title>
    <link rel="icon" type="image/x-icon" href="../../Vista/Imagenes/Logo.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        /* Font and base styles */
        html {
            font-size: 16px;
            box-sizing: border-box;
            height: 100%;
            margin: 0;
        }

        *, *::before, *::after {
            box-sizing: inherit;
        }

        /* Body general */
        .bodyPractica {    
            align-items: center;
            background-color: #d5d5d5; /* Mantengo el color de fondo original */
            background-image: url("../Imagenes/Logo.png");
            background-repeat: no-repeat;
            background-size: 12%;
            font-family: Arial;
        }

        /* Container y tabla */
        #containerTabla {
            width: 100%;
            background-color: #0A223D;
            padding: 20px;
            border-radius: 20px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        /* Tabla */
        .tabla {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: rgba(255, 255, 255, 0.1); /* Ligero contraste en las tablas */
            text-align: center;
        }

        .tabla th, .tabla td {
            padding: 10px;
            border: 1px solid white;
            color: white;
            text-align: center;
        }

        /* Estilo del scroll en la tabla */
        .tabla tbody {
            max-height: 300px;
            overflow-y: auto;
            background-color: #1A2E4A; /* Restaurado el color de fondo de la tabla */
        }

        /* Botones de acciones */
        .btn {
            border-radius: 5px;
            padding: 5px 10px;
            text-decoration: none;
        }

        .btn-primary {
            background-color: white;
            color: black;
        }

        .btn-primary:hover {
            background-color: green;
        }

        .btn-secondary {
            background-color: white;
            color: black;
        }

        .btn-secondary:hover {
            background-color: #d32f2f;
        }
    </style>

    <script src="../../Controlador/Profesor/JS/confirmarBorradoInscriptos.js"></script>
    <?php include '../../Controlador/Profesor/inscriptos.php' ?>
</head>
<body class="bodyPractica">
    <div class="container">
        <header>
            <h1 class="mt-4 mb-4">Alumnos Inscriptos en la Práctica</h1>
        </header>
        <br>
        <div id="containerTabla">
            <table class="tabla">
                <thead>
                    <tr>
                        <th>DNI</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Carrera</th>
                        <th>Materia</th>
                        <th>Fecha de Inscripción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($inscriptos)): ?>
                        <?php foreach ($inscriptos as $inscripto): ?>
                            <tr>
                                <td><?= $inscripto['DNI']; ?></td>
                                <td><?= $inscripto['Nombre']; ?></td>
                                <td><?= $inscripto['Apellido']; ?></td>
                                <td><?= $inscripto['Carrera']; ?></td>
                                <td><?= $inscripto['Materia']; ?></td>
                                <td><?= $inscripto['fechaInscripcion']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">No hay alumnos inscriptos en esta práctica.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

        </div>
        <form action="../../Controlador/Profesor/descargar_pdf_lista.php" method="post">
            <input type="hidden" name="idPractica" value="<?= $idPractica; ?>">
            <br>
            <button type="submit" class="btn btn-primary">Descargar PDF</button>
        </form>
        <br>
        <a class="btn btn-secondary" href="./listarPracticas.php" role="button">Volver a la lista de prácticas</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
