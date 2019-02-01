<?php
session_start();

if(isset($_SESSION['usuario']) && $_SESSION['tipo']== "admin")
{
    require 'views/contenido.view.php';
}
else if(isset($_SESSION['usuario']) && $_SESSION['tipo']=="investigador")
{
    header("Location: investigador.php");
}
else
{
    header("Location: login.php");
}
?>