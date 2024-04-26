<?php require_once '../menu.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <title>Lista de Actividades Pendientes</title>

    <style>
        * {box-sizing: border-box}
        body {font-family: Verdana, sans-serif; margin:0}
        .mySlides {display: none}
        img {vertical-align: middle;}

        .slideshow-img {
            width: 100%; /* Asegúrate de que la imagen ocupe todo el ancho del contenedor */
            height: auto; /* Esto permite que la imagen mantenga su proporción de aspecto */
        }

        /* Slideshow container */
        .slideshow-container {
            max-width: 1000px;
            position: relative;
            margin: auto;
            
        }

        /* Next & previous buttons */
        .prev, .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            margin-top: -22px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
        }

        /* Position the "next button" to the right */
        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        /* On hover, add a black background color with a little bit see-through */
        .prev:hover, .next:hover {
            background-color: rgba(0,0,0,0.8);
        }

        /* Caption text */
        .text {
            color: #f2f2f2;
            font-size: 15px;
            padding: 8px 12px;
            position: absolute;
            bottom: 8px;
            width: 100%;
            text-align: center;
        }

        /* Number text (1/3 etc) */
        .numbertext {
            color: #f2f2f2;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0;
        }

        /* The dots/bullets/indicators */
        .dot {
            cursor: pointer;
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.6s ease;
        }

        .active, .dot:hover {
            background-color: #717171;
        }

        /* Fading animation */
        .fadeSlide {
            animation-name: fade;
            animation-duration: 1.5s;
        }

        @keyframes fade {
            from {opacity: .4} 
            to {opacity: 1}
        }

        /* On smaller screens, decrease text size */
        @media only screen and (max-width: 300px) {
            .prev, .next,.text {font-size: 11px}
        }

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

    </style>

</head>

<body>

    <?php
        //Mensajes de retroalimentación para el Usuario
        if (isset($_SESSION['tempData'])) {
            $tempData = $_SESSION['tempData'];
            $_SESSION['tempData'] = "";
        } else {
            $tempData = "";
        }

    ?>

    <span><?php echo $tempData?></span>
    <br>

    <div id="container">
    
        <div class="slideshow-container">
            <!--Contenido 1-->
            <div class="mySlides fadeSlide">
                <div class="numbertext">1 / 3</div>
                <div class="row justify-content-center">

                    <div class="col-md-4">
                        <a href="../../archivos/Manual_De_Recursos_Para_La_Acreditación_2025_v-3-3.pdf" target="_blank" class="link-dark link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover">
                            <p style="text-align: center;">
                                <img src="../../img/Manual_De_Recursos_Para_La_Acreditación_2025_v-3-3.jpg" style="width:200px; height:250px" class="slideshow-img">
                                <br>Manual de Recursos para la Acreditación
                            </p>
                            
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="../../archivos/Marco_De_Referencia_2018_Ingenierias.pdf" target="_blank" class="link-dark link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover">
                            <p style="text-align: center;">
                                <img src="../../img/Marco_De_Referencia_2018_Ingenierias.jpg" style="width:200px; height:250px" class="slideshow-img">
                                <br>Marco de Referencia 2018 Ingenerias
                            </p>
                        </a>
                    </div>

                </div>
                    
                <div class="text"></div>
            </div>

            <!--Contenido 2-->
            <div class="mySlides fadeSlide">
                <div class="numbertext">2 / 3</div>
                <div class="row justify-content-center">

                    <div class="col-md-4">
                        <a href="../../archivos/Manual_De_Recursos_Para_La_Acreditación_2025_v-3-3.pdf" target="_blank" class="link-dark link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover">
                            <p style="text-align: center;">
                                <img src="../../img/Manual_De_Recursos_Para_La_Acreditación_2025_v-3-3.jpg" style="width:200px; height:250px" class="slideshow-img">
                                <br>Manual de Recursos para la Acreditación
                            </p>
                            
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="../../archivos/Marco_De_Referencia_2018_Ingenierias.pdf" target="_blank" class="link-dark link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover">
                            <p style="text-align: center;">
                                <img src="../../img/Marco_De_Referencia_2018_Ingenierias.jpg" style="width:200px; height:250px" class="slideshow-img">
                                <br>Marco de Referencia 2018 Ingenerias
                            </p>
                        </a>
                    </div>

                </div>
                    
                <div class="text"></div>
            </div>

            <!--Contenido 3-->
            <div class="mySlides fadeSlide">
                <div class="numbertext">3 / 3</div>
                <div class="row justify-content-center">

                    <div class="col-md-4">
                        <a href="../../archivos/Manual_De_Recursos_Para_La_Acreditación_2025_v-3-3.pdf" target="_blank" class="link-dark link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover">
                            <p style="text-align: center;">
                                <img src="../../img/Manual_De_Recursos_Para_La_Acreditación_2025_v-3-3.jpg" style="width:200px; height:250px" class="slideshow-img">
                                <br>Manual de Recursos para la Acreditación
                            </p>
                            
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="../../archivos/Marco_De_Referencia_2018_Ingenierias.pdf" target="_blank" class="link-dark link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover">
                            <p style="text-align: center;">
                                <img src="../../img/Marco_De_Referencia_2018_Ingenierias.jpg" style="width:200px; height:250px" class="slideshow-img">
                                <br>Marco de Referencia 2018 Ingenerias
                            </p>
                        </a>
                    </div>

                </div>

                <div class="text"></div>
            </div>

            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>

        </div>
        <br>
        <div style="text-align:center">
            <span class="dot" onclick="currentSlide(1)"></span> 
            <span class="dot" onclick="currentSlide(2)"></span> 
            <span class="dot" onclick="currentSlide(3)"></span> 
        </div>
    </div>

    <!--div  class="carpetas">
        <ul>
            <li><a href="#">Acreditaciones Pasadas</a></li>
            <li><a href="#">Archivos no Utilizados</a></li>
            <li><a href="#">Otras</a></li>
        </ul>
    </div-->

    <div id="container">
        <div class="tareas">
            <h1>Mis Actividades Pendientes</h1>
            <ul>
                <li><a href="pagina1.html">Completar informe de proyecto</a></li>
                <li><a href="pagina2.html">Revisar presentación para reunión</a></li>
                <li><a href="pagina3.html">Enviar correo electrónico de seguimiento</a></li>
                <!-- Agrega más actividades si es necesario -->
            </ul>
        </div>

        <div style="clear:both;"></div>
    </div>

    <?php require_once '../footer.php'; ?>

    <script>
        let slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");
            if (n > slides.length) {slideIndex = 1}    
            if (n < 1) {slideIndex = slides.length}
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";  
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";  
            dots[slideIndex-1].className += " active";
        }
    </script>

</body>

</html>
