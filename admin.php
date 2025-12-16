<?php
include 'establecer-sesion.php';

// Aquí deberías verificar que solo el admin pueda acceder
// Ejemplo sencillo: supongamos que idusuario 'admin' es el administrador
if (!isset($_SESSION['identificador']) || $_SESSION['identificador'] !== 'admin') {
    $_SESSION['error'] = "Acceso no autorizado";
    header("Location: index.php");
    exit;
}

// Conexión PDO
$host = 'localhost';
$db   = 'login-php';
$user = 'loginapp';
$pass = 'Abduzcan3E_';
$charset = 'utf8mb4';

try {
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (PDOException $e) {
    die("No se puede conectar a la base de datos");
}

// Obtener usuarios pendientes
$stmt = $pdo->query("SELECT coduser, idusuario, nombre, apellidos FROM usuarios WHERE admitido = FALSE ORDER BY coduser ASC");
$pendientes = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Panel de Administración</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #1f2a44;
        color: #ffffff;
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
    table {
        color: #ffffff;
    }
    th, td {
        vertical-align: middle !important;
    }
    .btn-approve {
        background-color: #4a6ea0;
        border: none;
        color: #fff;
    }
    .btn-approve:hover {
        background-color: #36538b;
    }
    .btn-reject {
        background-color: #a03a3a;
        border: none;
        color: #fff;
    }
    .btn-reject:hover {
        background-color: #7b2b2b;
    }
</style>
</head>
<body>
<div class="container">
    <div class="card">
        <h2 class="text-center mb-4 fw-bold">Usuarios Pendientes de Aprobación</h2>

        <?php if (count($pendientes) === 0): ?>
            <p class="text-center">No hay usuarios pendientes.</p>
        <?php else: ?>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pendientes as $usuario): ?>
                <tr>
                    <td><?= $usuario->coduser ?></td>
                    <td><?= htmlspecialchars($usuario->idusuario) ?></td>
                    <td><?= htmlspecialchars($usuario->nombre) ?></td>
                    <td><?= htmlspecialchars($usuario->apellidos) ?></td>
                    <td>
                        <form action="procesar-admin.php" method="post" style="display:inline-block;">
                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                            <input type="hidden" name="coduser" value="<?= $usuario->coduser ?>">
                            <button name="accion" value="aprobar" class="btn btn-approve btn-sm">Aprobar</button>
                        </form>
                        <form action="procesar-admin.php" method="post" style="display:inline-block;">
                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                            <input type="hidden" name="coduser" value="<?= $usuario->coduser ?>">
                            <button name="accion" value="rechazar" class="btn btn-reject btn-sm">Rechazar</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
</div>
</body>
</html>