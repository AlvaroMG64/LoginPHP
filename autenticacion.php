<?php
    include 'establecer-sesion.php';

    // Comprobación CSRF
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $_SESSION['error'] = "Solicitud inválida";
        header("Location: index.php");
        exit;
    }

    if (isset($_POST['identificador'])) {

        // Comprueba si hay demasiados intentos
        if ($_SESSION['intentos'] >= 5) {
            $_SESSION['error'] = "Demasiados intentos. Espere unos minutos.";
            header("Location: index.php");
            exit;
        }

        // Parámetros de conexión
        $host = 'localhost';
        $db   = 'login-php';
        $user = 'loginapp';
        $pass = 'Abduzcan3E_';
        $charset = 'utf8mb4';

        try {
            // DSN de conexión PDO
            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

            $pdo = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]);

        } catch (PDOException $e) {
            $_SESSION['error'] = "No se puede comprobar usuario en estos momentos";
            header("Location: index.php");
            exit;
        }

        // Limpieza básica de datos
        $usuario = htmlspecialchars($_POST['identificador']);
        $password = htmlspecialchars($_POST['password']);

        // Consulta preparada (evita SQL Injection)
        $sql = "SELECT * FROM usuarios WHERE idusuario = :usuario LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['usuario' => $usuario]);

        $row = $stmt->fetch();

        if (!$row) {
            $_SESSION['error'] = "Usuario incorrecto";
            $_SESSION['intentos']++;
            header("Location: index.php");
            exit;
        }

        // Comprobación de password (sin hash por ahora)
        if ($row->password === $password) {

            if (isset($row->admitido) && !$row->admitido) {
                $_SESSION['error'] = "Cuenta pendiente de aprobación por administrador.";
                header("Location: index.php");
                exit;
            }

            // Login correcto
            $_SESSION['nombre'] = $row->nombre;
            $_SESSION['apellidos'] = $row->apellidos;
            $_SESSION['intentos'] = 0;

            header("Location: inicio.php");
            exit;

        } else {
            $_SESSION['error'] = "Contraseña incorrecta";
            $_SESSION['intentos']++;
            header("Location: index.php");
            exit;
        }

    } else {
        $_SESSION['error'] = "Debe hacer login para acceder";
        header("Location: index.php");
        exit;
    }
?>