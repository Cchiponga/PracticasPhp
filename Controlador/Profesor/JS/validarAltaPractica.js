$(document).ready(function() {
    $('form').on('submit', function(event) {
        // Validación de selects
        var ID_Carrera = $('select[name="ID_Carrera"]').val();
        var ID_Materia = $('select[name="ID_Materia"]').val();
        var ID_Profesores = $('select[name="ID_Profesores"]').val();
        
        if (!ID_Carrera || !ID_Materia || !ID_Profesores) {
            alert('Por favor, selecciona una carrera, materia y profesor.');
            event.preventDefault();
            return;
        }
        
        // Validación de días seleccionados
        var diasSeleccionados = $('input[name="dias[]"]:checked').length;
        if (diasSeleccionados === 0) {
            alert('Por favor, selecciona al menos un día para la práctica.');
            event.preventDefault();
            return;
        }

        // Validación de horarios
        var horarioInicio = $('input[name="HorarioInicio"]').val();
        var horarioFinal = $('input[name="HorarioFinal"]').val();

        if (!horarioInicio || !horarioFinal) {
            alert('Por favor, ingresa ambos horarios: inicio y final.');
            event.preventDefault();
            return;
        }

        if (horarioFinal <= horarioInicio) {
            alert('El Horario Final no puede ser menor o igual al Horario Inicio.');
            event.preventDefault();
            return;
        }

        var start = new Date('1970-01-01T' + horarioInicio + 'Z');
        var end = new Date('1970-01-01T' + horarioFinal + 'Z');
        var diff = (end - start) / (1000 * 60 * 60); // Diferencia en horas

        if (diff > 4) {
            alert('La duración de la práctica no puede ser mayor a 4 horas.');
            event.preventDefault();
        }
    });
});

