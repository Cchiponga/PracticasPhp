<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ProyectoPracticas3.2.0/Controlador/Admin/PHP/conexion.php';
$conexion=conexion();

// Inicializar variable de filtro
$dni_filtro = '';

// Verificar si se ha enviado el formulario con un filtro de DNI
if (isset($_GET['dni']) && !empty($_GET['dni'])) {
    $dni_filtro = $_GET['dni'];
}

// Consulta SQL, filtrando por DNI si se ha ingresado
$sql = "SELECT a.ID_Alumno AS ID_Alumno,
               a.DNI,
               a.Apellido,
               a.Nombre,
               a.FechaNacimiento AS 'Fecha de nacimiento',
               a.Telefono,
               a.Genero,
               g.Sexo,
               u.ID_Usuario,
               u.Usuario,
               u.Contraseña,
               u.Email
        FROM alumno a
        JOIN usuarios u ON a.ID_Usuario = u.ID_Usuario
        JOIN sexo g ON a.Genero = g.ID_Sexo";

// Añadir filtro de DNI si está presente
if (!empty($dni_filtro)) {
    $sql .= " WHERE a.DNI = '$dni_filtro'";
}

$result = $conexion->query($sql);

// Verificar si hay resultados y almacenarlos en un array
$data = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Cerrar conexión
$conexion->close();
?>

