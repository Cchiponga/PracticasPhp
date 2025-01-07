<?php
// Conexión a la base de datos
require_once $_SERVER['DOCUMENT_ROOT'] . '/ProyectoPracticas3.2.0/Controlador/Admin/PHP/conexion.php';
$conexion=conexion();

if (isset($_GET['id']) && !empty($_GET['id'])) {
   $idPractica = intval($_GET['id']);
}

$sql = "SELECT u.ID_Usuario,u.DNI,u.Nombre, u.Apellido, c.Carrera, m.Materia, i.fechaInscripcion 
        FROM inscripcion i
        INNER JOIN alumno u ON i.ID_Usuario = u.ID_Usuario
        INNER JOIN carreras c ON i.ID_Carrera = c.ID_Carrera
        INNER JOIN materias m ON i.ID_Materias = m.ID_Materias
        WHERE i.ID_Practica = ?";
        
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $idPractica);
$stmt->execute();
$resultado = $stmt->get_result();

$inscriptos = [];
while ($row = $resultado->fetch_assoc()) {
    $inscriptos[] = $row;
}

// Cerrar la conexión
mysqli_close($conexion);
?>

