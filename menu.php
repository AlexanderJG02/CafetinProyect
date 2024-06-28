<?php
session_start();
if (!isset($_SESSION['nombre_usuario']) || !isset($_SESSION['rol_usuario'])) {

    header("Location: login.php");
    exit();
}
$nombre_usuario = $_SESSION['nombre_usuario'];
$rol_usuario = $_SESSION['rol_usuario'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barra de Navegación </title>
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome para los iconos -->
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Cafetin UDB</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                 <li class="nav-item">
                    <a class="nav-link" href="menu.php">
                        <i class="fas fa-home"></i> Inicio
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-box"></i> Productos
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="desayunos.php"><i class="fas fa-coffee"></i> Desayunos</a></li>
                        <li><a class="dropdown-item" href="almuerzo.php"><i class="fas fa-utensils"></i> Almuerzos</a></li>
                        <li><a class="dropdown-item" href="Antojitos.php"><i class="fas fa-cookie"></i> Antojitos</a></li>
                        <li><a class="dropdown-item" href="postre.php"><i class="fas fa-birthday-cake"></i> Postres</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pagarPedido.php">
                        <i class="fas fa-receipt"></i> Pedidos
                    </a>
                </li> 
                <li class="nav-item">
                    <a class="nav-link" href="eventos.php">
                        <i class="fas fa-calendar-alt"></i> Eventos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Locaal.php">
                        <i class="fas fa-store"></i> Locales
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Contacto.php">
                        <i class="fas fa-envelope"></i> Contacto
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Carrito.php">
                        <i class="fas fa-shopping-cart"></i> Carrito
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="salir.php">
                        <i class="fas fa-sign-out-alt"></i> Salir
                    </a>
                </li>
                </ul>
                <span class="navbar-text">
                    <i class="fas fa-user"></i> <span style="font-size: 1.2em;"><?php echo $nombre_usuario; ?></span><br>
                    <?php echo $rol_usuario; ?>
                </span>
            </div>
        </div>
    </nav>
    <h1 class="titulo">❃❃❃❃❃❃❃Nuestra Carta❃❃❃❃❃❃❃</h1>

    <div class="nuestra-carta">
    <div class="item">
    <a href="desayunos.php">
        <img src="img/desayuno.jpg" alt="Imagen 1">
        </a>
        <p>Desayunos</p>
    
</div>

        <div class="item">
        <a href="almuerzo.php">
            <img src="img/lasaña.jpg" alt="Imagen 2">
            </a>
            <p>Almuerzos</p>
        </div>
        <div class="item">
        <a href="Antojitos.php">
            <img src="img/antojitos.jpg" alt="Imagen 3">
            </a>
            <p>Antojitos</p>
        </div>
        <div class="item">
        <a  href="postre.php">
            <img src="img/tartaleta.jpg" alt="Imagen 4">
            </a>
            <p>Postres</p>
        </div>
    </div>

    <div class="titulo">❃❃❃❃❃❃❃Información❃❃❃❃❃❃❃</div>

    <div class="informacion-container">
        <div class="caja">
            <p>¡Ven y disfruta de una experiencia de sabor única!</p>
        </div>
        <div class="caja">
            <p>¡Ven y prueba nuestros platillos especiales cada día!</p>
        </div>
        <div class="caja">
            <p>Nuestros antojitos están disponibles todos los días a partir de las 3 de la tarde</p>
        </div>
        <div class="caja">
            <p>Nuestro cafetín ofrece un ambiente acogedor y una amplia variedad de postres</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</body>
</html>
