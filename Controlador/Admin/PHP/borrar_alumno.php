<?php
if (isset($_GET['id'])) {
    $idUsuario = $_GET['id'];

    if ($idUsuario == 1) {
        echo '<script type="text/javascript">
                alert("NO SE PUEDE BORRAR EL ADMIN");
                window.location.href="../../../Modelo/Admin/menuProfesoresAdmin.php";
              </script>';
    } else {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ProyectoPracticas3.2.0/Controlador/Admin/PHP/conexion.php';
        $conexion=conexion();


        $sqlInscripciones="DELETE FROM inscripcion WHERE ID_Usuario=$idUsuario";
        $conexion->query($sqlInscripciones);

        $sqlCarrera="DELETE FROM alumnoscarrera WHERE ID_Usuario=$idUsuario";
        $conexion->query($sqlCarrera);

        $sql1 = "DELETE FROM alumno WHERE ID_Usuario = $idUsuario";
        $conexion->query($sql1);

        $sql2 = "DELETE FROM usuarios WHERE ID_Usuario = $idUsuario";
        $conexion->query($sql2);

        header("Location: ../../../Modelo/Admin/menuAlumnosAdmin.php");
        exit;
    }
}
?>
