<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de la aplicación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <h1>CRUD a tu aplicación</h1>
    <p>Bienvenido, <?php echo $_SESSION['nombre']." ".$_SESSION['apellidos']; ?></p>
    <a class="btn btn-secondary" href="./logout.php">Logout</a>
</body>
</html>