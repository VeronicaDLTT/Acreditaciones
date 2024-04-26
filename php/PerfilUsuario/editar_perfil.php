<?php

    try{
        session_start();

        if(isset($_SESSION['TipoUsuario']) && isset($_SESSION['IdUsuario'])){
            $TipoUsuarioS = $_SESSION['TipoUsuario'];
            $IdUsuario = $_SESSION['IdUsuario'];
        }

        require_once '../modulo.php';

        $success = 0;
        $message = '';

        $Departamento = $_POST['Departamento'];
        $Puesto = $_POST['Puesto'];
        $Correo = $_POST['Correo'];

        
        //Se edita el Usuario
        $conn = conexion();
        $sql = "sp_Usuarios 2,'$IdUsuario',$Puesto,'','','$Correo',0,'',''";
        $resultado = $conn->query($sql);
        $resultado = $resultado->fetch();

        $success = $resultado[0];
        $message = $resultado[1];

        $conn = null;

        if($success != 1){
            $message = 'Error al actualizar la información del Perfil.';
        }else{
            //Actualizamos los datos de la sesión del Usuario
            $conn = conexion();
            $sql = "sp_Usuarios 4,'$IdUsuario','','','','',''";
            $resultado = $conn->query($sql);
            $resultado = $resultado->fetch();
            $conn = null;

            //Guardamos los datos del Usuario en una sesión
            $_SESSION['IdUsuario'] = $resultado[0];
            $_SESSION['Usuario'] = $resultado[1];
            $_SESSION["IdDepartamento"] = $resultado[2];
            $_SESSION["Departamento"] = $resultado[3];
            $_SESSION["IdPuestoTrabajo"] = $resultado[4];
            $_SESSION["Puesto"] = $resultado[5];
            $_SESSION["Correo"] = $resultado[6];
            $_SESSION["Estado"] = $resultado[7];
            $_SESSION["TipoUsuario"] = $resultado[8];
        }

        $_SESSION['tempData'] = $message;

        header("Location:  ../../vistas/PerfilUsuario/vista_perfil.php");
        exit();
        

    }
    catch (PDOException $e) {
        print("Error connecting to SQL Server.");
        die(print_r($e));
    }
?>