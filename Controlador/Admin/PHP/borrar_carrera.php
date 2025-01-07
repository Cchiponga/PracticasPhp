<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ProyectoPracticas3.2.0/Controlador/Admin/PHP/conexion.php';
$conexion = conexion();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['idCarrera'])) {
    $idCarrera = $_POST['idCarrera'];

    // Iniciar transacción
    $conexion->begin_transaction();

    try {
        // Eliminar materias asociadas a la carrera
        $eliminarMaterias = $conexion->prepare("DELETE FROM materias WHERE ID_Carrera = ?");
        $eliminarMaterias->bind_param("i", $idCarrera);
        $eliminarMaterias->execute();
        $eliminarMaterias->close();

        // Eliminar la carrera
        $eliminarCarrera = $conexion->prepare("DELETE FROM carreras WHERE ID_Carrera = ?");
        $eliminarCarrera->bind_param("i", $idCarrera);
        $eliminarCarrera->execute();
        $eliminarCarrera->close();

        // Confirmar la transacción
        $conexion->commit();
        header("Location: ../../../Modelo/Admin/carreras.php?mensaje=" . urlencode("Carrera y materias eliminadas exitosamente."));
        exit();
    } catch (Exception $e) {
        // Revertir la transacción en caso de error
        $conexion->rollback();
        header("Location: ../../../Modelo/Admin/carreras.php?mensaje=" . urlencode("Error: " . $e->getMessage()));
        exit();
    }
}

// Cerrar la conexión
$conexion->close();
?>
