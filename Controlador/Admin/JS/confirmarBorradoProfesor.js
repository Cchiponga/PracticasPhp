function confirmDelete(usuarioId, profesorId) {
    // Mostrar una ventana de confirmación
    if (confirm("¿Estás seguro de que quieres borrar este profesor?")) {
        // Redirigir al controlador de borrado con los IDs como parámetros
        window.location.href = `../../Controlador/Admin/PHP/borrar_profesor.php?id=${usuarioId}&profesorId=${profesorId}`;
    }
}