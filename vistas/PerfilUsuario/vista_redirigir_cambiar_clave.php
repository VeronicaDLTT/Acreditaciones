<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Cambiar Clave</title>
    <style>
        body {
            background-color: rgb(247, 247, 247);
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        h1 {
            color: black;
            text-align: center;
        }

        p {
            font-family: verdana;
            font-size: 16px;
        }

        img {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        div {
            display: inline-block;
            width: 100%;
        }

        .contenedor {
            text-align: center;
            margin: 0 auto;
        }

        .centrado {
            background-color: white;
            text-align: center;
            width: 600px;
            height: 450px;
            position: relative;
            margin: 0 auto;
        }

        .logotipos {
            display: flex;
            justify-content: space-around;
        
        }

        .imglogos {
            height: 100px;
        }

        .enviar {
            background-color: #fcbd36;
            border-radius: 5px;
            padding: 8px;
            font-family: arial;
            width: 80%;
            color: white;
            font-size: 14px;
            border-color: #fcdb36;
        }

        input[type=text],
        input[type=password] {
            width: 80%;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
            border-radius: 5px;
        }

        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: purple;
            color: yellow;
            text-align: center;
            padding: 10px 0;
        }
        
    </style>
</head>
<body>

    <div class="logotipos"> 
        <img class="imglogos" src="../../img/cacei2.png"> 
        <img class="imglogos" src="../../img/blanco con morado.png">
    </div>

    <hr style="color:purple; margin-top:0.5%;" >

    <div class="contenedor">
        <div class="centrado">
            <br>
            <p><b>Cambiar clave</b></p>
            <br>
            <p>Para cambiar su clave ingrese a su correo y siga las instrucciones.</p>
            <br><br><br>
            <p id="countdown">Redireccionando a la Página de Inicio en 20 segundos...</p>
        </div>
    </div>

    
       <?php
            require_once '../footer.php';
            require_once '../../php/modulo.php';

            $success = 0; //Resultado de la sentencia de la BD
            $message = ''; //Mensaje del resultado de la sentencia de la BD

            // Inicia la sesión si no está iniciada
            session_start();

            //Recuperamos el correo del usuario
            if(isset($_SESSION['Correo'])){
                $correo = $_SESSION['Correo'];
            }

            // Destruye la sesión
            session_destroy();

            //Creamos una Sesión Temporal para la actualización de la Clave
            session_start();
            $sid = session_id();

            //Agregamos la Sesión Temporal a la BD
            $conn = conexion();
            $sql = "sp_SesionesTemporales 1,'','$sid','0'";
            $resultado = $conn->query($sql);
            $resultado = $resultado->fetch();
            $conn = null;

            if(count($resultado) > 0 ){
                $success = $resultado[0];
                $message = $resultado[1];

                if($success == 1){

                    //Enviamos el correo con la información
                    $correoEnc = base64_encode("variable=".$correo);
                    $url = 'http://localhost/vistas/PerfilUsuario/vista_cambiar_clave.php?'.$correoEnc.'&sid='.$sid;
                    $mensaje = 'Abrir el siguiente <a href="'.$url.'">enlace</a> para cambiar su clave de acceso.';

                    // Cabeceras para indicar que el correo es en formato HTML
                    $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
                    $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                    mail($correo,'Cambiar clave',$mensaje, $cabeceras);

                }else{
                    $message = 'Ocurrio un error al enviar correo para cambiar la clave.';
                }
            }else{
                $message = 'Ocurrio un error al enviar correo para cambiar la clave.';
            }

            $_SESSION['tempData'] = $message;

        ?>

    <script>
        // Definir el tiempo de espera en segundos
        var tiempoEspera = 20;

        // Función para actualizar el contador de tiempo restante
        function actualizarContador() {
            document.getElementById('countdown').innerHTML = 'Redireccionando a la Página de Inicio en ' + tiempoEspera + ' segundos...';
            tiempoEspera--;

            // Si el tiempo de espera llega a cero, redirige
            if (tiempoEspera < 0) {
                window.location.href = "../../index.php";
            } else {
                // Si no ha llegado a cero, espera un segundo y actualiza de nuevo
                setTimeout(actualizarContador, 1000);
            }
        }

        // Llamar a la función para comenzar el contador
        actualizarContador();
    </script>

</body>
</html>