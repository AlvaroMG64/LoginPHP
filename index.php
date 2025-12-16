<?php
    include 'establecer-sesion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login PHP</title>
  
  <!-- Google Fonts: Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Icono de la web -->
  <link rel="shortcut icon" href="playamar.png" type="image/x-icon">

  <!-- Estilos personalizados -->
  <style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #0f2a52, #1c3b70); /* Azul oscuro degradado */
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #fff;
    }

    .login-card {
        background: #1f3a6f; /* Azul más claro para el card */
        border-radius: 20px;
        padding: 50px 40px;
        box-shadow: 0 12px 30px rgba(0,0,0,0.5);
        max-width: 500px;
        width: 100%;
        transition: transform 0.3s ease;
    }

    .login-card:hover {
        transform: translateY(-5px);
    }

    .login-card h1 {
        font-weight: 600;
        margin-bottom: 35px;
        text-align: center;
        color: #ffffff;
    }

    .form-control {
        background-color: #2a4a85;
        border: 1px solid #3d5f9c;
        color: #fff;
    }

    .form-control::placeholder {
        color: #cfd6e0; /* Color claro para placeholder */
        opacity: 1;
    }

    .form-control:focus {
        box-shadow: none;
        border-color: #66a3ff;
        background-color: #2a4a85;
        color: #fff;
    }

    .form-label {
        color: #e0e6f0;
        font-weight: 500;
    }

    .form-text {
        font-size: 0.85rem;
        color: #cfd6e0;
    }

    .btn-login {
        background: #66a3ff; /* Azul vivo */
        color: white;
        font-weight: 500;
        width: 100%;
        padding: 14px;
        border-radius: 10px;
        transition: background 0.3s ease;
    }

    .btn-login:hover {
        background: #4d8de0;
    }

    .alert {
        border-radius: 8px;
        font-size: 0.9rem;
    }
  </style>
</head>
<body>

  <div class="login-card">
      <h1>Iniciar sesión</h1>

      <form action="autenticacion.php" method="post">
          <!-- Errores desde la sesión -->
          <?php
              if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
                  echo "<div class='alert alert-danger' role='alert'>";
                  echo $_SESSION['error'];
                  echo "</div>";
                  $_SESSION['error'] = "";
                  unset($_SESSION['error']);
              }
          ?>

          <!-- Token CSRF -->
          <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

          <!-- Nombre de usuario -->
          <div class="mb-3">
              <label for="indentificador" class="form-label">Nombre de usuario</label>
              <input type="text" name="identificador" id="identificador" class="form-control form-control-lg" placeholder="Tu usuario" required>
              <div id="identificadorHelp" class="form-text">Requerido, 8-15 caracteres (letras, números o _)</div>
          </div>

          <!-- Contraseña -->
          <div class="mb-3">
              <label for="password" class="form-label">Contraseña</label>
              <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="********" required>
              <div id="passwordHelp" class="form-text">Debe tener mayúsculas, minúsculas, dígitos y caracteres especiales (!@#$%&*?-)</div>
          </div>

          <button type="submit" class="btn btn-login btn-lg mt-3">Acceder</button>
      </form>
  </div>

  <!-- JS de validaciones -->
  <script src="validaciones.js"></script>
</body>
</html>