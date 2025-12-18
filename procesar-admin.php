<?php
include 'establecer-sesion.php';

// Comprobación CSRF
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    $_SESSION['error'] = "Solicitud inválida";
    header("Location: admin.php");
    exit;
}

// Solo admin
if (!isset($_SESSION['identificador']) || $_SESSION['identificador'] !== 'admin') {
    $_SESSION['error'] = "Acceso no autorizado";
    header("Location: index.php");
    exit;
}

// Comprobar parámetros
if (!isset($_POST['coduser'], $_POST['accion'])) {
    $_SESSION['error'] = "Datos incompletos";
    header("Location: admin.php");
    exit;
}

$coduser = intval($_POST['coduser']);
$accion  = $_POST['accion'];

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
    $_SESSION['error'] = "Error de conexión";
    header("Location: admin.php");
    exit;
}

// Procesar acción
if ($accion === 'aprobar') {
    $stmt = $pdo->prepare("UPDATE usuarios SET admitido = TRUE WHERE coduser = :coduser");
    $stmt->execute(['coduser' => $coduser]);
    $_SESSION['error'] = "Usuario aprobado correctamente";
} elseif ($accion === 'rechazar') {
    $stmt = $pdo->prepare("DELETE FROM usuarios WHERE coduser = :coduser");
    $stmt->execute(['coduser' => $coduser]);
    $_SESSION['error'] = "Usuario rechazado y eliminado";
} else {
    $_SESSION['error'] = "Acción desconocida";
}

header("Location: admin.php");
exit;
?>