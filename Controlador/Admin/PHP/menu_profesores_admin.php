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
$sql = "SELECT p.ID_Profesores AS ID_Profesor,
               p.Nombre,
               p.Apellido,
               p.DNI,
               p.FechaNacimiento AS 'Fecha de nacimiento',
               p.celular AS Celular,
               p.Genero,
               g.Sexo,
               u.ID_Usuario,
               u.Usuario,
               u.Contraseña,
               u.Email
        FROM profesores p
        INNER JOIN usuarios u ON p.ID_Usuario = u.ID_Usuario
        JOIN sexo g ON p.Genero=g.ID_Sexo"; 

// Añadir filtro de DNI si está presente
if (!empty($dni_filtro)) {
    $sql .= " WHERE p.DNI = '$dni_filtro'";
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

