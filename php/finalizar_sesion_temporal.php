<?php

    require_once './modulo.php';

    $sid = $_GET['sid'];
    // Iniciar la sesión si no está iniciada
    session_id($sid);
    session_start();

    //Actualizamos la Sesión Temporal en la BD
    $conn = conexion();
    $sql = "sp_SesionesTemporales 2,'','$sid','1'";
    $resultado = $conn->query($sql);
    $resultado = $resultado->fetch();
    $conn = null;

    // Destruir la sesión
    session_unset();   // Eliminar todas las variables de sesión
    session_destroy(); // Destruir la sesión

    echo 'la sesion ha expirado';
    

?>