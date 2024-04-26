<?php
    //Recuperamos los datos de la sesión Usuario
    session_start();
    
    if(isset($_SESSION['Usuario']) && isset($_SESSION['TipoUsuario'])){
        $Usuario = $_SESSION['Usuario'];
        $TipoUsuario = $_SESSION['TipoUsuario'];
    }else{
        $Usuario = "Usuario";
        $TipoUsuario = "";
    }

?>

<div class="usuario">
    <!--span style="float:right;">Nombre de Usuario</span-->
    <div class="btn-group">
        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo $Usuario ?>
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="../PerfilUsuario/vista_perfil.php">Mi Perfil</a></li>
            <li><a class="dropdown-item" href="../Actividades/principal.php">Actividades</a></li>
            
            <?php 
                //Validar las pestañas de los Usuarios
                if($TipoUsuario == 'A'){
                    echo '<li><a class="dropdown-item" href="../Usuarios/vista_lista_usuarios.php">Usuarios</a></li>';
                }
            ?>

            <li><a class="dropdown-item" href="../../php/logout.php">Cerrar sesión</a></li>
        </ul>
    </div>
</div>