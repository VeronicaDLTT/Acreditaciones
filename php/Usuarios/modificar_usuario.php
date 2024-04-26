<?php

    try{
        require_once '../modulo.php';

        session_start();

        $TipoUsuarioS = ''; //Variable para el Tipo de Usuario de la sesión actual
        $success = 0; //Resultado de la sentencia de la BD
        $message = ''; //Mensaje del resultado de la sentencia de la BD

        //Obtenemos el Usuario de la sesión actual
        if(isset($_SESSION['TipoUsuario'])){
            $TipoUsuarioS = $_SESSION['TipoUsuario'];
        }else{
            $TipoUsuarioS = '';
        }

        if(isset($_POST['Usuario']) && isset($_POST['Departamento']) && isset($_POST['Puesto']) && isset($_POST['Correo']) && isset($_POST['Estado']) && isset($_POST['TipoUsuario'])){
            
            //Información que se envia desde el formulario
            $Usuario = $_POST['Usuario'];
            $Departamento = $_POST['Departamento'];
            $Puesto = $_POST['Puesto'];
            $Correo = $_POST['Correo'];
            $Estado = $_POST['Estado'];
            $TipoUsuario = $_POST['TipoUsuario'];

            //Validar si el Usuario de la sesion actual tiene permiso para modificar información de los demás Usuarios
            if($TipoUsuarioS != 'A'){

                $message = 'No tiene permiso para realizar la operación.';

            }else{

                //Se modifica el Usuario
                $conn = conexion();
                $sql = "sp_Usuarios 11,'',$Puesto,'$Usuario','','$Correo',0,$Estado,'$TipoUsuario'";
                $resultado = $conn->query($sql);
                $resultado = $resultado->fetch();
                $conn = null;

                if(count($resultado) > 0){
                    //La sentencia de la BD generó un resultado
                    $success = $resultado[0];
                    $message = $resultado[1];

                    if($success != 1){
                        $message .= ' No se logró actualizar la información del usuario.';
                    }
    
                    
                }else{

                    $message .= 'Error al modificar el usuario.';

                }
                
            }

        }else{

            $message = 'Error al guardar la información capturada.';

        }

        $_SESSION['tempData'] = $message;
        header("Location:  ../../vistas/Usuarios/vista_lista_usuarios.php");
        exit();

    }
    catch (PDOException $e) {
        print("Error connecting to SQL Server.");
        die(print_r($e));
    }
?>