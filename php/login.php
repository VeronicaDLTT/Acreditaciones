<?php
    
    try {
        require_once './modulo.php';

        session_start(); //Inicializamos la sesión

        $success = 0; //Resultado de la sentencia de la BD
        $message = ''; //Mensaje del resultado de la sentencia de la BD
        $Usuario = '';
        $Clave = '';

        if(isset($_POST["Usuario"]) && isset($_POST["Clave"])){
            //Información que se envia del formulario form_login
            $Usuario = $_POST["Usuario"];
            $Clave = $_POST["Clave"];

            //Valido si el Usuario tiene acceso al sistema
            $conn = conexion();
            $sql = "sp_Usuarios 6,'','','$Usuario','$Clave','',''";
            $resultado = $conn->query($sql);
            $resultado = $resultado->fetch();
            $conn = null;

            if(count($resultado) > 0){
                $success = $resultado[0];
                $message = $resultado[1];
            }

            if($success == 1){

                //El usuario tiene acceso al sistema, obtenemos la información del usuario
                $conn = conexion();
                $sql = "sp_Usuarios 7,'','','$Usuario','$Clave','',''";
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

                //Se registra el acceso del usuario
                $IdUsuario = $resultado[0];
                $conn = conexion();
                list($fecha, $hora) = fechaYHoraActual();
                $sql = "sp_BitAccesos 1,'','$IdUsuario','$fecha','$hora'";
                $resultado = $conn->query($sql);
                $conn = null;

                header("Location:  ../vistas/Actividades/principal.php");
                exit();
            }else{
                $message .= ' Ocurrió un error al ingresar al sistema.';
                $_SESSION['tempData'] = $message;
                header("Location:  ../index.php");
                exit();
            }
        }else{

            $Usuario = '';
            $Clave = '';

            $_SESSION['tempData'] = 'Ocurrió un error al ingresar al sistema. Intente de nuevo.';
            header("Location:  ../index.php");
            exit();

        }
        
    }
    catch (PDOException $e) {
        print("Error connecting to SQL Server.");
        die(print_r($e));
    }

    //Funcion para obtener la Fecha y Hora actual para registra el acceso del Usuario
    function fechaYHoraActual(){
        date_default_timezone_set('America/Chihuahua');
        $fechaActual = date("Y-m-d");
        $hora1 = date("H:i:s.v");
        $horaActual = strtotime('-1 hour', strtotime($hora1));
        $horaActual = date("H:i:s", $horaActual);

        return array($fechaActual, $horaActual);
    }
?>