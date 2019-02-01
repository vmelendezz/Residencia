<?php 
	//echo '{"respuesta": "'.$_POST["action"].'"}';

	if (isset($_GET["action"]) && $_GET["action"] == "getInitInfoGeneral") {
		require "../modelo/getInitSolicitudApoyo.php";
		$initGeneral = new SolicitudApoyo();

		echo json_encode ( $initGeneral->getInstituciones());
	}else if (isset($_GET["action"]) && $_GET["action"] == "getInitModProject") {
		require "../modelo/getInitSolicitudApoyo.php";
		$initModProject = new SolicitudApoyo();

		$result = [];

		$result[0] = $initModProject->getProgramas_lineaInvestigacion();
		$result[1] = $initModProject->getProgramas_investigadorProceso();
		$result[2] = $initModProject->getProgramas_cuerpoAcademico();
		$result[3] = $initModProject->getnameCuerpoAcademico_cuerpoAcademico();

		echo  json_encode ($result) ;
	}else if (isset($_POST["action"]) && $_POST["action"] == "validarInfoGeneral") {
		# Validar formulario de infoGeneral
		require "../modelo/validate.php";
		$valInfoGral = new Validate();

		print( $valInfoGral->validateInfoGeneral($_POST));
	}else if(isset($_POST["action"]) && $_POST["action"] == "validarModProject"){
		require "../modelo/validate.php";
		$valModProject = new Validate();

		print( $valModProject->validateModProyect($_POST));
	}else if (isset($_GET["action"]) && $_GET["action"] == "getporLineaNomProgram") {
		require "../modelo/getInitSolicitudApoyo.php";
		$initModProject = new SolicitudApoyo();

		$result = [];

		$result = $initModProject->getPorLineaNomProgram();

		echo  json_encode ($result) ;
	}else if (isset($_GET["action"]) && $_GET["action"] == "getporInvesNomProgram") {
		require "../modelo/getInitSolicitudApoyo.php";
		$initModProject = new SolicitudApoyo();

		$result = [];

		$result = $initModProject->getPorInvesNomProgram();

		echo  json_encode ($result) ;
	}else if (isset($_GET["action"]) && $_GET["action"] == "getporCuerpAcadNomProgram") {
		require "../modelo/getInitSolicitudApoyo.php";
		$initModProject = new SolicitudApoyo();

		$result = [];

		$result = $initModProject->getPorCuerpAcadNomProgram();

		echo  json_encode ($result) ;
	}else if(isset($_POST["action"]) && $_POST["action"] == "validarColaboradoresP"){
		require "../modelo/validate.php";
		$valColaboradores = new Validate();

		print( $valColaboradores->validateColaboradores($_POST));
	}else if(isset($_POST["action"]) && $_POST["action"] == "validarProgramaActividades"){
		require "../modelo/validate.php";
		$valColaboradores = new Validate();

		print( $valColaboradores->validarProgramaActividades($_POST));
	}else if(isset($_POST["action"]) && $_POST["action"] == "validarPlanTrabajo"){
		require "../modelo/validate.php";
		$valColaboradores = new Validate();

		print( $valColaboradores->validarPlanTrabajo($_POST));
	}else if( isset($_POST["action"]) && $_POST["action"] == "saveAllSolicitudApoyo" ){
		require "../modelo/saveSolicitudApoyo.php";

		/*print_r( json_decode( $_POST['dataInfoGeneral'] ) );
		print_r( json_decode( $_POST['modalidadProyecto'] ) );
		print_r( json_decode( $_POST['colaboradores'] ) );
		print_r( json_decode( $_POST['programaActividades'] ) );
		print_r( json_decode( $_POST['planTrabajo'] ) );*/

		$data['dataInfoGeneral'] = json_decode( $_POST['dataInfoGeneral'] );
		$data['modalidadProyecto'] = json_decode( $_POST['modalidadProyecto'] );
		$data['colaboradores'] = json_decode( $_POST['colaboradores'] );
		$data['programaActividades'] = json_decode( $_POST['programaActividades'] );
		$data['planTrabajo'] = json_decode( $_POST['planTrabajo'] );


		//print_r($data);
		$save = new SaveSolicitudApoyo();

		session_start();

		$save->SaveSolicitud($data, $_POST['id'], $_SESSION['idusuario'] );



	}else if(isset($_GET["action"]) && $_GET["action"] == "ModificarSolicitud"){
		require "../modelo/getSolicitudApoyo.php";
		$initModProject = new GetSolicitudApoyo();

		$result = [];	

		$result = $initModProject->getSolicitudApoyo($_GET['id']);
		echo  json_encode ($result) ;
	}

 ?>