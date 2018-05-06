<<<<<<< HEAD

<?php 
	//echo '{"respuesta": "'.$_POST["action"].'"}';
	
	$validado = 1;

	if (isset($_POST["action"]) && $_POST["action"] == "validarInfoGeneral") {
		# Validar formulario de infoGeneral
		$validar = validateInfoGeneral();
		print('{"respuesta" : '.json_encode($validar).', "data": '.json_encode($_POST).', "validado" : '.$validado.' }');
	}

	if(isset($_POST["action"]) && $_POST["action"] == "validarModProject"){
		$validar = validateModProject();
		print('{"respuesta" : '.$validar.', "data": '.json_encode($_POST).'}');
	}

	function validateInfoGeneral(){
		global $validado;
		$errores = Array();

		if(!preg_match("/^([0-9])+$/", $_POST["cmbxInstitucion"]) ){
			$validado = 0;
			array_push($errores, Array( "validado" => false, "error" => "Instituciones") ) ;
		}
		else{
			array_push($errores, Array( "validado" => true, "error" => "Instituciones") ) ;
		}

		if(!preg_match("/^([a-z A-Z \ñ\Ñ\á\é\í\ó\ú])+$/", $_POST["txtResponsable"]) ){
			$validado = 0;
			array_push($errores, Array( "validado" => false, "error" => "Responsable") ) ;
		}
		else{
			array_push($errores, Array( "validado" => true, "error" => "Responsable") ) ;
		}

		if(!preg_match('/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/',  $_POST["cmbxInstitucion"]) ){
			$validado = 0;
			array_push($errores, Array( "validado" => false, "error" => "correo"));
		}
		else{
			array_push($errores, Array( "validado" => true, "error" => "correo"));
		}

		if(isset($_POST["rbnSNI"])){
			if($_POST["rbnSNI"] == "true"){
				if(!preg_match('/^([0-9]){1,10}$/', $_POST["numero"])){
					$validado = 0;
					array_push($errores, Array("validado" => falso, "error" => "Numero de registro SNI"));
				}else{
					array_push($errores, Array("validado" => true));
				}
			}else{
				if($_POST["numero"] == ""){
					array_push($errores, Array("validado" => true));
				}else{
					$validado = 0;
					array_push($errores, Array("validado" => false, "error" => "SNI debe ser si"));
				}
			}
		}
		else{
			$validado = 0;
			array_push($errores, Array("validado" => false, "error" => "SNI"));
		}

		if(isset($_POST["rbnTipoInvest"])){
			if(!preg_match('/^([0-9])+$/', $_POST["rbnTipoInvest"])){
				$validado = 0;
				array_push($errores, Array("validado" => false, "error" => "tipoInvestigacion"));
			}
			else{
				array_push($errores, Array("validado" => true, "error" => "tipoInvestigacion"));
			}
		}
		else{
			$validado = 0;
			array_push($errores, Array("validado" => false, "error" => "tipoInvestigacion"));
		}

		return $errores;
	}

	function validateModProject(){
		$errores = '[';
		$errores .= '{"Raul": true}';
		$errores .= ']';
		return $errores;
	}


	echo json_encode( 
		Array( 
			"validado" => 1, 
			"title" => "Todos los usuarios", 
			"usuarios" => 
				Array( 
					Array(
					"nombre" => "Mario",
					"edad" => 22,
					"peso" => 60,
					"telefonos" => Array (123456, 1234567, 234567, 12345678),
					"mascotas" => Array("perro", "pajaro", "conejo")
					),
					Array(
					"nombre" => "Valeria",
					"edad" => 22,
					"peso" => 60,
					"telefonos" => Array (123456, 1234567, 234567, 12345678),
					"mascotas" => Array("perro", "pajaro", "conejo")
					),
					Array(
					"nombre" => "refri",
					"edad" => 22,
					"peso" => 60,
					"telefonos" => Array (123456, 1234567, 234567, 12345678),
					"mascotas" => Array("perro", "pajaro", "conejo")
					),
					Array(
					"nombre" => "Joss",
					"edad" => 22,
					"peso" => 60,
					"telefonos" => Array (123456, 1234567, 234567, 12345678),
					"mascotas" => Array("perro", "pajaro", "conejo")
					),
					Array(
					"nombre" => "vannesa",
					"edad" => 22,
					"peso" => 60,
					"telefonos" => Array (123456, 1234567, 234567, 12345678),
					"mascotas" => Array("perro", "pajaro", "conejo")
					),
				)
		) 
	);
=======
<?php 
	//echo '{"respuesta": "'.$_POST["action"].'"}';
	
	$validado = 1;

	if (isset($_POST["action"]) && $_POST["action"] == "validarInfoGeneral") {
		# Validar formulario de infoGeneral
		$validar = validateInfoGeneral();
		print('{"respuesta" : '.json_encode($validar).', "data": '.json_encode($_POST).', "validado" : '.$validado.' }');
	}

	if(isset($_POST["action"]) && $_POST["action"] == "validarModProject"){
		$validar = validateModProject();
		print('{"respuesta" : '.$validar.', "data": '.json_encode($_POST).'}');
	}

	function validateInfoGeneral(){
		global $validado;
		$errores = Array();

		if(!preg_match("/^([0-9])+$/", $_POST["cmbxInstitucion"]) ){
			$validado = 0;
			array_push($errores, Array( "validado" => false, "error" => "Instituciones") ) ;
		}
		else{
			array_push($errores, Array( "validado" => true, "error" => "Instituciones") ) ;
		}

		if(!preg_match("/^([a-z A-Z \ñ\Ñ\á\é\í\ó\ú])+$/", $_POST["txtResponsable"]) ){
			$validado = 0;
			array_push($errores, Array( "validado" => false, "error" => "Responsable") ) ;
		}
		else{
			array_push($errores, Array( "validado" => true, "error" => "Responsable") ) ;
		}

		if(!preg_match('/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/',  $_POST["cmbxInstitucion"]) ){
			$validado = 0;
			array_push($errores, Array( "validado" => false, "error" => "correo"));
		}
		else{
			array_push($errores, Array( "validado" => true, "error" => "correo"));
		}

		if(isset($_POST["rbnSNI"])){
			if($_POST["rbnSNI"] == "true"){
				if(!preg_match('/^([0-9]){1,10}$/', $_POST["numero"])){
					$validado = 0;
					array_push($errores, Array("validacion" => falso, "error" => "Numero de registro SNI"));
				}else{
					array_push($errores, Array("validacion" => true));
				}
			}else{
				if($_POST["numero"] == ""){
					array_push($errores, Array("validacion" => true));
				}else{
					$validado = 0;
					array_push($errores, Array("validacion" => false, "error" => "SNI debe ser si"));
				}
			}
		}
		else{
			$validado = 0;
			array_push($errores, Array("SNI" => false, "error" => "SNI"));
		}

		if(isset($_POST["rbnTipoInvest"])){
			if(!preg_match('/^([0-9])+$/', $_POST["rbnTipoInvest"])){
				$validado = 0;
				array_push($errores, Array("tipoInvestigacion" => false, "error" => "tipoInvestigacion"));
			}
			else{
				array_push($errores, Array("tipoInvestigacion" => true, "error" => "tipoInvestigacion"));
			}
		}
		else{
			$validado = 0;
			array_push($errores, Array("tipoInvestigacion" => false, "error" => "tipoInvestigacion"));
		}

		return $errores;
	}

	function validateModProject(){
		$errores = '[';
		$errores .= '{"Raul": true}';
		$errores .= ']';
		return $errores;
	}
>>>>>>> bfd732d8726367ba230f2f2e329e41b8b77222a1
 ?>