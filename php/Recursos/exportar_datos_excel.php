<?php
    $libros = array();
    $encabezados = array();
    $tabla = '';

    if(isset($_POST["export_data"])) {
        if(isset($_POST['libros'])){
            $libros = json_decode($_POST['libros'], true);
            $encabezados = json_decode($_POST['encabezados']);

            if(!empty($libros)) {
                $filename = "lista_usuarios.xls";
                header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
                header("Content-Disposition: attachment; filename=".$filename);
           
                $mostrar_columnas = false;
                $encabezados = array('Departamento', 'Puesto', 'Usuario', 'Fecha', 'Hora');
            
                foreach($libros as $libro) {
    
                    if(!$mostrar_columnas) {
                        echo implode("\t", $encabezados) . "\n";
                        $mostrar_columnas = true;
                    }
                    echo implode("\t", array_values($libro)) . "\n";
                }
           
            }else{
                echo 'No hay datos a exportar';
            }
        }else{
            
            echo 'Error al generar el archivo.' ;
        }
        
        exit;
    }

?>
