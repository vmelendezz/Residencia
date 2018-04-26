<?php
//1.- se cargan los archivos
 require "./controller/rutes.php";
 require "./controller/templates.php";

//2.- se crea un objeto de la clase Rutes el cual contiene las variables globales y los metodos mandados a llamar en el constructor
 $rutes = new Rutes ();

 $infoRute = $rutes->getFile();

//se crea un objeto de la clase Templates el cual contiene las variables globales y los metodos mandados a llamar en el constructor
$templates = new Templates(  $infoRute );

?>