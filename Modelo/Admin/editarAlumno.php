<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../../Vista/Imagenes/Logo.png">
    <link rel="stylesheet" type="text/css" href="../../Vista/Css/editarUser.css">
</head>
<body class="bodyEditarAlumno">
<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/ProyectoPracticas3.2.0/Controlador/Admin/PHP/conexion.php';
$conexion=conexion();


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sqlUsuario = "SELECT * FROM usuarios WHERE ID_Usuario = $id";
    $resultadoUsuario = mysqli_query($conexion, $sqlUsuario);
    $usuario = mysqli_fetch_assoc($resultadoUsuario);

    $sqlAlumno = "SELECT * FROM alumno WHERE ID_Usuario = $id";
    $resultadoAlumno = mysqli_query($conexion, $sqlAlumno);
    $alumno = mysqli_fetch_assoc($resultadoAlumno);
?>
   <div class="containerEditarAlumno">
<form action="../../Controlador/Admin/PHP/editar_alumno.php" method="post">
    <h2 class="tituloEditarAlumn">Editar Alumno</h2>
    <input type="hidden" name="id" value="<?php echo $usuario['ID_Usuario']; ?>">
    <label>DNI/Usuario</label><br>
    <input  type="text" name="DNI" value="<?php echo htmlspecialchars($alumno['DNI']); ?>"><br>
    <label>Contraseña:</label><br>
    <input  type="password" name="contraseña" value="<?php echo htmlspecialchars($usuario['Contraseña']); ?>"><br>
    <label>Cargo:</label><br>
    <input  type="text" name="idCargo" value="<?php echo htmlspecialchars($usuario['idCargo']); ?>"><br>
    
    
    <label class="labelEditAlumno">Apellido:</label><br>
    <input type="text" name="apellido" value="<?php echo htmlspecialchars($alumno['Apellido']); ?>"><br>
    <label>Nombre:</label><br>
    <input type="text" name="nombre" value="<?php echo htmlspecialchars($alumno['Nombre']); ?>"><br>
    <label>Fecha de Nacimiento:</label><br>
    <input type="date" name="fechaNacimiento" value="<?php echo htmlspecialchars($alumno['FechaNacimiento']); ?>"><br>
    <label>Email:</label><br>
    <input type="email" name="email" value="<?php echo htmlspecialchars($usuario['Email']); ?>"><br>
    <label>Teléfono:</label><br>
    <input type="text" name="telefono" value="<?php echo htmlspecialchars($alumno['Telefono']); ?>"><br>
    <label class="genero">Género</label>
                <div class="input">
                Masculino   <input type="radio" name="Genero" value=1>
                <br>
                Femenino    <input type="radio" name="Genero" value=2>
                <br>
                Otro    <input type="radio" name="Genero" value=3>
                </div>
   <div class="btnact">
    <input type="submit" name="enviar" value="Actualizar">
    <br>
</div>
</div>
<br>
    <div class="btnEditAlumno">
    <a href="./menuAlumnosAdmin.php">Volver</a>
</div>
</form>


<?php
}
?>
</body>
</html>
