<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nosotros</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header class="site-header">
        <div class="contenedor contenido-header">
            <div class="barra">
            <a href="index.html">
                    <img src="img/logo.svg" alt="logo">
                </a>
                
                <nav class="navegacion">
                <a href="index.html">Inicio</a>

                    <a href="nosotros.html">Nosotros</a>
                    <a href="register.html">Registrate</a>
                    <a href="micuenta.html">Mi Cuenta</a>
                </nav>
            </div>

        </div>
        <!----contenedor-->
    </header>
    <h1>Bienvenido 
<?php  echo $_SESSION['usuario']; ?>
    </h1>
    <footer class="site-footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="nosotros">Nosotros</a>
                <a href="anuncios.html">Anuncios</a>
                <a href="micuenta.html">Mi Cuenta</a>
                <a href="contacto">Contacto</a>
            </nav>
            <p class="copyright">Todos los Derechos Reservados &copy;</p>
        </div>
    </footer>
</body>

</html>