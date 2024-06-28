<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Evento</title>
    <link rel="stylesheet" href="css/editeven.css">
</head>
<body>
    <?php
    // Verificar si se ha proporcionado un ID de evento válido en la URL
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        // Obtener el ID del evento de la URL
        $evento_id = $_GET['id'];

        // Incluir el archivo de conexión
        include 'conexion.php';

        // Conexión a la base de datos
        $conn = conectar(); // Llama a la función conectar() para obtener la instancia de conexión

        // Verificar si se encontró el evento
        $sql = "SELECT * FROM eventos WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $evento_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            ?>
            <h2>Editar Evento</h2>
            <form action="guardar_edicion.php" method="POST">
                <input type="hidden" name="evento_id" value="<?php echo $evento_id; ?>">
                <label for="nombre_evento">Nombre del Evento:</label><br>
                <input type="text" id="nombre_evento" name="nombre_evento" value="<?php echo $row['nombre']; ?>" pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+" title="Solo letras y espacios permitidos" required><br>


                <label for="fecha">Fecha:</label><br>
                <input type="date" id="fecha" name="fecha" value="<?php echo date('Y-m-d', strtotime('+5 days')); ?>" min="<?php echo date('Y-m-d', strtotime('+5 days')); ?>" required><br>


                <label for="horaInicio">Hora de Inicio:</label><br>
                <input type="time" id="horaInicio" name="horaInicio" value="<?php echo $row['horaInicio']; ?>" required min="08:00" max="17:00"><br>


                <label for="horaFin">Hora de Fin:</label><br>
                <input type="time" id="horaFin" name="horaFin" value="<?php echo $row['horaFin']; ?>" required min="08:00" max="17:00"><br>


                <label for="montoMinimo">Monto Mínimo:</label><br>
                <input type="number" id="montoMinimo" name="montoMinimo" min="0" step="0.01" value="<?php echo $row['montoMinimo']; ?>" required><br>

                <label for="montoMaximo">Monto Máximo:</label><br>
                <input type="number" id="montoMaximo" name="montoMaximo" min="0" step="0.01" value="<?php echo $row['montoMaximo']; ?>" required><br>

                <button type="submit">Guardar</button>
            </form>
            <?php
        } else {
            echo "No se encontró el evento.";
        }

        // Cerrar conexión
        $stmt->close();
        $conn->close();
    } else {
        echo "ID de evento no proporcionado.";
    }
    ?>
</body>
</html>