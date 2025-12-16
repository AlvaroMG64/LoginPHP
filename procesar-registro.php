<?php
include 'establecer-sesion.php';

// CSRF
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    $_SESSION['error'] = "Solicitud inválida";
    header("Location: registro.php");
    exit;
}

// Recogida de datos
$usuario   = htmlspecialchars($_POST['identificador']);
$password  = htmlspecialchars($_POST['password']);
$nombre    = htmlspecialchars($_POST['nombre']);
$apellidos = htmlspecialchars($_POST['apellidos']);

// Validación mínima (ejemplo)
if (strlen($usuario) < 8 || strlen($usuario) > 15 || strlen($password) < 8 || strlen($password) > 15) {
    $_SESSION['error'] = "Usuario o contraseña fuera de rango.";
    header("Location: registro.php");
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
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]);
} catch (PDOException $e) {
    $_SESSION['error'] = "No se puede registrar el usuario ahora.";
    header("Location: registro.php");
    exit;
}

// Comprobamos si ya existe usuario
$stmt = $pdo->prepare("SELECT coduser FROM usuarios WHERE idusuario = :usuario LIMIT 1");
$stmt->execute(['usuario' => $usuario]);

if ($stmt->fetch()) {
    $_SESSION['error'] = "El usuario ya existe.";
    header("Location: registro.php");
    exit;
}

// Hasheamos la contraseña de forma segura
$hashPassword = password_hash($password, PASSWORD_DEFAULT);

// Insertar usuario con admitido = FALSE
$sql = "INSERT INTO usuarios (idusuario, password, nombre, apellidos, admitido) 
        VALUES (:usuario, :password, :nombre, :apellidos, FALSE)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'usuario' => $usuario,
    'password' => $hashPassword,
    'nombre' => $nombre,
    'apellidos' => $apellidos
]);

$_SESSION['error'] = "Registro completado. Pendiente de aprobación del administrador.";
header("Location: index.php");
exit;
?>