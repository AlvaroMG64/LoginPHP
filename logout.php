<?php
    include 'establecer-sesion-php';
    $_SESSION = [];
    session_destroy();
    // ***** Habría que destruir explícitamente la cookie
    // De sesión y otras cookies potencialmente peligrosas
    header("Location:./index.php");
?>