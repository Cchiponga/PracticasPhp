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
                }
            });
        });
