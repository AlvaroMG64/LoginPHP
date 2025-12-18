<?php
include 'establecer-sesion.php';

if (!isset($_SESSION['idusuario'])) {
    $_SESSION['error'] = "Debes iniciar sesión.";
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inicio de la aplicación</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
      body { font-family: 'Poppins', sans-serif; background-color: #1f2a44; color: #fff; }
      .container { margin-top: 60px; }
      .card { background-color: #2c3e70; padding: 20px; border-radius: 12px; margin-bottom: 20px; }
      .btn-secondary { background-color: #4a6ea0; border: none; color: #fff; }
      .btn-secondary:hover { background-color: #36538b; }
      h1, h4, p { color: #fff; }
  </style>
</head>
<body>
<div class="container">
    <h1 class="text-center mb-4">Bienvenido, <?= htmlspecialchars($_SESSION['nombre'] . ' ' . $_SESSION['apellidos']) ?></h1>

    <div class="card">
        <h4>Información de la sesión</h4>
        <p>Usuario: <strong><?= htmlspecialchars($_SESSION['idusuario']) ?></strong></p>
        <p>Estado: Activo</p>
        <p>Cookies y sesión seguras</p>
    </div>

    <a class="btn btn-secondary w-100" href="logout.php">Cerrar sesión</a>
</div>
</body>
</html>