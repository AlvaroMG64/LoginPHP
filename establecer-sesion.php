<?php
// establecer-sesion.php
session_start();

/*
|--------------------------------------------------------------------------
| Configuración segura de la sesión
|--------------------------------------------------------------------------
*/

// Crear token CSRF
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Inicializar contador de intentos (MUY IMPORTANTE)
if (!isset($_SESSION['intentos'])) {
    $_SESSION['intentos'] = 0;
}

// Tiempo máximo de sesión (2 horas)
if (!isset($_SESSION['inicio_sesion'])) {
    $_SESSION['inicio_sesion'] = time();
} elseif (time() - $_SESSION['inicio_sesion'] > 7200) {
    session_unset();
    session_destroy();
    header("Location: index.php?expired=1");
    exit;
}

// Regenerar ID cada 20 minutos
if (!isset($_SESSION['ultima_regeneracion'])) {
    $_SESSION['ultima_regeneracion'] = time();
} elseif (time() - $_SESSION['ultima_regeneracion'] > 1200) {
    session_regenerate_id(true);
    $_SESSION['ultima_regeneracion'] = time();
}