<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Usuarios</title>
    <link rel="stylesheet" href="css/listar.css">
</head>
<body>
    <?php
    $message = "";

    // Incluir el archivo de conexión a la base de datos
    include 'conexion.php';

    // Obtener la conexión a la base de datos
    $conn = conectar();

    // Verificar si se envió la solicitud para eliminar un usuario
    if (isset($_GET['delete_id'])) {
        $id = $_GET['delete_id'];
        $sql = "DELETE FROM usuarios WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            $message = "Usuario eliminado correctamente";
        } else {
            $message = "Error al eliminar el usuario: " . $conn->error;
        }
    }

    // Verificar si se envió la solicitud para dar de baja a un usuario
    if (isset($_GET['disable_id'])) {
        $id = $_GET['disable_id'];
        $sql = "UPDATE usuarios SET activo = 0 WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            $message = "Usuario dado de baja correctamente";
        } else {
            $message = "Error al dar de baja al usuario: " . $conn->error;
        }
    }
    ?>

    <h2>Usuarios</h2>
    <?php if ($message != "") { ?>
        <div style="background-color: <?php echo ($message == "Usuario eliminado correctamente" || $message == "Usuario dado de baja correctamente") ? "#dff0d8" : "#f2dede"; ?>; color: <?php echo ($message == "Usuario eliminado correctamente" || $message == "Usuario dado de baja correctamente") ? "#3c763d" : "#a94442"; ?>; padding: 10px; border-radius: 5px; margin-bottom: 10px;">
            <?php echo $message; ?>
        </div>
    <?php } ?>

    <button class="back-button" onclick="window.location.href='admin.php';"><i class="fas fa-arrow-left"></i> Regresar</button>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
        <?php
        // Consultar usuarios
        $sql = "SELECT * FROM usuarios";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["nombre"] . "</td>";
                echo "<td>" . $row["rol"] . "</td>";
                echo "<td>";
                if ($row["activo"] == 1) {
                    echo "<a href='editar.php?id=" . $row["id"] . "' class='btn btn-editar'>Editar</a> | ";
                    echo "<button class='btn btn-disable' onclick='confirmDisable(" . $row["id"] . ")'>Dar de baja</button> | ";
                }
                echo "<button class='btn btn-eliminar' onclick='confirmDelete(" . $row["id"] . ")'>Eliminar</button>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No se encontraron usuarios.</td></tr>";
        }

        // Cerrar conexión
        $conn->close();
        ?>
    </table>

    <script>
        function confirmDelete(id) {
            if (confirm("¿Estás seguro de que deseas eliminar este usuario?")) {
                window.location.href = "?delete_id=" + id;
            }
        }

        function confirmDisable(id) {
            if (confirm("¿Estás seguro de que deseas dar de baja a este usuario?")) {
                window.location.href = "?disable_id=" + id;
            }
        }
    </script>
</body>
</html>
