<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="../Vista/Imagenes/Logo.png">
    <link rel="stylesheet" type="text/css" href="../Vista/Css/signUp.css">
    <title>Registrarse</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ProyectoPracticas3.2.0/Controlador/Admin/PHP/conexion.php';
    $conexion=conexion();
include("../Controlador/controladorRegistro.php");
?>

<div class='container'>
    
        <h1>Registrarse</h1>     
         <center><form action="" method="POST" id="registrationForm">
            <div class="inputs">
                <label>Ingrese su DNI (será su usuario)</label><br>
                <input type="text" class="input" name="DNI" placeholder="DNI" required><br>
                <input type="password" class="input" name="contraseña" placeholder="Contraseña" required><br>
                <input type="text" class="input" name="Apellido" placeholder="Apellido" required><br>
                <input type="text" class="input" name="Nombre" placeholder="Nombre" required><br>

                <label>Fecha de Nacimiento:</label><br>
                <input type="date" class="input" name="FechaNacimiento" id="fechaNacimiento" required><br>

                <input type="text" class="input" name="Email" placeholder="Email" required><br>
                <input type="text" class="input" name="Telefono" placeholder="Teléfono" required><br>


                <div class="rowGenero">
                    <label>Género:</label>
                    <div>
                        <label>
                            Masculino<input type="radio" name="Genero" value=1 required> 
                        </label>
                        <label>
                            Femenino<input type="radio" name="Genero" value=2 required> 
                        </label>
                        <label>
                            Otro<input type="radio" name="Genero" value=3 required>
                        </label>
                    </div>                   
                </div>

                <div class="listaCarrera">
                    <label for="Carrera">Seleccionar Carreras:</label><br>
                    <?php
                    require_once $_SERVER['DOCUMENT_ROOT'] . '/ProyectoPracticas3.2.0/Controlador/Admin/PHP/conexion.php';
                    $conexion = conexion();
                    session_start();
                    $carreras = mysqli_query($conexion, "SELECT * FROM carreras");
                    while ($c = mysqli_fetch_array($carreras)) {
                        echo "{$c['Carrera']}<input type='checkbox' name='carrera[]' value='{$c['ID_Carrera']}'><br>";
                    }
                    ?>
                </div>
                <br>
            </div>
        <div class="rowBotones">
            <div class="boton">
                <button type="submit"  value="Registrarse" class="btnRegistrarse" name="registrarse">Registrarme</button>
                <button class="btnVolverLogin" onclick="document.location.href='../index.php'">Volver al Login</button>
            </div>
        </div>        
            
</div>

<script src="../Controlador/validacionSignUp.js"></script>
</body>
</html>
