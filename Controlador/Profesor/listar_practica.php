<?php
// Conexión a la base de datos
require_once $_SERVER['DOCUMENT_ROOT'] . '/ProyectoPracticas3.2.0/Controlador/Admin/PHP/conexion.php';
$conexion = conexion();

// Verificar que el usuario esté logueado
session_start();
if (!isset($_SESSION['ID_Usuario'])) {
    die("El usuario no está logueado.");
}

$ID_Usuario = $_SESSION['ID_Usuario'];

// Obtener el ID_Profesor asociado al ID_Usuario
$sqlProfesor = "SELECT ID_Profesores FROM profesores WHERE ID_Usuario = ?";
$stmtProfesor = $conexion->prepare($sqlProfesor);
$stmtProfesor->bind_param("i", $ID_Usuario);
$stmtProfesor->execute();
$resultProfesor = $stmtProfesor->get_result();

if ($resultProfesor->num_rows === 0) {
    die("No se encontró un profesor asociado a este usuario.");
}

$rowProfesor = $resultProfesor->fetch_assoc();
$ID_Profesores = $rowProfesor['ID_Profesores'];

// Consulta para obtener todas las prácticas asociadas al profesor logueado, incluyendo la columna de Observaciones
$sql = "SELECT p.ID_Practica, p.Practica, p.Lugar, p.HorarioInicio, p.HorarioFinal, p.Vacantes,p.Fecha_apertura,p.Observacion, 
               prof.Nombre AS Profesor, 
               carr.Carrera AS Carrera, 
               mat.Materia AS Materia
        FROM practicas p
        INNER JOIN profesores prof ON p.ID_Profesores = prof.ID_Profesores
        INNER JOIN carreras carr ON p.ID_Carrera = carr.ID_Carrera
        INNER JOIN materias mat ON p.ID_Materias = mat.ID_Materias
        WHERE p.ID_Profesores = ?";  // Filtrar por el ID del profesor

$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $ID_Profesores); // Enlazar el ID del profesor

// Ejecutar la consulta
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    // Comenzar a construir la tabla
    echo "
    <table class='tablaAdmin'>
        <thead>
            <tr>
                <th>Práctica</th>
                <th>Lugar</th>
                <th>Horario Inicio</th>
                <th>Horario Final</th>
                <th>Vacantes</th>
                <th>Carrera</th>
                <th>Materia</th>
                <th>Día de la Práctica</th>
                <th>Fecha Apertura</th>
                <th>Observaciones</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
    ";

    // Almacenar los resultados
    while ($row = $resultado->fetch_assoc()) {
        // Obtener los días de la práctica
        $idPractica = $row['ID_Practica'];
        $diasQuery = "SELECT DiaSemana FROM diaPractica
                      JOIN practicaDia ON diaPractica.ID_DiaPractica = practicaDia.ID_DiaPractica
                      WHERE practicaDia.ID_Practica = ?";
        
        $stmtDias = $conexion->prepare($diasQuery);
        $stmtDias->bind_param("i", $idPractica);
        $stmtDias->execute();
        $diasResult = $stmtDias->get_result();
        
        $dias = [];
        while ($diaRow = $diasResult->fetch_assoc()) {
            $dias[] = $diaRow['DiaSemana'];
        }
        $row['DiaPractica'] = implode(', ', $dias);

        // Mostrar cada fila de la práctica
        echo "
        <tr>
            <td>{$row['Practica']}</td>
            <td>{$row['Lugar']}</td>
            <td>{$row['HorarioInicio']}</td>
            <td>{$row['HorarioFinal']}</td>
            <td>{$row['Vacantes']}</td>
            <td>{$row['Carrera']}</td>
            <td>{$row['Materia']}</td>
            <td>{$row['DiaPractica']}</td>
            <td>{$row['Fecha_apertura']}</td>
            <td class='observaciones'><div class='scrollable'>{$row['Observacion']}</div></td> 
            <td>
                <a class='boton' href='./editarPractica.php?id={$row['ID_Practica']}'>Editar</a>
                <br>
                <br>
                <a class='boton' href='./menuInscriptos.php?id={$row['ID_Practica']}'>Inscriptos</a>
                <br>
                <br>
            </td>
          
        </tr>
        
        ";
    }

    echo "</tbody></table>";  // Cerrar la tabla
} else {
    echo "<p>No hay prácticas disponibles para este profesor.</p>";
}

// Cerrar la conexión
mysqli_close($conexion);
?>
