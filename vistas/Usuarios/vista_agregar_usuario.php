<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Lista de Actividades Pendientes</title>
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

    <?php require_once '../menu.php'; ?>

    <div class="container">

        <h2>Agregar usuarios</h2>

        <?php
            require_once '../../php/modulo.php';

            //Información de los Departamentos
            $conn = conexion();
            $sql = "sp_Departamentos 5,'',''";
            $resultado = $conn->query($sql);
            $resultado = $resultado->fetchAll();
            $conn = null;
        ?>

        <form action="../../php/Usuarios/agregar_usuario.php" method="post" name="form_agregar_usuarios">
            <div class="row">
                <div class="col-md-5">
                    <label>Departamento</label>
                    <select id="Departamento" name="Departamento">
                        <option value="0">-- Selecciona un Departamento --</option>
                        <?php
                            foreach($resultado as $rows){
                                echo '<option value="'.$rows['IdDepartamento'].'">'.$rows['Departamento'].'</option>';
                            }
                        ?>
                    </select>

                </div>
            </div>

            <div class="row">
                <div class="col-md-5">
                    <label>Puesto</label>
                    <select id="Puesto" name="Puesto">
                        <option value="0">-- Selecciona un Puesto de Trabajo --</option>

                    </select>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-5">
                    <label>Correo</label>
                    <input type="email" id="Correo" name="Correo"/>
                </div>
            </div>
                    
            <div class="row">
                <div class="col-md-5">
                    <label>Estado</label>
                    <select id="Estado" name="Estado">
                        <option value="0">INACTIVO</option>
                        <option value="1" selected>ACTIVO</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-5">
                    <label>Tipo de Usuario</label>
                    <select id="TipoUsuario" name="TipoUsuario">
                        <option value="A">Administrador</option>
                        <option value="M" >Moderador</option>
                        <option value="G" selected>Usuario General</option>
                    </select>
                </div>
            </div>
            
            <button type="submit" class="enviar" id="agregar_usuario" name="agregar_usuario">Agregar</button>

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
                    });
                });
            });
        });
    </script>

</body>
</html>