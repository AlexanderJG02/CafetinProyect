<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Usuario</title>
    <link rel="stylesheet" href="css/actualizar.css">
</head>
<body>
    <?php
    // Incluir el archivo de conexión a la base de datos
    include 'conexion.php';

    // Verificar si se recibió el formulario de actualización
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los datos del formulario
        $id = $_POST["id"];
        $nombre = $_POST["nombre"];
        $rol = $_POST["rol"];

        // Conexión a la base de datos
        $conn = conectar();

        // Preparar la consulta SQL para actualizar los datos del usuario
        $sql = "UPDATE usuarios SET nombre='$nombre', rol='$rol' WHERE id=$id";

        // Ejecutar la consulta SQL
        if ($conn->query($sql) === TRUE) {
            // Mostrar un mensaje de éxito
            echo "<div class='container'>";
            echo "<a href='listar.php' class='btn-regresar'>Regresar</a>";
            echo "<div class='mensaje'>Cambios modificados correctamente.</div>";
            echo "</div>";
        } else {
            // Mostrar un mensaje de error si la consulta falla
            echo "<div class='container'>";
            echo "<a href='listar.php' class='btn-regresar'>Regresar</a>";
            echo "<div class='mensaje'>Error al actualizar el usuario: " . $conn->error . "</div>";
            echo "</div>";
        }

        // Cerrar conexión
        $conn->close();
    } else {
        // Si no se recibió el formulario de actualización, redirigir a una página de error
        header("Location: error.php");
        exit();
    }
    ?>
</body>
</html>
