<?php 
	//echo '{"respuesta": "'.$_POST["action"].'"}';

	if (isset($_GET["action"]) && $_GET["action"] == "getInitInfoGeneral") {
		require "../modelo/getInitSolicitudApoyo.php";
		$initGeneral = new SolicitudApoyo();

		echo json_encode ( $initGeneral->getInitInfoGeneral() ) ;
	}

	if (isset($_POST["action"]) && $_POST["action"] == "validarInfoGeneral") {
		# Validar formulario de infoGeneral
		require "../modelo/validate.php";
		$valInfoGral = new Validate();

		print( $valInfoGral->validateInfoGeneral($_POST));
	}

	if(isset($_POST["action"]) && $_POST["action"] == "validarModProject"){
		require "../modelo/va.php";
		$valModProject = new Validate();

		print( $valModProject->validateModProyect($_POST));
	}

 ?>