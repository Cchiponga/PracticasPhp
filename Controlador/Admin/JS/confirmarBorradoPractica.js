function confirmDelete(practicaId) {
    if (confirm("¿Estás seguro de que quieres borrar esta practica?")) {
        // Redirigir al controlador de borrado con los IDs como parámetros
        window.location.href = `../../Controlador/Admin/PHP/borrar_practica.php?id=${practicaId}`;
    }
}