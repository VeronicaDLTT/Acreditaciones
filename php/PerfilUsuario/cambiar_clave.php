<?php
    try{

        require_once '../modulo.php';

        $tempData = '';

        //Obtenemos los valores del Formulario
        $correo = $_POST['correo'];
        $claveActual = $_POST['claveActual'];
        $claveNueva1 = $_POST['claveNueva1'];
        $claveNueva2 = $_POST['claveNueva2'];
        $sid = $_POST['sid'];

        //Obtenemos el correo original del usuario
        $correoDec = base64_decode($correo);
        $correoOriginal = preg_split("/\=/",$correoDec);
        $correoUsuario = $correoOriginal[1];

        session_id($sid);
        session_start();

        //Verificamos si la clave actual es correcta
        $conn = conexion();
        $sql = "sp_Usuarios 8,'','','','$claveActual','$correoUsuario',''";
        $resultado = $conn->query($sql);
        $resultado = $resultado->fetch();
        $conn = null;

        $cantidad = $resultado[0];

        if($cantidad == 1){
            //La clave actual es correcta, validamos que la claveNueva1 y claveNueva2 sean iguales
            if($claveNueva1 == $claveNueva2){
                //Actualizamos la clave
                $conn = conexion();
                $sql = "sp_Usuarios 9,'','','','$claveNueva1','$correoUsuario',''";
                $resultado = $conn->query($sql);
                $resultado = $resultado->fetch();
                $conn = null;

                $success = $resultado[0];
                $message = $resultado[1];

                if($success == 1){

                    //Actualizamos la Sesión Temporal en la BD
                    $conn = conexion();
                    $sql = "sp_SesionesTemporales 2,'','$sid','1'";
                    $resultado = $conn->query($sql);
                    $resultado = $resultado->fetch();
                    $conn = null;

                    // Destruir la sesión
                    session_unset();   // Eliminar todas las variables de sesión
                    session_destroy(); // Destruir la sesión

                    session_start();
                    $tempData = $message;
                    $_SESSION['tempData'] = $tempData;

                    header("Location: ../../index.php");
                    exit();
                }
            }else{
                //echo 'La clave nueva no es correcta intentelo de nuevo.';
                $tempData = 'Las claves no son iguales, intentelo de nuevo.';
                $_SESSION['tempData'] = $tempData;

                header("Location:  ../../vistas/PerfilUsuario/vista_cambiar_clave.php?".$correo.'&sid='.$sid);
                exit();

            }
        }else{
            $tempData = 'La Clave Actual no es correcta intentelo de nuevo.';
            $_SESSION['tempData'] = $tempData;

            header("Location:  ../../vistas/PerfilUsuario/vista_cambiar_clave.php?".$correo.'&sid='.$sid);
            exit();
        }

    }catch(PDOException $e) {
        print("Error connecting to SQL Server.");
        die(print_r($e));
    }
?>