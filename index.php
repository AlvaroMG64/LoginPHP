<?php
include 'establecer-sesion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login PHP</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
      body { font-family: 'Poppins', sans-serif; background-color: #1f2a44; color: #fff; }
      .container { margin-top: 80px; max-width: 450px; }
      .card { background-color: #2c3e70; padding: 25px; border-radius: 12px; }
      .form-control { background-color: #3a4f7c; color: #fff; border: none; }
      .form-control::placeholder { color: #cbd5e1; opacity: 1; }
      .form-control:focus { background-color: #3a4f7c; color: #fff; box-shadow: none; }
      label { color: #fff; font-weight: 600; }
      .btn-primary { background-color: #4a6ea0; border: none; color: #fff; }
      .btn-primary:hover { background-color: #36538b; }
      .form-text { color: #cbd5e1; }
      h2 { color: #fff; }
      .alert-danger { background-color: #8b1a1a; color: #fff; border: none; }
  </style>
</head>
<body>
<div class="container">
  <div class="card">
    <h2 class="text-center mb-4 fw-bold">Iniciar sesión</h2>

    <?php
      if (isset($_SESSION['error']) && $_SESSION['error'] !== "") {
          echo "<div class='alert alert-danger'>" . $_SESSION['error'] . "</div>";
          $_SESSION['error'] = "";
          unset($_SESSION['error']);
      }
    ?>

    <form action="autenticacion.php" method="post">
      <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

      <div class="mb-3">
        <label for="identificador" class="form-label">Usuario</label>
        <input type="text" name="identificador" id="identificador" class="form-control" placeholder="Introduce tu usuario" required>
        <div class="form-text">Requerido y con caracteres válidos</div>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Introduce tu contraseña" required>
        <div class="form-text">Debe tener mayúsculas, minúsculas, dígitos y caracteres especiales (!@#$%&*?-)</div>
      </div>

      <button type="submit" class="btn btn-primary w-100">Acceder</button>
    </form>
  </div>
</div>
</body>
</html>