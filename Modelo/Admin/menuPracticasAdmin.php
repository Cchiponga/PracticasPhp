<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Prácticas</title>
    <link rel="icon" type="image/x-icon" href="../../Vista/Imagenes/Logo.png">
    <link rel="stylesheet" type="text/css" href="../../Vista/Css/menuAdminPractica.css">
</head>
<body class="bodyPractica">
    <div class="containerLista">
        <h1>Lista de Prácticas</h1>    
        <form class='form' method="GET" action="">
            <label for="carrera">Filtrar por Carrera:</label>
            <select class="select" name="carrera" id="carrera" onchange="this.form.submit()">
                <option value=""> Seleccionar Carrera </option>
                <?php
                // Conexión y consulta de carreras
                require_once $_SERVER['DOCUMENT_ROOT'] . '/ProyectoPracticas3.2.0/Controlador/Admin/PHP/conexion.php';
                $conexion = conexion();
                $sqlCarreras = "SELECT ID_Carrera, Carrera FROM carreras";
                $resultadoCarreras = $conexion->query($sqlCarreras);
                while ($carrera = $resultadoCarreras->fetch_assoc()) {
                    // Comprobar si la carrera seleccionada en el filtro está marcada
                    $selected = (isset($_GET['carrera']) && $_GET['carrera'] == $carrera['ID_Carrera']) ? 'selected' : '';
                    echo "<option value='{$carrera['ID_Carrera']}' $selected>{$carrera['Carrera']}</option>";
                }
                ?>
            </select>
            <br><br>
            <a class="btnCrear" href="./altaPractica.php" role="button">Nueva Práctica</a>
            <a class="volver" href="../../Vista/html/indexAdmin.html" role="button">Volver</a>
        </form>

    
    </div>  
        <!-- Contenedor de la tabla de prácticas -->
        <div id="containerTabla">
            <table class="tabla">
            <?php
            // Incluir la tabla generada por PHP
            require '../../Controlador/Admin/PHP/menu_practicas_admin.php';
            ?>
            </table>
        </div>
    
</body>
</html>
