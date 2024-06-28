<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desayunos</title>
    <link rel="stylesheet" href="css/productos.css">
    <link rel="stylesheet" href="css/carrito.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">❃❃❃Desayunos❃❃❃</h1>
        <div class="row mt-4">
            <?php
            session_start();
            if (!isset($_SESSION['nombre_usuario']) || !isset($_SESSION['rol_usuario'])) {
                header("Location: login.php");
                exit();
            }
            $rol_usuario = $_SESSION['rol_usuario'];
          
            // Incluir la clase de conexión
            include 'conexion.php';
            
            // Obtener la conexión a la base de datos
            $conn = conectar();
           
            // Ruta a la carpeta de imágenes
            $ruta_imagenes = 'img/';
            
            // Consulta para obtener los datos de los desayunos
            $sql = "SELECT * FROM productos WHERE categoria_id = 2";
            $resultado = $conn->query($sql);

            // Verifica si hay resultados
            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<div class='col-md-3'>
                            <div class='producto'>
                                <img src='" . $ruta_imagenes . strtolower(str_replace(' ', '', $fila['nombre'])) . ".jpg' alt='" . $fila['nombre'] . "'>
                                <div class='nombre'>" . $fila['nombre'] . "</div>
                                <div class='descripcion'>" . $fila['descripcion'] . "</div>";
                   if (isset($fila['cafetin_id'])) {
                       echo '<div class="local">Local Disponible ' . $fila["cafetin_id"] . '</div>';
                    } else {
                        echo "<div class='local'>Local no especificado</div>";
                    }
                    echo "<div class='precio'>$" . $fila['precio'] . "</div>
                                <div class='btn-container'>
                                    <button class='btn-comprar' onclick='agregarAlCarrito(\"" . $fila['nombre'] . "\", " . $fila['precio'] . ")'>Agregar</button>
                                    <button class='btn-pedido' onclick='agregarAlPedido(\"" . $fila['nombre'] . "\", " . $fila['precio'] . ")'>Pedido</button>
                                </div>
                            </div>
                        </div>";
                }
            } else {
                echo "No se encontraron desayunos.";
            }

            // Cierra la conexión
            $conn->close();
            ?>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                
                <?php if ($rol_usuario == 'admin' || $rol_usuario == 'administrativo'): ?>
                    <button class="btn-regresar" onclick="window.location.href='admin.php'">Regresar al Menú</button>
                <?php elseif ($rol_usuario == 'estudiante' || $rol_usuario == 'docente'): ?>
                    <button class="btn-regresar" onclick="window.location.href='menu.php'">Regresar al Menú</button>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
   <script src="js/carrito.js"></script>
</body>
</html>
