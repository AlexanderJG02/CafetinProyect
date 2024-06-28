<?php
// Incluir archivo de conexión a la base de datos
include 'conexion.php';

// Verificar si se envió el formulario de login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $password = $_POST["password"];

    // Obtener la conexión a la base de datos
    $conn = conectar();

    // Validar el nombre de usuario usando expresión regular
    if (!preg_match("/^[A-Za-z]+$/", $nombre)) {
        $error = "El nombre de usuario solo puede contener letras";
    } else {
        // Consulta SQL para buscar el usuario activo
        $sql = "SELECT * FROM usuarios WHERE nombre='$nombre' AND activo = 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $fila = $result->fetch_assoc();
            $contraseña_hash = $fila["password"];
            $rol_usuario = $fila["rol"];

            // Verificar si la contraseña proporcionada coincide con la contraseña encriptada almacenada en la base de datos
            if (password_verify($password, $contraseña_hash)) {
                session_start();
                $_SESSION["nombre_usuario"] = $nombre;
                $_SESSION["rol_usuario"] = $rol_usuario;

                if ($rol_usuario === "administrativo") {
                    header("Location: admin.php");
                } else {
                    header("Location: menu.php");
                }
                exit();
            } else {
                $error = "Nombre de usuario o contraseña incorrectos";
            }
        } else {
            // Si no hay resultados o el usuario está inactivo, mostrar mensaje de error
            $error = "Nombre de usuario incorrecto o usuario inactivo";
        }
    }
    $conn->close();
}


?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="css/login.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
  <div class="login-container">
    <div class="login-logo">
      <img src="img/UDB_negras.png" alt="Logo">
    </div>

    <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>

    <form id="loginForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <div class="form-group">
        <label for="nombre">Usuario</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required>
      </div>
      <div class="form-group">
        <label for="password">Contraseña</label>
        <div class="input-group">
          <input type="password" class="form-control" id="password" name="password" required>
          <div class="input-group-append" id="togglePassword">
            <span class="input-group-text">
              <i class="fas fa-eye" style="font-size: 14px;"></i>
            </span>
          </div>
        </div>
      </div>
      <button type="submit" class="btn-pink">Iniciar Sesión</button>
    </form>
  </div>

  <!-- Modal de carga -->
  <div id="loadingModal">
    <div class="modal-dialog text-center">
      <div class="modal-content bg-dark">
        <div class="modal-body">
          <div class="spinner-border" role="status">
            <span class="sr-only">Cargando...</span>
          </div>
          <p>Cargando...</p>
        </div>
      </div>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#togglePassword').click(function() {
        const passwordField = $('#password');
        const fieldType = passwordField.attr('type');
        if (fieldType === 'password') {
          passwordField.attr('type', 'text');
          $('#togglePassword i').removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
          passwordField.attr('type', 'password');
          $('#togglePassword i').removeClass('fa-eye-slash').addClass('fa-eye');
        }
      });

      $('#loginForm').submit(function() {
        $('#loadingModal').fadeIn(); // Mostrar modal de carga al enviar el formulario
      });
    });

    $(window).on('load', function() {
      setTimeout(function() {
        $('#loadingModal').fadeOut(); // Ocultar modal de carga después de 3 segundos
      }, 3000);
    });
  </script>
</body>
</html>
