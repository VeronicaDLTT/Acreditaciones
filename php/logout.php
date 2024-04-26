<?php
    // Inicia la sesión si no está iniciada
    session_start();

    // Destruye la sesión
    session_destroy();

    // Redirige a donde quieras después de cerrar sesión
    header("Location: http://127.0.0.1");
    exit();
?>