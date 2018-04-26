<?php 
	//echo '{"respuesta": "'.$_POST["action"].'"}';

	if (isset($_POST["action"]) && $_POST["action"] == "validarInfoGeneral") {
		# Validar formulario de infoGeneral
		$validar = validateInfoGeneral();
		print('{"respuesta" : '.$validar.', "data": '.json_encode($_POST).'}');
	}

	if(isset($_POST["action"]) && $_POST["action"] == "validarModProject"){
		$validar = validateModProject();
		print('{"respuesta" : '.$validar.', "data": '.json_encode($_POST).'}');
	}

	function validateInfoGeneral(){
		$errores = '[';

		if(!preg_match("/^([0-9])+$/", $_POST["cmbxInstitucion"]) ){
			$errores .= '{"instituciones": false },';
		}
		else{
			$errores .= '{ "instituciones" : true },';
		}

		if(!preg_match('/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/',  $_POST["cmbxInstitucion"]) ){
			$errores .= '{ "correo" : false },';
		}
		else{
			$errores .= '{ "correo" : true },';
		}

		if(isset($_POST["rbnSNI"])){
			if($_POST["rbnSNI"] == "true"){
				if(!preg_match('/^([0-9]){1,10}$/', $_POST["numero"])){
					$errores .= '{ "SNI" : true }, { "registroSNI": false},';
				}
				else{
					$errores .= '{ "SNI" : true }, { "registroSNI": true},';
				}
			}
			else{
				if($_POST["numero"] == ""){
					$errores .= '{ "SNI" : true }, { "registroSNI": true},';
				}
				else{
					$errores .= '{ "SNI" : true }, { "registroSNI": false},';
				}
			}
		}
		else{
			$errores .= '{ "SNI": false},';
		}

		if(isset($_POST["rbnTipoInvest"])){
			if(!preg_match('/^([0-9])+$/', $_POST["rbnTipoInvest"])){
				$errores .= '{ "tipoInvestigacion": false}';
			}
			else{
				$errores .= '{ "tipoInvestigacion": true}';
			}
		}
		else{
			$errores .= '{ "tipoInvestigacion": false}';
		}

		$errores .= ']';

		return $errores;
	}

	function validateModProject(){
		$errores = '[';

		$errores .= '{"Raul": true}';

		$errores .= ']';

		return $errores;
	}
 ?>