<?php
    include 'establecer-sesion-php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login PHP</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="shortcut icon" href="playamar.png" type="image/x-icon">
</head>
<body class="bg-light">

    <div class="container-fluid py-5 bg-white shadow-sm">
        <div class="container">
            <div class="row justify-content-center">
                <div>
                    <h1 class="text-center mb-4 fw-bold">Iniciar sesión</h1>
                    <form action="autenticacion.php" method="post">
                        <!-- Aquí se mostrarán los errores desde dentro de la aplicación -->
                        <?php
                            if (isset($_SESSION['error'])) {
                                echo "<div class='alert alert-danger' role='alert'>";
                                echo $_SESSION['error'];
                                echo "</div>";
                                $_SESSION['error']="";
                                unset($_SESSION['error']); // Desaparece la key y la variable
                            }
                        ?>

                        <!-- Nombre de usuario -->
                        <div class="mb-3">
                            <label for="indentificador" class="form-label">Nombre de usuario</label>
                            <input type="text" name="identificador" id="identificador" class="form-control form-control-lg" placeholder="" required>
                            <div id="identificadorHelp" class="form-text">Requerido y con caracteres válidos</div>
                        </div>
                        <!-- Contraseña -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="" required>
                            <div id="passwordHelp" class="form-text">Debe tener mayúsculas, minúsculas, dígitos y caracteres especiales</div>
                        </div>
                        <button class="btn btn-primary btn-lg mt-2">Acceder</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="validaciones.js"></script>
</body>
</html>