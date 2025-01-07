<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="../../Vista/Imagenes/Logo.png">
    <link rel="stylesheet" type="text/css" href="../../Vista/Css/modeloAlumno.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>ISFT 182 - Mis Inscripciones</title>
</head>
<header class="header">
    <div class="contact-info">
        <span><i class="fa fa-envelope"></i> <a href="mailto:182informes@gmail.com">182informes@gmail.com</a></span>
        <span><i class="fa fa-map-marker"></i> <a href="https://www.google.com/maps">Ruta 8 y Avellaneda - San Miguel</a></span>
    </div>
    <br>
    <div class="social-media">
        <a href="https://www.facebook.com/isft182" target="_blank"><i class="fab fa-facebook"></i></a>
        <a href="https://www.instagram.com/isft_182" target="_blank"><i class="fab fa-instagram"></i></a>
        <a href="https://www.youtube.com/user/Biblioteca182" target="_blank"><i class="fab fa-youtube"></i></a>
        <a href="https://www.linkedin.com/company/isft182" target="_blank"><i class="fab fa-linkedin"></i></a>
    </div>
</header>

<a href="./perfilAlumno.php" class="btnperfil" role="button">MI PERFIL</a>
<a href="../../Vista/html/indexAlumno.html" class="btnvolver" role="button">Volver</a>

<body class="bodyPractica">
    <?php 
        session_start();
        $id_usuario = $_SESSION['ID_Usuario'] ?? null;

        if (!$id_usuario) {
            header("Location: ../../Vista/html/indexAlumno.html");
            exit();
        }
    ?>
    <div id="container">
        <h1>Mis Inscripciones</h1>       

        <?php 
        require_once $_SERVER['DOCUMENT_ROOT'] . '/ProyectoPracticas3.2.0/Controlador/Admin/PHP/conexion.php';
        $conexion=conexion();

        $consulta = "SELECT i.ID_Inscripcion, p.Practica, c.Carrera, m.Materia, a.Año, i.fechaInscripcion 
                     FROM inscripcion i 
                     JOIN practicas p ON i.ID_Practica = p.ID_Practica
                     JOIN carreras c ON i.ID_Carrera = c.ID_Carrera
                     JOIN materias m ON i.ID_Materias = m.ID_Materias
                     JOIN año a ON i.ID_Año = a.ID_Año
                     WHERE i.ID_Usuario = $id_usuario";

        $resultado = mysqli_query($conexion, $consulta) or die("Problemas en el select: " . mysqli_error($conexion));

        if (mysqli_num_rows($resultado) > 0) {
            echo '<table class="tabla">
                    <tr>
                        <th>Práctica</th>
                        <th>Carrera</th>
                        <th>Materia</th>
                        <th>Año</th>
                        <th>Fecha Inscripción</th>
                        <th></th>
                        <th></th>
                    </tr>';

            while ($fila = mysqli_fetch_array($resultado)) {
                $id_inscripcion = htmlspecialchars($fila['ID_Inscripcion']);
                echo '<tr>
                        <td>' . htmlspecialchars($fila['Practica']) . '</td>
                        <td>' . htmlspecialchars($fila['Carrera']) . '</td>
                        <td>' . htmlspecialchars($fila['Materia']) . '</td>
                        <td>' . htmlspecialchars($fila['Año']) . '</td>
                        <td>' . htmlspecialchars($fila['fechaInscripcion']) . '</td>
                        <td>
                            <a href="#" class="btnbaja" onclick="confirmarBaja(' . $id_inscripcion . ')">Darme de baja</a>
                        </td>
                        <td>
                            <a href="comprobanteInscripcion.php?id=' . $id_inscripcion . '" class="btncomprobante">Ver Comprobante</a>
                        </td>
                      </tr>';
            }

            echo '</table>';
        } else {
            echo "<p>No tienes inscripciones registradas.</p>";
        }

        mysqli_close($conexion);
        ?>
    </div>

    <script>
        function confirmarBaja(id_inscripcion) {
            if (confirm("¿Estás seguro que te quieres dar de baja?")) {
                // Redirige a la página de baja con el ID de inscripción
                window.location.href = "../../Controlador/Alumno/baja.php?id=" + id_inscripcion;
            }
        }
    </script>
</body>
</html>

