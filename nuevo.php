<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="css/nuevo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>
<body>
    <div class="container">
        <h2><i class="fas fa-user-plus"></i> Registro de Usuario</h2>
        <?php
           
            // Incluir archivo de conexión a la base de datos
            include 'conexion.php';

            // Verificar si se envió el formulario
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                // Obtener la conexión a la base de datos
                $conn = conectar();

                $nombre = $_POST['nombre'];
                $password = $_POST['password']; // Contraseña sin encriptar
                $password_encriptada = password_hash($password, PASSWORD_DEFAULT); // Encriptar la contraseña
                $rol = $_POST['rol'];

                // Consulta para insertar usuario
                $sql = "INSERT INTO usuarios (nombre, password, rol) VALUES ('$nombre', '$password_encriptada', '$rol')";

                if ($conn->query($sql) === TRUE) {
                    echo '<p class="success-message">Usuario registrado correctamente</p>';
                } else {
                    echo '<p class="error-message">Error al registrar usuario: ' . $conn->error . '</p>';
                }
                // Cerrar la conexión
                $conn->close();
            }
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="nombre"><i class="fas fa-user"></i> Nombre de usuario:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="password"><i class="fas fa-lock"></i> Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <label for="rol"><i class="fas fa-user-tag"></i> Rol:</label>
            <select id="rol" name="rol">
                <option value="Administrativo">Administrativo</option>
                <option value="docente">Docente</option>
                <option value="estudiante">Estudiante</option>
            </select>

            <button type="submit"><i class="fas fa-user-plus"></i> Registrar usuario</button>
        </form>
        <div class="back-button-container">
            <button class="back-button" onclick="window.location.href='admin.php';"><i class="fas fa-arrow-left"></i> Regresar</button>
        </div>
    </div>
</body>
</html>
