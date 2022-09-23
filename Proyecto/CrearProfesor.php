<?php
    session_start();
    include("Funciones.php");
    $conexion=bbdd();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Infobdn - Administrador</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" type="text/css" href="styles.css"/>
</head>
<body>
    <?php
        if(isset($_SESSION['admin'])){?>
            <header>
                <h1 class="logo">infoBDN</h1>
                <h6 class="slogan">cursos d'informàtica online</h6>
            </header>

            <nav>
                <a href="IndexAdmin.php">Tornar al menú</a>
            </nav>


            <main>
                <form action="CrearProfesor.php" method="POST" enctype="multipart/form-data"><!--form-data ¬¬-->
                    <p>DNI:</p>
                    <input type="text" name="dni" value="" required>

                    <p>Contrasenya:</p>
                    <input type="password" name="passwd" value="" required>

                    <p>Nom:</p>
                    <input type="text" name="nom" value="" required><br>

                    <p>Cognoms:</p>
                    <input type="text" name="cognoms" value="" required ><br>

                    <p>Títol:</p>
                    <input type="text" name="titol" value="" required><br>

                    <p>Foto:</p>
                    <input type="file" name="imagen" accept=".jpg" required><br>

                    
                    <!--<p>Cursos:</p>
                    <select name="curs">
                        <option value="0">Selecciona</option>-->
                            <?php  
                                //conexion
                                //$conexion=bbdd();
                                //CursosProfe($conexion);
                            ?>
                    <!--</select>-->
                    

                    <input type="submit" name="enviar" value="Crear"/>
                </form>
            </main>

            <footer>
                <p>infoBDN® 2022</p>
            </footer>

            <?php
                if(isset($_POST['enviar'])){
                    crearProfessor($conexion);
                }
            ?>
            
        <?php } //importante cerrar el } del if
        else{
            ?>
            <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=LogIn.php">
            <?php
        }
    ?>
</body>
</html>