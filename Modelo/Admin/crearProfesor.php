<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="../../Vista/Imagenes/Logo.png">
    <link rel="stylesheet" type="text/css" href="../../Vista/Css/perfilUsuario.css"/>
    <title>Crear Profesor</title>
</head>
<body>
    <center>
        <div class='containerProfesor'>
            <h2>Nuevo Profesor</h2>
            <?php
            if (!empty($_GET['errorMessage'])) {
                $errorMessage = $_GET['errorMessage'];
                echo "
                    <div class='error' role='alert'>
                        <strong>$errorMessage</strong>
                        <button type='button' class='btn-error' aria-label='Cerrar'></button>
                    </div>
                ";
            } 
            ?>
            <form method="POST" action="../../Controlador/Admin/PHP/crear_profesor.php" id="crearProfesorForm">
                <div class="caja">
                    <div class="rowUsuario">
                        <label class="usuario">DNI/Usuario</label>
                        <div class="input">
                            <input type="text" name="dni" value="" required>
                        </div>
                    </div>

                    <div class="rowContraseña">
                        <label class="contra">Contraseña</label>
                        <div class="input">
                            <input type="password" name="contraseña" value="" required>
                        </div>  
                    </div>

                    <div class="rowApellido">
                        <label class="apellido">Apellido</label>
                        <div class="input">
                            <input type="text" name="apellido" value="" required>
                        </div>  
                    </div>

                    <div class="rowNombre">
                        <label class="nombre">Nombre</label>
                        <div class="input">
                            <input type="text" name="nombre" value="" required>
                        </div>  
                    </div>

                    <div class="rowFechaNacimiento">
                        <label class="fecha">Fecha de Nacimiento</label>
                        <div class="input">
                            <input type="date" id="fechaNacimiento" name="fecha_nacimiento" required>
                        </div>
                    </div>

                    <div class="rowCelular">
                        <label class="celular">Celular</label>
                        <div class="input">
                            <input type="text" name="celular" value="" required>
                        </div>
                    </div>

                    <div class="rowEmail">
                        <label class="email">Email</label>
                        <div class="input">
                            <input type="email" name="email" value="" required>
                        </div>
                    </div>

                    <div class="rowGenero">
                        <label class="genero">Género</label>
                        <div class="input">
                            <select  name="genero" required>
                                <option value=1>Masculino</option>
                                <option value=2>Femenino</option>
                                <option value=3>Otro</option>
                            </select>
                        </div>
                    </div>

                    <div class="listaCarrera">
                        <u><label class="titulo">Seleccionar Carreras</label></u>
                        <?php
                        require_once $_SERVER['DOCUMENT_ROOT'] . '/ProyectoPracticas3.2.0/Controlador/Admin/PHP/conexion.php';
                        $conexion = conexion();
                        $carreras = mysqli_query($conexion, "SELECT * FROM carreras");
                        while ($c = mysqli_fetch_array($carreras)) {
                            echo "<div class='checkbox-container'><span>{$c['Carrera']}</span><input type='checkbox' name='carrera[]' value='{$c['ID_Carrera']}'></div>";
                        }
                        ?>
                    </div>
                    <div class="checkbox">
                        <u><label class="titulo">Años</label></u>
                        <div class="checkbox-container"><span>Primer Año</span><input type="checkbox" name="años[]" value="1"></div>
                        <div class="checkbox-container"><span>Segundo Año</span><input type="checkbox" name="años[]" value="2"></div>
                        <div class="checkbox-container"><span>Tercer Año</span><input type="checkbox" name="años[]" value="3"></div>
                    </div>
                    <br>
                    <div class="btnact">
                        <div class="button">
                            <button type="submit" class="boton">Cargar</button>
                        </div>
                        <br>
                        <div class="cancelar">
                            <a href="../../Modelo/Admin/menuProfesoresAdmin.php" class="boton2" role="button">Atrás</a>
                        </div>
                        <br>
                    </div>
                </div>
            </form>
        </div>
    </center>

    <!-- Llamada al archivo JavaScript externo -->
    <script src="../../Controlador/Admin/JS/validarCrearProfesor.js"></script>
    <script src="../../Controlador/Admin/JS/validacionFechaNacimiento.js"></script>
</body>
</html>
