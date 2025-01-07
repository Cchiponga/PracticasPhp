<?php
// Incluir la conexión a la base de datos
require_once $_SERVER['DOCUMENT_ROOT'] . '/ProyectoPracticas3.2.0/Controlador/Admin/PHP/conexion.php';
$conexion = conexion();

// Obtener el ID de la práctica desde la URL
$id = isset($_GET['id']) ? mysqli_real_escape_string($conexion, $_GET['id']) : null;

// Si el ID está disponible, consulta la práctica
if ($id) {
    $query = "SELECT * FROM practicas WHERE ID_Practica = $id";
    $result = mysqli_query($conexion, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $practicaData = mysqli_fetch_assoc($result);
    } else {
        die('No se encontró la práctica.');
    }
} else {
    die('ID de práctica no proporcionado.');
}

// Obtener todas las carreras disponibles
$carrerasQuery = "SELECT * FROM carreras";
$carrerasResult = mysqli_query($conexion, $carrerasQuery);

// Obtener las materias asociadas a la carrera seleccionada
$ID_Carrera = $practicaData['ID_Carrera'];
$materiasQuery = "SELECT * FROM materias WHERE ID_Carrera = $ID_Carrera";
$materiasResult = mysqli_query($conexion, $materiasQuery);

// Obtener todos los profesores
$profesoresQuery = "SELECT * FROM profesores";
$profesoresResult = mysqli_query($conexion, $profesoresQuery);

// Obtener días de práctica seleccionados para la práctica actual
$diasPractica = [];
$queryDias = "SELECT ID_DiaPractica FROM practicaDia WHERE ID_Practica = $id";
$resultDias = mysqli_query($conexion, $queryDias);
while ($row = mysqli_fetch_assoc($resultDias)) {
    $diasPractica[] = $row['ID_DiaPractica'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Práctica</title>
    <link rel="icon" type="image/x-icon" href="../../Vista/Imagenes/Logo.png">
    <link rel="stylesheet" type="text/css" href="../../Vista/Css/altasAdmin.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('select[name="ID_Carrera"]').change(function() {
                var ID_Carrera = $(this).val();

                // Obtener las materias de la carrera seleccionada
                $.ajax({
                    type: 'POST',
                    url: '../../Controlador/Profesor/obtener_materias.php',
                    data: {ID_Carrera: ID_Carrera},
                    dataType: 'json',
                    success: function(data) {
                        var options = '<option value="">Seleccionar Materia</option>';
                        $.each(data, function(index, item) {
                            options += '<option value="' + item.ID_Materias + '">' + item.Materia + '</option>';
                        });
                        $('select[name="ID_Materia"]').html(options);
                    },
                    error: function() {
                        alert('Error al obtener las materias.');
                    }
                });

                // Obtener los profesores de la carrera seleccionada
                $.ajax({
                    type: 'POST',
                    url: '../../Controlador/Profesor/obtener_profesores.php',
                    data: {ID_Carrera: ID_Carrera},
                    dataType: 'json',
                    success: function(data) {
                        var options = '<option value="">Seleccionar Profesor</option>';
                        $.each(data, function(index, item) {
                            options += '<option value="' + item.ID_Profesores + '">' + item.Nombre + ' ' + item.Apellido + '</option>';
                        });
                        $('select[name="ID_Profesores"]').html(options);
                    },
                    error: function() {
                        alert('Error al obtener los profesores.');
                    }
                });
            });
        });
    </script>
</head>
<body>
    <div class="caja">
        <form action="../../Controlador/Admin/PHP/editar_practica.php" method="post">
            <h1>Editar Práctica</h1>

            <input type="hidden" name="ID_Practica" value="<?php echo $practicaData['ID_Practica']; ?>">

            <h3>Seleccione la Carrera:</h3>
            <select class="input" name="ID_Carrera" required>
                <option value="">Seleccionar Carrera</option>
                <?php 
                    $carreraSeleccionada = $practicaData['ID_Carrera'];
                    while ($carrera = mysqli_fetch_assoc($carrerasResult)) {
                        $selected = ($carrera['ID_Carrera'] == $carreraSeleccionada) ? 'selected' : '';
                        echo "<option value=\"{$carrera['ID_Carrera']}\" $selected>{$carrera['Carrera']}</option>";
                    }
                ?>
            </select>
            <br>

            <h3>Seleccione la Materia:</h3>
            <select class="input" name="ID_Materia" required>
                <option value="">Seleccionar Materia</option>
                <?php 
                    while ($materia = mysqli_fetch_assoc($materiasResult)) {
                        $selected = ($materia['ID_Materias'] == $practicaData['ID_Materias']) ? 'selected' : '';
                        echo "<option value=\"{$materia['ID_Materias']}\" $selected>{$materia['Materia']}</option>";
                    }
                ?>
            </select>
            <br>

            <h3>Seleccione el Profesor:</h3>
            <select class="input" name="ID_Profesores" required>
                <option value="">Seleccionar Profesor</option>
                <?php 
                    while ($profesor = mysqli_fetch_assoc($profesoresResult)) {
                        $selected = ($profesor['ID_Profesores'] == $practicaData['ID_Profesores']) ? 'selected' : '';
                        echo "<option value=\"{$profesor['ID_Profesores']}\" $selected>{$profesor['Nombre']} {$profesor['Apellido']}</option>";
                    }
                ?>
            </select>
            <br>

            <h3>Nombre de la Práctica:</h3>
            <input class="input" type="text" name="Practica" value="<?php echo $practicaData['Practica']; ?>" required>
            <br>

            <h3>Lugar de la Práctica:</h3>
            <input class="input" type="text" name="Lugar" value="<?php echo $practicaData['Lugar']; ?>" required>
            <br>

            <h3>Horario de la Práctica:</h3>
            <label for="HorarioInicio">Inicio:</label>
            <input class="input" type="time" name="HorarioInicio" value="<?php echo $practicaData['HorarioInicio']; ?>" required>
            <br><br>
            <label for="HorarioFinal">Final:</label>
            <input class="input" type="time" name="HorarioFinal" value="<?php echo $practicaData['HorarioFinal']; ?>" required>
            <br>

            <h3>Fecha de Apertura:</h3>
            <input class="input" type="date" name="Fecha_apertura" value="<?php echo $practicaData['Fecha_apertura']; ?>" required>
            <br>

            <h3>Vacantes Disponibles:</h3>
            <input class="input" type="number" name="Vacantes" value="<?php echo $practicaData['Vacantes']; ?>" required min="1">
            <br>

            <h3>Días de la Práctica:</h3>
            <?php
                $dias = [];
                $registrosDias = mysqli_query($conexion, "SELECT ID_DiaPractica, DiaSemana FROM diaPractica") or die("Problemas con el select: " . mysqli_error($conexion));
                while ($reg = mysqli_fetch_array($registrosDias)) {
                    $dias[] = $reg;
                }

                foreach ($dias as $dia) {
                    $checked = in_array($dia['ID_DiaPractica'], $diasPractica) ? 'checked' : '';
                    echo "<input type='checkbox' name='dias[]' value='{$dia['ID_DiaPractica']}' $checked> {$dia['DiaSemana']}<br>";
                }
            ?>
            <br>

            <h3>Observación:</h3>
            <textarea class="input" name="Observacion" rows="4" cols="50"><?php echo htmlspecialchars($practicaData['Observacion']); ?></textarea>
            <br>

            <input class="btn" type="submit" value="Actualizar">
            <h3><a class="btn" href="./menuPracticasAdmin.php">Volver</a></h3>
        </form>
    </div>
</body>
</html>
