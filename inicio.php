<?php
include 'establecer-sesion.php';

if (!isset($_SESSION['identificador'])) {
    $_SESSION['error'] = "Debes iniciar sesión para acceder.";
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<h1>Inicio de la aplicación</h1>

<p>
    Bienvenido,
    <strong><?= htmlspecialchars($_SESSION['nombre'] . " " . $_SESSION['apellidos']); ?></strong>
</p>

<?php if ($_SESSION['identificador'] === 'admin'): ?>
    <a href="admin.php" class="btn btn-warning mb-3">Panel de administración</a>
<?php endif; ?>

<br>
<a href="logout.php" class="btn btn-secondary">Cerrar sesión</a>

</body>
</html>