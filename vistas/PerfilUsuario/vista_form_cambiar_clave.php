

<div class="logotipos"> 
    <img class="imglogos" src="../../img/cacei2.png"> 
    <img class="imglogos" src="../../img/blanco con morado.png">
</div>

<hr style="color:purple; margin-top:0.5%;" >

<p id="countdown">Redireccionando a la Página de Inicio en 20 segundos...</p>

<div class="contenedor">
    <div class="centrado">
        <form action="../../php/PerfilUsuario/cambiar_clave.php" method="post">
            <br>
            <p><b>Cambiar clave</b></p>
            <span><?php echo $tempData; ?></span>
            <br>
            <label>Clave actual: </label> <br>
            <input type="password" id="claveActual" name="claveActual">
            <br><br>
            <label>Clave nueva: </label> <br>
            <input type="password" id="claveNueva1" name="claveNueva1">
            <br><br>
            <label>Repetir Clave: </label> <br>
            <input type="password" id="claveNueva2" name="claveNueva2">
            <br><br>
            <input type="hidden" id="correo" name="correo" value="<?php echo $correoEnc ?>">
            <input type="hidden" id="sid" name="sid" value="<?php echo $sid ?>">
            <button type="submit" class="enviar">Guardar</button>
        </form>
    </div>
</div>

<script>
    // Definir el tiempo de espera en segundos
    var tiempoEspera = 20;

    // Función para actualizar el contador de tiempo restante
    function actualizarContador() {
        document.getElementById('countdown').innerHTML = 'Redireccionando a la Página de Inicio en ' + tiempoEspera + ' segundos...';
        tiempoEspera--;
        
        // Si el tiempo de espera llega a cero, redirige
        if (tiempoEspera < 0) {
            
            window.location.href = "http://localhost/php/finalizar_sesion_temporal.php?sid="<?php echo $sid ?>;
        } else {
            // Si no ha llegado a cero, espera un segundo y actualiza de nuevo
            setTimeout(actualizarContador, 1000);
        }
    }

    // Llamar a la función para comenzar el contador
    actualizarContador();
</script>

<?php require_once '../footer.php'; ?>