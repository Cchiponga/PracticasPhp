<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ProyectoPracticas3.2.0/Controlador/Admin/PHP/conexion.php';
$conexion = conexion();

if (isset($_GET['id'])) {
    $id_inscripcion = intval($_GET['id']);
    
    // Intentar eliminar la inscripción
    $query = "DELETE FROM inscripcion WHERE ID_Inscripcion = $id_inscripcion";
    
    if ($conexion->query($query) === TRUE) {
        // Redirigir de vuelta a la página sin mostrar ningún mensaje
        header("Location: ../../Modelo/Alumno/misInscripciones.php");
        exit();
    } else {
        // Si hay un error, redirigir de vuelta sin mostrar mensajes
        header("Location: ../../Modelo/Alumno/misInscripciones.php");
        exit();
    }
} else {
    // Si no hay ID, redirigir de vuelta sin mostrar mensajes
    header("Location: ../../Modelo/Alumno/misInscripciones.php");
    exit();
}

mysqli_close($conexion);
?>

