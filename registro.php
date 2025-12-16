<?php
    include 'establecer-sesion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registro de Usuario</title>
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Tipografía Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #1f2a44; /* azul oscuro */
        color: #ffffff;
    }
    .card {
        max-width: 480px;
        margin: 50px auto;
        background-color: #2c3e70;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.3);
    }
    .form-control {
        background-color: #3a4a7c;
        color: #ffffff;
        border: 1px solid #5a6ea0;
    }
    .form-control::placeholder {
        color: #cfd8ff;
        opacity: 1;
    }
    .form-label {
        font-weight: 600;
    }
    .btn-primary {
        background-color: #4a6ea0;
        border: none;
    }
    .btn-primary:hover {
        background-color: #36538b;
    }
    .alert {
        margin-bottom: 15px;
    }
    a {
        color: #cfd8ff;
        text-decoration: underline;
    }
  </style>
</head>
<body>
    <div class="card">
        <h2 class="text-center mb-4 fw-bold">Registro de Usuario</h2>

        <!-- Mensajes de error -->
        <?php
            if (isset($_SESSION['error']) && $_SESSION['error'] != "") {
                echo "<div class='alert alert-danger' role='alert'>";
                echo $_SESSION['error'];
                echo "</div>";
                $_SESSION['error'] = "";
                unset($_SESSION['error']);
            }
        ?>

        <form action="procesar-registro.php" method="post">
            <!-- Token CSRF -->
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

            <div class="mb-3">
                <label for="identificador" class="form-label">Usuario</label>
                <input type="text" name="identificador" id="identificador" class="form-control" placeholder="Nombre de usuario" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña segura" required>
            </div>

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Tu nombre" required>
            </div>

            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" name="apellidos" id="apellidos" class="form-control" placeholder="Tus apellidos" required>
            </div>

            <button class="btn btn-primary w-100">Registrar</button>
        </form>

        <p class="mt-3 text-center">
            ¿Ya tienes cuenta? <a href="index.php">Iniciar sesión</a>
        </p>
    </div>
</body>
</html>