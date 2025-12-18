<?php
require 'establecer-sesion.php';
require 'conexion.php'; // tu conexión PDO

// Comprobar CSRF
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    $_SESSION['error'] = "Token CSRF inválido";
    header("Location: index.php");
    exit;
}

// Comprobar límite de intentos
if ($_SESSION['intentos'] >= 5) {
    $_SESSION['error'] = "Demasiados intentos. Cierra el navegador y vuelve a intentarlo.";
    header("Location: index.php");
    exit;
}

// Recoger datos
$idusuario = trim($_POST['idUser'] ?? '');
$password  = $_POST['password'] ?? '';

if ($idusuario === '' || $password === '') {
    $_SESSION['error'] = "Rellena todos los campos";
    header("Location: index.php");
    exit;
}

// Buscar usuario
$sql = "SELECT * FROM usuarios WHERE idusuario = :idusuario AND admitido = 1";
$stmt = $pdo->prepare($sql);
$stmt->execute(['idusuario' => $idusuario]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

// Verificar contraseña
if ($usuario && password_verify($password, $usuario['password'])) {

    // Login correcto → reiniciar intentos
    $_SESSION['intentos'] = 0;

    $_SESSION['idUser']    = $usuario['idusuario'];
    $_SESSION['nombre']    = $usuario['nombre'];
    $_SESSION['apellidos'] = $usuario['apellidos'];

    header("Location: inicio.php");
    exit;

} else {

    // Login incorrecto → sumar intento
    $_SESSION['intentos']++;

    $_SESSION['error'] = "Usuario o contraseña incorrectos";
    header("Location: index.php");
    exit;
}