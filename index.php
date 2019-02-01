<?php
 //header('location:views/modules/inicio.php'); // nombre de la pagina de inicio

if( isset( $_GET['module'] ) && $_GET['module'] == 'BancoProyecto'  ){
	echo 'sdfsdfsdf';
}else if( isset( $_GET['module'] ) && $_GET['module'] == 'Tickets' ){
	echo 'Tickets';
} else{
	header('location:views/modules/inicio.php'); // nombre de la pagina de inicio
}
?>