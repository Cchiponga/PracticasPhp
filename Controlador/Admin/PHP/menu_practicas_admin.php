<?php
// Conexión a la base de datos
require_once $_SERVER['DOCUMENT_ROOT'] . '/ProyectoPracticas3.2.0/Controlador/Admin/PHP/conexion.php';
$conexion = conexion();

// Verificar si se ha seleccionado una carrera en el filtro
$carreraSeleccionada = isset($_GET['carrera']) ? $_GET['carrera'] : '';

// Consulta para obtener todas las prácticas, incluyendo la columna de Observaciones
$sql = "SELECT p.ID_Practica, p.Practica, p.Lugar, p.HorarioInicio, p.HorarioFinal, p.Vacantes,p.Fecha_apertura,p.Observacion, 
               prof.Nombre AS Profesor, 
               carr.Carrera AS Carrera, 
               mat.Materia AS Materia
        FROM practicas p
        INNER JOIN profesores prof ON p.ID_Profesores = prof.ID_Profesores
        INNER JOIN carreras carr ON p.ID_Carrera = carr.ID_Carrera
        INNER JOIN materias mat ON p.ID_Materias = mat.ID_Materias";

// Si se ha seleccionado una carrera, añadir un filtro a la consulta
if (!empty($carreraSeleccionada)) {
    $sql .= " WHERE p.ID_Carrera = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $carreraSeleccionada);
} else {
    $stmt = $conexion->prepare($sql);  // Preparar la consulta sin filtro si no hay carrera seleccionada
}

// Ejecutar la consulta
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    // Comenzar a construir la tabla
    echo "
    <table class='tabla'>
        <thead>
            <tr>
                <th>ID</th>
                <th>Práctica</th>
                <th>Lugar</th>
                <th>Horario Inicio</th>
                <th>Horario Final</th>
                <th>Vacantes</th>
                <th>Profesor</th>
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
            <td>{$row['ID_Practica']}</td>
            <td>{$row['Practica']}</td>
            <td>{$row['Lugar']}</td>
            <td>{$row['HorarioInicio']}</td>
            <td>{$row['HorarioFinal']}</td>
            <td>{$row['Vacantes']}</td>
            <td>{$row['Profesor']}</td>
            <td>{$row['Carrera']}</td>
            <td>{$row['Materia']}</td>
            <td>{$row['DiaPractica']}</td>
            <td>{$row['Fecha_apertura']}</td>
            <td class='observaciones'><div class='scrollable'>{$row['Observacion']}</div></td> 
            <td><a class='btnEditar' href='./editarPractica.php?id={$row['ID_Practica']}'>Editar</a>
            <a class='btnBorrar' href='#' onclick='confirmDelete({$row['ID_Practica']})'>Borrar</a></td>            
        </tr>
        ";
    }

    echo "</tbody></table>";  // Cerrar la tabla
} else {
    echo "<p>No hay prácticas disponibles para la carrera seleccionada.</p>";
}

// Cerrar la conexión
mysqli_close($conexion);
?>
