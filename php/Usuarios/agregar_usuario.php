<?php

    try{
        session_start();

        if(isset($_SESSION['TipoUsuario'])){
            $TipoUsuarioS = $_SESSION['TipoUsuario'];
        }

        require_once '../modulo.php';

        $success = 0;
        $message = '';

        $Departamento = $_POST['Departamento'];
        $Puesto = $_POST['Puesto'];
        $Correo = $_POST['Correo'];
        $Estado = $_POST['Estado'];
        $TipoUsuario = $_POST['TipoUsuario'];

        if($TipoUsuarioS != 'A'){

            $message = 'No tiene permiso para realizar la operación.';
            $_SESSION['tempData'] = $message;

            header("Location:  ../../vistas/Actividades/principal.php");
            exit();
            
        }else{
            //Se agrega el Usuario
            $conn = conexion();
            $sql = "sp_Usuarios 1,'',$Puesto,'','','$Correo',0,$Estado,'$TipoUsuario'";
            $resultado = $conn->query($sql);
            $resultado = $resultado->fetch();

            $success = $resultado[0];
            $message = $resultado[1];

            $conn = null;

            if($success != 1){
                $message = 'Error al registrar el usuario.';
            }

            $_SESSION['tempData'] = $message;

            header("Location:  ../../vistas/Usuarios/vista_lista_usuarios.php");
            exit();
        }

    }
    catch (PDOException $e) {
        print("Error connecting to SQL Server.");
        die(print_r($e));
    }
?>