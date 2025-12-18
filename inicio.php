<?php
include 'establecer-sesion.php';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['identificador'])) {
    $_SESSION['error'] = "Acceso denegado: Debes iniciar sesión.";
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Login PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #1f2a44;
            color: #fff;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            background-color: #2c3e70;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        }
        .btn-logout {
            background-color: #a03a3a;
            border: none;
            color: #fff;
        }
        .btn-logout:hover {
            background-color: #7b2b2b;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card text-center">
        <h2 class="mb-4 fw-bold">Bienvenido a la aplicación</h2>
        <p>Hola, <strong><?= htmlspecialchars($_SESSION['nombre'] . ' ' . $_SESSION['apellidos']) ?></strong></p>
        <p>Has iniciado sesión correctamente.</p>
        <a href="logout.php" class="btn btn-logout mt-3">Cerrar sesión</a>
    </div>
</div>
</body>
</html>