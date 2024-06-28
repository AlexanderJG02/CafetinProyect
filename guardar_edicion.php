<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Evento</title>
    <link rel="stylesheet" href="css/guardar.css">
</head>
<body>
    <div class="container">
        <?php
        include 'conexion.php';

        // Verificar si se han enviado los datos del formulario
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Verificar si se han recibido los datos necesarios del formulario
            if (isset($_POST['evento_id']) && isset($_POST['nombre_evento']) && isset($_POST['fecha']) && isset($_POST['horaInicio']) && isset($_POST['horaFin']) && isset($_POST['montoMinimo']) && isset($_POST['montoMaximo'])) {
                // Obtener los datos del formulario
                $evento_id = $_POST['evento_id'];
                $nombre_evento = $_POST['nombre_evento'];
                $fecha = $_POST['fecha'];
                $horaInicio = $_POST['horaInicio'];
                $horaFin = $_POST['horaFin'];
                $montoMinimo = $_POST['montoMinimo'];
                $montoMaximo = $_POST['montoMaximo'];

                // Conexión a la base de datos
                $conn = conectar(); 

                // Preparar la consulta SQL para actualizar los datos del evento
                $sql = "UPDATE eventos SET nombre = ?, fecha = ?, horaInicio = ?, horaFin = ?, montoMinimo = ?, montoMaximo = ? WHERE id = ?";

                // Preparar la declaración
                $stmt = $conn->prepare($sql);

                // Vincular parámetros
                $stmt->bind_param("ssssddi", $nombre_evento, $fecha, $horaInicio, $horaFin, $montoMinimo, $montoMaximo, $evento_id);

                // Ejecutar la declaración
                if ($stmt->execute()) {
                    echo "<div class='success'>Los datos del evento han sido actualizados correctamente.</div>";
                } else {
                    echo "<div class='error'>Error al actualizar los datos del evento: " . $stmt->error . "</div>";
                }

                // Cerrar la declaración y la conexión
                $stmt->close();
                $conn->close();
            } else {
                echo "<div class='error'>No se han recibido todos los datos necesarios del formulario.</div>";
            }
        } else {
            echo "<div class='error'>Los datos del formulario no han sido enviados correctamente.</div>";
        }
        ?>
        <a href="admin.php" class="btn-back">Regresar</a>
    </div>
</body>
</html>
