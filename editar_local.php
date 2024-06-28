<?php
// Verificar si se ha proporcionado un ID de local en la URL
if (!isset($_GET['id'])) {
    header("Location: nuestros_locales.php");
    exit();
}

// Incluir la conexión a la base de datos
include 'conexion.php';
$conn = conectar();

// Obtener el ID del local de la URL
$id_local = $_GET['id'];

// Definir una variable para el mensaje de actualización
$mensaje = "";

// Verificar si se ha enviado el formulario de edición
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar los datos del formulario
    $nombre_nuevo = $_POST['nombre'];
    $direccion_nueva = $_POST['direccion'];
    $horario_nuevo = $_POST['horario'];

    // Actualizar los datos del local en la base de datos
    $sql = "UPDATE cafetines SET nombre='$nombre_nuevo', direccion='$direccion_nueva', horario='$horario_nuevo' WHERE id=$id_local";
    if ($conn->query($sql) === TRUE) {
        // Redirigir al usuario de vuelta a la página principal si la actualización fue exitosa
        header("Location: nuestros_locales.php");
        exit();
    } else {
        // Mostrar un mensaje de error si la actualización falló
        $mensaje = "Error al actualizar el local: " . $conn->error;
    }
}

// Consulta para obtener los datos del local actual
$sql = "SELECT * FROM cafetines WHERE id=$id_local";
$resultado = $conn->query($sql);

// Verificar si se encontró el local
if ($resultado->num_rows == 1) {
    // Obtener los datos del local actual
    $fila = $resultado->fetch_assoc();
    $nombre_actual = $fila['nombre'];
    $direccion_actual = $fila['direccion'];
    $horario_actual = $fila['horario'];
} else {
    // Si no se encuentra el local, redirigir de vuelta a la página principal
    header("Location: nuestros_locales.php");
    exit();
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Local</title>
    <link rel="stylesheet" href="css/editlocal.css">
    
</head>
<body>
    <div class="container">
        <h1>Editar Local</h1>
        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $id_local); ?>">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $nombre_actual; ?>" required class="form-control">
            </div>

            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección:</label>
                <input type="text" id="direccion" name="direccion" value="<?php echo $direccion_actual; ?>" required class="form-control">
            </div>

            <div class="mb-3">
                <label for="horario" class="form-label">Horario:</label>
                <input type="text" id="horario" name="horario" value="<?php echo $horario_actual; ?>" required class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>
</body>
</html>

