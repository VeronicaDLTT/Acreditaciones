<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
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
            width: 400px;
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
    <?php
        require '../../php/modulo.php';
        
        //Obtenemos el correo del Usuario y el ID de la sesión
        $enlace_actual = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $enlace_separado = preg_split("/\?/",$enlace_actual);
        $variables = $enlace_separado[1];
        $variables = preg_split("/\&/",$variables);
        $correoEnc = $variables[0];
        $sid = $_GET['sid'];

        //Verificamos si la Sesión Temporal ya fue usada
        $conn = conexion();
        $sql = "sp_SesionesTemporales 4,'','$sid',''";
        $resultado = $conn->query($sql);
        $resultado = $resultado->fetch();
        $conn = null;

        if(count($resultado) > 0){
            $success = $resultado[0];
            $message = $resultado[1];

            if($success == 1){
                //La Sesión ya fue usada, finalizamos la sesión
                header("Location: http://localhost/php/finalizar_sesion_temporal.php?sid=".$sid);
                exit();
            }else{
                //Iniciamos la Sesión Temporal
                session_id($sid);
                session_start();

                if (isset($_SESSION['tempData'])) {
                    $tempData = $_SESSION['tempData'];
                    $_SESSION['tempData'] = "";
                } else {
                    $tempData = "";
                }

                require_once './vista_form_cambiar_clave.php';

            }
        }

    ?>

</body>
</html>