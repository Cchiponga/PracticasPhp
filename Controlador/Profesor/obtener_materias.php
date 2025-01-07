<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ProyectoPracticas3.2.0/Controlador/Admin/PHP/conexion.php';
$conexion=conexion();
$ID_Carrera = $_POST['ID_Carrera'];

$query = "SELECT ID_Materias, Materia FROM materias WHERE ID_Carrera = '$ID_Carrera'";
$result = mysqli_query($conexion, $query);

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode($data);
?>
