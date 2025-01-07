<?php
if (isset($_GET['id']) && isset($_GET['profesorId'])) {
    $idUsuario = $_GET['id'];
    $idProfesor = $_GET['profesorId'];

    if ($idUsuario == 1) {
        echo '<script type="text/javascript">
                alert("NO SE PUEDE BORRAR EL ADMIN");
                window.location.href="../../../Modelo/Admin/menuProfesoresAdmin.php";
              </script>';
    } else {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/ProyectoPracticas3.2.0/Controlador/Admin/PHP/conexion.php';
        $conexion=conexion();

        
  
    $sqlpracticaDia="DELETE FROM practicadia WHERE ID_Profesores=$idProfesor";
    $conexion->query($sqlpracticaDia);

        $sqlpracticas="DELETE FROM practicas WHERE ID_Profesores=$idProfesor";
        $conexion->query($sqlpracticas);

        $sql0="DELETE FROM profesorescarrera WHERE ID_Usuario=$idUsuario";
        $conexion->query($sql0);

        $sql1 = "DELETE FROM profeaño WHERE ID_Profesores = $idProfesor";
        $conexion->query($sql1);

        $sql2 = "DELETE FROM profesores WHERE ID_Usuario = $idUsuario";
        $conexion->query($sql2);

        $sql3 = "DELETE FROM usuarios WHERE ID_Usuario = $idUsuario";
        $conexion->query($sql3);

        header("Location: ../../../Modelo/Admin/menuProfesoresAdmin.php");
        exit;
    }
}
?>
