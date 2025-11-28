<?php
    session_start(); // Pendiente de hacer segura

    if (isset($_POST['identificador'])) {

        // Inicialización de parámetros de conexión
        $host = 'localhost';
        $usuario = 'root';      // Inseguro
        $password = '';         // Inseguro
        $baseDatos = 'login-php';

        // Establecimiento de conexión
        $mysqli = new mysqli($host,$usuario,$password,$baseDatos);

        if ($mysqli->connect_error) {
            $_SESSION['error'] = "No se puede comprobar usuario en estos momentos. Vuelva a intentarlo en unos minutos";
            header('Location: ./index.php');
        }

        // Habría que comprobar si hubo un intento de XSS y
        // contestar con un mensaje de error reprobatorio
        $usuario = htmlspecialchars($_POST['identificador']);
        $password = htmlspecialchars($_POST['password']);

        // Nos quedda: Hacer la query
        // Redireccionar a index si no está o la constraseña es errónea
        // Redireccionar a inicio.php si todo es correcto

        $querySQL = "SELECT * FROM usuarios WHERE idusuario = `$usuario`";
        $resultado = $mysqli -> query($querySQL);

        if ($resultado -> num_rows == 0) { // Usuario inexistente
            $_SESSION['error'] = "Usuario incorrecto";
            header('Location: ./index.php');
        } else { // Usuario encontrado
            // Comprobar si la password coincide
            // Si no, mensaje de error y redireccionar a index.php
            // Si sí, redireccionar a inicio.php
            $_SESSION['error'] = 'Usuario reconocido';
            header('Location: ./index.php');
        }

    } else {

        $_SESSION['error'] = "Debe hacer login para acceder";
        header('Location: ./index.php');

    }
?>