<?php 
	//echo '{"respuesta": "'.$_POST["action"].'"}';

	if (isset($_GET["action"]) && $_GET["action"] == "getInitDescProyecto") {
		require "../modelo/getInitProtocoloInvestigacion.php";
		$initDescProyecto = new ProtocoloInvestigacion();

		echo json_encode ( $initDescProyecto ->getCampus());
	}else if (isset($_POST["action"]) && $_POST["action"] == "validarDescProyecto") {
		# Validar formulario de infoGeneral
		require "../modelo/validateProtocoloInvestigacion.php";
		$valNomEmpresa = new Validate();

		print( $valNomEmpresa->validateProtocoloInvestigacion($_POST));
	}else if (isset($_POST["action"]) && $_POST["action"] == "validarObjProyecto") {
		# Validar formulario de infoGeneral
		require "../modelo/validateProtocoloInvestigacion.php";
		$valNomLugarTrab = new Validate();

		print( $valNomLugarTrab->validateObjetivosProyecto($_POST));
	}else if (isset($_POST["action"]) && $_POST["action"] == "validarDatosEmpresa") {
		# Validar formulario de infoGeneral
		require "../modelo/validateProtocoloInvestigacion.php";
		$valDireccion = new Validate();

		print( $valDireccion->validateDatosEmpresa($_POST));
	}else if (isset($_POST["action"]) && $_POST["action"] == "validarLugarInfra") {
		# Validar formulario de infoGeneral
		require "../modelo/validateProtocoloInvestigacion.php";
		$valEstado = new Validate();

		print( $valEstado->validarLugarInfra($_POST));
	}else if( isset($_POST["action"]) && $_POST["action"] == "saveAllProtocolo" ){
		require "../modelo/saveProtocoloInvestigacion.php";

		/*print_r( json_decode($_POST['dataDescProyecto']) ) ;
		print_r( json_decode($_POST['dataObjProyecto']) ) ;
		print_r( json_decode($_POST['dataDatEmpresa']) ) ;
		print_r( json_decode($_POST['dataLugarInfra']) ) ;
		print_r( json_decode($_POST['dataDatEmpresaFiles']) ) ;*/

		$data['dataDescProyecto'] = json_decode($_POST['dataDescProyecto']);
		$data['dataObjProyecto'] = json_decode($_POST['dataObjProyecto']);
		$data['dataDatEmpresa'] = json_decode($_POST['dataDatEmpresa']);
		$data['dataLugarInfra'] = json_decode($_POST['dataLugarInfra']);
		$data['dataDatEmpresaFiles'] = json_decode($_POST['dataDatEmpresaFiles']);

		$save = new SaveProtocoloInvestigacion();
		
		session_start();

		$save->SaveProtocoloInvestigacion($data, $_POST['id'], $_SESSION['idusuario'] );
		
	}else if(isset($_GET["action"]) && $_GET["action"] == "ModificarProtocolo"){
		require "../modelo/getProtocoloInvestigacion.php";
		$initModProject = new GetProtocoloInvestigacion();

		$result = [];	

		$result = $initModProject->getProtocoloInvestigacion($_GET['id']);
	
		echo  json_encode ($result) ;
	}
 ?>