<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../../Vista/Css/perfilUsuario.css">
    <link rel="icon" type="image/x-icon" href="../../Vista/Imagenes/Logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrarse</title>
</head>
<body>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ProyectoPracticas3.2.0/Controlador/Admin/PHP/conexion.php';
$conexion=conexion();
include("../../Controlador/Admin/PHP/crear_alumno.php");
?>
<div class="container">
    <h2>Registrarse</h2>

    <div id="input">
        <form action="" method="POST" id="registrationForm">
            <div class="inputs">
                <label>Ingrese su DNI (será su usuario)</label><br>
                <input type="text" class="input" name="DNI" placeholder="DNI" required><br>
                <input type="password" class="input" name="contraseña" placeholder="Contraseña" required><br>
                <input type="text" class="input" name="Apellido" placeholder="Apellido" required><br>
                <input type="text" class="input" name="Nombre" placeholder="Nombre" required><br>

                <label class="fecha">Fecha de Nacimiento</label>
                <input type="date" id="fechaNacimiento" name="fecha_nacimiento" required>

                <input type="text" class="input" name="Email" placeholder="Email" required><br>
                <input type="text" class="input" name="Telefono" placeholder="Teléfono" required><br>

                <div class="rowGenero">
                    <label>Género:</label>
                    <div>
                        <label>Masculino:<br><input type="radio" name="Genero" value="1" required> </label>
                    </div>
                    <div>
                        <label>Femenino:<br><input type="radio" name="Genero" value="2" required></label>
                    </div>
                    <div>
                        <label>Otro:<br><input type="radio" name="Genero" value="3" required> </label>
                    </div>
                </div>
                <div class="listaCarrera">
                    <label for="Carrera">Seleccionar Carreras</label><br>
                    <?php
                    $conexion = mysqli_connect("localhost", "root", "", "practica") or die("Problemas con la conexión");
                    $carreras = mysqli_query($conexion, "SELECT * FROM carreras");
                    while ($c = mysqli_fetch_array($carreras)) {
                        echo "<div class='checkbox-container'>";
                        echo "<label for='carrera{$c['ID_Carrera']}'>{$c['Carrera']}</label>";
                        echo "<input type='checkbox' id='carrera{$c['ID_Carrera']}' name='carrera[]' value='{$c['ID_Carrera']}'>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>

            <div class="btnact">
                <input type="submit" value="Registrarse" name="registrarse">
                <br>
            </div>
        </form>
    </div>

    <br>
    <div class="btn">
        <p><a href="./menuAlumnosAdmin.php">Volver al Login</a></p>
    </div>
</div>

<!-- Se incluye el archivo validacionSignUp.js para la validación -->
<script src="../../Controlador/validacionSignUp.js"></script>

</body>
</html>
