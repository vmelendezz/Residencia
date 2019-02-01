<?php
session_start();
//comprobar que no haya sesion iniciada
if (isset($_SESSION['usuario'])) 
{
    header("Location: index.php");
}
if ($_SERVER['REQUEST_METHOD'] == "POST") 
{
    $usuario = filter_var(strtolower( $_POST['usuario']), FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    $password = hash('sha512',$password);
    try
    {
        //inicia la conexión a la base de datos
        $conexion = new PDO('mysql:host=localhost;dbname=modulos', 'root', '');    
	    //Cambiar las opciones de pdo para que muestre errores de mysql y no continue la ejecución 
	    // si está mal la sintaxis de la consulta
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        // //variable para mostrar errores en pantalla
        $errores = '';
        // //verificar que los datos sean correctos en la base de datos
        // //tratamos de encontrar el usuario en la base de datos
        $statement = $conexion->prepare('SELECT * FROM user where user = :user AND contrasena = :pass');
        // //ejecutamos la consulta pasando los datos del usuario que intenta ingresar
        $statement->execute(array(':user' => $usuario, ':pass' => $password));
        // //obtenemos los datos si es que encontró algo
        $resultado = $statement->fetch();
        //tipo de usuario
        $usertype = $resultado['tipo'];  
       
        // //si resultado es == true significa que encontró algo, entonces lo redireccionamos al contenido.php 
        // // significando que si se logueó correctamente
        if($resultado == true && isset($usertype))
        {
            $_SESSION['usuario'] = $usuario;
            $_SESSION['tipo'] = $usertype;
            header("Location: index.php");
        }
        else
        {
            $errores.="<li>El usuario o la contraseña son incorrectos</li>";            
        }
    }
    catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }
}
require 'views/login.view.php';
?>