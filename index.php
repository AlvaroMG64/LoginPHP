<?php
include 'establecer-sesion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login PHP</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
  <link rel="shortcut icon" href="playamar.png" type="image/x-icon">
  <style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #1f2a44;
    }
    .container-fluid {
        background-color: #ffffff;
        border-radius: 12px;
        padding: 40px;
    }
    h1 {
        color: #1f2a44;
    }
    .btn-primary {
        background-color: #4a6ea0;
        border: none;
    }
    .btn-primary:hover {
        background-color: #36538b;
    }
    .form-text {
        color: #1f2a44;
    }
  </style>
</head>
<body>

    <div class="container-fluid py-5 shadow-sm">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <h1 class="text-center mb-4 fw-bold">Iniciar sesión</h1>
                    <form action="autenticacion.php" method="post">
                        <!-- Errores desde la aplicación -->
                        <?php
                        if (isset($_SESSION['error']) && $_SESSION['error'] != "") {
                            echo "<div class='alert alert-danger' role='alert'>";
                            echo $_SESSION['error'];
                            echo "</div>";
                            $_SESSION['error'] = "";
                            unset($_SESSION['error']);
                        }
                        ?>

                        <!-- Token CSRF -->
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

                        <!-- Nombre de usuario -->
                        <div class="mb-3">
                            <label for="identificador" class="form-label">Nombre de usuario</label>
                            <input type="text" name="identificador" id="identificador" class="form-control form-control-lg" placeholder="" required>
                            <div id="identificadorHelp" class="form-text">Requerido y con caracteres válidos</div>
                        </div>

                        <!-- Contraseña -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="" required>
                            <div id="passwordHelp" class="form-text">Debe tener mayúsculas, minúsculas, dígitos y caracteres especiales (!@#$%&*?-)</div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg mt-2 w-100">Acceder</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script src="validaciones.js"></script>
</body>
</html>