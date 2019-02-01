<?php
//Iniciamos la sesión para que quede registrado que se está usando el sitio
session_start();
//si ya existe una sesión iniciada lo mandamos al index, el index se encarga de comprobar
//si está registrado o no
if(isset($_SESSION['usuario']))
{
    header("Location: index.php");
}
//si los datos se enviaron por post vamos a guardarlo en la bdd
if($_SERVER['REQUEST_METHOD']== 'POST')
{
    //inicia la conexión a la base de datos
    $conexion = new PDO('mysql:host=localhost;dbname=usuarios', 'root', '');    
	//Cambiar las opciones de pdo para que muestre errores de mysql y no continue la ejecución 
	// si está mal la sintaxis de la consulta
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    //variable para mostrar errores en pantalla
    $errores = ""; 
    //obtenemos usuario y las contraseñas para comprobar que sean iguales
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    //le quitamos caracteres especiales a usuario para evitar inyección de código
    $usuario = filter_var(strtolower($usuario), FILTER_SANITIZE_STRING);    
    //si algun espacio está en blanco entonces no puede continuar y se le manda el error
    if(empty($usuario) OR empty($password) OR empty($password2))
    {
        $errores .= "<li>Rellena todos los campos correctamente</li> ";
    }
    //si no hay errores
    else
    {
        //se crea la conexión a la base de datos
        try 
        {
            //Se selecciona el usuario de la base de datos para comprobar si no existe
            $statement = $conexion->prepare("Select * from usuario where user = :usuario limit 1");
            //se ejecuta
            $statement->execute(array(':usuario' =>$usuario));
            //se guarda en resultado
            $resultado = $statement->fetch();
            //Si resultado es = true significa que encontró algo, entonces ese usuario ya existe
            if($resultado == true)
            {
                //se manda el error y no se deja insertar en la bdd
                $errores .= "<li>El nombre de usuario ya está en existencia</li>";
            }
            //encriptamos la contraseña con el hash
            $password = hash('sha512',$password);
            $password2 = hash('sha512', $password2);
            
            //Comprobar contraseñas para verificar que coincidan
            if ($password != $password2)
            {
                $errores .= "<li> Las contraseñas deben coincidir </li>";
            }
        }
        //si hay algún error se muestra en pantalla
        catch (PDOException $e) 
        {
            echo "Error: " . $e->getMessage();
        }          
    }    
    //Si no existe ningún error entonces sí se puede insertar en la base de datos
    if($errores == '')
    {
        //se crea el inser para poner datos en la tabla usuario
        $statement = $conexion->prepare('INSERT INTO usuario (id,user,contrasena) VALUES(null,:usuario,:pass)');
        //se ejecuta la consulta pasando los parametros correspondientes
        $statement->execute(array(':usuario' => $usuario,':pass' => $password));                            
        //Se le redirige al usuario a la página de login confirmando que ya se registró
        $confirmacion = "verdad";
        header("Location: login.php");
    }
}
require 'views/registro.view.php';
?>