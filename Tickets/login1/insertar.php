<?php
if (isset($_POST["subject"])) 
{
      //inicia la conexión a la base de datos
      $conexion = new PDO('mysql:host=localhost;dbname=usuarios', 'root', '');
      //Cambiar las opciones de pdo para que muestre errores de mysql y no continue la ejecución
      // si está mal la sintaxis de la consulta
  
  
      $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      $titulo = $_POST["subject"]; 
      $descripcion = $_POST["comment"];

      //Si no están vacíos los inserta
      if($titulo != "" && $descripcion != "")
      {
          //se crea el inser para poner datos en la tabla usuario
          $statement = $conexion->prepare("INSERT INTO `notifications` (`id`, `user_id`, `titulo`, `descripcion`, `leido`) VALUES ( NULL,'1','$titulo','$descripcion','0')");
          //se ejecuta la consulta pasando los parametros correspondientes
          $statement->execute();
       }
    else
    {
        header("Location: login.php");
    }
                       
}
?>