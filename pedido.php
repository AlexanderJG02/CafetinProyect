<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Pedido</title>
    <script src="https://kit.fontawesome.com/6596fae3b7.js" crossorigin="anonymous"></script>
    <style>
        fieldset {
            border-color: rgb(56, 140, 151);
            padding: 20px 30px;
            max-width: 400px;
            margin: 0 auto;
        }
        h2 {
            text-align: center;
            padding: 30px;
            color: rgb(112, 61, 139);
        }
        input[type="text"],
        input[type="number"],
        input[type="time"],
        select {
            margin-bottom: 10px;
            width: calc(100% - 24px);
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color:rgb(128, 152, 152);
            color: rgb(0, 0, 0);
            padding: 10px 20px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: rgb(255, 255, 255);
        }
        .total {
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <h2>Formulario de Pedido</h2>
    <form action="pago.php" method="POST">
        <fieldset>
            <legend><i class="fa-regular fa-clipboard"></i>Ingresar Pedido</legend>

            <label for="nombre_cliente">Nombre del cliente:</label><br>
            <input type="text" id="nombre_cliente" name="nombre_cliente" pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+" required><br><br>
            
            <label for="dia_entrega">Día de entrega:</label><br>
            <input type="date" id="dia_entrega" name="dia_entrega" min="<?php echo date('Y-m-d'); ?>" required><br><br>
            
            <label for="hora_entrega">Hora de entrega:</label><br>
            <input type="time" id="hora_entrega" name="hora_entrega" min="08:00" max="17:00" required><br><br>
            
            <label for="lugar_entrega">Lugar de entrega:</label><br>
            <textarea id="lugar_entrega" name="lugar_entrega" rows="4" pattern="[A-Za-z0-9\s-]+" required></textarea><br><br>
            
            
            <button type="submit"><i class="fas fa-save"></i> Guardar</button>
            <button type="button" onclick="window.history.back();"><i class="fas fa-times"></i> Cancelar</button>
        </fieldset>
    </form>

    <?php
    // Conexión a la base de datos
    $servername = "sql200.infinityfree.com";
    $username = "si0_36505981";
    $password = "8xvBYUDMzOd";
    $dbname = "if0_36505981_cafetines_udb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica la conexión
    if ($conn->connect_error) {
        die("Error en la conexión: " . $conn->connect_error);
    }

    // Consulta para obtener el total de pedidos
    $sql = "SELECT SUM(cantidad) AS total_pedidos FROM pedidos";
    $resultado = $conn->query($sql);

    // Verifica si hay resultados
    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $total_pedidos = $fila['total_pedidos'];
    } else {
        $total_pedidos = 0;
    }

    // Cierra la conexión
    $conn->close();
    ?>

    <div class="total">
        <h3>Total de pedidos: <?php echo $total_pedidos; ?></h3>
    </div>
</body>
</html>
