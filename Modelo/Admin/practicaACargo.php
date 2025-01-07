<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="../../Vista/Imagenes/Logo.png">
    <link rel="stylesheet" type="text/css" href="../../Vista/Css/menuAdmin.css"/> 
    <title>Admin</title>
</head>
<body>

    <div class="container">
        <header>
            <h1>Practica a Cargo</h1>
        </header>
        <br>
        <a class="btn" href="./menuProfesoresAdmin.php" role="button">Volver</a>
        <br>
        <br>
        <table class="tablaAdmin">
            <thead>
                <tr>
                    <th>Practica</th>
                    <th>Lugar</th>
                    <th>Horario</th>
                    <th>Dia de la Practica</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../../Controlador/Admin/PHP/practica_a_cargo.php';

                foreach ($practicas as $row) {
                    echo "
                    <tr>
                        <td>{$row['Practica']}</td>
                        <td>{$row['Lugar']}</td>
                        <td>{$row['Horario']}</td>
                        <td>{$row['DiaPractica']}</td>
                    </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
        <br>
    </div>
</body>
</html>
