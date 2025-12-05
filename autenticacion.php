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

        $querySQL = "SELECT * FROM usuarios WHERE idusuario = '". $usuario . "'";
        $resultado = $mysqli -> query($querySQL);

        if ($resultado -> num_rows == 0) { // Usuario inexistente
            $_SESSION['error'] = "Usuario incorrecto";
            header('Location: ./index.php');
        } else { // Usuario encontrado
            $row = mysqli_fetch_object($resultado); // Trata la fila como un objeto
            // Ahora hay que ver si la password introducida coincide
            // El objeto $row es de la clase stdClass
            if ($row->password == $password) {
                // Cojo todos los datos de este usuario y los paso como
                // Variables de sesión
                $_SESSION['nombre'] =  $row->nombre;
                $_SESSION['apellidos'] =  $row->apellidos;
                header("Location: ./inicio.php");
            } else {
                $_SESSION['error'] = "Contraseña incorrecta";
                header("Location: ./index.php");
            }
            //  Libera la conexión con la base de datos
            $mysqli->close();
        }

    } else {

        $_SESSION['error'] = "Debe hacer login para acceder";
        header('Location: ./index.php');

    }
?>