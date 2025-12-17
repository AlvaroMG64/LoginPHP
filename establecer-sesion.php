<?php
// Configuración de cookies de sesión seguras y token CSRF
session_set_cookie_params([
    'lifetime' => 3600,           // Tiempo de expiración 1 hora
    'path' => '/',
    'httponly' => true,           // No accesible desde JavaScript
    'samesite' => 'Strict'        // Prevención CSRF
]);

session_start();

// Intervalo para regenerar ID de sesión cada 20 minutos
$regenerate_interval = 1200;
if (!isset($_SESSION['last_regeneration'])) {
    $_SESSION['last_regeneration'] = time();
}
if (time() - $_SESSION['last_regeneration'] >= $regenerate_interval) {
    session_regenerate_id(true);
    $_SESSION['last_regeneration'] = time();
}

// Tiempo máximo de sesión 2 horas
$limite_sesion = 7200;
if (!isset($_SESSION['inicio_sesion'])) {
    $_SESSION['inicio_sesion'] = time();
}
if (time() - $_SESSION['inicio_sesion'] > $limite_sesion) {
    $_SESSION = [];
    session_destroy();
    header("Location: index.php");
    exit;
}

// Generar token CSRF si no existe
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(openssl_random_pseudo_bytes(64));
}

// Inicializar contador de intentos de login
if (!isset($_SESSION['intentos'])) {
    $_SESSION['intentos'] = 0;
}
?>