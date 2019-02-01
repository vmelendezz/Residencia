<?php
//Iniciamos la sesión para que quede registrado que se está usando el sitio
session_start();
//si los datos se enviaron por post vamos a guardarlo en la bdd
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
     //inicia la conexión a la base de datos
    $conexion = new PDO('mysql:host=localhost;dbname=blog', 'root', '');
    
	//Cambiar las opciones de pdo para que muestre errores de mysql y no continue la ejecución
    // si está mal la sintaxis de la consulta


    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];
    //Si no están vacíos los inserta
    if($titulo != "" && $contenido != "")
    {
        //se crea el inser para poner datos en la tabla usuario
        $statement = $conexion->prepare('INSERT INTO articulos (id,titulo,descripcion,contenido,imagen) VALUES(null,:titulo,:descripcion,:contenido,:imagen)');
        //se ejecuta la consulta pasando los parametros correspondientes
        $descripcion = substr($contenido,0,20);
        $statement->execute(array
        (
            ':titulo' => $titulo, 
            ':descripcion' => $descripcion,
            ':contenido' => $contenido,
            ':imagen'=> '1.jpg'));
        //Se le redirige al usuario a la página de login para que lo redirija a entradas si es que está logueado nuevamente.
        header("Location: login.php");
    }
    else
    {
        header("Location: login.php");
    }
}
?>
