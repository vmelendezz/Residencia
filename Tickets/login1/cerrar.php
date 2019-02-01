<?php
//inicia la sesión significa que quiere seguir conservando la ya existente
session_start();
//para poder destruir esa sesión al cerrar.
session_destroy();
header("Location: login.php");
?>