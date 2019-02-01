<?php  

	if (isset($_GET["action"]) && $_GET["action"] == "getProyectos") {
		require "../modelo/busqueda.php";
		$initDescProyecto = new Busqueda();

		session_start();

		echo json_encode ( $initDescProyecto ->getProyectos( $_SESSION['idusuario'] ));

	}else if (isset($_POST["action"]) && $_POST["action"] == "eliminarProyecto") {
		require "../modelo/busqueda.php";
		

		$initDescProyecto = new Busqueda();

		echo $initDescProyecto ->eliminarProyecto( $_POST['id'] );
	}

?>