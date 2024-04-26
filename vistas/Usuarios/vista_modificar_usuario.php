<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Modificar Usuario</title>
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

        //Variables de la informacion del Usuario a Modificar
        $IdUsuarioMod = 0;
        $UsuarioMod = '';
        $IdDepartamentoMod = 0;
        $DepartamentoMod = '';
        $IdPuestoMod = 0;
        $PuestoMod = '';
        $CorreoMod = '';
        $EstadoMod = '';
        $TipoUsuarioMod = '';

        //Recuperamos el Usuario a modificar
        if(isset($_GET['usuario'])){
            $UsuarioMod = $_GET['usuario'];

            //Consulta para obtener la información del Usuario
            $conn = conexion();
            $sql = "sp_Usuarios 10,'','','$UsuarioMod'";
            $resultado = $conn->query($sql);
            $resultado = $resultado->fetch();
            $conn = null;

            if(count($resultado) > 0){
                $IdUsuarioMod = $resultado[0];
                $IdDepartamentoMod = $resultado[2];
                $DepartamentoMod = $resultado[3];
                $IdPuestoMod = $resultado[4];
                $PuestoMod = $resultado[5];
                $CorreoMod = $resultado[6];
                $EstadoMod = $resultado[7];
                $TipoUsuarioMod = $resultado[8];

            }else{
                $IdUsuarioMod = 0;
                $IdDepartamentoMod = 0;
                $DepartamentoMod = '';
                $IdPuestoMod = 0;
                $PuestoMod = '';
                $CorreoMod = '';
                $EstadoMod = '';
                $TipoUsuarioMod = '';
            }

        }else{
            $IdUsuarioMod = 0;
            $UsuarioMod = '';
            $IdDepartamentoMod = 0;
            $DepartamentoMod = '';
            $IdPuestoMod = 0;
            $PuestoMod = '';
            $CorreoMod = '';
            $EstadoMod = '';
            $TipoUsuarioMod = '';
        }

        //Información de los Departamentos
        $conn = conexion();
        $sql = "sp_Departamentos 5,'',''";
        $resultado = $conn->query($sql);
        $resultado = $resultado->fetchAll();
        $conn = null;

    ?>

    <div class="container">
        <h2>Modificar Usuario</h2>

        <?php
            if($UsuarioMod == ''){
                echo 'No hay datos que mostrar.' ;
            }
        ?>
        
        <br>

        <form action="../../php/Usuarios/modificar_usuario.php" method="post" id="form_modificar_usuario">
            <label><b>Usuario:</b></label>
            <input type="text" id="Usuario" name="Usuario" value="<?php echo $UsuarioMod; ?>" disabled/>

            <br>

            <label><b>Departamento:</b></label>
            <select id="Departamento" name="Departamento" disabled>
                <option value="0">-- Selecciona un Departamento --</option>
                <?php
                    foreach($resultado as $rows){
                        echo '<option value="'.$rows['IdDepartamento'].'">'.$rows['Departamento'].'</option>';
                    }
                ?>
            </select>

            <br>

            <label><b>Puesto:</b></label>
            <select id="Puesto" name="Puesto" disabled>
                <option value="0">-- Selecciona un Puesto de Trabajo --</option>
            </select>

            <br>

            <label><b>Correo:</b></label>
            <input type="email" id="Correo" name="Correo" value="<?php echo $CorreoMod; ?>"/>

            <br>

            <label><b>Estado:</b></label>
            <select id="Estado" name="Estado">
                <option value="0">INACTIVO</option>
                <option value="1">ACTIVO</option>
            </select>

            <label>Tipo de Usuario</label>
            <select id="TipoUsuario" name="TipoUsuario">
                <option value="A">Administrador</option>
                <option value="M">Moderador</option>
                <option value="G">Usuario General</option>
            </select>

            <button type="submit" class="enviar" id="modificar_usuario" name="modificar_usuario">Guardar Información</button>

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
            seleccionar_estado();
            seleccionar_tipo_usuario();
        });

        function seleccionar_departamento() {
            var selectElement = document.getElementById("Departamento");
            for(var i = 0; i < selectElement.options.length; i++){
                if (selectElement.options[i].text == "<?php echo $DepartamentoMod; ?>") {
                    
                    selectElement.options[i].selected = true;
                    i = selectElement.options.length;
                }
            }

            $("#Departamento").trigger("change");
            
        }

        function seleccionar_puesto() {
            var selectElement = document.getElementById("Puesto");
            for(var i = 0; i < selectElement.options.length; i++){
                if (selectElement.options[i].text == "<?php echo $PuestoMod; ?>") {
                    
                    selectElement.options[i].selected = true;
                    i = selectElement.options.length;
                }
            }
        }

        function seleccionar_estado() {
            var selectElement = document.getElementById("Estado");
            for(var i = 0; i < selectElement.options.length; i++){
                if (selectElement.options[i].value == "<?php echo $EstadoMod; ?>") {
                    
                    selectElement.options[i].selected = true;
                    i = selectElement.options.length;
                }
            }
        }

        function seleccionar_tipo_usuario() {
            var selectElement = document.getElementById("TipoUsuario");
            for(var i = 0; i < selectElement.options.length; i++){
                if (selectElement.options[i].value == "<?php echo $TipoUsuarioMod; ?>") {
                    
                    selectElement.options[i].selected = true;
                    i = selectElement.options.length;
                }
            }

        }

        //Habilatar campos para que se envien
        document.getElementById("form_modificar_usuario").addEventListener("submit", function() {
            document.getElementById("Usuario").disabled = false;
            document.getElementById("Departamento").disabled = false;
            document.getElementById("Puesto").disabled = false;
        });

    </script>
    
</body>
</html>