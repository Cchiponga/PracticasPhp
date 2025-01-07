<?php
session_start();

// Obtener el ID de inscripción de la URL
$id_inscripcion = intval($_GET['id'] ?? 0);

// Verificar que el ID de inscripción sea válido
if (!$id_inscripcion) {
    die("ID de inscripción no proporcionado.");
}

// Conexión a la base de datos
require_once $_SERVER['DOCUMENT_ROOT'] . '/ProyectoPracticas3.2.0/Controlador/Admin/PHP/conexion.php';
$conexion=conexion();

// Consulta preparada para obtener los detalles de la inscripción
$consulta = "SELECT i.ID_Inscripcion, p.Practica, c.Carrera, m.Materia, a.Año, i.fechaInscripcion, al.Nombre, al.Apellido, u.Usuario
             FROM inscripcion i 
             JOIN practicas p ON i.ID_Practica = p.ID_Practica
             JOIN carreras c ON i.ID_Carrera = c.ID_Carrera
             JOIN materias m ON i.ID_Materias = m.ID_Materias
             JOIN `año` a ON i.ID_Año = a.ID_Año
             JOIN alumno al ON i.ID_Usuario = al.ID_Usuario
             JOIN usuarios u ON al.ID_Usuario = u.ID_Usuario
             WHERE i.ID_Inscripcion = ?";

$stmt = mysqli_prepare($conexion, $consulta);
mysqli_stmt_bind_param($stmt, "i", $id_inscripcion);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

// Obtener la fila del resultado
$fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC);

if (!$fila) {
    die("No se encontraron datos para la inscripción.");
}

// Datos de la inscripción
$nombre_usuario = htmlspecialchars($fila['Usuario']);
$nombre = htmlspecialchars($fila['Nombre']);
$apellido = htmlspecialchars($fila['Apellido']);
$practica = htmlspecialchars($fila['Practica']);
$carrera = htmlspecialchars($fila['Carrera']);
$materia = htmlspecialchars($fila['Materia']);
$ano = htmlspecialchars($fila['Año']);
$fecha_inscripcion = htmlspecialchars($fila['fechaInscripcion']);

// Fecha actual para el comprobante
$fecha = date("Y-m-d");

// Cerrar conexión a la base de datos
mysqli_close($conexion);
?>
