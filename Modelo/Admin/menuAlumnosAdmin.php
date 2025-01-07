<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../../Vista/Imagenes/Logo.png">
    <link rel="stylesheet" type="text/css" href="../../Vista/Css/menuAdmin.css"/> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Listado de Alumnos</title>
</head>
<body class="bodyPractica">
    <div id="containerLista">
        <h1>Listado de Alumnos</h1>
        <?php include '../../Controlador/Admin/PHP/menu_alumnos_admin.php'; ?>
        <script src="../../Controlador/Admin/JS/confirmarBorradoAlumno.js"></script>
        <form class='form' method="GET" action="">
            <label for="dni">Buscar por DNI:</label>
            <input type="text" id="dni" name="dni" value="<?= htmlspecialchars($dni_filtro); ?>" placeholder="Introducir DNI">
            <input class='btnbuscar' type="submit" value="Buscar">
        </form>
        <a class='btnCrear' href='./crearAlumno.php'>Crear Alumno</a>
        <br>
    </div>
    <div id="containerTabla">
    <!-- Aquí la tabla va justo debajo del formulario -->
    <?php if (!empty($data)): ?>
        <table class="tabla">
            <tr>
                <th>DNI</th>
                <th>Apellido</th>
                <th>Nombre</th>
                <th>Fecha de nacimiento</th>
                <th>Telefono</th>
                <th>Genero</th>
                <th>ID_Usuario</th>
                <th>Usuario</th>
                <th>Contraseña</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($data as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row["DNI"]); ?></td>
                    <td><?= htmlspecialchars($row["Apellido"]); ?></td>
                    <td><?= htmlspecialchars($row["Nombre"]); ?></td>
                    <td><?= htmlspecialchars($row["Fecha de nacimiento"]); ?></td>
                    <td><?= htmlspecialchars($row["Telefono"]); ?></td>
                    <td><?= htmlspecialchars($row["Sexo"]); ?></td>
                    <td><?= htmlspecialchars($row["ID_Usuario"]); ?></td>
                    <td><?= htmlspecialchars($row["Usuario"]); ?></td>
                    <td><?= htmlspecialchars($row["Contraseña"]); ?></td>
                    <td><?= htmlspecialchars($row["Email"]); ?></td>
                    <td> 
                        <a class='btnEditar' href='./editarAlumno.php?id=<?= $row["ID_Usuario"]; ?>'>Editar</a>
                        <a class='btnBorrar' href='#' onclick="confirmDelete(<?= $row['ID_Usuario']; ?>)">Borrar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No se encontraron resultados.</p>
    <?php endif; ?>

    <a href="../../Vista/html/indexAdmin.html" class="volver">Volver</a>
    <div>
</body>
</html>
