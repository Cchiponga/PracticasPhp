<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de Prácticas</title>
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

            // Validación del formulario antes del envío
            $('form').on('submit', function(event) {
                var horarioInicio = $('input[name="HorarioInicio"]').val();
                var horarioFinal = $('input[name="HorarioFinal"]').val();

                if (horarioFinal <= horarioInicio) {
                    alert('El Horario Final no puede ser menor o igual al Horario Inicio.');
                    event.preventDefault(); // Evita el envío del formulario
                    return;
                }

                var start = new Date('1970-01-01T' + horarioInicio + 'Z');
                var end = new Date('1970-01-01T' + horarioFinal + 'Z');
                var diff = (end - start) / (1000 * 60 * 60); // Diferencia en horas

                if (diff > 4) {
                    alert('La duración de la práctica no puede ser mayor a 4 horas.');
                    event.preventDefault(); // Evita el envío del formulario
                    return;
                }

                // Validar que haya seleccionado días
                if ($('input[name="dias[]"]:checked').length === 0) {
                    alert('Debes seleccionar al menos un día para la práctica.');
                    event.preventDefault(); // Evita el envío del formulario
                    return;
                }

                // Validar selectores que no pueden estar vacíos
                if ($('select[name="ID_Carrera"]').val() === '') {
                    alert('Debes seleccionar una Carrera.');
                    event.preventDefault();
                    return;
                }
                if ($('select[name="ID_Materia"]').val() === '') {
                    alert('Debes seleccionar una Materia.');
                    event.preventDefault();
                    return;
                }
                if ($('select[name="ID_Profesores"]').val() === '') {
                    alert('Debes seleccionar un Profesor.');
                    event.preventDefault();
                    return;
                }
            });
        });
    </script>
</head>
<body>
    <?php include '../../Controlador/Admin/PHP/alta_practica.php'; ?>
    <div class="caja">
        <form action="../../Controlador/Admin/PHP/alta_practica.php" method="post">
            <h1>Alta de Prácticas</h1>

            <h3>Seleccione la Carrera:</h3>
            <select class="input" name="ID_Carrera" required>
                <option value="">Seleccionar Carrera</option>
                <?php 
                    foreach ($carreras as $carrera) {
                        echo "<option value=\"{$carrera['ID_Carrera']}\">{$carrera['Carrera']}</option>";
                    }
                ?>
            </select>
            <br>

            <h3>Seleccione la Materia:</h3>
            <select class="input" name="ID_Materia" required>
                <option value="">Seleccionar Materia</option>
            </select>
            <br>

            <h3>Seleccione el Profesor:</h3>
            <select class="input" name="ID_Profesores" required>
                <option value="">Seleccionar Profesor</option>
            </select>
            <br>

            <h3>Nombre de la Práctica:</h3>
            <input class="input" type="text" name="Practica" required>
            <br>

            <h3>Lugar de la Práctica:</h3>
            <input class="input" type="text" name="Lugar" required>
            <br>

            <h3>Horario de la Práctica:</h3>
            <label for="HorarioInicio">Inicio:</label>
            <input class="input" type="time" name="HorarioInicio" required>
            <br>
            <label for="HorarioFinal">Final:</label>
            <input class="input" type="time" name="HorarioFinal" required>
            <br>

            <h3>Vacantes Disponibles:</h3>
            <input class="input" type="number" name="Vacantes" required min="1">
            <br>

            <h3>Días de la Práctica:</h3>
            <?php
                // Obtener días de práctica
                $dias = [];
                $registrosDias = mysqli_query($conexion, "SELECT ID_DiaPractica, DiaSemana FROM diaPractica") or die("Problemas con el select: " . mysqli_error($conexion));
                while ($reg = mysqli_fetch_array($registrosDias)) {
                    $dias[] = $reg;
                }
                foreach ($dias as $dia) {
                    echo "<input type='checkbox' name='dias[]' value='{$dia['ID_DiaPractica']}'> {$dia['DiaSemana']}<br>";
                }
            ?>
            <br>

            <h3>Fecha de Apertura de Inscripciones:</h3>
            <input class="input" type="date" name="FechaApertura" required>
            <br>

            <h3>Observaciones:</h3>
            <textarea class="input" name="Observacion" rows="4" cols="50"></textarea>
            <br>
            <input class="btn" type="submit" value="Cargar">
            <h3><a href="./menuPracticasAdmin.php">Volver</a></h3>
        </form>
    </div>
</body>
</html>
