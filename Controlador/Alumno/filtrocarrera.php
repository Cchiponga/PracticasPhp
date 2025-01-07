<?php
session_start(); // Iniciar la sesión si aún no lo has hecho

// Obtener el idCarrera de la sesión
$idCarreraAlumno = $_SESSION['idCarrera'];

// Conectar a la base de datos
require_once $_SERVER['DOCUMENT_ROOT'] . '/ProyectoPracticas3.2.0/Controlador/Admin/PHP/conexion.php';
$conexion=conexion();
// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Consulta para obtener las materias solo del IDCarrera correspondiente
$sql = "SELECT * FROM materias WHERE idCarrera = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $idCarreraAlumno);
$stmt->execute();
$result = $stmt->get_result();

// Mostrar las materias en un formulario
echo "<form>";
while ($row = $result->fetch_assoc()) {
    echo "<input type='checkbox' name='materias[]' value='" . $row['idMateria'] . "'>" . $row['nombreMateria'] . "<br>";
}
echo "</form>";

$stmt->close();
$conn->close();
?>