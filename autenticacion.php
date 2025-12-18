<?php
include 'establecer-sesion.php';

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
    die("Error de conexión");
}

if (!isset($_POST['identificador'], $_POST['password'], $_POST['csrf_token'])) {
    $_SESSION['error'] = "Datos incompletos";
    header("Location: index.php");
    exit;
}

// Comprobación CSRF
if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    $_SESSION['error'] = "Solicitud inválida";
    header("Location: index.php");
    exit;
}

$identificador = trim($_POST['identificador']);
$password      = $_POST['password'];

// Buscar usuario
$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE idusuario = :idusuario LIMIT 1");
$stmt->execute(['idusuario' => $identificador]);
$usuario = $stmt->fetch();

if (!$usuario) {
    $_SESSION['error'] = "Usuario incorrecto";
    header("Location: index.php");
    exit;
}

// Comparación en texto plano
if ($password !== $usuario->password) {
    $_SESSION['error'] = "Contraseña incorrecta";
    header("Location: index.php");
    exit;
}

// Guardar datos en sesión
$_SESSION['idusuario'] = $usuario->idusuario;
$_SESSION['nombre'] = $usuario->nombre;
$_SESSION['apellidos'] = $usuario->apellidos;

// Redirigir al inicio
header("Location: inicio.php");
exit;