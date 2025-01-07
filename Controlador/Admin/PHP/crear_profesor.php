<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ProyectoPracticas3.2.0/Controlador/Admin/PHP/conexion.php';
$conexion=conexion();

// Variables de entrada
$dni = $_POST['dni'];
$usuario = $dni; // DNI y Usuario son iguales
$contraseña = $_POST['contraseña'];
$Nombre = $_POST['nombre'];
$Apellido = $_POST['apellido'];
$fechaNacimiento = $_POST['fecha_nacimiento'];
$celular = $_POST['celular'];
$email = $_POST['email'];
$genero = $_POST['genero'];
$idCarreras = isset($_POST['carrera']) ? $_POST['carrera'] : []; // Manejar como array
$añosSeleccionados = isset($_POST['años']) ? $_POST['años'] : []; // Manejar como array
$errorMessage = "";

if (
    empty($dni) || 
    empty($contraseña) || 
    empty($Nombre) || 
    empty($Apellido) || 
    empty($fechaNacimiento) || 
    empty($celular) || 
    empty($email) || 
    empty($genero) ||
    !is_array($idCarreras) || count($idCarreras) == 0 || // Verificar que al menos una carrera esté seleccionada
    !is_array($añosSeleccionados) || count($añosSeleccionados) == 0 // Verificar que al menos un año esté seleccionado
) {
    $errorMessage = "Todos los campos son requeridos, incluyendo al menos una carrera y un año.";
    header("Location: crearProfesor.html?errorMessage=" . urlencode($errorMessage));
    exit;
}


// Insertar en usuarios
$sql = "INSERT INTO usuarios(Usuario, Contraseña,Email, idCargo) VALUES('$usuario', '$contraseña','$email', 2)";
$resultado = $conexion->query($sql);

if ($resultado) {
    // Obtener el ID_Usuario generado
    $idUsuario = mysqli_insert_id($conexion);

    // Insertar en profesores
    $sql2 = "INSERT INTO profesores(DNI, Nombre, Apellido, FechaNacimiento, Celular, Genero, ID_Usuario) VALUES('$dni', '$Nombre', '$Apellido', '$fechaNacimiento', '$celular','$genero', '$idUsuario')";
    $resul2 = $conexion->query($sql2);

    if ($resul2) {
        // Obtener el ID del profesor recién insertado
        $idProfesor = mysqli_insert_id($conexion);

        // Insertar en profesoresCarrera para cada carrera seleccionada
        foreach ($idCarreras as $idCarrera) {
            $sql3 = "INSERT INTO profesoresCarrera(ID_Usuario, ID_Carrera) VALUES('$idUsuario', '$idCarrera')";
            $resul3 = $conexion->query($sql3);
            if (!$resul3) {
                $errorMessage = "Error al insertar en profesoresCarrera: " . $conexion->error;
                break;
            }
        }

        // Insertar en profeaño para cada año seleccionado
        if (empty($errorMessage)) {
            foreach ($añosSeleccionados as $año) {
                $sql4 = "INSERT INTO profeaño(ID_Profesores, ID_Año) VALUES('$idProfesor', '$año')";
                $resul4 = $conexion->query($sql4);
                if (!$resul4) {
                    $errorMessage = "Error al insertar en profeaño: " . $conexion->error;
                    break;
                }
            }
        }

        if (empty($errorMessage)) {
            header("Location: ../../../Modelo/Admin/menuProfesoresAdmin.php");
            exit;
        } else {
            header("Location: crearProfesor.html?errorMessage=" . urlencode($errorMessage));
            exit;
        }
    } else {
        $errorMessage = "Error al insertar en profesores: " . $conexion->error;
        header("Location: crearProfesor.html?errorMessage=" . urlencode($errorMessage));
        exit;
    }
} else {
    $errorMessage = "Error al insertar en usuarios: " . $conexion->error;
    header("Location: crearProfesor.html?errorMessage=" . urlencode($errorMessage));
    exit;
}
?>
