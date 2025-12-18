<?php
include 'establecer-sesion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login PHP</title>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="shortcut icon" href="playamar.png" type="image/x-icon">

  <style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #0f2a52, #1c3b70);
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #fff;
    }
    .login-card {
        background: #1f3a6f;
        border-radius: 20px;
        padding: 50px 40px;
        box-shadow: 0 12px 30px rgba(0,0,0,0.5);
        max-width: 500px;
        width: 100%;
    }
  </style>
</head>
<body>

<div class="login-card">
    <h1 class="text-center mb-4">Iniciar sesión</h1>

    <?php if (!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error']; ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <form action="autenticacion.php" method="post">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">

        <div class="mb-3">
            <label class="form-label">Usuario</label>
            <input type="text" name="identificador" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Contraseña</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button class="btn btn-primary w-100 mt-3">Acceder</button>
    </form>

    <p class="text-center mt-3">
        ¿No tienes cuenta? <a href="registro.php" class="text-light">Regístrate</a>
    </p>
</div>

<script src="validaciones.js"></script>
</body>
</html>