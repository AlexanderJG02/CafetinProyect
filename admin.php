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
    <title>Barra de Navegación Animada</title>
    <link rel="stylesheet" href="css/admin.css">
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
                        <a class="nav-link" href="admin.php">Inicio</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="nuevo.php">Nuevo Usuario</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="listar.php">Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="TablaEventos.php">Administracion  Eventos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="nuestros_locales.php">Locales</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="salir.php">Salir</a>
                    </li>
                </ul>
               <span class="navbar-text">
    <i class="fas fa-user"></i> <span style="font-size: 1.2em;"><?php echo $nombre_usuario; ?></span><br>
    <?php echo $rol_usuario; ?>
</span>
            </div>
        </div>
    </nav>
    <h1>❃❃❃❃❃❃❃Nuestra Carta❃❃❃❃❃❃❃</h1>

    <div class="nuestra-carta">
        <div class="item">
            <img src="img/desayuno.jpg" alt="Imagen 1">
            <p>Desayunos</p>
        </div>
        <div class="item">
            <img src="img/lasaña.jpg" alt="Imagen 2">
            <p>Almuerzos</p>
        </div>
        <div class="item">
            <img src="img/antojitos.jpg" alt="Imagen 3">
            <p>Antojitos</p>
        </div>
        <div class="item">
            <img src="img/tartaleta.jpg" alt="Imagen 4">
            <p>Postres</p>
        </div>
    </div>

    <div class="titulo">❃❃❃❃❃❃❃Información❃❃❃❃❃❃❃</div>

   <div class="informacion">
        <div class="caja">
            <p>¡Ven y disfruta de una experiencia de sabor única!
                <br>
            </p>
        </div>
        <div class="caja">
            <p>¡Ven y prueba nuestros platillos especiales cada día!
                <br>
            </p>
        </div>  
   </div>
      <div class="informacion">
        <div class="caja">
            <p>Nuestros antojitos están disponibles 
                <br>todos los días a partir de las 3 de la tarde
            </p>
        </div>
        <div class="caja">
            <p>Nuestro cafetín ofrece un ambiente acogedor
                <br>y una amplia variedad de postres
            </p>
        </div>  
   </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</body>
</html>
