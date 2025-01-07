<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../../Vista/Imagenes/Logo.png">
    <link rel="stylesheet" type="text/css" href="../../Vista/Css/menuAdmin.css"/> 
    <title>Listado de Profesores</title>
</head>
<body class="bodyPractica">
    <div id="containerLista">
        <h1>Listado de Profesores</h1>

        <?php include '../../Controlador/Admin/PHP/menu_profesores_admin.php'; ?>
        <script src="../../Controlador/Admin/JS/confirmarBorradoProfesor.js"></script>

        <!-- Formulario de búsqueda por DNI -->
        <form method="GET" action="">
            <label for="dni">Buscar por DNI:</label>
            <input type="text" id="dni" name="dni" value="<?= htmlspecialchars($dni_filtro); ?>" placeholder="Introducir DNI">
            <input class='btnbuscar' type="submit" value="Buscar">
        </form>
        <br>
        <a class='btnCrear' href="./crearProfesor.php">Crear Profesor</a>
    </div>
    <div id="containerTabla">

    <?php if (!empty($data)): ?>
        <table class='tabla'>
            <tr>
                <th>ID_Profesor</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>DNI</th>
                <th>Fecha de nacimiento</th>
                <th>Celular</th>
                <th>Genero</th>
                <th>Usuario</th>
                <th>Contraseña</th>
                <th>EMail</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($data as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row["ID_Profesor"]); ?></td>
                    <td><?= htmlspecialchars($row["Nombre"]); ?></td>
                    <td><?= htmlspecialchars($row["Apellido"]); ?></td>
                    <td><?= htmlspecialchars($row["DNI"]); ?></td>
                    <td><?= htmlspecialchars($row["Fecha de nacimiento"]); ?></td>
                    <td><?= htmlspecialchars($row["Celular"]); ?></td>
                    <td><?= htmlspecialchars($row["Sexo"]); ?></td>
                    <td><?= htmlspecialchars($row["Usuario"]); ?></td>
                     <td><?= htmlspecialchars($row["Contraseña"]); ?></td>
                    <td><?= htmlspecialchars($row["Email"]); ?></td>                   
                    <td>
                        <a class='btnEditar' href='./editarProfesor.php?id=<?= $row["ID_Usuario"]; ?>'>Editar</a>
                        <a class='btnBorrar' href='#' onclick="confirmDelete(<?= $row['ID_Usuario']; ?>, <?= $row['ID_Profesor']; ?>)">Borrar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No se encontraron resultados.</p>
    <?php endif; ?>

    <a href="../../Vista/html/indexAdmin.html" class="volver">Volver</a>

</body>
</html>

