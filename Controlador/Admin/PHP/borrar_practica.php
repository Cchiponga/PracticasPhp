<?php
	if(isset($_GET['id'])){
		$id=$_GET['id'];
		require_once $_SERVER['DOCUMENT_ROOT'] . '/ProyectoPracticas3.2.0/Controlador/Admin/PHP/conexion.php';
        $conexion=conexion();

        $sql1="DELETE FROM practicadia WHERE ID_Practica=$id";
        $conexion->query($sql1);

        $sql2="DELETE FROM inscripcion WHERE ID_Practica=$id";
        $conexion->query($sql2);

	    $sql="DELETE FROM practicas WHERE ID_Practica=$id";
	    $conexion->query($sql);
	    header("location:../../../Modelo/Admin/menuPracticasAdmin.php");
	    }
?>