// Establecer la fecha máxima en el campo de fecha de nacimiento
window.addEventListener('load', function() {
    const fechaActual = new Date();
    const dia = String(fechaActual.getDate()).padStart(2, '0');
    const mes = String(fechaActual.getMonth() + 1).padStart(2, '0'); // Los meses comienzan desde 0
    const año = fechaActual.getFullYear();
    
    // Asignar la fecha máxima como hoy
    document.getElementById('fechaNacimiento').max = `${año}-${mes}-${dia}`;
});

// Validación adicional de fecha para evitar fechas en el futuro
document.getElementById('crearProfesorForm').addEventListener('submit', function(event) {
    const fechaNacimiento = document.getElementById('fechaNacimiento').value;
    console.log("Fecha de nacimiento seleccionada: " + fechaNacimiento);  // Debug

    const fechaNac = new Date(fechaNacimiento);
    const fechaActual = new Date();

    const edadMinima = 18;  // Asegurarse de que la edad mínima es de 18 años
    const edadMaxima = 100;

    let edadUsuario = fechaActual.getFullYear() - fechaNac.getFullYear();
    const mes = fechaActual.getMonth() - fechaNac.getMonth();

    if (mes < 0 || (mes === 0 && fechaActual.getDate() < fechaNac.getDate())) {
        edadUsuario--;
    }

    console.log("Edad del usuario: " + edadUsuario);  // Debug

    // Validar si la fecha es en el futuro
    if (fechaNac.getTime() > fechaActual.getTime()) {
        alert("La fecha de nacimiento no puede estar en el futuro.");
        event.preventDefault();
        return;
    }

    // Validar si la edad está dentro del rango permitido
    if (edadUsuario < edadMinima || edadUsuario > edadMaxima) {
        alert(`La edad debe estar entre ${edadMinima} y ${edadMaxima} años.`);
        event.preventDefault();
    }
});
