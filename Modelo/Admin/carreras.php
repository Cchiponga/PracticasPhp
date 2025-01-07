<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ProyectoPracticas3.2.0/Controlador/Admin/PHP/conexion.php';

// Crear una instancia de la conexión
$conexion = conexion();

// Consultar todas las carreras
$resultado = $conexion->query("SELECT ID_Carrera, Carrera FROM carreras");

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../../Vista/Imagenes/Logo.png">
    <link rel="stylesheet" type="text/css" href="../../Vista/Css/carreras.css">
    <title>Menú de Carreras</title>
    <script>
        function confirmarBorrado() {
            return confirm("¿Estás seguro de que deseas borrar esta carrera? Esto también eliminará todas las materias asociadas.");
        }
    </script>
</head>
<body class="bodyCarreras">
    <div class="titleCarreras">
        <h2>Lista de Carreras</h2>
    </div>
    
    <div class="container">
            <table border="1" class="tablaStyle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre de la Carrera</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($resultado->num_rows > 0): ?>
                        <?php while ($fila = $resultado->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $fila['ID_Carrera']; ?></td>
                                <td><?php echo $fila['Carrera']; ?></td>
                                <td>
                                    <form action="../../Controlador/Admin/PHP/borrar_carrera.php" method="POST" onsubmit="return confirmarBorrado();">
                                        <input type="hidden" name="idCarrera" value="<?php echo $fila['ID_Carrera']; ?>">
                                        <button type="submit" class="botonsito">Borrar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">No hay carreras disponibles.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    <br>
       
        <button class="botonCrear" type="submit" onclick="document.location.href='../../Modelo/Admin/crearCarrera.php'">Crear Carrera</button>
        <br>
        <br>
        <br>
        <button class="botonVolver" type="submit" onclick="document.location.href='../../Vista/html/indexAdmin.html'" >Volver</button>  
</body>
</html>

<?php
$conexion->close();
?>

