<?php
    include 'establecer-sesion.php';

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

        // Inicialización de parámetros de conexión
        $host = 'localhost';
        $usuario = 'loginapp';      
        $password = 'Abduzcan3E_';         
        $baseDatos = 'login-php';

        $mysqli = new mysqli($host,$usuario,$password,$baseDatos);

        if ($mysqli->connect_error) {
            $_SESSION['error'] = "No se puede comprobar usuario en estos momentos. Vuelva a intentarlo en unos minutos";
            header('Location: ./index.php');
            exit;
        }

        $usuario = htmlspecialchars($_POST['identificador']);
        $password = htmlspecialchars($_POST['password']);

        $querySQL = "SELECT * FROM usuarios WHERE idusuario = '". $usuario . "'";
        $resultado = $mysqli -> query($querySQL);

        if ($resultado -> num_rows == 0) {
            $_SESSION['error'] = "Usuario incorrecto";
            $_SESSION['intentos']++;
            header('Location: ./index.php');
        } else {
            $row = mysqli_fetch_object($resultado); 
            // Comprobación de password simple (para producción usar hash)
            if ($row->password == $password) {
                if (isset($row->admitido) && !$row->admitido) {
                    $_SESSION['error'] = "Cuenta pendiente de aprobación por administrador.";
                    header("Location: index.php");
                    exit;
                }

                // Login correcto
                $_SESSION['nombre'] =  $row->nombre;
                $_SESSION['apellidos'] =  $row->apellidos;
                $_SESSION['intentos'] = 0; // resetea contador
                header("Location: ./inicio.php");
            } else {
                $_SESSION['error'] = "Contraseña incorrecta";
                $_SESSION['intentos']++;
                header("Location: ./index.php");
            }
            $mysqli->close();
        }

    } else {
        $_SESSION['error'] = "Debe hacer login para acceder";
        header('Location: ./index.php');
    }
?>