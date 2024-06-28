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
    <title>Contacto - Cafetín UDB</title>
    <link rel="stylesheet" href="css/contacto.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Cafetin UDB</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <?php if ($rol_usuario === 'administrativo'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="admin.php">Administrar</a>
                    </li>
                    <?php elseif ($rol_usuario === 'estudiante' || $rol_usuario === 'docente'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="menu.php">Menú</a>
                    </li>
                    <?php endif; ?>
                   
                </ul>
                <span class="navbar-text">
                    <i class="fas fa-user"></i> <span style="font-size: 1.2em;"><?php echo $nombre_usuario; ?></span><br>
                    <?php echo $rol_usuario; ?>
                </span>
            </div>
        </div>
    </nav>

   <div class="container">
    <h1 class="text-center mt-4">Equipo de Cafetin UDB</h1>
    <div class="team-members">
        <div class="team-member">
            <img src="img/foto1.jpg" alt="Foto de Jorge Alexander Martinez Gonzalez">
            <div class="team-member-info">
                <h4>Jorge Alexander Martinez Gonzalez</h4>
                <p>Correo electrónico: 
                <br> <a href="mailto:soyalexgg2@gmail.com">soyalexgg2@gmail.com</a></p>
                <p>Teléfono: 
                <br>+503 7658-9639</p>
                <div class="social-links">
                    <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook"></i></a>
                    <a href="https://github.com/AlexanderJG02" target="_blank"><i class="fab fa-github"></i></a>
                    <a href="https://www.instagram.com/agz._01?igsh=MTVraW55dTlnYXB2" target="_blank"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        
        <div class="team-member">
            <img src="img/personal.jpeg" alt="Foto de Alisson Yasmin Vivas Castro">
            <div class="team-member-info">
                <h4>Alisson Yasmin Vivas Castro</h4>
                <p>Correo electrónico: <a href="mailto:correo2@cafetinudb.com">alissoncastrov93v@gmail.com</a></p>
                <p>Teléfono:
                <br> +503 7810-3661</p>
                <div class="social-links">
                    <a href="#" target="_blank"><i class="fab fa-facebook"></i></a>
                    <a href="https://github.com/CastroJC7" target="_blank"><i class="fab fa-github"></i></a>
                    <a href="https://www.instagram.com/cstro7k?igsh=OXE3NmRpOHA5aWM5" target="_blank"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>

        <div class="team-member">
            <img src="img/foto3.png" alt="Foto de Emerson Josue Gabriel Rosales">
            <div class="team-member-info">
                <h4>Emerson Josue Gabriel Rosales</h4>
                <p>Correo electrónico: <a href="mailto:egabriel2251763@gmail.com">egabriel2251763@gmail.com</a></p>
                <p>Teléfono:
                <br> +503 7823-2620</p>
                <div class="social-links">
                    <a href="#" target="_blank"><i class="fab fa-facebook"></i></a>
                    <a href="https://github.com/Emerson-gabrielx" target="_blank"><i class="fab fa-github"></i></a>
                    <a href="https://www.instagram.com/emersongabrielx/" target="_blank"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</body>
</html>
