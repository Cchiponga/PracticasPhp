function confirmDelete(usuarioId) {
    if (confirm("¿Estás seguro de que quieres borrar este alumno de la practica?")) {
        // Redirigir al controlador de borrado con los IDs como parámetros
        window.location.href = `../../Controlador/Profesor/borrar_inscriptos.php?id=${usuarioId}`;
    }
}