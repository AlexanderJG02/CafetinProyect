<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuestros Locales</title>
    <link rel="stylesheet" href="css/local.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center mt-5 mb-4">❃❃❃❃Nuestros Locales❃❃❃❃</h1>
      
        <div class="row">
            <?php
            session_start();
            if (!isset($_SESSION['nombre_usuario']) || !isset($_SESSION['rol_usuario'])) {
                header("Location: login.php");
                exit();
            }
            $rol_usuario = $_SESSION['rol_usuario'];
         
            // Incluir la conexión a la base de datos
            include 'conexion.php';
            $conn = conectar();

            // Consulta para obtener los datos de los locales
            $sql = "SELECT * FROM cafetines";
            $resultado = $conn->query($sql);

            // Verifica si hay resultados
            if ($resultado->num_rows > 0) {
                // Itera sobre los resultados y genera la estructura HTML
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<div class='col-md-4'>
                            <div class='caja'>
                              <img class='imagen-local' src='img/" . strtolower(str_replace(' ', '', $fila['nombre'])) . ".jpg' alt='" . $fila['nombre'] . "'>
                                <div class='nombre-local'>
                                    <a href='editar_local.php?id=" . $fila['id'] . "'>" . $fila['nombre'] . "</a>
                                </div>
                                <div class='direccion-local'>" . $fila['direccion'] . "</div>
                                <div class='horario-local'>Horario: " . (isset($fila['horario']) ? $fila['horario'] : 'Horario no especificado') . "</div>
                                <div class='id-local'>ID: " . $fila['id'] . "</div>
                            </div>
                        </div>";
                }
            } else {
                echo "No se encontraron locales.";
            }

            // Cierra la conexión
            $conn->close();
            ?>
        </div>
    </div>
    <div class="text-center mb-4">
        <!-- Condicional para el enlace de regreso al menú -->
        <?php if ($rol_usuario == 'admin' || $rol_usuario == 'administrativo'): ?>
            <button class="btn btn-info" onclick="window.location.href='admin.php'">Regresar al Menú</button>
        <?php elseif ($rol_usuario == 'estudiante' || $rol_usuario == 'docente'): ?>
            <button class="btn btn-info" onclick="window.location.href='menu.php'">Regresar al Menú</button>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
