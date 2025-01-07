<?php 
// Conexión a la base de datos
require_once $_SERVER['DOCUMENT_ROOT'] . '/ProyectoPracticas3.2.0/Controlador/Admin/PHP/conexion.php';
$conexion=conexion();

if(!empty($_POST['registrarse'])) {

    // Verificar si algún campo está vacío
    if(empty($_POST["contraseña"]) || empty($_POST["DNI"]) || empty($_POST["Apellido"]) || empty($_POST["Nombre"]) || empty($_POST["fecha_nacimiento"]) || empty($_POST["Email"]) || empty($_POST["Telefono"]) || !isset($_POST["Genero"]) || empty($_POST["carrera"])) {
        echo "<script>alert('Alguno de los campos está vacío o es erróneo');</script>";
    } else {
        // Asignar valores de formulario a variables
        $contraseña = $_POST['contraseña'];
        $DNI = $_POST['DNI'];
        $Apellido = $_POST['Apellido'];
        $Nombre = $_POST['Nombre'];
        $FechaNacimiento = $_POST['fecha_nacimiento'];
        $Email = $_POST['Email'];
        $Telefono = $_POST['Telefono'];
        $Genero = $_POST['Genero'];  // Género ya está confirmado que no está vacío
        $Carreras = $_POST['carrera']; // Carreras seleccionadas por el usuario

        // Verificar si el usuario ya está registrado
        $checkUser = mysqli_query($conexion, "SELECT * FROM usuarios WHERE Usuario='$DNI'");
        
        if(mysqli_num_rows($checkUser) > 0) {
            echo "<script>alert('El usuario ya está registrado.');</script>";
        } else {
            // Insertar datos en la tabla usuarios
            $sql = mysqli_query($conexion, "INSERT INTO usuarios(Usuario, Contraseña,Email,idCargo) VALUES('$DNI', '$contraseña','$Email', 3)");

            // Obtener el ID del usuario insertado
            $idUsuario = mysqli_insert_id($conexion);

            if($idUsuario) {
                // Insertar los datos del alumno
                $sqlDatos = mysqli_query($conexion, "INSERT INTO alumno(DNI, Apellido, Nombre, FechaNacimiento,Telefono, Genero, ID_Usuario) VALUES('$DNI', '$Apellido', '$Nombre', '$FechaNacimiento','$Telefono', '$Genero', '$idUsuario')") 
                or die("Problemas en el INSERT ".mysqli_error($conexion));        
                
                // Insertar carreras seleccionadas en la tabla alumnoscarrera
                foreach ($Carreras as $carrera) {
                    $sql3 = "INSERT INTO alumnoscarrera(ID_Usuario, ID_Carrera) VALUES('$idUsuario', '$carrera')";
                    $resul3 = $conexion->query($sql3);
                    if (!$resul3) {
                        $errorMessage = "Error al insertar en alumnoscarrera: " . $conexion->error;
                        echo "<script>alert('$errorMessage');</script>";
                        break;
                    }
                }

                // Verificar si la inserción fue exitosa
                if($sqlDatos) {
                    echo '<script type="text/javascript">
                            alert("Usuario creado con éxito");
                            window.location.href="../../Modelo/Admin/menuAlumnosAdmin.php";
                          </script>';
                    exit;
                } else {
                    echo "<script>alert('Problemas al insertar los datos del alumno.');</script>";
                }

            } else {
                echo "<script>alert('Problemas al insertar el usuario.');</script>";
            }
        }
    }
}
?>
