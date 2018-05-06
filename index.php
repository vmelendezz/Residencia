<?php
//1.- se cargan los archivos
 require "./controller/rutes.php";
 require "./controller/templates.php";

//2.- se crea un objeto de la clase Rutes el cual contiene las variables globales y los metodos mandados a llamar en el constructor
 $rutes = new Rutes ();
//6- se manda llamar el metodo getFile de la instancia rutes y lo que retorna se guarda en infoRute
 $infoRute = $rutes->getFile();

//7- se crea un objeto de la clase Templates el cual contiene las variables globales y los metodos mandados a llamar en el constructor
$templates = new Templates(  $infoRute );
?>