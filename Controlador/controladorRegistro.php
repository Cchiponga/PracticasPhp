<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/ProyectoPracticas3.2.0/Controlador/Admin/PHP/conexion.php';
$conexion = conexion();

if (!empty($_POST['registrarse'])) {

    if (empty($_POST["contraseña"]) || empty($_POST["DNI"]) || empty($_POST["Apellido"]) || empty($_POST["Nombre"]) || empty($_POST["FechaNacimiento"]) || empty($_POST["Email"]) || empty($_POST["Telefono"]) || empty($_POST["Genero"])) {
        echo '<script>alert("Alguno de los campos está vacío o es erróneo");</script>';
    } else {
        $contraseña = $_POST['contraseña'];
        $DNI = $_POST['DNI'];
        $Apellido = $_POST['Apellido'];
        $Nombre = $_POST['Nombre'];
        $FechaNacimiento = $_POST['FechaNacimiento'];
        $Email = $_POST['Email'];
        $Telefono = $_POST['Telefono'];
        $Genero = $_POST['Genero'];
        $Carreras = $_POST['carrera'];

        // Verificar si el usuario ya existe
        $checkUser = mysqli_query($conexion, "SELECT * FROM usuarios WHERE Usuario='$DNI'");
        
        if (mysqli_num_rows($checkUser) > 0) {
            echo '<script>alert("El usuario ya está registrado.");</script>';
        } else {
            // Insertar en la tabla usuarios
            $sql = mysqli_query($conexion, "INSERT INTO usuarios(Usuario, Contraseña,Email,idCargo) VALUES('$DNI', '$contraseña','$Email', 3)");

            $idUsuario = mysqli_insert_id($conexion);

            if ($idUsuario) {
                // Insertar en la tabla alumno
                $sqlDatos = mysqli_query($conexion, "INSERT INTO alumno(DNI, Apellido, Nombre, FechaNacimiento, Telefono, Genero, ID_Usuario) 
                VALUES('$DNI', '$Apellido', '$Nombre', '$FechaNacimiento', '$Telefono', '$Genero', '$idUsuario')") 
                or die("Problemas en el INSERT ".mysqli_error($conexion));

                // Insertar en alumnoscarrera
                foreach ($Carreras as $carrera) {
                    $sql3 = "INSERT INTO alumnoscarrera(ID_Usuario, ID_Carrera) VALUES('$idUsuario', '$carrera')";
                    $resul3 = $conexion->query($sql3);
                    if (!$resul3) {
                        $errorMessage = "Error al insertar en alumnoscarrera: " . $conexion->error;
                        echo '<script>alert("'.$errorMessage.'");</script>';
                        break;
                    }
                }

                if ($sqlDatos) {
                    echo '<script type="text/javascript">
                            alert("Usuario creado con éxito");
                            window.location.href="../index.php";
                          </script>';
                    exit;
                } else {
                    echo 'Problemas al insertar los datos del alumno.';
                }
            } else {
                echo 'Problemas al insertar el usuario.';
            }
        }
    }
}
?>
