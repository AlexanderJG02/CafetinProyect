<?php
include 'conexion.php';

// Conexión a la base de datos
$conn = conectar(); // Llama a la función conectar()

// Función para limpiar los datos del formulario
function limpiarDatos($datos) {
    $datos = trim($datos);
    $datos = stripslashes($datos);
    $datos = htmlspecialchars($datos);
    return $datos;
}

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario y limpiarlos
    $nombre_evento = limpiarDatos($_POST['nombre_evento']);
    $fecha = limpiarDatos($_POST['fecha']);
    $horaInicio = limpiarDatos($_POST['horaInicio']);
    $horaFin = limpiarDatos($_POST['horaFin']);
    $montoMinimo = limpiarDatos($_POST['montoMinimo']);
    $montoMaximo = limpiarDatos($_POST['montoMaximo']);

    // Preparar la consulta SQL utilizando consultas preparadas
    $sql = "INSERT INTO eventos (nombre, fecha, horaInicio, horaFin, montoMinimo, montoMaximo) VALUES (?, ?, ?, ?, ?, ?)";

    // Preparar la declaración
    $stmt = $conn->prepare($sql);

    // Vincular parámetros
    $stmt->bind_param("ssssdd", $nombre_evento, $fecha, $horaInicio, $horaFin, $montoMinimo, $montoMaximo);

    // Ejecutar la declaración
    if ($stmt->execute()) {
        echo "<script>alert('Se ha guardado el evento con éxito');</script>";
        // Restablecer los valores del formulario
        echo "<script>document.getElementById('eventoForm').reset();</script>";
    } else {
        echo "Error al guardar el evento: " . $stmt->error;
    }

    // Cerrar la declaración
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Eventos Especiales</title>
    <link rel="stylesheet" href="css/eventos.css">
    <script src="https://kit.fontawesome.com/6596fae3b7.js" crossorigin="anonymous"></script>
</head>
<body>
    <h2>Formulario de Eventos Especiales</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" id="eventoForm">
        <fieldset>
           <legend><i class="fa-regular fa-clipboard"></i>Ingresar Evento Especial</legend>

           <label for="nombre_evento">Nombre del Evento:</label><br>
<input type="text" id="nombre_evento" name="nombre_evento" pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+" title="Solo letras y espacios permitidos" required><br>


<label for="fecha">Fecha:</label><br>
<input type="date" id="fecha" name="fecha" required min="<?php echo date('Y-m-d', strtotime('+5 days')); ?>"><br>

            
<label for="horaInicio">Hora de Inicio:</label><br>
<input type="time" id="horaInicio" name="horaInicio" required min="08:00" max="17:00"><br>


<label for="horaFin">Hora de Fin:</label><br>
<input type="time" id="horaFin" name="horaFin" required min="08:00" max="17:00"><br>


            <label for="montoMinimo">Monto Mínimo:</label><br>
            <input type="number" id="montoMinimo" name="montoMinimo" min="0" step="0.01" required><br>

            <label for="montoMaximo">Monto Máximo:</label><br>
            <input type="number" id="montoMaximo" name="montoMaximo" min="0" step="0.01" required><br>

            <button type="submit"><i class="fas fa-save"></i> Guardar</button>
            <button type="button" onclick="window.location.href='menu.php';"><i class="fas fa-times"></i> Regresar</button>
        </fieldset>
    </form>
</body>
</html>