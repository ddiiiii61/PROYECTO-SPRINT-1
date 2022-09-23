<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Infobdn - Inicia la sessió</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" type="text/css" href="styles.css"/>
</head>
<body>
    <header>
        <h1 class="logo">infoBDN</h1>
        <h6 class="slogan">cursos d'informàtica online</h6>
    </header>

    <nav>
        <a href="Admin.php">Zona admin</a>
    </nav>

    <div class="validacion">
        <h1 class="ini">Benvingut/da</h1>
        <form class="formlogin" action="LogIn.php" method="POST">
            <p>E-mail:</p>
            <input class="inpt" type="text" name="email" value="" required>
            <p>Contrasenya:</p>
            <input class="inpt" type="password" name="passwd" value="" required><br>
            <p class="tipo" id="al">Alumne:</p>
            <input class="tipo" type="radio" name="tipo" value="" checked>
            <p class="tipo" id="profe">Professor:</p>
            <input class="tipo" type="radio" name="tipo" value="">
            <input class="smit" type="submit" name="aceptar" value="Iniciar sessió"/>
            <a href="#" class="alta">Vull donar-me d'alta</a>
        </form>
    </div>

    <footer>
        <p>infoBDN® 2022</p>
    </footer>

    <?php
    
    ?>
</body>
</html>