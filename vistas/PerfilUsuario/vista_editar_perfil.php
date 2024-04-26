<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Editar Perfil</title>
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
        require_once '../../php/modulo.php';

        //Recuperamos los datos de la sesión Usuario
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

        //Información de los Departamentos
        $conn = conexion();
        $sql = "sp_Departamentos 5,'',''";
        $resultado = $conn->query($sql);
        $resultado = $resultado->fetchAll();
        $conn = null;

    ?>

    <div class="container">
        <h2>Editar Perfil</h2>

        <?php
            if($IdUsuario == 0){
                echo 'No hay datos que mostrar.' ;
            }
        ?>
        
        <br>

        <form action="../../php/PerfilUsuario/editar_perfil.php" method="post" id="form_editar_perfil_usuario">
            <label><b>Usuario:</b></label>
            <input type="text" id="Usuario" name="Usuario" value="<?php echo $Usuario; ?>"/>

            <br>

            <label><b>Clave:</b></label>
            <a size="200px"href="../PerfilUsuario/vista_redirigir_cambiar_clave.php">Cambiar clave</a>

            <br>

            <label><b>Departamento:</b></label>
            <select id="Departamento" name="Departamento">
                <option value="0">-- Selecciona un Departamento --</option>
                <?php
                    foreach($resultado as $rows){
                        echo '<option value="'.$rows['IdDepartamento'].'">'.$rows['Departamento'].'</option>';
                    }
                ?>
            </select>

            <br>

            <label><b>Puesto:</b></label>
            <select id="Puesto" name="Puesto">
                <option value="0">-- Selecciona un Puesto de Trabajo --</option>
            </select>

            <br>

            <label><b>Correo:</b></label>
            <input type="email" id="Correo" name="Correo" value="<?php echo $Correo; ?>"/>

            <br>

            <button type="submit" class="enviar" id="editar_perfil_usuario" name="editar_perfil_usuario">Guardar Información</button>

        </form>

    </div>
    
    <?php require_once '../footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script>

        $(document).ready(function(){
            
            $("#Departamento").on('change', function () {
                $("#Departamento option:selected").each(function () {
                    var IdDepartamento = $(this).val();
                    $.post("../../php/Recursos/puestos.php", { IdDepartamento: IdDepartamento }, function(data) {
                        $("#Puesto").html(data);
                        seleccionar_puesto();
                    });
                });
            });
            seleccionar_departamento();
        });

        function seleccionar_departamento() {
            var selectElement = document.getElementById("Departamento");
            for(var i = 0; i < selectElement.options.length; i++){
                if (selectElement.options[i].text == "<?php echo $Departamento; ?>") {
                    
                    selectElement.options[i].selected = true;
                    i = selectElement.options.length;
                }
            }

            $("#Departamento").trigger("change");
            
        }

        function seleccionar_puesto() {
            var selectElement = document.getElementById("Puesto");
            for(var i = 0; i < selectElement.options.length; i++){
                if (selectElement.options[i].text == "<?php echo $Puesto; ?>") {
                    
                    selectElement.options[i].selected = true;
                    i = selectElement.options.length;
                }
            }
        }

    </script>
    
</body>
</html>