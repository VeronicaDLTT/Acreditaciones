<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Perfil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        #container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 10px;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }
        li a {
            text-decoration: none;
            color: #333;
            display: block;
        }
        .usuario {
            background-color: #6a0dad;
            color: #fff;
            padding: 20px;
            text-align: right;
        }
        .tareas {
            float: left;
            width: 90%;
            /*padding-right: 10px;*/
        }
        .carpetas {
            /*float: right;*/
            /*width: 20%;*/
            position: relative;
            display: inline-block;

        }
        .carpetas h1 {
            color: #6a0dad;
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
        .enviar {
            background-color: #fcbd36;
            border-radius: 5px;
            padding: 8px;
            font-family: arial;
            width: 80%;
            color: white;
            font-size: 14px;
            border-color: #fcdb36;
            width: 150px;
        }
        
    </style>
</head>
<body>
    <?php
        require_once '../menu.php';

        //Recuperamos los datos de la sesión del Usuario
        if(isset($_SESSION['IdUsuario']) && isset($_SESSION['Usuario']) && isset($_SESSION['Departamento']) && isset($_SESSION['Puesto']) && isset($_SESSION['Correo'])){
            $IdUsuario = $_SESSION['IdUsuario'];
            $Usuario = $_SESSION['Usuario'];
            $Departamento = $_SESSION["Departamento"];
            $Puesto = $_SESSION["Puesto"];
            $Correo = $_SESSION["Correo"];
        }else{
            $IdUsuario = 0;
            $Departamento = "";
            $Puesto = "";
            $Correo = "";
        }

        if(isset($_SESSION['tempData'])){
            $tempData = $_SESSION['tempData'];

            $_SESSION['tempData'] = "";
        }else{
            $tempData = "";
        }

    ?>

    <div class="container">
        <h2>Perfil</h2>

        <span><?php echo $tempData; ?></span>
        <?php
            if($IdUsuario == 0){
                echo 'No hay datos que mostrar.' ;
            }
        ?>

        <br>
        <label><b>Usuario:</b> <?php echo $Usuario; ?></label>
        <br>
        <label><b>Departamento:</b> <?php echo $Departamento; ?></label>
        <br>
        <label><b>Puesto:</b> <?php echo $Puesto; ?></label>
        <br>
        <label><b>Correo:</b> <?php echo $Correo; ?></label>
        <br>
        <a size="200px" class="enviar" href="./vista_editar_perfil.php" >Editar Perfil</a>

    </div>
    
    <?php require_once '../footer.php' ?>
  
</body>
</html>