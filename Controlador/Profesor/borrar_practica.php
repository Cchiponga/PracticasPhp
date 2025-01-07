<?php
	if(isset($_GET['id'])){
		$id=$_GET['id'];
		require_once '../Admin/PHP/conexion.php';
		$conexion=conexion();
		
        $sql1="DELETE FROM practicadia WHERE ID_Practica=$id";
        $conexion->query($sql1);

        $sql2="DELETE FROM inscripcion WHERE ID_Practica=$id";
        $conexion->query($sql2);

	    $sql="DELETE FROM practicas WHERE ID_Practica=$id";
	    $conexion->query($sql);
	    header("location:../../Modelo/Profesor/listarPracticas.php");
	    }
?>