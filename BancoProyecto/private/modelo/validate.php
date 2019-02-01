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

	public function text($data)
	{
		return preg_match("/^(.[\t\r\n]*){1,500}$/",$data);
	}

	public function float($data)
	{
		return preg_match("/^\d+(\.\d{1,2})?$/",$data);
	}

	public function validateInfoGeneral($data)
	{
		$validado = 1;
		$errores = Array();

		if( !$this->idInt( $data["cmbxInstitucion"] || $data["cmbxInstitucion"] != -1) ){
			$validado = 0;
			array_push($errores, Array( "validado" => false, "error" => "Institucion incorrecta") ) ;
		}
		else{
			array_push($errores, Array( "validado" => true, "error" => "Instituciones") ) ;
		}

		if(!preg_match("/^([a-z A-Z \ñ\Ñ\á\é\í\ó\ú])+$/", $data["txtTituloProject"]) ){
			$validado = 0;
			array_push($errores, Array( "validado" => false, "error" => "El titulo del proyecto es obligatorio, o esta incorrecto") ) ;
		}
		else{
			array_push($errores, Array( "validado" => true, "error" => "txtTituloProject") ) ;
		}

		if(!preg_match("/^([a-z A-Z \ñ\Ñ\á\é\í\ó\ú])+$/", $data["txtResponsable"]) ){
			$validado = 0;
			array_push($errores, Array( "validado" => false, "error" => "El responsable es obligatorio o esta incorrecto") ) ;
		}
		else{
			array_push($errores, Array( "validado" => true, "error" => "Responsable") ) ;
		}

		if(!preg_match('/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/',  $data["txtCorreo"]) ){
			$validado = 0;
			array_push($errores, Array( "validado" => false, "error" => "El correo es obligatorio o esta incorrecto"));
		}
		else{
			array_push($errores, Array( "validado" => true, "error" => "correo"));
		}

		if(isset($data["rbnSNI"])){
			array_push($errores, Array("validado" => true, "error" => "SNI"));
			if($data["rbnSNI"] == "1"){
				if(!preg_match('/^([0-9]){1,10}$/', $data["txtNumero"])){
					$validado = 0;
					array_push($errores, Array("validado" => false, "error" => "Numero de registro SNI esta mal capturado"));
				}else{
					array_push($errores, Array("validado" => true, "error" => "Numero de registro SNI"));
				}
			}else{
				if($data["txtNumero"] == ""){
					array_push($errores, Array("validado" => true));
				}else{
					$validado = 0;
					array_push($errores, Array("validado" => false, "error" => "SNI debe ser 'Si'"));
				}
			}
		}
		else{
			if($data["txtNumero"] == ""){
				array_push($errores, Array("validado" => true, "error" => "SNI"));
			}else{
				$validado = 0;
				array_push($errores, Array("validado" => false, "error" => "Numero de SNI debe estar vacio"));
			}
		}

		return '{"respuesta" : '.json_encode($errores).', "data": '.json_encode($data).', "validado" : '.$validado.' }';
	}

	public function validateModProyect($data)
	{
		$validado = 1;
		$errores = Array();

		if(isset($data["rbnLicPos"]) && $data["rbnLicPos"] == 'posgrado'){
			if (isset($data["rbnHabPNPC"]) ) {
				if ($data["rbnHabPNPC"] == 'habilitado' ||  $data["rbnHabPNPC"] == 'pnpc') {
					array_push($errores, Array("validado" => true, "error" => "rbnHabPNPC"));
				}
				else{
					array_push($errores, Array("validado" => false, "error" => "rbnHabPNPC"));
					$validado = 0;
				}
			}else{
				array_push($errores, Array("validado" => false, "error" => "rbnHabPNPC"));
					$validado = 0;
			}
		}

		if (!preg_match('/^[0-9]{0,10}$/', $data["txtNumsni"])) {
			array_push($errores, Array("validado" => false, "error" => "Numero SNI mal capturado"));
			$validado = 0;
		}
		else{
			array_push($errores, Array("validado" => true, "error" => "txtNumsni"));
		}

		if ($this->idInt( $data["txtNumprodep"] ) || $data["txtNumprodep"] == '') {
			array_push($errores, Array("validado" => true, "error" => "Numero PRODEP"));
		}else{
			array_push($errores, Array("validado" => false, "error" => "Numero PRODEP mal capturado"));
			$validado = 0;
		}	

		if ($this->fecha( $data["datefechaModProject"]) || $data["datefechaModProject"] == ''){
			array_push($errores, Array("validado" => true, "error" => "Fecha"));
		}
		else{
			array_push($errores, Array("validado" => false, "error" => "Fecha mal capturada"));
			$validado = 0;
		}

		if(($this->idInt( $data["txtNumber"]) && $data["txtNumber"] != 0) || $data["txtNumber"] == ''){
			array_push($errores, Array("validado" => true, "error" => "Duracion del proyecto"));
		}
		else{
			array_push($errores, Array("validado" => false, "error" => "Duracion del proyecto mal capturada"));
			$validado = 0;
		}

		if(($this->idInt( $data["txtHorasDes"]) && $data["txtHorasDes"] != 0) || $data["txtHorasDes"] == ''){
			array_push($errores, Array("validado" => true, "error" => "txtHorasDes"));
		}
		else{
			array_push($errores, Array("validado" => false, "error" => "Horas requeridas para desarrollo mal capturadas"));
			$validado = 0;
		}

		return '{"respuesta" : '.json_encode($errores).', "data": '.json_encode($data).', "validado" : '.$validado.' }';
	}

	public function validateColaboradores($data){
		$validado = 1;
		$errores = Array();

		if($this->text( $data["textAreaObjetivos"] ) || $data["textAreaObjetivos"] == ''){
			array_push($errores, Array( "validado" => true, "error" => "Objetivo general") ) ;
		}
		else{
			$validado = 0;
			array_push($errores, Array( "validado" => false, "error" => "Objetivo general mal capturado") ) ;
		}

		if( $this->text( $data["textAreaObjetivosEspecificos"] ) || $data["textAreaObjetivosEspecificos"] == '' ){
			array_push($errores, Array( "validado" => true, "error" => "Objetivos especificos") ) ;
		}
		else{
			array_push($errores, Array( "validado" => false, "error" => "Objetivos especificos mal capturados") ) ;
			$validado = 0;
		}

		if( $this->text( $data["txtLicProdEntreg"] ) || $data["txtLicProdEntreg"] == ''){
			array_push($errores, Array( "validado" => true, "error" => "Licenciatura") ) ;
		}
		else{
			array_push($errores, Array( "validado" => false, "error" => "Licenciatura mal capturada") ) ;
			$validado = 0;
		}

		if( $this->text( $data["txtMaestProdEntreg"] ) || $data["txtMaestProdEntreg"] == ''){
			array_push($errores, Array( "validado" => true, "error" => "Maestria"));
		}
		else{
			array_push($errores, Array( "validado" => false, "error" => "Maestria mal capturada"));
			$validado = 0;
		}

		if( $this->text( $data["txtDocProdEntreg"] ) || $data["txtDocProdEntreg"] == ''){
			array_push($errores, Array( "validado" => true, "error" => "Doctorado"));
		}
		else{
			array_push($errores, Array( "validado" => false, "error" => "Doctorado mal capturado"));
			$validado = 0;
		}

		if( $this->text( $data["articulosIndizadas"] ) || $data["articulosIndizadas"] == ''){
			array_push($errores, Array( "validado" => true, "error" => "Artículos científicos en revistas indizadas enviados"));
		}
		else{
			array_push($errores, Array( "validado" => false, "error" => "Artículos científicos en revistas indizadas enviados  mal capturados"));
			$validado = 0;
		}

		if( $this->text( $data["articulosArbitradas"] ) || $data["articulosArbitradas"] == ''){
			array_push($errores, Array( "validado" => true, "error" => "Artículos científicos en revistas arbitradas enviados"));
		}
		else{
			array_push($errores, Array( "validado" => false, "error" => "Artículos científicos en revistas arbitradas enviados mal capturados"));
			$validado = 0;
		}

		if( $this->text( $data["articulosDivulgacionEnviados"] ) || $data["articulosDivulgacionEnviados"] == ''){
			array_push($errores, Array( "validado" => true, "error" => "Artículos de divulgación enviados"));
		}
		else{
			array_push($errores, Array( "validado" => false, "error" => "Artículos de divulgación enviados  mal capturados"));
			$validado = 0;
		}

		if( $this->text( $data["articulosMemoriasEnviados"] ) || $data["articulosMemoriasEnviados"] == ''){
			array_push($errores, Array( "validado" => true, "error" => "Artículos en memorias en congreso enviados"));
		}
		else{
			array_push($errores, Array( "validado" => false, "error" => "Artículos en memorias en congreso enviados mal capturados"));
			$validado = 0;
		}

		if( $this->text( $data["memoriasCongreso"] ) || $data["memoriasCongreso"] == ''){
			array_push($errores, Array( "validado" => true, "error" => "Memorias en extenso en congresos"));
		}
		else{
			array_push($errores, Array( "validado" => false, "error" => "Memorias en extenso en congresos mal capturadas"));
			$validado = 0;
		}

		if( $this->text( $data["capitulosEnviados"] ) || $data["capitulosEnviados"] == ''){
			array_push($errores, Array( "validado" => true, "error" => "Capítulos de libros enviados para revisión"));
		}
		else{
			array_push($errores, Array( "validado" => false, "error" => "Capítulos de libros enviados para revisión mal capturados"));
			$validado = 0;
		}

		if( $this->text( $data["librosEnviados"] ) || $data["librosEnviados"] == ''){
			array_push($errores, Array( "validado" => true, "error" => "Libros enviados para revisión"));
		}
		else{
			array_push($errores, Array( "validado" => false, "error" => "Libros enviados para revisión mal capturados"));
			$validado = 0;
		}

		if( $this->text( $data["librosEditadosPublicados"] ) || $data["librosEditadosPublicados"] == ''){
			array_push($errores, Array( "validado" => true, "error" => "Libros editados y publicados"));
		}
		else{
			array_push($errores, Array( "validado" => false, "error" => "Libros editados y publicados mal capturados"));
			$validado = 0;
		}

		if( $this->text( $data["prototipoEnviados"] ) || $data["prototipoEnviados"] == ''){
			array_push($errores, Array( "validado" => true, "error" => "Prototipos enviados para registro"));
		}
		else{
			array_push($errores, Array( "validado" => false, "error" => "Prototipos enviados para registro mal capturados"));
			$validado = 0;
		}

		if( $this->text( $data["patentesEnviados"] ) || $data["patentesEnviados"] == ''){
			array_push($errores, Array( "validado" => true, "error" => "Patentes enviadas para registro"));
		}
		else{
			array_push($errores, Array( "validado" => false, "error" => "Patentes enviadas para registro mal capturadas"));
			$validado = 0;
		}

		if( $this->text( $data["paquetesEnviados"] ) || $data["paquetesEnviados"] == ''){
			array_push($errores, Array( "validado" => true, "error" => "Paquetes tecnológicos enviados para registro"));
		}
		else{
			array_push($errores, Array( "validado" => false, "error" => "Paquetes tecnológicos enviados para registro mal capturados"));
			$validado = 0;
		}

		if(isset($data["rbnFinanciamiento"]) && ($data["rbnFinanciamiento"] == 'true' || $data["rbnFinanciamiento"] == 'false' ) ){
			if( $data["rbnFinanciamiento"] == 'true' && isset( $data["financiamiento"]) && $this->text( $data["financiamiento"] ) ){
				array_push($errores, Array( "validado" => true, "error" => "Seleccionar un financiamiento"));
			}else if( $data["rbnFinanciamiento"] == 'true' ){
				$validado = 0;
				array_push($errores, Array("validado" => false, "error" => "Señalar una fuente de financiamiento"));
			}else{
				array_push($errores, Array( "validado" => true, "error" => "Seleccionar un financiamiento"));
			}
		}

		$tablesInfoProfesores = json_decode($data["tablesInfoProfesores"]);

		for ($i=0; $i < count($tablesInfoProfesores) ; $i++) { 
			foreach ($tablesInfoProfesores[$i] as $key => $value) {
				if( $key == 'txtNombreProfCol' && !$this->text( $value ) ){
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Nombre de colaborador del proyecto es obligatorio o esta mal capturado"));
				}else if($key == 'txtCorreoProfCol' && !preg_match('/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/',  $value ) ){ 
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Correo del profesor es obligatorio o esta mal capturado"));
				}else if($key == 'txtNivelSNI' && !preg_match("/^([0-9])+$/", $value) ){ 
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Nivel SNI/No. CVU es obligatorio o esta mal capturado"));
				}else if( explode('-', $key)[0] == 'rbnProfesorTC' && ($value != '1' && $value != '0') ){
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Seleccionar profesor TC"));
				}else if( explode('-', $key)[0] == 'rbnPerfilPromep' && ($value != '1' && $value != '0') ){
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Seleccionar Perfil PROMEP"));
				}
			}
		}

		$incorporarAlumnos = json_decode($data["incorporarAlumnos"]);

		for ($i=0; $i < count($incorporarAlumnos) ; $i++) { 
			foreach ($incorporarAlumnos[$i] as $key => $value) {
				if( $key == 'txtAlumProyectoProdEntreg' && !$this->text( $value ) ){
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Incorporación de alumnos de licenciatura al proyecto es obligatorio o esta mal capturado"));
				}
			}
		}

		$alumnosResidentes = json_decode($data["alumnosResidentes"]);

		for ($i=0; $i < count($alumnosResidentes) ; $i++) { 
			foreach ($alumnosResidentes[$i] as $key => $value) {
				if( $key == 'txtAlumResidentesProdEntreg' && !$this->text( $value ) ){
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Nombre de Alumnos residentes es obligatorio o esta mal capturado"));
				}
			}
		}

		return '{"respuesta" : '.json_encode($errores).', "data": '.json_encode($data).', "validado" : '.$validado.' }';
	}

	public function validarProgramaActividades($data){
		$validado = 1;
		$errores = Array();

		$tblProgramAct = json_decode($data["tblProgramAct"]);

		for ($i=0; $i < count($tblProgramAct) ; $i++) { 
			foreach ($tblProgramAct[$i] as $key => $value) {

				if( $key == 'txtNomResponAct' && !$this->text( $value ) ){
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Nombre del responsable de la actividad es obligatorio o esta mal capturado"));
				}else if( $key == 'txtActividad' && !$this->text( $value ) ){ 
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Actividad es obligatoria o esta mal capturada"));
				}else if($key == 'txtPeriodoActiv' && !preg_match("/^([0-9])+$/", $value) ){ 
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Número de meses es obligatorio o esta mal capturado"));
				}else if( $key == 'txtResultEntregables' && !$this->text( $value ) ){
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Resultados entregables de la actividad es obligatorio o esta mal capturado"));
				}else if( $key == 'txtPartidasSol' && !$this->text( $value ) ){
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Partidas solicitadas es obligatorio o esta mal capturado"));
				}else if( $key == 'txtMontoSolicitadoActiv' && !$this->text( $value ) ){
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Monto solicitado es obligatorio o esta mal capturado"));
				}else if( $key == 'txtDesBienes' && !$this->text( $value ) ){
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Descripción de los bienes es obligatorio o esta mal capturado"));
				}

			}
		}

		$tblPresupSolicitado = json_decode($data["tblPresupSolicitado"]);

		for ($i=0; $i < count($tblPresupSolicitado) ; $i++) { 
			foreach ($tblPresupSolicitado[$i] as $key => $value) {

				if( $key == 'txtMaterialesMontoDgest' && !$this->float( $value ) && $value != ''){
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Materiales y suministros Monto Solicitado a la DGEST es obligatorio o esta mal capturado"));
				}else if( $key == 'txtMaterialesMontOtorgarTec' && !$this->float( $value ) && $value != ''){ 
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Materiales y suministros Monto a otorgar por el Tecnológico es obligatorio o esta mal capturado"));
				}else if($key == 'txtMaterialesMontOtrasInst' && !$this->float( $value ) && $value != ''){ 
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Materiales y suministros Monto a otorgar por otras instituciones es obligatorio o esta mal capturado"));
				}else if( $key == 'txtMaterialesTotal' && !$this->float( $value ) && $value != ''){
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Materiales y suministros TOTAL es obligatorio o esta mal capturado"));
				}

				else if( $key == 'txtServiciosMontoDgest' && !$this->float( $value ) && $value != ''){
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Servicio Monto Solicitado a la DGEST es obligatorio o esta mal capturado"));
				}else if( $key == 'txtServiciosMontOtorgarTec' && !$this->float( $value ) && $value != ''){ 
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Servicio Monto a otorgar por el Tecnológico es obligatorio o esta mal capturado"));
				}else if($key == 'txtServiciosMontOtrasInst' && !$this->float( $value ) && $value != ''){ 
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Servicio Monto a otorgar por otras instituciones es obligatorio o esta mal capturado"));
				}else if( $key == 'txtServiciosTotal' && !$this->float( $value ) && $value != ''){
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Servicio TOTAL es obligatorio o esta mal capturado"));
				}

				else if( $key == 'txtTotalMontoDgest' && !$this->float( $value ) && $value != ''){
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Total Monto Solicitado a la DGEST es obligatorio o esta mal capturado"));
				}else if( $key == 'txtTotalMontOtorgarTec' && !$this->float( $value ) && $value != ''){ 
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Total Monto a otorgar por el Tecnológico es obligatorio o esta mal capturado"));
				}else if($key == 'txtTotalMontOtrasInst' && !$this->float( $value ) && $value != ''){ 
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Total Monto a otorgar por otras instituciones es obligatorio o esta mal capturado"));
				}else if( $key == 'txtTotalDeTotales' && !$this->float( $value ) && $value != ''){
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Total TOTAL es obligatorio o esta mal capturado"));
				}

			}
		}

		return '{"respuesta" : '.json_encode($errores).', "data": '.json_encode($data).', "validado" : '.$validado.' }';
	}

	public function validarPlanTrabajo($data){
		$validado = 1;
		$errores = Array();

		$tblActDocencia = json_decode($data["tblActDocencia"]);

		for ($i=0; $i < count($tblActDocencia) ; $i++) { 
			foreach ($tblActDocencia[$i] as $key => $value) {

				if( $key == 'txtPTNomAsig' && !$this->text( $value ) ){
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Docencia Nombre del estudiente es obligatorio o esta mal capturado"));
				}else if( $key == 'numberPTNoEstudi' && !preg_match("/^([0-9])+$/", $value) ){ 
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Docencia No. de estudiantes es obligatorio o esta mal capturado"));
				}else if( explode('-', $key)[0] == 'nivelDocente'){ 
					if( $value != '0' && $value != '1' ){
						$validado = 0;
						array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Docencia Seleccionar nivel es obligatorio o esta mal capturado"));
					}
				}else if( $key == 'numberPTTeorica' && !preg_match("/^([0-9])+$/", $value)  ){
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Docencia Horas teóricas es obligatorio o esta mal capturado"));
				}else if( $key == 'numberPTTeoPrac' && !preg_match("/^([0-9])+$/", $value) ){
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Docencia Horas Teórica/práctica es obligatorio o esta mal capturado"));
				}else if( $key == 'numberPTPractica' && !preg_match("/^([0-9])+$/", $value) ){
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Docencia Horas Práctica es obligatorio o esta mal capturado"));
				}else if( $key == 'txtPTTotal' && !preg_match("/^([0-9])+$/", $value) ){
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Docencia Total horas semana es obligatorio o esta mal capturado"));
				}

			}
		}

		$tblActTutoria = json_decode($data["tblActTutoria"]);

		for ($i=0; $i < count($tblActTutoria) ; $i++) { 
			foreach ($tblActTutoria[$i] as $key => $value) {

				if( $key == 'txtPTNomAsig' && !$this->text( $value ) ){
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Tutorias Nombre del estudiente es obligatorio o esta mal capturado"));
				}else if( $key == 'numberPTNoEstudi' && !$this->text( $value ) ){ 
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Tutorias Tipo de tutoría es obligatorio o esta mal capturado"));
				}else if( explode('-', $key)[0] == 'nivelTutorias'){ 
					if( $value != '0' && $value != '1' ){
						$validado = 0;
						array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Tutorias Seleccionar nivel es obligatorio o esta mal capturado"));
					}
				}else if( $key == 'numberPTTeorica' && !preg_match("/^([0-9])+$/", $value)  ){
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Tutorias Horas teóricas es obligatorio o esta mal capturado"));
				}else if( $key == 'numberPTTeoPrac' && !preg_match("/^([0-9])+$/", $value) ){
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Tutorias Horas Teórica/práctica es obligatorio o esta mal capturado"));
				}else if( $key == 'numberPTPractica' && !preg_match("/^([0-9])+$/", $value) ){
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Tutorias Horas Práctica es obligatorio o esta mal capturado"));
				}else if( $key == 'txtPTTotal' && !preg_match("/^([0-9])+$/", $value) ){
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Tutorias Total horas semana es obligatorio o esta mal capturado"));
				}

			}
		}

		$tblActDireTesis = json_decode($data["tblActDireTesis"]);

		for ($i=0; $i < count($tblActDireTesis) ; $i++) { 
			foreach ($tblActDireTesis[$i] as $key => $value) {

				if( $key == 'txtPTNomAsig' && !$this->text( $value ) ){
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Tesis Nombre del estudiante es obligatorio o esta mal capturado"));
				}else if( $key == 'numberPTNoEstudi' && !$this->text( $value ) ){ 
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Tesis Nombre de la tesis es obligatorio o esta mal capturado"));
				}else if( explode('-', $key)[0] == 'nivelTesis'){ 
					if( $value != '0' && $value != '1' ){
						$validado = 0;
						array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Tesis Seleccionar nivel es obligatorio o esta mal capturado"));
					}
				}else if( $key == 'datePTFechaTerm' && !$this->fecha($value)  ){
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Tesis Fecha de termino es obligatorio o esta mal capturado"));
				}else if( $key == 'textPTTotalHrs' && !preg_match("/^([0-9])+$/", $value) ){
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Tesis Total de horas a la semana es obligatorio o esta mal capturado"));
				}

			}
		}
		
		$tblActInvest = json_decode($data["tblActInvest"]);

		for ($i=0; $i < count($tblActInvest) ; $i++) { 
			foreach ($tblActInvest[$i] as $key => $value) {

				if( $key == 'textPTNomProject' && !$this->text( $value ) ){
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Actividades de investigación Función es obligatorio o esta mal capturado"));
				}else if( $key == 'textPTFuncProject' && !$this->text( $value ) ){ 
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Actividades de investigación Descripción de la actividad es obligatorio o esta mal capturado"));
				}else if( $key == 'textPTPoductProject' && !$this->text( $value ) ){ 
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Actividades de investigación Producto esperado es obligatorio o esta mal capturado"));
				}else if( $key == 'textPTTotalHrs' && !preg_match("/^([0-9])+$/", $value) ){
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Actividades de investigación Total horas semana es obligatorio o esta mal capturado"));
				}

			}
		}

		$tblActGestAcadem = json_decode($data["tblActGestAcadem"]);

		for ($i=0; $i < count($tblActGestAcadem) ; $i++) { 
			foreach ($tblActGestAcadem[$i] as $key => $value) {

				if( $key == 'textPTNomProject' && !$this->text( $value ) ){
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Gestion academica Función es obligatorio o esta mal capturado"));
				}else if( $key == 'textPTFuncProject' && !$this->text( $value ) ){ 
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Gestion academica Descripción de la actividad es obligatorio o esta mal capturado"));
				}else if( $key == 'textPTPoductProject' && !$this->text( $value ) ){ 
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Gestion academica Producto esperado es obligatorio o esta mal capturado"));
				}else if( $key == 'textPTTotalHrs' && !preg_match("/^([0-9])+$/", $value) ){
					$validado = 0;
					array_push($errores, Array("validado" => false, "Fila" => $i, "error" => "Gestion academica Total horas semana es obligatorio o esta mal capturado"));
				}

			}
		}

		return '{"respuesta" : '.json_encode($errores).', "data": '.json_encode($data).', "validado" : '.$validado.' }';
	}
}
	
?>