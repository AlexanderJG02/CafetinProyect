<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Evento</title>
    <link rel="stylesheet" href="css/guardar.css">
</head>
<body>
    <div class="container">
        <?php
        // Verificar si se ha proporcionado un ID de evento válido en la URL
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            // Obtener el ID del evento de la URL
            $evento_id = $_GET['id'];

            // Incluir el archivo de conexión
            include 'conexion.php';

            // Conexión a la base de datos
            $conn = conectar();

            // Eliminar el evento de la base de datos
            $sql = "DELETE FROM eventos WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $evento_id);

            if ($stmt->execute()) {
                echo "<div class='success'>El evento ha sido eliminado correctamente.</div>";
            } else {
                echo "<div class='error'>Error al eliminar el evento: " . $stmt->error . "</div>";
            }

            // Cerrar conexión
            $stmt->close();
            $conn->close();
        } else {
            echo "<div class='error'>ID de evento no proporcionado.</div>";
        }
        ?>
        <a href="admin.php" class="btn-back">Regresar</a>
    </div>
</body>
</html>
