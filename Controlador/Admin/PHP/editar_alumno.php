<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/ProyectoPracticas3.2.0/Controlador/Admin/PHP/conexion.php';
$conexion = conexion();

if (isset($_POST['enviar'])) {
    $id = $_POST['id'];
    $contraseña = $_POST['contraseña'];
    $idCargo = $_POST['idCargo'];
    $DNI = $_POST['DNI'];
    $apellido = $_POST['apellido'];
    $nombre = $_POST['nombre'];
    $fechaNacimiento = $_POST['fechaNacimiento'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $genero = $_POST['Genero'];

    // Validación para verificar campos vacíos
    if (empty($contraseña) || empty($idCargo) || empty($DNI) || empty($apellido) || empty($nombre) || empty($fechaNacimiento) || empty($email) || empty($telefono) || empty($genero)) {
        echo "<script language='JavaScript'>
                alert('Por favor, complete todos los campos requeridos.');
                window.history.back(); // Para que permanezca en la misma página sin redirigir
              </script>";
    } else {
        // Si no hay campos vacíos, continuar con las actualizaciones
        $sql1= "UPDATE usuarios SET Usuario=$DNI,Contraseña='$contraseña',Email='$email',idCargo=$idCargo WHERE ID_Usuario=$id";
        $resultadoUsuario=mysqli_query($conexion,$sql1);

        $sqlAlumno = "UPDATE alumno SET DNI=$DNI, Apellido='$apellido', Nombre='$nombre', FechaNacimiento='$fechaNacimiento', Telefono='$telefono', Genero='$genero' WHERE ID_Usuario=$id";
        $resultadoAlumno = mysqli_query($conexion, $sqlAlumno);

        if ($resultadoUsuario && $resultadoAlumno) {
            echo "<script language='JavaScript'>
                    alert('Los datos se actualizaron correctamente');
                    location.assign('../../../Modelo/Admin/menuAlumnosAdmin.php');
                  </script>";
        } else {
            // Mostrar el error específico para depuración
            echo "<script language='JavaScript'>
                    alert('Error al actualizar datos: " . mysqli_error($conexion) . "');
                    window.history.back(); // Para que permanezca en la misma página sin redirigir
                  </script>";
        }
    }
    mysqli_close($conexion);
}
?>
