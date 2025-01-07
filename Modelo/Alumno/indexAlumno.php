<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="../../Vista/Imagenes/Logo.png">
    <link rel="stylesheet" type="text/css" href="../../Vista/Css/modeloAlumno.css">
    <title>Isft 182 - Inscripcion</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<?php 
    session_start();
$id_usuario = $_SESSION['ID_Usuario'] ?? null;
?>
<header class="header">
            <div class="contact-info">
            <span><i class="fa fa-envelope"></i> <a href="mailto:182informes@gmail.com">182informes@gmail.com</a></span>
            <span><i class="fa fa-map-marker"></i> <a href="https://www.google.com/maps/dir/ISFT+N%C2%B0182,+Campo+de+Mayo,+Buenos+Aires,+Argentina/ISFT+N%C2%B0182,+Campo+de+Mayo,+Buenos+Aires,+Argentina/@-34.5345495,-58.7764882,12z/data=!3m1!4b1!4m13!4m12!1m5!1m1!1s0x95bcbd1d06cd9eb7:0x8f675b6edd434507!2m2!1d-58.6940863!2d-34.5347186!1m5!1m1!1s0x95bcbd1d06cd9eb7:0x8f675b6edd434507!2m2!1d-58.6940863!2d-34.5347186?entry=ttu&g_ep=EgoyMDI0MDkyNS4wIKXMDSoASAFQAw%3D%3D">Ruta 8 y Avellaneda - San Miguel</a></span>
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
    <div id="container">
        <header>
            <h1>Isft 182 - Inscripción a prácticas</h1>
        </header>
        

        <?php 
        // Mostrar mensaje si existe
        if (isset($_GET['mensaje'])) {
            echo '<div id="myModal" class="modal">
                    <div class="modal-content">
                        <p>' . htmlspecialchars($_GET['mensaje']) . '</p>
                        <button class="close" onclick="closeModal()">Aceptar</button>
                    </div>
                  </div>';
        }
        ?>
        
        <table class="tabla">
            <tr>
                <th>Práctica</th>
                <th>Nombre y Apellido</th>                 
                <th>Lugar</th>
                <th>Horario</th>
                <th>Día Prácticas</th>
                <th>Observación</th>
                <th>Vacantes</th>
                <th>Carrera</th> 
                <th>Fecha de Apertura</th>
                <th>Inscribirse</th>
            </tr>

            <?php 
            include '../../Controlador/Alumno/index_alumno.php'; 
            // Este archivo se encarga de generar las filas con los datos de la tabla
            ?>
        </table>


    </div>
    <script>
        // Mostrar el modal automáticamente si existe un mensaje
        document.addEventListener("DOMContentLoaded", function() {
            var modal = document.getElementById("myModal");
            if (modal) {
                modal.style.display = "block";
            }
        });

        // Cerrar el modal al hacer clic en el botón Aceptar
        function closeModal() {
            var modal = document.getElementById("myModal");
            if (modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>
