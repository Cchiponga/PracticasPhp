<?php
session_start();

if (!isset($_SESSION['ID_Usuario'])) {
    echo "<script>
            alert('Debe iniciar sesión para acceder a esta página');
            location.assign('../../Modelo/Alumno/login.php');
          </script>";
    exit();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/ProyectoPracticas3.2.0/Controlador/Admin/PHP/conexion.php';
$conexion = conexion();

$idUsuario = $_SESSION['ID_Usuario'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

        // Utilizar el operador ternario correctamente
        $mensaje = $resultado ? 'Tus datos se han actualizado correctamente.' : 'Error al actualizar datos.';

        echo "<script language='JavaScript'>
                alert('$mensaje');
                location.assign('../../Modelo/Alumno/perfilAlumno.php');
              </script>";
    }

    mysqli_close($conexion);

    exit();
}
?>
