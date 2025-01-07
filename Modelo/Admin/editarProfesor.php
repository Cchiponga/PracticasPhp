<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ProyectoPracticas3.2.0/Controlador/Admin/PHP/conexion.php';
$conexion = conexion();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consulta para obtener datos de la tabla usuarios
    $sqlUsuario = "SELECT * FROM usuarios WHERE ID_Usuario=$id";
    $resultadoUsuario = mysqli_query($conexion, $sqlUsuario);
    if ($resultadoUsuario) {
        $usuario = mysqli_fetch_assoc($resultadoUsuario);
    } else {
        die("Error al obtener datos del usuario: " . mysqli_error($conexion));
    }

    // Consulta para obtener datos de la tabla profesores
    $sqlProfesor = "SELECT * FROM profesores WHERE ID_Usuario=$id";
    $resultadoProfesor = mysqli_query($conexion, $sqlProfesor);
    if ($resultadoProfesor) {
        $profesor = mysqli_fetch_assoc($resultadoProfesor);
    } else {
        die("Error al obtener datos del profesor: " . mysqli_error($conexion));
    }

    // Consulta para obtener las carreras del profesor
    $sqlCarrerasProfesor = "SELECT ID_Carrera FROM profesoresCarrera WHERE ID_Usuario=$id";
    $resultadoCarrerasProfesor = mysqli_query($conexion, $sqlCarrerasProfesor);
    $carrerasProfesor = array();
    if ($resultadoCarrerasProfesor) {
        while ($carrera = mysqli_fetch_assoc($resultadoCarrerasProfesor)) {
            $carrerasProfesor[] = $carrera;
        }
    } else {
        die("Error al obtener las carreras del profesor: " . mysqli_error($conexion));
    }

    // Consulta para obtener todas las carreras
    $sqlCarreras = "SELECT ID_Carrera, Carrera FROM carreras";
    $resultadoCarreras = mysqli_query($conexion, $sqlCarreras);
} else {
    die("ID de usuario no especificado.");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Profesor</title>
    <link rel="icon" type="image/x-icon" href="../../Vista/Imagenes/Logo.png">
    <link rel="stylesheet" type="text/css" href="../../Vista/Css/editarUser.css">
</head>
<body class="bodyEditProfesor">

    <div class='containerEditProfesor'>
        <h2>Editar Profesor</h2>
        <form action="../../Controlador/Admin/PHP/editar_profesor.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            
            <!-- Campos para tabla usuarios -->
            <div class="rowUsuario">
                <label class="nombre">Usuario/DNI</label>
                <div class="inputEditProfesor">
                    <input type="text" name="usuario" value="<?php echo $usuario['Usuario']; ?>">
                </div>
            </div>
            <div class="rowContraseña">
                <label class="contra">Contraseña</label>
                <div class="inputEditProfesor">
                    <input type="text" name="contraseña" value="<?php echo $usuario['Contraseña']; ?>">
                </div>    
            </div>
            
            <!-- Campos para tabla profesores -->
            <div class="rowNombre">
                <label class="nombre">Nombre</label>
                <div class="inputEditProfesor">
                    <input type="text" name="nombre" value="<?php echo $profesor['Nombre']; ?>">
                </div>
            </div>
            <div class="rowApellido">
                <label class="apellido">Apellido</label>
                <div class="inputEditProfesor">
                    <input type="text" name="apellido" value="<?php echo $profesor['Apellido']; ?>">
                </div>
            </div>
            <div class="rowFechaNacimiento">
                <label class="fechaNacimiento">Fecha de Nacimiento</label>
                <div class="inputEditProfesor">
                    <input type="date" name="fechaNacimiento" value="<?php echo $profesor['FechaNacimiento']; ?>">
                </div>
            </div>
            <div class="rowCelular">
                <label class="celular">Celular</label>
                <div class="inputEditProfesor">
                    <input type="text" name="celular" value="<?php echo $profesor['celular']; ?>">
                </div>
            </div>
            <div class="rowMail">
                <label class="mail">Mail</label>
                <div class="inputEditProfesor">
                    <input type="email" name="mail" value="<?php echo $usuario['Email']; ?>">
                </div>
            </div>
            <div class="rowGenero">
                <label class="generoEditProfesor">Género</label>
                <div class="inputEditProfesor">
                Masculino <input type="radio" name="Genero" value=1 <?php echo ($profesor['Genero'] == 1) ? 'checked' : ''; ?>>
                Femenino <input type="radio" name="Genero" value=2 <?php echo ($profesor['Genero'] == 2) ? 'checked' : ''; ?>>
                Otro <input type="radio" name="Genero" value=3 <?php echo ($profesor['Genero'] == 3) ? 'checked' : ''; ?>>
                </div>
            </div>

            <div class="rowCarreras">
                <label class="carreras">Carreras</label>
                <div class="inputEditProfesor">
                    <?php
                    // Asegúrate de que la consulta de carreras no devuelva false
                    if ($resultadoCarreras) {
                        foreach ($resultadoCarreras as $carrera) {
                            // Verificar si la carrera está seleccionada previamente
                            $checked = in_array($carrera['ID_Carrera'], array_column($carrerasProfesor, 'ID_Carrera')) ? 'checked' : '';
                            echo "<div class='checkbox'>";
                            echo "<label>";
                            echo "<input type='checkbox' name='idCarrera[]' value='{$carrera['ID_Carrera']}' $checked> {$carrera['Carrera']}";
                            echo "</label>";
                            echo "</div>";
                        }
                    } else {
                        echo "<div>No hay carreras disponibles</div>";
                    }
                    ?>
                </div>
            </div>

            <div class="rowBotones">
            <div class="btnactProfesor">
              <input  type="submit" name="enviar" value="Actualizar">
               <br>
            </div>
            </div>
        </form>
    </div>
     <br>
    <div class="btnEditProfesor">
       <a class="textoEditProfesor" href="./menuProfesoresAdmin.php">Volver</a>
    </div>
</body>
</html>
<?php
// Ahora cerramos la conexión después de usarla en todas las consultas
mysqli_close($conexion);
?>
