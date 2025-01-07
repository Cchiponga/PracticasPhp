<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ProyectoPracticas3.2.0/Controlador/Admin/PHP/conexion.php';
$conexion = conexion();

if (isset($_POST['enviar'])) {
    $id = $_POST['id'];
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];
    $mail = $_POST['mail'];
    
    // Datos para la tabla profesores
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fechaNacimiento = $_POST['fechaNacimiento'];
    $celular = $_POST['celular'];
    $genero = $_POST['Genero'];
    $idCarreras = $_POST['idCarrera']; // Array de ID_Carrera

    // Validación de campos vacíos
    if (empty($usuario) || empty($contraseña) || empty($nombre) || empty($apellido) || empty($fechaNacimiento) || empty($celular) || empty($mail) || empty($genero) || empty($idCarreras)) {
        echo "<script language='JavaScript'>
                alert('Por favor, complete todos los campos requeridos.');
                window.history.back(); // Permanece en la misma página sin redirigir
              </script>";
    } else {
        // Si no hay campos vacíos, continuar con las actualizaciones
        // Actualizar la tabla usuarios
        $sqlUsuario = "UPDATE usuarios SET Usuario=$usuario, Contraseña='$contraseña',Email='$mail' WHERE ID_Usuario=$id";
        $resultadoUsuario = mysqli_query($conexion, $sqlUsuario);

        // Actualizar la tabla profesores
        $sqlProfesor = "UPDATE profesores SET Nombre='$nombre', Apellido='$apellido', DNI=$usuario, FechaNacimiento='$fechaNacimiento', Celular='$celular', Genero='$genero' WHERE ID_Usuario=$id";
        $resultadoProfesor = mysqli_query($conexion, $sqlProfesor);

        // Actualizar la tabla profesoresCarrera
        // Primero eliminar todas las entradas anteriores
        $sqlEliminarCarreras = "DELETE FROM profesoresCarrera WHERE ID_Usuario = $id";
        mysqli_query($conexion, $sqlEliminarCarreras);

        // Insertar las nuevas carreras seleccionadas
        foreach ($idCarreras as $idCarrera) {
            $sqlInsertarCarrera = "INSERT INTO profesoresCarrera (ID_Usuario, ID_Carrera) VALUES ($id, $idCarrera)";
            mysqli_query($conexion, $sqlInsertarCarrera);
        }

        if ($resultadoUsuario && $resultadoProfesor) {
            echo "<script language='JavaScript'>
                    alert('Los datos se actualizaron correctamente');
                    location.assign('../../../Modelo/Admin/menuProfesoresAdmin.php');
                  </script>";
        } else {
            echo "<script language='JavaScript'>
                    alert('Error al actualizar datos');
                    window.history.back(); // Permanece en la misma página sin redirigir
                  </script>";
        }
    }
    mysqli_close($conexion);
}
?>