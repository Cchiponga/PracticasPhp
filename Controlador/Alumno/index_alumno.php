<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ProyectoPracticas3.2.0/Controlador/Admin/PHP/conexion.php';
$conexion = conexion();

$id_usuario = $_SESSION['ID_Usuario']; // ID del usuario logueado

$consulta = "SELECT 
    p.ID_Practica AS Id, 
    p.Practica AS Practica,
    CONCAT(prof.Nombre, ' ', prof.Apellido) AS Profesor, 
    p.Lugar AS Lugar, 
    CONCAT(p.HorarioInicio, ' - ', p.HorarioFinal) AS Horario, 
    GROUP_CONCAT(dp.DiaSemana ORDER BY dp.ID_DiaPractica SEPARATOR ', ') AS DiaPractica,
    p.Observacion AS Observacion,
    p.Vacantes AS Vacantes,
    c.Carrera AS Carrera, 
    p.Fecha_apertura AS FechaApertura 
FROM 
    practicas p
JOIN 
    profesores prof ON p.ID_Profesores = prof.ID_Profesores
JOIN 
    practicaDia pd ON p.ID_Practica = pd.ID_Practica
JOIN 
    diaPractica dp ON pd.ID_DiaPractica = dp.ID_DiaPractica
JOIN
    alumnosCarrera ac ON ac.ID_Carrera = p.ID_Carrera
JOIN
    carreras c ON ac.ID_Carrera = c.ID_Carrera 
WHERE 
    ac.ID_Usuario = '$id_usuario'
GROUP BY 
    p.ID_Practica, prof.Nombre, prof.Apellido, p.Lugar, p.HorarioInicio, p.HorarioFinal, p.Observacion, p.Vacantes, c.Carrera, p.Fecha_apertura;";

$resultado = mysqli_query($conexion, $consulta) or die("Problemas en el select: " . mysqli_error($conexion));

while ($fila = mysqli_fetch_array($resultado)) {
    echo "<tr>";
    echo "<td>{$fila['Practica']}</td>";
    echo "<td>{$fila['Profesor']}</td>";
    echo "<td>{$fila['Lugar']}</td>";
    echo "<td>{$fila['Horario']}</td>";
    echo "<td>{$fila['DiaPractica']}</td>";
    echo "<td class='observacion'>{$fila['Observacion']}</td>";
    echo "<td>{$fila['Vacantes']}</td>";
    echo "<td>{$fila['Carrera']}</td>";
    echo "<td>{$fila['FechaApertura']}</td>"; 
    echo "<td><a class='btnInscribirse' href='../../Controlador/Alumno/inscribirse.php?id_practica={$fila['Id']}&id_usuario={$id_usuario}'>Inscribirse</a></td>";
    echo "</tr>";
}


mysqli_close($conexion);
?>
