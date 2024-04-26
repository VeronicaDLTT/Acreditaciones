<?php
    require_once '../modulo.php';

    $html = '';
    $IdDepartamento = $_POST['IdDepartamento'];

    $conn = conexion();
    $sql = "sp_PuestosTrabajo 5,'',$IdDepartamento,''";
    $resultado = $conn->query($sql);
    $resultado = $resultado->fetchAll();
    $conn = null;

    $html .= '<option value="0">-- Selecciona un Puesto de Trabajo --</option>';

    foreach($resultado as $rows){
        $html .= '<option value="'.$rows['IdPuestoTrabajo'].'">'.$rows['Puesto'].'</option>';
    }

    echo $html;

?>