<?php
$id = $_GET['id'];
require_once $_SERVER['DOCUMENT_ROOT'] . '/ProyectoPracticas3.2.0/Controlador/Admin/PHP/conexion.php';
$conexion=conexion();

$sql = "SELECT Practica, Lugar, Horario, DiaPractica FROM practicas WHERE ID_Profesores = $id";
$resultado = $conexion->query($sql);

if (!$resultado) {
    die("Query invalida: " . $conexion->error);
}

$practicas = [];

while ($row = $resultado->fetch_assoc()) {
    $practicas[] = $row;
}
?>
