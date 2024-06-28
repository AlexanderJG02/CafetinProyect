<?php
include 'conexion.php';

// Conexión a la base de datos
$conn = conectar(); // Llama a la función conectar()

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Eventos</title>
    <link rel="stylesheet" href="css/tablaeven.css">
</head>
<body>
    <h2>Tabla de Eventos</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Fecha</th>
            <th>Hora de Inicio</th>
            <th>Hora de Fin</th>
            <th>Monto Mínimo</th>
            <th>Monto Máximo</th>
            <th>Acciones</th>
        </tr>
        <?php
        // Consulta SQL para seleccionar todos los registros de la tabla eventos
        $sql = "SELECT * FROM eventos";
        $result = $conn->query($sql);

        // Verificar si hay resultados
        if ($result->num_rows > 0) {
            // Iterar sobre los resultados y mostrar cada fila en la tabla
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["nombre"] . "</td>";
                echo "<td>" . $row["fecha"] . "</td>";
                echo "<td>" . $row["horaInicio"] . "</td>";
                echo "<td>" . $row["horaFin"] . "</td>";
                echo "<td>" . $row["montoMinimo"] . "</td>";
                echo "<td>" . $row["montoMaximo"] . "</td>";
                echo "<td>";
                echo "<a href='editar_evento.php?id=" . $row["id"] . "'>Editar</a> | ";
                echo "<a href='eliminar_evento.php?id=" . $row["id"] . "' onclick='return confirm(\"¿Estás seguro de eliminar este evento?\")'>Eliminar</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No hay eventos registrados.</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
// Cerrar conexión
$conn->close();
?>
