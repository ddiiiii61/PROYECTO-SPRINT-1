<?php
    session_start();
    include("Funciones.php")
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
                <form action="CrearCurso.php" method="POST">
                    <p>Codi:</p>
                    <input type="number" name="codi" value="" required>

                    <p>Nom:</p>
                    <input type="text" name="nom" value="" required><br>

                    <p>Descripció:</p>
                    <input type="text" name="desc" value="" ><br>

                    <p>Hores:</p>
                    <input type="number" name="hores" value="" required><br>

                    <p>Data inici:</p>
                    <input type="date" name="inici" value=""  required><br>

                    <p>Data fi:</p>
                    <input type="date" name="fi" value=""  required><br>

                    <p>DNI Professor:</p>
                    <select name="dni">
                        <option value="0">Selecciona</option>
                            <?php  
                                //conexion
                                $conexion=bbdd();
                                DNIProfe($conexion);
                            ?>
                    </select>


                    <input type="submit" name="enviar" value="Crear"/>
                </form>
            </main>

            <footer>
                <p>infoBDN® 2022</p>
            </footer>

            <?php
                if(isset($_POST['enviar'])){                    
                    //valores
                    crearCurso($conexion);
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