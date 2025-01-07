<?php
// Incluir la conexión a la base de datos
require_once $_SERVER['DOCUMENT_ROOT'] . '/ProyectoPracticas3.2.0/Controlador/Admin/PHP/conexion.php';
$conexion = conexion();

// Verificar si se han enviado datos por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir datos del formulario
    $id_practica = mysqli_real_escape_string($conexion, $_POST['ID_Practica']);
    $practica = mysqli_real_escape_string($conexion, $_POST['Practica']);
    $lugar = mysqli_real_escape_string($conexion, $_POST['Lugar']);
    $horarioInicio = mysqli_real_escape_string($conexion, $_POST['HorarioInicio']);
    $horarioFinal = mysqli_real_escape_string($conexion, $_POST['HorarioFinal']);
    $vacantes = mysqli_real_escape_string($conexion, $_POST['Vacantes']);
    $id_profesor = mysqli_real_escape_string($conexion, $_POST['ID_Profesores']);
    $id_carrera = mysqli_real_escape_string($conexion, $_POST['ID_Carrera']);
    $id_materia = mysqli_real_escape_string($conexion, $_POST['ID_Materia']);
    $observacion = mysqli_real_escape_string($conexion, $_POST['Observacion']);
    $fecha_apertura = mysqli_real_escape_string($conexion, $_POST['Fecha_apertura']);
    
    // Verificar si se han seleccionado días
    if (empty($_POST['dias'])) {
        echo "<script>
            alert('Error: Debes seleccionar al menos un día para la práctica.');
            window.location.href = '../../../Modelo/Admin/menuPracticasAdmin.php';
        </script>";
    } else {
        // Actualizar la práctica en la tabla practicas
        $updatePracticaQuery = "UPDATE practicas SET 
            Practica = '$practica',
            Lugar = '$lugar',
            HorarioInicio = '$horarioInicio',
            HorarioFinal = '$horarioFinal',
            Vacantes = '$vacantes',
            Fecha_apertura = '$fecha_apertura',
            ID_Profesores = '$id_profesor',
            ID_Carrera = '$id_carrera',
            ID_Materias = '$id_materia',
            Observacion = '$observacion'
        WHERE ID_Practica = $id_practica";

        if (mysqli_query($conexion, $updatePracticaQuery)) {
            // Eliminar días existentes para la práctica
            $deleteDiasQuery = "DELETE FROM practicaDia WHERE ID_Practica = $id_practica";
            mysqli_query($conexion, $deleteDiasQuery);
            
            // Insertar los nuevos días seleccionados
            foreach ($_POST['dias'] as $id_dia) {
                $id_dia = mysqli_real_escape_string($conexion, $id_dia);
                $insertDiaQuery = "INSERT INTO practicaDia (ID_Profesores, ID_Practica, ID_DiaPractica) VALUES ('$id_profesor', '$id_practica', '$id_dia')";
                mysqli_query($conexion, $insertDiaQuery);
            }
            
            // Redirigir a menuPracticasAdmin.php después de la actualización exitosa
            echo "<script>
                alert('Práctica actualizada correctamente.');
                window.location.href = '../../Modelo/Profesor/listarPracticas.php';
            </script>";
        } else {
            echo "Error al actualizar la práctica: " . mysqli_error($conexion);
        }
    }
}
?>
