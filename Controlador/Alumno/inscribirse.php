<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ProyectoPracticas3.2.0/Controlador/Admin/PHP/conexion.php';
    $conexion = conexion();
    $id_practica = isset($_GET['id_practica']) ? $_GET['id_practica'] : null;
    $id_usuario = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : null;

    if ($id_practica && $id_usuario) {
        // Comprobar la fecha de apertura
        $sqlFechaApertura = "SELECT fecha_apertura FROM practicas WHERE ID_Practica = $id_practica";
        $resultado_fecha = mysqli_query($conexion, $sqlFechaApertura);
        $fila_fecha = mysqli_fetch_assoc($resultado_fecha);
        $fecha_apertura = $fila_fecha['fecha_apertura'];

        // Validar si la fecha actual es mayor o igual a la fecha de apertura
        if (date('Y-m-d') < $fecha_apertura) {
            echo "<script>
                    alert('Las inscripciones para esta práctica aún no están abiertas.');
                    window.location.href = '../../Modelo/Alumno/indexAlumno.php';
                  </script>";
            exit;
        }

        // Resto del código para verificar carreras e inscripciones
        $sqlCarrera = "SELECT COUNT(*) AS total_carreras FROM alumnoscarrera WHERE ID_Usuario = $id_usuario";
        $resultado_carrera = mysqli_query($conexion, $sqlCarrera);
        $fila_carrera = mysqli_fetch_assoc($resultado_carrera);
        $total_carreras = $fila_carrera['total_carreras'];

        $sqlInscripciones = "SELECT COUNT(*) AS total_inscripciones FROM inscripcion WHERE ID_Usuario = $id_usuario";
        $resultado_inscripciones = mysqli_query($conexion, $sqlInscripciones);
        $fila_inscripciones = mysqli_fetch_assoc($resultado_inscripciones);
        $total_inscripciones = $fila_inscripciones['total_inscripciones'];

        if ($total_inscripciones >= $total_carreras) {
            echo "<script>
                    alert('Ya tienes inscripciones suficientes según tus carreras.');
                    window.location.href = '../../Modelo/Alumno/indexAlumno.php';
                  </script>";
            exit;
        }

        $consulta_carrera_materia = "
            SELECT p.ID_Carrera, p.ID_Materias, pa.ID_Año
            FROM practicas p
            JOIN profesores prof ON p.ID_Profesores = prof.ID_Profesores
            JOIN profeAño pa ON prof.ID_Profesores = pa.ID_Profesores
            WHERE p.ID_Practica = $id_practica
        ";
        
        $resultado_carrera_materia = mysqli_query($conexion, $consulta_carrera_materia);

        if ($fila_carrera_materia = mysqli_fetch_array($resultado_carrera_materia)) {
            $id_carrera = $fila_carrera_materia['ID_Carrera'];
            $id_materia = $fila_carrera_materia['ID_Materias'];
            $id_año = $fila_carrera_materia['ID_Año'];

            $consulta = "
                INSERT INTO inscripcion (ID_Usuario, ID_Carrera, ID_Materias, ID_Año, fechaInscripcion, ID_Practica)
                VALUES ($id_usuario, $id_carrera, $id_materia, $id_año, NOW(), $id_practica)
            ";

            mysqli_query($conexion, $consulta);

            echo "<script>
                    alert('Te has inscrito correctamente en la práctica.');
                    window.location.href = '../../Modelo/Alumno/indexAlumno.php';
                  </script>";
        } else {
            echo "<script>
                    alert('No se encontraron datos para la práctica seleccionada.');
                    window.location.href = '../../Modelo/Alumno/indexAlumno.php';
                  </script>";
        }
    } else {
        echo "<script>
                alert('Faltan datos requeridos para la inscripción.');
                window.location.href = '../../Modelo/Alumno/indexAlumno.php';
              </script>";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
