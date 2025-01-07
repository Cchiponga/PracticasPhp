<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../../Vista/Imagenes/Logo.png">
    <link rel="stylesheet" type="text/css" href="../../Vista/Css/crearCarrera.css">
    <title>Isft 182 - Crear Carreras</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Crear Nueva Carrera</title>
</head>
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
<body class="bodyPractica">
    

    <!-- Mostrar mensaje de éxito o error, si existe -->
    <?php if (isset($_GET['mensaje'])): ?>
        <p style="color: green;"><?php echo htmlspecialchars($_GET['mensaje']); ?></p>
    <?php endif; ?>

    <form action="../../Controlador/Admin/PHP/crear_carrera.php" method="POST">
        <h1>Crear Nueva Carrera</h1>
        <label for="nombreCarrera">Nombre de la Carrera:</label>
        <input type="text" id="nombreCarrera" name="nombreCarrera" required><br>
        
        <h3>Materias de la Carrera</h3>
        <div id="materiasContainer">
            <div class="materia">
                <label>Materia 1:</label>
                <input type="text" name="materias[]" required>
                <!-- Botón para quitar la materia -->
                <button type="button" onclick="quitarMateria(this)">Quitar</button>
            </div>
        </div>
        <button type="button" onclick="agregarMateria()">Agregar Materia</button><br>
        
        <button type="submit" name="crearCarrera">Crear Carrera</button>
    </form>

    <script>
        // Función para agregar más campos de materias
        function agregarMateria() {
            var container = document.getElementById("materiasContainer");
            var numMaterias = container.getElementsByClassName("materia").length + 1;
            var div = document.createElement("div");
            div.classList.add("materia");
            div.innerHTML = `<label>Materia ${numMaterias}:</label>
                             <input type="text" name="materias[]" required>
                             <button type="button" onclick="quitarMateria(this)">Quitar</button>`;
            container.appendChild(div);
        }

        // Función para quitar una materia
        function quitarMateria(button) {
            var container = document.getElementById("materiasContainer");
            if (container.getElementsByClassName("materia").length > 1) {
                // Eliminar el contenedor de la materia
                var materiaDiv = button.parentNode;
                container.removeChild(materiaDiv);
                
                // Actualizar los labels de las materias restantes
                var materias = container.getElementsByClassName("materia");
                for (var i = 0; i < materias.length; i++) {
                    materias[i].getElementsByTagName("label")[0].innerText = `Materia ${i + 1}:`;
                }
            } else {
                alert("Debe haber al menos una materia en la carrera.");
            }
        }
    </script>
    <a href="./carreras.php" class="btnvolver" role="button">Volver</a>
</body>
</html>
