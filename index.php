<?php
  session_start();

  //Mensajes de retroalimentación para el Usuario
  if (isset($_SESSION['tempData'])) {
    $tempData = $_SESSION['tempData'];
    $_SESSION['tempData'] = "";
  } else {
    $tempData = "";
  }

  session_destroy();
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>BIENVENIDOS A :</title>
  <style>
    body {
      background-color: rgb(247, 247, 247);
      margin: 0;
      padding: 0;
      overflow-x: hidden;
      /*font-family: 'Segoe UI', sans-serif;*/
      font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    }

    h1 {
      color: black;
      text-align: center;
    }

    p {
      /*font-family: Verdana;*/
      font-size: 20px;
    }

    img {
      display: block;
      margin-left: auto;
      margin-right: auto;
    }

    div {
      display: inline-block;
      width: 100%;
    }

    .contenedor {
      text-align: center;
      margin: 0 auto;
    }

    .centrado {
      background-color: white;
      text-align: center;
      width: 400px;
      height: 450px;
      position: relative;
      margin: 0 auto;
    }

    .logotipos {
      display: flex;
      justify-content: space-around;

    }

    .imglogos {
      height: 100px;
    }

    .enviar {
      background-color: #fcbd36;
      border-radius: 5px;
      padding: 8px;
      /*font-family: arial;*/
      width: 80%;
      color: white;
      font-size: 14px;
      border-color: #fcdb36;
    }

    input[type=text],
    input[type=password] {
      width: 80%;
      padding: 12px 20px;
      margin: 8px 0;
      box-sizing: border-box;
      border-radius: 5px;
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

  <div class="logotipos">
    <img class="imglogos" src="img/cacei2.png">
    <img class="imglogos" src="img/blanco con morado.png">
  </div>

  <hr style="color:purple; margin-top:0.5%;">

  <div class="contenedor">
    <div class="centrado">
      <form action="./php/login.php" method="post" id="form_login">
        <img class="imglogos" src="img/ingenieria_fondoblanco circulo.png">
        <p>Inicio de sesión</p>
        <label for="usuario">Nombre de usuario :</label><br>
        <input type="text" id="Usuario" name="Usuario" size="40"><br><br>
        <label for="Clave">Contraseña :</label><br>
        <input type="password" id="Clave" name="Clave" size="40"><br><br>
        <button type="submit" class="enviar">Ingresar</button>
      </form>
      <span><?php echo $tempData ?></span>
    </div>

  </div>

  <div class="footer">
    <span id="fecha_actual"></span>
  </div>

  <script>
    // Función para actualizar la fecha actual
    function actualizarFecha() {
      const fecha = new Date();
      const opciones = {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
      };
      document.getElementById('fecha_actual').textContent = fecha.toLocaleDateString('es-ES', opciones);
    }

    // Ejecutar la función para actualizar la fecha al cargar la página
    actualizarFecha();
    // Actualizar la fecha cada segundo
    setInterval(actualizarFecha, 1000);
  </script>

</body>

</html>