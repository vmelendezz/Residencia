<?php
//Comprobar si está abierta la sesión
session_start();
if (isset($_SESSION['usuario']) && $_SESSION['tipo'] == admin)
{
    header("Location: header.php");
}
else if(isset($_SESSION['usuario']) && $_SESSION['tipo'] == investigador) 
{
    header("Location: investigador.php");
}
else
{
    header("Location: registro.php");
}
?>