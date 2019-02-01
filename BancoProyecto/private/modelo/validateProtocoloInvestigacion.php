<?php  

/**
* 
*/
class Validate
{
	
	function __construct()
	{
		# code...
	}

	public function generateRandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	} 

	public function text($data)
	{
		return preg_match("/^(.[\t\r\n]*){1,1300}$/",$data);
	}

	public function textShort($data)
	{
		return preg_match("/^(.[\t\r\n]*){1,255}$/",$data);
	}

	public function textMedium($data)
	{
		return preg_match("/^(.[\t\r\n]*){1,500}$/",$data);
	}

	public function validateProtocoloInvestigacion($data)
	{
		$validado = 1;
		$errores = Array();

		if($this->textShort($data["titulo"])){
			array_push($errores, Array( "validado" => true, "error" => "titulo") ) ;
		}else{
			array_push($errores, Array( "validado" => false, "error" => "titulo") ) ;
			$validado = 0;
		}

		if($this->text($data["textAreaResumen"]) || $data["textAreaResumen"] == ''){
			array_push($errores, Array( "validado" => true, "error" => "Resumen") ) ;
		}else{
			array_push($errores, Array( "validado" => false, "error" => "Resumen") ) ;
			$validado = 0;
		}

		if($this->text( $data["textAreaIntroduccion"]) || $data["textAreaIntroduccion"] == ''){
			array_push($errores, Array( "validado" => true, "error" => "Introducción") ) ;
		}
		else{
			array_push($errores, Array( "validado" => false, "error" => "Introducción") ) ;
			$validado = 0;
		}

		if($this->text( $data["textAreaAntecedentes"]) || $data["textAreaAntecedentes"] == ''){
			array_push($errores, Array( "validado" => true, "error" => "Antecedentes") ) ;
		}
		else{
			array_push($errores, Array( "validado" => false, "error" => "Antecedentes") ) ;
			$validado = 0;
		}

		if($this->text( $data["textAreaMteorico"]) || $data["textAreaMteorico"] == ''){
			array_push($errores, Array( "validado" => true, "error" => "Marco teórico") ) ;
		}
		else{
			array_push($errores, Array( "validado" => false, "error" => "Marco teórico") ) ;
			$validado = 0;
		}		

		return '{"respuesta" : '.json_encode($errores).', "data": '.json_encode($data).', "validado" : '.$validado.' }';
	}

	public function validateObjetivosProyecto($data)
	{
		$validado = 1;
		$errores = Array();

		if($this->text($data["textAreaObjetivos"]) || $data["textAreaObjetivos"] == ''){
			array_push($errores, Array( "validado" => true, "error" => "Objetivo general"));
		}
		else{
			array_push($errores, Array( "validado" => false, "error" => "Objetivo general"));	
			$validado = 0;
		}

		if($this->text($data["textAreaObjetivosEspecificos"]) || $data["textAreaObjetivosEspecificos"] == ''){
			array_push($errores, Array( "validado" => true, "error" => "Objetivos especificos"));
		}
		else{
			array_push($errores, Array( "validado" => false, "error" => "Objetivos especificos"));	
			$validado = 0;
		}

		if($this->text($data["textAreaMeta"]) || $data["textAreaMeta"] == ''){
			array_push($errores, Array( "validado" => true, "error" => "Metas"));
		}
		else{
			array_push($errores, Array( "validado" => false, "error" => "Metas"));	
			$validado = 0;
		}

		if($this->text($data["textAreaImpacto"]) || $data["textAreaImpacto"] == ''){
			array_push($errores, Array( "validado" => true, "error" => "Impacto beneficio"));	
		}
		else{
			array_push($errores, Array( "validado" => false, "error" => "Impacto beneficio"));
			$validado = 0;
		}

		if($this->text($data["textAreaMetodologia"]) || $data["textAreaMetodologia"] == ''){
			array_push($errores, Array( "validado" => true, "error" => "Metodologia"));	
		}
		else{
			array_push($errores, Array( "validado" => false, "error" => "Metodologia"));
			$validado = 0;
		}

		if($this->text($data["textAreaProductos"]) || $data["textAreaProductos"] == ''){
			array_push($errores, Array( "validado" => true, "error" => "Productos entregables"));	
		}
		else{
			array_push($errores, Array( "validado" => false, "error" => "Productos entregables"));
			$validado = 0;
		}

		return '{"respuesta" : '.json_encode($errores).', "data" : '.json_encode($data).', "validado" : '.$validado.' }';
	}

	public function validateDatosEmpresa($data)
	{
		$validado = 1;
		$errores = Array();

		if($this->textShort($data["txtnomempresa"]) || $data["txtnomempresa"] == ''){
			array_push($errores, Array( "validado" => true, "error" => "Nombre de la empresa"));
		}
		else{
			array_push($errores, Array( "validado" => false, "error" => "Nombre de la empresa"));	
			$validado = 0;
		}

		if($this->textShort($data["textAreaTipoCooperacion"]) || $data["textAreaTipoCooperacion"] == ''){
			array_push($errores, Array( "validado" => true, "error" => "Tipo de cooperacion"));
		}
		else{
			array_push($errores, Array( "validado" => false, "error" => "Tipo de cooperacion"));	
			$validado = 0;
		}

		if($this->textShort($data["textAreaResponsabilidad"]) || $data["textAreaResponsabilidad"] == ''){
			array_push($errores, Array( "validado" => true, "error" => "Responsabilidad"));
		}
		else{
			array_push($errores, Array( "validado" => false, "error" => "Responsabilidad"));	
			$validado = 0;
		}

		if($this->textShort($data["textAreaUsuariosPotenciales"]) || $data["textAreaUsuariosPotenciales"] == ''){
			array_push($errores, Array( "validado" => true, "error" => "Usuarios potenciales"));
		}
		else{
			array_push($errores, Array( "validado" => false, "error" => "Usuarios potenciales"));	
			$validado = 0;
		}

		if($this->textMedium($data["referencias"]) || $data["referencias"] == ''){
			array_push($errores, Array( "validado" => true, "error" => "Referencias"));
		}
		else{
			array_push($errores, Array( "validado" => false, "error" => "Referencias"));	
			$validado = 0;
		}

		if($this->textMedium($data["campoarte"]) || $data["campoarte"] == ''){
			array_push($errores, Array( "validado" => true, "error" => "Campo del arte"));
		}
		else{
			array_push($errores, Array( "validado" => false, "error" => "Campo del arte"));	
			$validado = 0;
		}

		if($this->textMedium($data["plateamiento"]) || $data["plateamiento"] == ''){
			array_push($errores, Array( "validado" => true, "error" => "Planteamiento"));
		}
		else{
			array_push($errores, Array( "validado" => false, "error" => "Planteamiento"));	
			$validado = 0;
		}

		if($this->textMedium($data["desarrollo"]) || $data["desarrollo"] == ''){
			array_push($errores, Array( "validado" => true, "error" => "Desarrollo del proyecto"));
		}
		else{
			array_push($errores, Array( "validado" => false, "error" => "Desarrollo del proyecto"));	
			$validado = 0;
		}

		unset($data['file']);

		if( $validado != 0 ){
			$data['file'] = [];
			/*Validar archivos*/
			if( isset($_FILES) ){
				foreach ($_FILES as $key => $value) {
					if( $_FILES[$key]['type'] == 'application/pdf' ){
						if( $_FILES[$key]['size'] <= 4000000){
							$dir_subida = dirname(__FILE__).'/../../files/';

							$name = $this->generateRandomString(30);
							while (file_exists($dir_subida . $name . '.pdf')) {
								$name = $this->generateRandomString(30);
							}

							$fichero_subido = $dir_subida . $name . '.pdf';
							if (move_uploaded_file($_FILES[$key]['tmp_name'], $fichero_subido ) ) {
								array_push($data['file'], array('nombre' => $_FILES[$key]['name'], 'id' => $name));
							    array_push($errores, Array( "validado" => true, "error" => "Cargar archivos"));
							} else {
							    array_push($errores, Array( "validado" => false, "error" => "¡Posible ataque de subida de ficheros!"));
							}
							
						}else{
							$validado=0;
							array_push($errores, Array( "validado" => false, "error" => "Los archivos no deben ser mayor a 4MB"));
						}
					}else{
						$validado=0;
						array_push($errores, Array( "validado" => false, "error" => "Los archivos deben ser PDF"));	
					}
				}
			}
		}
		
		/*Validar archivos*/

		return '{"respuesta" : '.json_encode($errores).', "data" : '.json_encode($data).', "validado" : '.$validado.' }';
	}

	public function validarLugarInfra($data)
	{
		$validado = 1;
		$errores = Array();

		if($this->textShort($data["txtnombrelugtrab"]) || $data["txtnombrelugtrab"] == ''){
			array_push($errores, Array( "validado" => true, "error" => "Seccion"));
		}
		else{
			array_push($errores, Array( "validado" => false, "error" => "Seccion"));	
			$validado = 0;
		}

		if($this->textShort($data["txtdireccionlugtrab"]) || $data["txtdireccionlugtrab"] == ''){
			array_push($errores, Array( "validado" => true, "error" => "Direccion exacta"));
		}
		else{
			array_push($errores, Array( "validado" => false, "error" => "Direccion exacta"));	
			$validado = 0;
		}

		if($this->textShort($data["txtEstado"]) || $data["txtEstado"] == ''){
			array_push($errores, Array( "validado" => true, "error" => "Estado"));
		}
		else{
			array_push($errores, Array( "validado" => false, "error" => "Estado"));	
			$validado = 0;
		}

		if($this->textShort($data["txtregion"]) || $data["txtregion"] == ''){
			array_push($errores, Array( "validado" => true, "error" => "Region"));
		}
		else{
			array_push($errores, Array( "validado" => false, "error" => "Region"));	
			$validado = 0;
		}

		if($this->textShort($data["txtzona"]) || $data["txtzona"] == ''){
			array_push($errores, Array( "validado" => true, "error" => "Zona"));
		}
		else{
			array_push($errores, Array( "validado" => false, "error" => "Zona"));	
			$validado = 0;
		}

		if($this->textShort($data["txtmunicipio"]) || $data["txtmunicipio"] == ''){
			array_push($errores, Array( "validado" => true, "error" => "Municipio"));
		}
		else{
			array_push($errores, Array( "validado" => false, "error" => "Municipio"));	
			$validado = 0;
		}

		if((preg_match("/^\d+(\.\d{1,2})?$/", $data["txtdistanciakm"]) && $data["txtdistanciakm"] != 0) || $data["txtdistanciakm"] == ''){
			array_push($errores, Array( "validado" => true, "error" => "Distancia en KM"));
		}
		else{
			array_push($errores, Array( "validado" => false, "error" => "Distancia en KM"));	
			$validado = 0;
		}

		if($this->textMedium($data["infraestructura"]) || $data["infraestructura"] == ''){
			array_push($errores, Array( "validado" => true, "error" => "Infraestructura"));
		}
		else{
			array_push($errores, Array( "validado" => false, "error" => "Infraestructura"));	
			$validado = 0;
		}

		if( !isset( $data["pruebas"] ) || $data["pruebas"] == '0' || $data["pruebas"] == '1'){
			array_push($errores, Array( "validado" => true, "error" => "Infraestructura"));
		}
		else{
			array_push($errores, Array( "validado" => false, "error" => "Debe seleccionar una opcion de pruebas"));	
			$validado = 0;
		}

		return '{"respuesta" : '.json_encode($errores).', "data" : '.json_encode($data).', "validado" : '.$validado.' }';
	}
}

?>