<?php
function bbdd(){
    $conection = mysqli_connect('localhost','root','','infobdn')or die("Conexion fallida: " . mysqli_connect_error());
    return $conection;
}

function crearProfessor($conexion){
    //CONTROL CLAVES PRIMARIAS
    $dni=$_POST['dni'];
    $q="SELECT dni FROM professors WHERE dni='$dni'";
    $consult = mysqli_query($conexion, $q);
    $registros=mysqli_num_rows($consult);
    if($registros>0){
        ?><script>alert("Este DNI ya consta en la base de datos \nCreación no exitosa")</script>
        <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=CrearProfesor.php">
        <?php
    }
    else{
        if (is_uploaded_file ($_FILES['imagen']['tmp_name'])){
        $nombreDirectorio = "imagenesprofe/";
        $nombreFichero = $_FILES['imagen']['name'];
        $nombreCompleto = $nombreDirectorio . $nombreFichero;
        if (is_file($nombreCompleto))
        {
        $idUnico = time();
        $nombreFichero = $idUnico . "-" . $nombreFichero;
        }
        move_uploaded_file ($_FILES['imagen']['tmp_name'],
        $nombreDirectorio . $nombreFichero);}
        else print ("No se ha podido subir el fichero\n");

        //query
        $query= "INSERT INTO professors VALUES('".$_POST['dni']."',md5('".($_POST['passwd'])."'),'".$_POST['nom']."','".$_POST['cognoms']."','".$_POST['titol']."','".$_FILES['imagen']['name']."')";
        $consult = mysqli_query($conexion, $query);
        ?>
            <script>alert('Profesor creado con Exito');</script>
            <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=CrearProfesor.php">
        <?php
    }


}


//CREAR CURSO TRATAMIENTO DE DATOS
function crearCurso($conexion){

    $codi=$_POST['codi'];
    $nom=$_POST['nom'];
    $desc=$_POST['desc'];
    $hores=$_POST['hores'];
    $inici=$_POST['inici'];
    $fi=$_POST['fi'];
    $dni=$_POST['dni'];

    $q="SELECT codi FROM cursos WHERE codi='$codi'";
    $consult = mysqli_query($conexion, $q);
    $registros=mysqli_num_rows($consult);
    if($registros>0){
        ?><script>alert("Este codigo ya consta en la base de datos \nCreación no exitosa")</script>
        <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=CrearCurso.php">
        <?php
    }else{
        $inicidate=new DateTime($inici);
        $fidate=new DateTime($fi);

        if($inicidate<$fidate){
        //conexion bbdd


        //query
        $query= "INSERT INTO cursos VALUES('$codi','$nom','$desc','$hores','$inici','$fi','$dni')";
        $consulta = mysqli_query($conexion, $query);
        ?>
        <script>alert('Curso creado con éxito');</script>
        <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=CrearCurso.php">
        <?php
        }
        else if($inicidate>$fidate) { ?><script>alert('La fecha de fin no puede ser más antigua \nIntroduzca de nuevo los datos');</script><?php }
        //Control FECHAS
    }
}

//MOSTRAR CURSOS
function mostrarCursos($conection){
    //Conectar con la bbdd
    $query= "SELECT * FROM cursos";

    //Enviar query
    $consult = mysqli_query($conection, $query);

    //Numero de registros
    $numeroregistros=mysqli_num_rows($consult);

    //Importante hacer un bule con el numero de registros
    for ($i=0;$i<$numeroregistros;$i++){

        //CREAR UN ARRAY ASOCIATIVO DE LA SIGUIENTE FORMA
        $filas=$consult->fetch_assoc();
        
    
        //IMPRIMIR
        echo "<tr>";
        echo "<td>" .$filas['CODI']. "</td>";
        echo "<td>" .$filas['NOM']. "</td>";
        echo "<td>" .$filas['DESCRIPCIO']. "</td>";
        echo "<td>" .$filas['HORES']. "</td>";
        echo "<td>" .$filas['INICI']. "</td>";
        echo "<td>" .$filas['FI']. "</td>";
        echo "<td>" .$filas['DNIPROFESSOR']. "</td>";
        ?>
        <td><a href="EditarCurso2.php?id=<?php echo $filas['CODI'];?>"><img src="img/lapiz.png" style="height:20px;width:20px;"></a></td>

        <?php
        echo "</tr>";
    }
}

/*function eliminarprofe($conection){
    //Importante el isset ;_;
    if(isset($_POST['esborrar'])){
        //si el numero de checkbox marcados(con valor de dni) es superior a 0...
        if (count($_POST['eliminar'])>0){
            //Hacer implode del array $_POST
            $borrar = implode(',', $_POST['eliminar']);
            //Hacer y enviar consulta
            $query2="DELETE FROM professors WHERE DNI in ('{$borrar}')";
            $consult = mysqli_query($conection, $query2);
            //Refrescar para ver que realmente se han borrado
            ?>
                <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=EliminarProfesor.php">
            <?php
        }
    }
}*/


//ELIMINAR PROFESOR
function eliminarprofesor($conection){
    $id=$_GET['id'];
    $query="DELETE FROM professors WHERE dni='$id'";
    $consult = mysqli_query($conection, $query);
    ?>
    <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=EliminarProf.php">
    <?php
    
}

//ELIMINAR CURSOS
function eliminarcurso($conection){
    $id=$_GET['id'];
    $query="DELETE FROM cursos WHERE codi='$id'";
    $consult = mysqli_query($conection, $query);
    ?>
    <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=EliminarCurs.php">
    <?php
}

/*function eliminarCURSO($conection){
    //Importante el isset ;_;
    if(isset($_POST['esborrar'])){
        //si el numero de checkbox marcados(con valor de dni) es superior a 0...
        if (count($_POST['eliminar'])>0){
            //Hacer implode del array $_POST
            $borrar = implode(',', $_POST['eliminar']);
            //Hacer y enviar consulta
            $query2="DELETE FROM cursos WHERE CODI in ('{$borrar}')";
            $consult = mysqli_query($conection, $query2);
            //Refrescar para ver que realmente se han borrado
            ?>
                <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=EliminarCurso.php">
            <?php
        }
    }
}*/

//MOSTRAR CURSOS
function CursosProfe($conexion){
    $qry="SELECT nom FROM cursos";
    $cons = mysqli_query($conexion, $qry);

    while($valores = mysqli_fetch_array($cons)){
        echo '<option value="'.$valores['nom'].'">"'.$valores['nom'].'"</option>';  //en minusculas si no peta :( 
    }
}


//DESENCRIPTAR CODIGO CURSOS
function desencriptarcursos($codi,$conection){
    $qry="SELECT nom FROM cursos WHERE DNIPROFESSOR='$codi'";
    $cons = mysqli_query($conection, $qry);
    $code="";
                
    while($valores = mysqli_fetch_array($cons)){
        $code=$valores['nom'];  //en minusculas si no peta :( 
    }
    return $code;
}


//DNI PROFESOR
function DNIProfe($conexion){
    $qry="SELECT dni FROM professors";
    $cons = mysqli_query($conexion, $qry);

    while($valores = mysqli_fetch_array($cons)){
        echo '<option value="'.$valores['dni'].'">"'.$valores['dni'].'"</option>';  
    }
}

//MODIFICAR FOTO
function modFoto($conexion){
    if(isset($_POST['edit'])){

        if (is_uploaded_file ($_FILES['imagen']['tmp_name']))
        {
            $nombreDirectorio = "imagenesprofe/";
            $nombreFichero = $_FILES['imagen']['name'];
            $nombreCompleto = $nombreDirectorio . $nombreFichero;
            if (is_file($nombreCompleto))
            {
            $idUnico = time();
            $nombreFichero = $idUnico . "-" . $nombreFichero;
            }
            move_uploaded_file ($_FILES['imagen']['tmp_name'],
            $nombreDirectorio . $nombreFichero);
        }
        else
            print ("No se ha podido subir el fichero\n");
        $query= "UPDATE professors SET FOTO='".$_FILES['imagen']['name']."' WHERE DNI='".$_SESSION['DNI']."'";
        $consult = mysqli_query($conexion, $query);
        ?>
            <script>alert('Foto actualizada con éxito');</script>
            <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=EditarProfe.php">
        <?php
    }    
}

//EDITAR PROFESOR
function editarProfe($conexion,$sesion,$cambiar){
    if(isset($_POST['enviar'])){
        //query
        if ($sesion && $cambiar){
        $query= "UPDATE professors SET DNI='".$_POST['dni']."',CONTRASENYA=md5('".$_POST['passwd']."'), NOM='".$_POST['nom']."', COGNOMS='".$_POST['cognoms']."', TITOL='".$_POST['titol']."' WHERE DNI='".$_SESSION['DNI']."'";
        $consult = mysqli_query($conexion, $query);
        ?>
            <script>alert('Profesor editado con éxito, dni y contraseñas actualizadas');</script>
        <?php
        }

        else if ($sesion && !$cambiar){
            $query= "UPDATE professors SET DNI='".$_POST['dni']."',NOM='".$_POST['nom']."', COGNOMS='".$_POST['cognoms']."', TITOL='".$_POST['titol']."' WHERE DNI='".$_SESSION['DNI']."'";
            $consult = mysqli_query($conexion, $query);
            ?>
                <script>alert('Profesor editado con éxito, dni actualizado');</script>
            <?php
            }

        else if (!$sesion && $cambiar){
            $query= "UPDATE professors SET DNI='".$_POST['dni']."',CONTRASENYA=md5('".$_POST['passwd']."'),NOM='".$_POST['nom']."', COGNOMS='".$_POST['cognoms']."', TITOL='".$_POST['titol']."' WHERE DNI='".$_SESSION['DNI']."'";
            $consult = mysqli_query($conexion, $query);
            ?>
                <script>alert('Profesor editado con éxito, contraseña actualizada');</script>
            <?php
            }
    



        else{
            $query= "UPDATE professors SET NOM='".$_POST['nom']."', COGNOMS='".$_POST['cognoms']."',TITOL='".$_POST['titol']."' WHERE DNI='".$_SESSION['DNI']."'";
            $consult = mysqli_query($conexion, $query);
        ?>
            <script>alert('Profesor editado con éxito, contraseña no actualizada');</script>
        <?php
        }
        
        }

}

//EDITAR CURSO
function editarCurso($conexion,$sesion){
    if(isset($_POST['enviar'])){
        //query
        if ($sesion){
        $query= "UPDATE cursos SET  CODI='".$_POST['CODI']."', NOM='".$_POST['NOM']."', DESCRIPCIO='".$_POST['DESCRIPCIO']."', HORES='".$_POST['HORES']."', INICI='".$_POST['INICI']."', FI='".$_POST['FI']."', DNIPROFESSOR='".$_POST['DNI']."' WHERE CODI='".$_SESSION['CODI']."'";
        $consult = mysqli_query($conexion, $query);
        ?>
            <script>alert('Curso editado con éxito');</script>
        <?php
        }
        else{
            $query= "UPDATE cursos SET NOM='".$_POST['NOM']."', DESCRIPCIO='".$_POST['DESCRIPCIO']."', HORES='".$_POST['HORES']."', INICI='".$_POST['INICI']."', FI='".$_POST['FI']."', DNIPROFESSOR='".$_POST['DNI']."' WHERE CODI='".$_SESSION['CODI']."'";
            $consult = mysqli_query($conexion, $query);
        ?>
            <script>alert('Curso editado con éxito');</script>
        <?php
        }
        
        }

}

function controlClavePrimaria($code,$conexion){
    $q="SELECT codi FROM cursos WHERE CODI ='$code'";
    $consult = mysqli_query($conexion, $q);
    $registros=mysqli_num_rows($consult);
    return $registros;
}

?>