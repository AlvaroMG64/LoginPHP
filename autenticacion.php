<?php
include 'establecer-sesion.php';

if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    $_SESSION['error'] = "CSRF inválido";
    header("Location: index.php");
    exit;
}

if ($_SESSION['intentos'] >= 5) {
    $_SESSION['error'] = "Demasiados intentos";
    header("Location: index.php");
    exit;
}

$usuario = trim($_POST['identificador']);
$password = $_POST['password'];

$pdo = new PDO(
    "mysql:host=localhost;dbname=login-php;charset=utf8mb4",
    "loginapp",
    "Abduzcan3E_",
    [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ]
);

$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE idusuario = ?");
$stmt->execute([$usuario]);
$user = $stmt->fetch();

if (!$user || !password_verify($password, $user->password)) {
    $_SESSION['error'] = "Usuario o contraseña incorrectos";
    $_SESSION['intentos']++;
    header("Location: index.php");
    exit;
}

if (!$user->admitido) {
    $_SESSION['error'] = "Cuenta pendiente de aprobación";
    header("Location: index.php");
    exit;
}

$_SESSION['identificador'] = $user->idusuario;
$_SESSION['nombre'] = $user->nombre;
$_SESSION['apellidos'] = $user->apellidos;
$_SESSION['intentos'] = 0;

header("Location: inicio.php");
exit;