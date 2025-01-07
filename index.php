<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="icon" type="image/x-icon" href="./Vista/Imagenes/Logo.png">
   <link rel="stylesheet" type="text/css" href="./Vista/Css/index.css">
   <title>Isft 182</title>
   <!-- Add Font Awesome for icons -->
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

<body class="bodyIndex">

<a href="https://isft182-bue.infd.edu.ar/sitio/" target="_blank" class="logo-link">
    <img src="./Vista/Imagenes/Logo.png" alt="Logo">
</a>

<?php 
   include './Controlador/controladorLogin.php'; 
?>

<div id="form">
    <div id="titulo">
        <h1 class="TituloIndex">Bienvenido</h1>
    </div>
    <div id="input">
        <form action="" method="post">
            <div id="inputIndex">
                <input id="usuario" class="inputIndex" type="text" name="usuario" placeholder="Ingrese Usuario">
                <input type="password" id="input" class="inputIndex" name="contraseña" placeholder="Ingrese Contraseña">
            </div>
            <div id="boton"> 
                <input type="submit" name="login" class="btnIngresar" value="Ingresar">
            </div>
            <br>
            <p>Create una cuenta acá: <a class="register" href="./Modelo/signUp.php">Registrarse</a></p>
           
        </form>
    </div>
</div>

</body>
</html>
