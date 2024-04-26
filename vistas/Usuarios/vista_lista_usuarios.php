<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Lista de Usuarios</title>
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
        require_once '../menu.php'; 
    
        if(isset($_SESSION['tempData'])){
            $tempData = $_SESSION['tempData'];

            $_SESSION['tempData'] = "";
        }else{
            $tempData = "";
        }

        //Información para generar Archivo Excel
        require_once '../../php/modulo.php';

        $libros = array();

        $conn = conexion();
        $sql = "sp_BitAccesos 2,'','','',''";
        $resultado = $conn->query($sql);
        $resultado = $resultado->fetchAll();
        $conn = null;

        foreach($resultado as $rows){
            $libro = array(
                'Departamento' => $rows['Departamento'],
                'Puesto' => $rows['Puesto'],
                'Usuario' => $rows['Usuario'],
                'Fecha' => $rows['Fecha'],
                'Hora' => $rows['Hora']
            );
            $libros[] = $libro;
        }
        
        $encabezados = array('Departamento', 'Puesto', 'Usuario', 'Fecha', 'Hora');
        $encabezados_json = json_encode($encabezados);
        $libros_json = json_encode($libros);
    ?>

    <div class="container">

        <h2>Lista de usuarios</h2>

        <span> <?php echo $tempData; ?> </span>

        <div class="row">
            <div class="col-md-6">
                <!--Formulario para generar Archivo Excel-->
                <form method="POST" action="../../php/Recursos/exportar_datos_excel.php">
                    <input type="hidden" name="libros" value='<?php echo $libros_json; ?>'/>
                    <input type="hidden" name="encabezados" value='<?php echo $encabezados_json; ?>'/>
                    <button type="submit" class="enviar" id="export_data" name="export_data">Generar Archivo</button>
                </form>
                <!--Fin Formulario para generar Archivo Excel-->
            </div>

            <div class="col-md-6">
                <a size="200px" class="enviar" href="./vista_agregar_usuario.php">Agregar</a>
            </div>
        </div>

        <?php
            try{

                require_once '../../php/Usuarios/lista_usuarios.php';

            }catch(Exception $e){
                echo 'Excepción capturada: ',  $e->getMessage();
            }
        ?>

    </div>

    <?php require_once '../footer.php'; ?>

</body>
</html>