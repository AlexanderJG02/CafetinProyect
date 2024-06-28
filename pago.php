<?php
session_start(); // Iniciar la sesión para acceder a $_SESSION['carrito']

// Verifica si el carrito de compras está definido en la sesión
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

// Calcular el total del carrito
$total = 0;
foreach ($_SESSION['carrito'] as $producto) {
    $total += $producto['precio'];
}

// Verificar si se realizó el pago
if (isset($_POST['pago_realizado'])) {
    // Establece el monto en cero
    $total = 0;
    // Vacía el carrito
    $_SESSION['carrito'] = array();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Pagos</title>
    <link rel="stylesheet" href="css/pago.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <h2>Formulario de Pagos</h2>
    <form action="" method="POST">
        <fieldset>
            <legend><i class="fas fa-coins"></i> Datos de Pago</legend>

            <label for="tipo_pago">Tipo de pago:</label><br>
            <select name="tipo_pago" id="tipo_pago" onchange="mostrarTarjeta()">
                <option value="efectivo">Efectivo</option>
                <option value="tarjeta">Tarjeta</option>
                <option value="bitcoin">Bitcoin</option>
            </select><br>
            
            <div class="tarjeta">
                <label for="numero_tarjeta">Número de tarjeta:</label><br>
                <input type="text" id="numero_tarjeta" name="numero_tarjeta" maxlength="16"><br>
                
                <label for="vencimiento">Fecha de vencimiento:</label><br>
                <input type="text" id="vencimiento" name="vencimiento" placeholder="MM/YY" maxlength="5"><br>
                
                <label for="cvv">CVV:</label><br>
                <input type="text" id="cvv" name="cvv" maxlength="3"><br>
            </div>
            
            <label for="monto">Monto:</label><br>
            <input type="text" id="monto" name="monto" value="<?php echo number_format($total, 2); ?>" readonly><br><br>
            <button type="submit" name="pago_realizado"><i class="fas fa-money-check"></i> Pagar</button>
            <button type="button" onclick="window.history.back();"><i class="fas fa-times"></i> Cancelar</button>
            <button type="button" onclick="window.location.href = 'menu.php';"><i class="fas fa-arrow-left"></i> Regresar</button>

        </fieldset>
    </form>
     <script src="js/tarjeta.js"></script>
</body>
</html>
