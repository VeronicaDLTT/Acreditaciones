<?php

    try {
        //require_once '../modulo.php';

        //Mostrar información de los Usuarios
        $tabla = "";
        
        $conn = conexion();
        $sql = "sp_Usuarios 5,'','','','','',''";

        $resultado = $conn->query($sql);
        $resultado = $resultado->fetchAll();

        $tabla.='
            <div class="container">
                <table>
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Departamento</th>
                            <th>Puesto</th>
                            <th>Correo</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
            
        ';
        
        foreach($resultado as $rows){
            $tabla.='
                <tr>
                    <td>'.$rows['Usuario'].'</td>
                    <td>'.$rows['Departamento'].'</td>
                    <td>'.$rows['Puesto'].'</td>
                    <td>'.$rows['Correo'].'</td>
                    <td>'.$rows['Estado'].'</td>
                    <td><a href="../../vistas/Usuarios/vista_modificar_usuario.php?usuario='.$rows['Usuario'].'" class="enviar">Modificar</a></td>
                </tr>
            ';

        }

        $tabla.='</tbody></table></div>';
        $conn = null;
        echo $tabla;
    //Fin de Mostrar información de los Usuarios

    }
    catch (PDOException $e) {
        print("Error connecting to SQL Server.");
        die(print_r($e));
    }
    
?>