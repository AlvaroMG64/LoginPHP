<?php
include 'establecer-sesion.php';

// CSRF
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    $_SESSION['error'] = "Solicitud inválida";
    header("Location: index.php");
    exit;
}

if ($_SESSION['intentos'] >= 5) {
    $_SESSION['error'] = "Demasiados intentos. Espere unos minutos.";
    header("Location: index.php");
    exit;
}

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
    header("Location: index.php");
    exit;
}

$usuario = trim($_POST['identificador']);
$password = $_POST['password'];

$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE idusuario = :u LIMIT 1");
$stmt->execute(['u' => $usuario]);
$row = $stmt->fetch();

if (!$row) {
    $_SESSION['error'] = "Usuario incorrecto";
    $_SESSION['intentos']++;
    header("Location: index.php");
    exit;
}

if (!password_verify($password, $row->password)) {
    $_SESSION['error'] = "Contraseña incorrecta";
    $_SESSION['intentos']++;
    header("Location: index.php");
    exit;
}

if (!$row->admitido) {
    $_SESSION['error'] = "Cuenta pendiente de aprobación";
    header("Location: index.php");
    exit;
}

// LOGIN CORRECTO
$_SESSION['idusuario'] = $row->idusuario;   // 🔴 CLAVE
$_SESSION['nombre'] = $row->nombre;
$_SESSION['apellidos'] = $row->apellidos;
$_SESSION['intentos'] = 0;

header("Location: inicio.php");
exit;