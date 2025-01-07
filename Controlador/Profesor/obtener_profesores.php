<?php
// Conexión a la base de datos
require_once $_SERVER['DOCUMENT_ROOT'] . '/ProyectoPracticas3.2.0/Controlador/Admin/PHP/conexion.php';
$conexion=conexion();

if (isset($_POST['ID_Carrera'])) {
    $ID_Carrera = intval($_POST['ID_Carrera']); // Convertir a entero para mayor seguridad

    // Consulta para obtener los profesores según la carrera seleccionada
    $consultaProfesores = "
        SELECT p.ID_Profesores, p.Nombre, p.Apellido 
        FROM Profesores p
        JOIN profesoresCarrera pc ON p.ID_Usuario = pc.ID_Usuario
        WHERE pc.ID_Carrera = $ID_Carrera
    ";

    $resultado = mysqli_query($conexion, $consultaProfesores) or die("Problemas con el select: " . mysqli_error($conexion));

    $profesores = [];
    while ($row = mysqli_fetch_assoc($resultado)) {
        $profesores[] = $row;
    }

    // Devolver los profesores como JSON
    echo json_encode($profesores);
}

mysqli_close($conexion);
?>