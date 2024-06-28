<?php
session_start();

// Verifica si el carrito de compras está definido en la sesión
if (!isset($_SESSION['pedido'])) {
    $_SESSION['pedido'] = array();
}

// Función para agregar un producto al pedido
function agregarAlPedido($producto) {
    $_SESSION['pedido'][] = $producto;
}

// Verifica si se ha enviado un producto para agregar al pedido
if (isset($_POST['agregarAlPedido'])) {
    $producto = array(
        'nombre' => $_POST['nombre'],
        'precio' => $_POST['precio']
    );
    agregarAlPedido($producto);
}

// Verifica si se ha enviado una solicitud para eliminar un producto del pedido
if (isset($_POST['eliminarDelPedido'])) {
    $index = $_POST['index'];
    eliminarDelPedido($index);
    // Detiene el script aquí para evitar redireccionamiento
    exit();
}

// Función para eliminar un producto del pedido
function eliminarDelPedido($index) {
    unset($_SESSION['pedido'][$index]);
    // Reindexar el array después de eliminar un producto
    $_SESSION['pedido'] = array_values($_SESSION['pedido']);
}

// Verificar si se realizó el pago
if (isset($_POST['pago_realizado'])) {
    // Establece el monto en cero
    $total = 0;
    // Vacía el carrito
    $_SESSION['pedido'] = array();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagos</title>
    <link rel="stylesheet" href="css/car.css">
    <link rel="stylesheet" href="css/alerta.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">

</head>
<body>
    <div class="container">
        <h1>Pedidos</h1>
        <div class="row">
            <div class="col-md-8">
                <?php
                // Mostrar los productos del carrito
                if (!empty($_SESSION['pedido'])) {
                    foreach ($_SESSION['pedido'] as $index => $producto) {
                        echo "<div class='producto'>
                                <div class='info'>
                                    <div class='nombre'>" . $producto['nombre'] . "</div>
                                    <div class='precio'>$" . $producto['precio'] . "</div>
                                </div>
                                <button type='button' onclick='eliminarProducto($index)' class='btn btn-outline-danger'>Eliminar</button>
                            </div>";
                    }
                } else {
                    echo "<p>No hay productos.</p>";
                }
                ?>
            </div>
            <div class="col-md-4">
                <?php
                // Calcular el total del carrito
                $total = 0;
                foreach ($_SESSION['pedido'] as $producto) {
                    $total += $producto['precio'];
                }
                ?>
                <div class="total">
                    Total: $<?php echo number_format($total, 2); ?>
                </div>
                <div class="btn-container">
                    <button class="btn btn-outline-success" onclick="irAPaginaDePedido()">Pedido</button>
                    <button type="button" class="btn btn-outline-dark" onclick="window.location.href = 'menu.php';"><i class="fas fa-arrow-left"></i> Regresar</button>

                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/pedido.js"></script>
</body>
</html>
