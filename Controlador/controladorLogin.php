<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/ProyectoPracticas3.2.0/Controlador/Admin/PHP/conexion.php';
$conexion = conexion();
session_start();

if(isset($_POST['login'])) {
    // Verificar si los campos están vacíos
    if(trim($_POST['usuario']) === '' || trim($_POST['contraseña']) === '') {
        echo "<script>alert('Al menos un campo esta vacío'); window.location.href='index.php';</script>";
    } else {
        $usuario = $_POST['usuario'];
        $contraseña = $_POST['contraseña'];
        
        // Consultar en la base de datos
        $sql = mysqli_query($conexion, "SELECT * FROM usuarios WHERE Usuario='$usuario' AND Contraseña='$contraseña'");
        $row = mysqli_num_rows($sql);
        
        if($row == 1) {
            $buscarID = mysqli_fetch_array($sql);
            $_SESSION['ID_Usuario'] = $buscarID['ID_Usuario'];

            // Redirigir según el idCargo
            if($buscarID['idCargo'] == 1) {
                header("location:./Vista/html/indexAdmin.html");
            } else if($buscarID['idCargo'] == 2) {
                header("location:./Vista/html/indexProfesor.html");
            } else if($buscarID['idCargo'] == 3) {
                header("location:./Vista/html/indexAlumno.html");
            } else {
                echo "<script>alert('Error en el idCargo'); window.location.href='index.php';</script>";
            }
        } else {
            echo "<script>alert('El usuario no existe o la contraseña es incorrecta'); window.location.href='index.php';</script>";
        }
    }
}
?>
