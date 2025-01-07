    document.getElementById('crearProfesorForm').addEventListener('submit', function (event) {
        // Obtener todas las carreras seleccionadas
        const carrerasSeleccionadas = document.querySelectorAll('input[name="carrera[]"]:checked');
        
        // Obtener todos los años seleccionados
        const añosSeleccionados = document.querySelectorAll('input[name="años[]"]:checked');
        
        let errorMessage = '';
        
        // Verificar que se haya seleccionado al menos una carrera
        if (carrerasSeleccionadas.length === 0) {
            errorMessage += 'Debe seleccionar al menos una carrera.\n';
        }
        
        // Verificar que se haya seleccionado al menos un año
        if (añosSeleccionados.length === 0) {
            errorMessage += 'Debe seleccionar al menos un año.\n';
        }
        
        // Si hay errores, mostrar la alerta y prevenir el envío del formulario
        if (errorMessage) {
            alert(errorMessage);
            event.preventDefault(); // Evitar que el formulario se envíe
        }
    });
