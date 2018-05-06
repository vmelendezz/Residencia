<?php 
//class para validar cosas generales
/**
* 
*/
class Validate
{
	
	function __construct()
	{
	}

	public function idInt( $data ){
		return preg_match("/^([0-9])+$/", $data);
	}

	public function fecha($data)
	{
		return preg_match("/^((19[5-9][0-9])|(20[0-9][0-9]))-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$data);
	}

	public function validateInfoGeneral($data)
	{
		$validado = 1;
		$errores = Array();

		if( !$this->idInt( $data["cmbxInstitucion"] ) ){
			$validado = 0;
			array_push($errores, Array( "validado" => false, "error" => "Instituciones") ) ;
		}
		else{
			array_push($errores, Array( "validado" => true, "error" => "Instituciones") ) ;
		}

		if(!preg_match("/^([a-z A-Z \ñ\Ñ\á\é\í\ó\ú])+$/", $data["txtResponsable"]) ){
			$validado = 0;
			array_push($errores, Array( "validado" => false, "error" => "Responsable") ) ;
		}
		else{
			array_push($errores, Array( "validado" => true, "error" => "Responsable") ) ;
		}

		if(!preg_match('/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/',  $data["cmbxInstitucion"]) ){
			$validado = 0;
			array_push($errores, Array( "validado" => false, "error" => "correo"));
		}
		else{
			array_push($errores, Array( "validado" => true, "error" => "correo"));
		}

		if(isset($data["rbnSNI"])){
			if($data["rbnSNI"] == "true"){
				if(!preg_match('/^([0-9]){1,10}$/', $data["numero"])){
					$validado = 0;
					array_push($errores, Array("validado" => falso, "error" => "Numero de registro SNI"));
				}else{
					array_push($errores, Array("validado" => true));
				}
			}else{
				if($data["numero"] == ""){
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

		if(isset($data["rbnTipoInvest"])){
			if(!$this->idInt($data["rbnTipoInvest"])){
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

		return '{"respuesta" : '.json_encode($errores).', "data": '.json_encode($data).', "validado" : '.$validado.' }';
	}

	public function validateModProyect($data)
	{
		$validado = 1;
		$errores = Array();

		if(isset($data["rbnLicPos"])){
			array_push($errores, Array("validado" => true, "error" => "rbnLicPos"));
			if ($data["rbnHabPNPC"] == false) {
				if (isset($data["rbnHabPNPC"])) {
					array_push($errores, Array("validado" => true, "error" => "rbnHabPNPC"));
				}
				else{
					array_push($errores, Array("validado" => false, "error" => "rbnHabPNPC"));
					$validado = 0;
				}
			}
		}
		else{
			array_push($errores, Array("validado" => false, "error" => "rbnLicPos"));
			$validado = 0;
		}

		if(!$this->idInt( $data["cmbxProgramEdu"]) ){
			array_push($errores, Array("validado" => false, "error" => "cmbxProgramEdu"));
			$validado = 0;
		}
		else{
			array_push($errores, Array("validado" => true, "error" => "cmbxProgramEdu"));
		}

		if(!$this->idInt( $data["cmbxLineInvest"])){
			array_push($errores, Array("validado" => false, "error" => "cmbxLineInvest"));
			$validado = 0;
		}
		else{
			array_push($errores, Array("validado" => true, "error" => "cmbxLineInvest"));
		}

		if (!preg_match('/^[0-9]{1,10}$/', $data["txtNumsni"])) {
			array_push($errores, Array("validado" => false, "error" => "txtNumsni"));
			$validado = 0;
		}
		else{
			array_push($errores, Array("validado" => true, "error" => "txtNumsni"));
		}

		if(!$this->idInt( $data["cmbxNameProgramEdu"])){
			array_push($errores, Array("validado" => false, "error" => "cmbxNameProgramEdu"));
			$validado = 0;
		}
		else{
			array_push($errores, Array("validado" => true, "error" => "cmbxNameProgramEdu"));
		}

		if(!$this->idInt( $data["cmbxLineInvestOrTrab"])){
			array_push($errores, Array("validado" => false, "error" => "cmbxLineInvestOrTrab"));
			$validado = 0;
		}
		else{
			array_push($errores, Array("validado" => true, "error" => "cmbxLineInvestOrTrab"));
		}

		if (!$this->idInt( $data["txtNumprodep"])) {
			array_push($errores, Array("validado" => false, "error" => "txtNumprodep"));
			$validado = 0;
		}
		else{
			array_push($errores, Array("validado" => true, "error" => "txtNumprodep"));
		}	

		if (isset($data["rbnCuerpo"])) {
			array_push($errores, Array("validado" => true, "error" => "rbnCuerpo"));
		}
		else{
			array_push($errores, Array("validado" => false, "error" => "rbnCuerpo"));
			$validado = 0;
		}

		if(!$this->idInt( $data["cmbxNameCuerpoAc"])){
			array_push($errores, Array("validado" => false, "error" => "cmbxNameCuerpoAc"));
			$validado = 0;
		}
		else{
			array_push($errores, Array("validado" => true, "error" => "cmbxNameCuerpoAc"));
		}

		if(!$this->idInt( $data["cmbxProgramEducativo"])){
			array_push($errores, Array("validado" => false, "error" => "cmbxProgramEducativo"));
			$validado = 0;
		}
		else{
			array_push($errores, Array("validado" => true, "error" => "cmbxProgramEducativo"));
		}

		if(!$this->idInt( $data["cmbxLineInvest"])){
			array_push($errores, Array("validado" => false, "error" => "cmbxLineInvest"));
			$validado = 0;
		}
		else{
			array_push($errores, Array("validado" => true, "error" => "cmbxLineInvest"));
		}		

		if (!$this->fecha( $data["datefechaModProject"]) ){
			array_push($errores, Array("validado" => false, "error" => "datefechaModProject"));
			$validado = 0;
		}
		else{
			array_push($errores, Array("validado" => true, "error" => "datefechaModProject"));
		}

		if(!$this->idInt( $data["txtNumber"])){
			array_push($errores, Array("validado" => false, "error" => "txtNumber"));
			$validado = 0;
		}
		else{
			array_push($errores, Array("validado" => true, "error" => "txtNumber"));
		}

		if(!$this->idInt( $data["txtHorasDes"])){
			array_push($errores, Array("validado" => false, "error" => "txtHorasDes"));
			$validado = 0;
		}
		else{
			array_push($errores, Array("validado" => true, "error" => "txtHorasDes"));
		}

		return '{"respuesta" : '.json_encode($errores).', "data": '.json_encode($data).', "validado" : '.$validado.' }';
	}

}
	
?>