<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="css/editar.css">
</head>
<body>
    <div class="form-container">
        <h2>Editar Usuario</h2>
        <?php
        // Incluir el archivo de conexión a la base de datos
        include 'conexion.php';

        // Verificar si se recibió el parámetro 'id'
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Obtener la conexión a la base de datos
            $conn = conectar();

            // Consultar el usuario por su ID
            $sql = "SELECT * FROM usuarios WHERE id=$id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                ?>
                <form action="actualizar.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo $row['nombre']; ?>" required>
                    <label for="rol">Rol:</label>
                    <select id="rol" name="rol" required>
                        <option value="admin" <?php echo ($row['rol'] == 'admin') ? 'selected' : ''; ?>>Administrador</option>
                        <option value="docente" <?php echo ($row['rol'] == 'docente') ? 'selected' : ''; ?>>Docente</option>
                        <option value="estudiante" <?php echo ($row['rol'] == 'estudiante') ? 'selected' : ''; ?>>Estudiante</option>
                    </select>
                    <div class="form-buttons">
                        <input type="submit" value="Guardar Cambios">
                        <button type="button" class="btn-cancelar" onclick="window.history.back();"><i class="fas fa-times"></i> Cancelar</button>
                    </div>
                </form>
                <?php
            } else {
                echo "<p>No se encontró ningún usuario con ese ID.</p>";
            }

            // Cerrar conexión
            $conn->close();
        } else {
            echo "<p>No se proporcionó el ID del usuario a editar.</p>";
        }
        ?>
    </div>
</body>
</html>
