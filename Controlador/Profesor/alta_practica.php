<?php
// Conexión a la base de datos
require_once $_SERVER['DOCUMENT_ROOT'] . '/ProyectoPracticas3.2.0/Controlador/Admin/PHP/conexion.php';
$conexion = conexion();

// Obtener carreras
$carreras = [];
$registrosCarreras = mysqli_query($conexion, "SELECT ID_Carrera, Carrera FROM Carreras") or die("Problemas con el select: " . mysqli_error($conexion));
while ($reg = mysqli_fetch_array($registrosCarreras)) {
    $carreras[] = $reg;
}

// Obtener profesores
$profesores = [];
$registrosProfesores = mysqli_query($conexion, "SELECT ID_Profesores, Nombre, Apellido FROM Profesores") or die("Problemas con el select: " . mysqli_error($conexion));
while ($reg = mysqli_fetch_array($registrosProfesores)) {
    $profesores[] = $reg;
}

// Manejo del formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capturar datos del formulario
    $Practica = trim($_POST['Practica'] ?? '');
    $Lugar = trim($_POST['Lugar'] ?? '');
    $HorarioInicio = $_POST['HorarioInicio'] ?? '';
    $HorarioFinal = $_POST['HorarioFinal'] ?? '';
    $Vacantes = intval($_POST['Vacantes'] ?? 0);
    $ID_Profesores = intval($_POST['ID_Profesores'] ?? 0);
    $ID_Carrera = intval($_POST['ID_Carrera'] ?? 0);
    $ID_Materias = intval($_POST['ID_Materia'] ?? 0);
    $dias = array_map('intval', $_POST['dias'] ?? []); 
    $Observacion = trim($_POST['Observacion'] ?? '');
    $fecha_apertura = $_POST['FechaApertura'] ?? ''; // Corregido para coincidir con el nombre en el formulario

    // Validaciones
    $errores = [];

    if (empty($Practica)) {
        $errores[] = 'El campo "Práctica" es obligatorio.';
    }

    if (empty($Lugar)) {
        $errores[] = 'El campo "Lugar" es obligatorio.';
    }

    if (empty($HorarioInicio)) {
        $errores[] = 'El campo "Horario de Inicio" es obligatorio.';
    }

    if (empty($HorarioFinal)) {
        $errores[] = 'El campo "Horario Final" es obligatorio.';
    }

    if ($HorarioFinal <= $HorarioInicio) {
        $errores[] = 'El "Horario Final" no puede ser menor o igual que el "Horario de Inicio".';
    }

    if ($Vacantes <= 0) {
        $errores[] = 'El número de vacantes debe ser mayor a 0.';
    }

    if ($ID_Profesores === 0) {
        $errores[] = 'Selecciona un profesor válido.';
    }

    if ($ID_Carrera === 0) {
        $errores[] = 'Selecciona una carrera válida.';
    }

    if ($ID_Materias === 0) {
        $errores[] = 'Selecciona una materia válida.';
    }

    if (count($dias) === 0) {
        $errores[] = 'Debes seleccionar al menos un día para la práctica.';
    }

    if (empty($fecha_apertura)) {
        $errores[] = 'Debes seleccionar una fecha de apertura.';
    }

    // Mostrar errores si los hay
    if (!empty($errores)) {
        foreach ($errores as $error) {
            echo "<script>alert('$error');</script>";
        }
        exit(); // Detener la ejecución si hay errores
    }

   

    // Si todo está correcto, continuar con la inserción
    $insertarPractica = "
        INSERT INTO practicas (Practica, Lugar, HorarioInicio, HorarioFinal, Vacantes, ID_Profesores, ID_Carrera, ID_Materias, Observacion, Fecha_apertura) 
        VALUES ('$Practica', '$Lugar', '$HorarioInicio', '$HorarioFinal', $Vacantes, $ID_Profesores, $ID_Carrera, $ID_Materias, '$Observacion', '$fecha_apertura')";
    
    $stmtPractica = mysqli_prepare($conexion, $insertarPractica);
    if ($stmtPractica && mysqli_stmt_execute($stmtPractica)) {
        $ID_Practica = mysqli_insert_id($conexion); // Obtener el ID de la práctica recién insertada

        // Insertar en la tabla practicaDia
        foreach ($dias as $ID_DiaPractica) {
            $insertarDia = "INSERT INTO practicaDia (ID_Profesores, ID_Practica, ID_DiaPractica) 
                            VALUES ($ID_Profesores, $ID_Practica, $ID_DiaPractica)";
            $stmtDia = mysqli_prepare($conexion, $insertarDia);
            if ($stmtDia) {
                mysqli_stmt_execute($stmtDia);
            }
        }

        // Cerrar conexión y redirigir
        mysqli_close($conexion);
        echo '<script type="text/javascript">alert("Alta realizada con éxito"); window.location.href="../../Modelo/Profesor/listarPracticas.php";</script>';
    } else {
        echo '<script type="text/javascript">alert("Error en la inserción de la práctica.");</script>';
    }
    exit();
}
?>
