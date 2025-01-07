<?php
// Incluir la clase de conexión
require_once $_SERVER['DOCUMENT_ROOT'] . '/ProyectoPracticas3.2.0/Controlador/Admin/PHP/conexion.php';

$conexion = conexion(); // Crear una conexión

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['crearCarrera'])) {
    // Obtener los datos del formulario
    $nombreCarrera = $_POST['nombreCarrera'];
    $materias = $_POST['materias'];

    // Iniciar transacción
    $conexion->begin_transaction();

    try {
        // 1. Insertar nueva carrera en la tabla `carreras`
        $insertarCarrera = $conexion->prepare("INSERT INTO carreras (Carrera) VALUES (?)");
        $insertarCarrera->bind_param("s", $nombreCarrera);
        $insertarCarrera->execute();
        $ID_Carrera = $insertarCarrera->insert_id; // Obtener el ID de la carrera recién insertada
        $insertarCarrera->close();

        // 2. Insertar materias para la nueva carrera en la tabla `materias`
        $insertarMateria = $conexion->prepare("INSERT INTO materias (Materia, ID_Carrera) VALUES (?, ?)");
        foreach ($materias as $materia) {
            $insertarMateria->bind_param("si", $materia, $ID_Carrera);
            $insertarMateria->execute();
        }
        $insertarMateria->close();

        // Confirmar la transacción
        $conexion->commit();
        $mensaje = "Carrera y materias creadas exitosamente.";

    } catch (Exception $e) {
        // Revertir la transacción en caso de error
        $conexion->rollback();
        $mensaje = "Error: " . $e->getMessage();
    }

    // Cerrar la conexión
    $conexion->close();
    header("Location: ../../../Modelo/Admin/crearCarrera.php?mensaje=" . urlencode($mensaje));
    exit();
}
?>
