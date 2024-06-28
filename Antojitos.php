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
        <h1 class="mt-5">❃❃❃Antojitos❃❃❃</h1>
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
            
                // Conexión a la base de datos
                $conn = conectar(); 
          
            // Consulta SQL para obtener los productos
            $sql = "SELECT * FROM productos WHERE categoria_id = 1";
            $result = $conn->query($sql);

            // Mostrar los productos
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $imagenProducto = ""; // Variable para almacenar el nombre del archivo de imagen

                    // Asignar el nombre del archivo de imagen según el nombre del producto
                    switch ($row["nombre"]) {
                        case "Nuegados":
                            $imagenProducto = "antojitos.jpg";
                            break;
                        case "Papas fritas":
                            $imagenProducto = "antojitos1.jpg";
                            break;
                        case "Yuca frita":
                            $imagenProducto = "antojitos2.jpg";
                            break;
                        case "Elote":
                            $imagenProducto = "antojito3.jpg";
                            break;
                    }

                    echo '<div class="col-md-3">';
                    echo '<div class="producto">';
                    echo '<img src="img/' . $imagenProducto . '" alt="' . $row["nombre"] . '">';
                    echo '<div class="nombre">' . $row["nombre"] . '</div>';
                    echo '<div class="descripcion">' . $row["descripcion"] . '</div>';
                    echo '<div class="precio">$' . $row["precio"] . '</div>';
                    echo '<div class="local">Local Disponible ' . $row["cafetin_id"] . '</div>';
                    echo '<div class="btn-container">';
                    echo '<button class="btn-comprar" onclick="agregarAlCarrito(\'' . $row["nombre"] . '\', \'' . $row["precio"] . '\')">Agregar</button>';
                    echo '<button class="btn-pedido" onclick="agregarAlPedido(\'' . $row["nombre"] . '\', \'' . $row["precio"] . '\')">Pedido</button>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "No se encontraron productos.";
            }

            // Cerrar la conexión
            $conn->close();
            ?>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <!-- Condicional para el enlace de regreso al menú -->
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
    <script>
    // Función para agregar producto al carrito
    function agregarAlCarrito(nombre, precio) {
   const horaActual = new Date().getHours();
    if (horaActual >= 14 && horaActual < 16) {
        const formData = new FormData();
        formData.append('agregarAlCarrito', true);
        formData.append('nombre', nombre);
        formData.append('precio', precio);
        fetch('carrito.php', {
            method: 'POST',
            body: formData
        }).then(response => {
            if (response.ok) {
                mostrarAlerta('¡Producto agregado al carrito!', true);
            } else {
                mostrarAlerta('Ha ocurrido un error al agregar el producto al carrito.', false);
            }
        });
    } else {
        mostrarAlerta('Agregar productos al carrito solo estan disponibles de 2:00 PM a 4:00 PM.', false);
    }
}
    

    // Función para agregar producto al pedido
    function agregarAlPedido(nombre, precio) {
        const horaActual = new Date().getHours();
        if (horaActual >= 14 && horaActual < 16) {
            const formData = new FormData();
            formData.append('agregarAlPedido', true);
            formData.append('nombre', nombre);
            formData.append('precio', precio);
            fetch('pagarPedido.php', { // Cambiar 'pagarPedido.php' por la URL correcta
                method: 'POST',
                body: formData
            }).then(response => {
                if (response.ok) {
                    mostrarAlerta('¡Producto agregado al pedido!', false);
                } else {
                    mostrarAlerta('Ha ocurrido un error al agregar el producto al pedido.', false);
                }
            });
        } else {
            mostrarAlerta('Los pedidos solo están disponibles de 2:00 PM a 4:00 PM.', false);
        }
    }

    // Función para mostrar alerta y ocultarla después de un tiempo determinado 
    function mostrarAlerta(mensaje, exito) {
        const alerta = document.createElement('div');
        alerta.className = 'alerta';
        alerta.textContent = mensaje;

        if (exito) {
            alerta.style.backgroundColor = '#28a745'; // verde
            const icono = document.createElement('span');
            icono.className = 'fa fa-check';
            alerta.appendChild(icono);
        } else {
            alerta.style.backgroundColor = '#007bff'; // azul
        }

        document.body.appendChild(alerta);

        setTimeout(function() {
            alerta.style.opacity = '0';
            setTimeout(function() {
                alerta.remove();
            }, 1000);
        }, 1000);
    }
    </script>
</body>
</html>
