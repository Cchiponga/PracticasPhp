<?php
if (isset($_GET['id'])) {
    $idUsuario = $_GET['id'];

    if ($idUsuario == 1) {
    } else {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ProyectoPracticas3.2.0/Controlador/Admin/PHP/conexion.php';
        $conexion=conexion();
        
        $sqlInscriptos="DELETE FROM inscripcion WHERE ID_Usuario=$idUsuario";
        $conexion->query($sqlInscriptos);

        header("Location: ../../Modelo/Profesor/menuInscriptos.php");
        exit;
    }
}
?>
