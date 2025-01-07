function confirmDelete(usuarioId) {
    // Mostrar una ventana de confirmación
    if (confirm("¿Estás seguro de que quieres borrar este alumno?")) {
        // Redirigir al controlador de borrado con los IDs como parámetros
        window.location.href = `../../Controlador/Admin/PHP/borrar_alumno.php?id=${usuarioId}`;
    }
}