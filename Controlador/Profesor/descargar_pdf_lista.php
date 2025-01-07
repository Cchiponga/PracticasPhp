<?php
require('../fpdf/fpdf.php');

// Conexión a la base de datos
require_once '../Admin/PHP/conexion.php';
$conexion=conexion();

$idPractica = intval($_POST['idPractica']);

// Consulta para obtener los alumnos inscritos en la práctica
$sql = "SELECT u.DNI,u.Nombre, u.Apellido, c.Carrera, m.Materia, i.fechaInscripcion 
        FROM inscripcion i
        INNER JOIN alumno u ON i.ID_Usuario = u.ID_Usuario
        INNER JOIN carreras c ON i.ID_Carrera = c.ID_Carrera
        INNER JOIN materias m ON i.ID_Materias = m.ID_Materias
        WHERE i.ID_Practica = ?";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $idPractica);
$stmt->execute();
$resultado = $stmt->get_result();

// Crear el PDF usando FPDF
class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 12); 
        $this->Cell(0, 10, utf8_decode('Instituto Superior de Formacion Tecnica ISFT N° 182'), 0, 1, 'C');
        $this->Cell(0, 10, utf8_decode('Alumnos Inscriptos en la Práctica'), 0, 1, 'C');
        $this->Ln(6);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo(), 0, 0, 'C');
    }

    function TablaInscriptos($header, $data)
    {
        // Ajustamos los anchos de las columnas
        $w = array(20,20,20,50,35,40); // Aquí ajusté los anchos

        // Cabecera
        $this->SetFont('Arial', 'B', 9); 
        for ($i = 0; $i < count($header); $i++) {
            $this->Cell($w[$i], 6, utf8_decode($header[$i]), 1, 0, 'C');
        }
        $this->Ln();

        // Datos
        $this->SetFont('Arial', '', 8); 
        foreach ($data as $row) {
            $this->Cell($w[0], 6, utf8_decode($row['DNI']), 1);
            $this->Cell($w[1], 6, utf8_decode($row['Nombre']), 1);
            $this->Cell($w[2], 6, utf8_decode($row['Apellido']), 1);
            $this->Cell($w[3], 6, utf8_decode($row['Carrera']), 1);
            $this->Cell($w[4], 6, utf8_decode($row['Materia']), 1);
            $this->Cell($w[5], 6, utf8_decode($row['fechaInscripcion']), 1);
            $this->Ln();
        }
    }
}

// Crear instancia de PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

// Títulos de las columnas
$header = array('DNI','Nombre', 'Apellido', 'Carrera', 'Materia', 'Fecha Inscripción');

// Datos de los alumnos
$data = [];
while ($row = $resultado->fetch_assoc()) {
    $data[] = $row;
}

// Generar la tabla
$pdf->TablaInscriptos($header, $data);

// Cerrar la conexión a la base de datos
mysqli_close($conexion);

// Descargar el archivo PDF
$pdf->Output('D', 'alumnos_inscriptos.pdf');
?>
