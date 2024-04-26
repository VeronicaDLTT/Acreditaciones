<?php   
    
    function conexion(){
        
        $pdo = new PDO("sqlsrv:server = ; Database = ", "", "");
        
        return $pdo;
    }
?>

