<?php
session_start();

if (!isset($_SESSION['ID_Usuario'])) {
    echo "<script language='JavaScript'>
            alert('Debe iniciar sesión para acceder a esta página');
            location.assign('../../Modelo/Alumno/login.php');
          </script>";
    exit();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/ProyectoPracticas3.2.0/Controlador/Admin/PHP/conexion.php';
$conexion = conexion();

$idUsuario = $_SESSION['ID_Usuario'];
$mensaje = '';

if (isset($_POST['enviar'])) {
    $dni = trim($_POST['dni']);
    $apellido = trim($_POST['apellido']);
    $nombre = trim($_POST['nombre']);
    $fechaNacimiento = $_POST['fechaNacimiento'];
    $genero = $_POST['genero'];
    $telefono = trim($_POST['telefono']);

    if (empty($dni) || empty($apellido) || empty($nombre) || empty($fechaNacimiento) || empty($genero) || empty($telefono)) {
        $mensaje = 'Todos los campos deben estar completos.';
    } elseif ($dni == '0' || $telefono == '0' || $genero == '0') {
        $mensaje = 'DNI, Teléfono y Género no pueden ser 0.';
    } else {
        $sql = "UPDATE alumno SET DNI='$dni', Apellido='$apellido', Nombre='$nombre', FechaNacimiento='$fechaNacimiento', Genero='$genero', Telefono='$telefono' WHERE ID_Usuario='$idUsuario'";
        $resultado = mysqli_query($conexion, $sql);

        if ($resultado) {
            $mensaje = 'Tus datos se han actualizado correctamente.';
        } else {
            $mensaje = 'Error al actualizar datos.';
        }
    }

    mysqli_close($conexion);
} else {
    $sqlx = "SELECT * FROM alumno WHERE ID_Usuario='$idUsuario'";
    $resultado = $conexion->query($sqlx);

    if ($data = $resultado->fetch_assoc()) {
        $dni = $data['DNI'];
        $apellido = $data['Apellido'];
        $nombre = $data['Nombre'];
        $fechaNacimiento = $data['FechaNacimiento'];
        $genero = $data['Genero'];
        $telefono = $data['Telefono'];
    }

    mysqli_close($conexion);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../../Vista/Imagenes/Logo.png">
    <link rel="stylesheet" type="text/css" href="../../Vista/Css/perfilUsuario.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>Isft 182 - Perfil</title>
    <script>
        function confirmarActualizacion(event) {
            event.preventDefault();
            if (confirm("¿Estás seguro que quieres actualizar tus datos?")) {
                event.target.submit();
            }
        }
    </script>

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
    <a href="https://isft182-bue.infd.edu.ar/sitio/" target="_blank" class="logo-link">
    <img src="../../Vista/Imagenes/Logo.png" alt="Logo"></a>

<div class='container'>
    <h1>¿Quieres actualizar tu información?</h1>
    <center>
        <form method="POST" action="../../Controlador/Alumno/perfil_alumno.php" onsubmit="confirmarActualizacion(event)">
            <div class="rowDNI">
                <label class="contra">DNI</label>
                <div class="input">
                    <input type="text" name="dni" value="<?php echo isset($dni) ? $dni : ''; ?>" readonly>
                </div>    
            </div>
            <div class="rowApellido">
                <label class="contra">Apellido</label>
                <div class="input">
                    <input type="text" name="apellido" value="<?php echo isset($apellido) ? $apellido : ''; ?>">
                </div>    
            </div>
            <div class="rowNombre">
                <label class="nombre">Nombre</label>
                <div class="input">
                    <input type="text" name="nombre" value="<?php echo isset($nombre) ? $nombre : ''; ?>">
                </div>
            </div>
            <div class="rowFechaNacimiento">
                <label class="contra">Fecha de Nacimiento</label>
                <div class="input">
                    <input type="date" name="fechaNacimiento" value="<?php echo isset($fechaNacimiento) ? $fechaNacimiento : ''; ?>">
                </div>    
            </div>
            <div class="rowGenero">
                <label>Género:</label>
                <br>
                <div>
                    <label>
                        <input type="radio" name="genero" value="1" <?php echo (isset($genero) && $genero == 1) ? 'checked' : ''; ?>> Masculino
                    </label>
                </div>
                <br>
                <div>
                    <label>
                        <input type="radio" name="genero" value="2" <?php echo (isset($genero) && $genero == 2) ? 'checked' : ''; ?>> Femenino
                    </label>
                </div>
                <br>
                <div>
                    <label>
                        <input type="radio" name="genero" value="3" <?php echo (isset($genero) && $genero == 3) ? 'checked' : ''; ?>> Otros
                    </label>
                </div>
            </div>

            <div class="rowTelefono">
                <label class="contra">Teléfono</label>
                <div class="input">
                    <input type="text" name="telefono" value="<?php echo isset($telefono) ? $telefono : ''; ?>">
                </div>    
            </div>
            <div class="rowBotones">
                <div class="boton">
                    <button type="submit" class="btnActualizar" name="enviar" value="Actualizar">Actualizar</button>
                    <a href="../../Vista/html/indexAlumno.html" class="btnvolver">Volver</a>
                </div>
            </div>
        </form>
    </center>
    <?php if ($mensaje): ?>
        <div class="mensaje">
            <p><?php echo $mensaje; ?></p>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
