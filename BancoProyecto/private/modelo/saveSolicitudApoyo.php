<?php 

/**
* 
*/
class SaveSolicitudApoyo
{
	
	public $conn = null;
	public $result;
	function __construct()
	{
		require "conexion.php";
		$this->conn = new conexion();
	}

	public function SaveSolicitud($data, $id, $idInvestigador)
	{
		//print_r($data);
		$dataSave = array();
		$dataSave = array(':idSolicitudApoyo' => $id,
							':titulo' => null,
							':descripcion' => null,
							':idTipoInvestigacion' => null,
							':orientacion' => null,
							':idPrograma' => null,
							':idLinea' => null,
							':fechaInicio' => null,
							':duracion' => null,
							':horasRequeridas' => null,
							':responsable' => null,
							':idProgramaInv' => null,
							':idLineaInv' => null,
							':idProgramaCuerpo' => null,
							':idLineaCuerpo' => null,
							':correoResponsable' => null,
							':subOrientacion' => null,
							'idInvestigador' => $idInvestigador,
							':idCuerpoAcademico' => null,
							':sniInv' => null,
							':promepInv' => null,
							':idInstitucion' => null,
							':SNI' => null,
							':numeroRegistroSNI' => null,
							':vigencia' => null,
							':orientacionCuerpo' => null);

		foreach ($data as $key => $value) {
			if( $key == 'dataInfoGeneral'){
				foreach ($data[$key]->campos as $key1 => $value1) {
					if( $value1->nombre == 'txtTituloProject' ){
						$dataSave[':titulo'] = $value1->value;
					}else if( $value1->nombre == 'rbnTipoInvest' ){
						$dataSave[':idTipoInvestigacion'] = $value1->value;
					}else if( $value1->nombre == 'txtResponsable' ){
						$dataSave[':responsable'] = $value1->value;
					}else if( $value1->nombre == 'txtCorreo' ){
						$dataSave[':correoResponsable'] = $value1->value;
					}else if( $value1->nombre == 'cmbxInstitucion' ){
						$dataSave[':idInstitucion'] = $value1->value;
					}else if( $value1->nombre == 'rbnSNI' ){
						if($value1->value == true){
							$dataSave[':SNI'] = 1;
						}else{
							$dataSave[':SNI'] = 0;
						}
					}else if( $value1->nombre == 'txtNumero' ){
						$dataSave[':numeroRegistroSNI'] = $value1->value;
					}
				}
			}else if ($key == 'modalidadProyecto') {
				foreach ($data[$key]->campos as $key1 => $value1) {
					if ($value1->nombre == 'rbnLicPos') {
						$dataSave[':orientacion'] = $value1->value;
					}else if ($value1->nombre == 'cmbxProgramEdu') {
						$dataSave[':idPrograma'] = $value1->value;
					}else if ($value1->nombre == 'cmbxLineInvest') {
						$dataSave[':idLinea'] = $value1->value;
					}else if ($value1->nombre == 'datefechaModProject') {
						$dataSave[':fechaInicio'] = $value1->value;
					}else if ($value1->nombre == 'txtNumber') {
						$dataSave[':duracion'] = $value1->value;
					}else if ($value1->nombre == 'txtHorasDes') {
						$dataSave[':horasRequeridas'] = $value1->value;
					}else if ($value1->nombre == 'cmbxNameProgramEdu') {
						$dataSave[':idProgramaInv'] = $value1->value;
					}else if ($value1->nombre == 'cmbxLineInvestOrTrab') {
						$dataSave[':idLineaInv'] = $value1->value;
					}else if ($value1->nombre == 'cmbxProgramEducativo') {
						$dataSave[':idProgramaCuerpo'] = $value1->value;
					}else if ($value1->nombre == 'cmbxLineInvestCuerpo') {
						$dataSave[':idLineaCuerpo'] = $value1->value;
					}else if ($value1->nombre == 'rbnHabPNPC') {
						$dataSave[':subOrientacion'] = $value1->value;
					}else if ($value1->nombre == 'cmbxNameCuerpoAc') {
						$dataSave[':idCuerpoAcademico'] = $value1->value;
					}else if ($value1->nombre == 'txtNumsni') {
						$dataSave[':sniInv'] = $value1->value;
					}else if ($value1->nombre == 'txtNumprodep') {
						$dataSave[':promepInv'] = $value1->value;
					}else if ($value1->nombre == 'txtVigNombramiento') {
						$dataSave[':vigencia'] = $value1->value;
					}else if ($value1->nombre == 'rbnCuerpo') {
						$dataSave[':orientacionCuerpo'] = $value1->value;
					}
				}
			}
		}
	
		//print_r($dataSave);
		

		$sql = 'CALL spGuardarSolicitudApoyo(:idSolicitudApoyo, :titulo, :descripcion, :idTipoInvestigacion, :orientacion, :idPrograma, :idLinea, :fechaInicio, :duracion, :horasRequeridas, :responsable, :idProgramaInv, :idLineaInv, :idProgramaCuerpo, :idLineaCuerpo, :correoResponsable, :subOrientacion, :idInvestigador, :idCuerpoAcademico, :sniInv, :promepInv, :idInstitucion, :SNI, :numeroRegistroSNI, :vigencia, :orientacionCuerpo)';

		$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute($dataSave);

		$this->result['guardado'] = 'Solicitud de apoyo';
		$this->result = $sth->fetchAll(PDO::FETCH_ASSOC);

		//print_r($this->result);

		$id = $this->result[0]['id'];

		$dataSave1 = array(':id' => $id,
							':titulo' => $dataSave[':titulo'],
							':idAdmin' => $idInvestigador);

		$sql = 'CALL spInicializarProtocoloInvestigacion(:id, :titulo, :idAdmin)';

		$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute($dataSave1);


		$sql = 'DELETE FROM colaboradores WHERE idSolicitudApoyo = :idSolicitudApoyo';

		$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':idSolicitudApoyo' => $id));

		$dataSave = array(':idSolicitudApoyo' => $id,
									':nombre' => null,
									':tiempoCompleto' => null,
									':correo' => null,
									':perfilPromep' => null,
									':nivelSNI' => null);

		$tablesInfoProfesores = $data["colaboradores"]->campos;

		for ($i=0; $i < count($tablesInfoProfesores) ; $i++) { 

			if( $tablesInfoProfesores[$i]->nombre == 'tablesInfoProfesores' ){

				$tablesInfoProfesores[$i]->value = json_decode($tablesInfoProfesores[$i]->value);
				
				for ($j=0; $j < count($tablesInfoProfesores[$i]->value) ; $j++) { 
					foreach ($tablesInfoProfesores[$i]->value[$j] as $key => $value) {
						if(explode('-', $key)[0] == 'txtNombreProfCol'){
							$dataSave[':nombre'] = $value;
						}else if (explode('-', $key)[0] == 'rbnProfesorTC') {
							$dataSave[':tiempoCompleto'] = $value;
						}else if (explode('-', $key)[0] == 'txtCorreoProfCol') {
							$dataSave[':correo'] = $value;
						}else if (explode('-', $key)[0] == 'rbnPerfilPromep') {
							$dataSave[':perfilPromep'] = $value;
						}else if (explode('-', $key)[0] == 'txtNivelSNI') {
							$dataSave[':nivelSNI'] = $value;
						}
					}
				//print_r($dataSave);
				$sql = 'CALL spGuardarColaboradores(:idSolicitudApoyo, :nombre, :tiempoCompleto, :correo, :perfilPromep, :nivelSNI)';

				$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute($dataSave);

				$this->result = $sth->fetchAll(PDO::FETCH_ASSOC);

				$this->result['guardado'] = 'colaborador';

				//print_r($this->result);
				}
			}	
		}

		$dataSave = array(':objetivoGeneral' => null,
						':idSolicitudApoyo' => $id);

		$dataSave1 = array(':objetivoEspecifico' => null,
							':idSolicitudApoyo' => $id);

		foreach ($data as $key => $value) {
			if( $key == 'colaboradores'){
				foreach ($data[$key]->campos as $key1 => $value1) {
					if( $value1->nombre == 'textAreaObjetivos' ){
						$dataSave[':objetivoGeneral'] = $value1->value;
					}
					else if ($value1->nombre == 'textAreaObjetivosEspecificos') {
						$dataSave1[':objetivoEspecifico'] = $value1->value;
					}
				}
			}
		}

		//print_r($dataSave);
		//print_r($dataSave1);

		$sql = 'CALL spGuardarObjetivoGeneral(:objetivoGeneral, :idSolicitudApoyo)';

		$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute($dataSave);

		$this->result = $sth->fetchAll(PDO::FETCH_ASSOC);

		$this->result['guardado'] = 'Objetivo general';

		//print_r($this->result);

		$sql = 'CALL spGuardarObjetivoEspecifico(:objetivoEspecifico, :idSolicitudApoyo)';

		$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute($dataSave1);

		$this->result = $sth->fetchAll(PDO::FETCH_ASSOC);

		$this->result['guardado'] = 'Objetivos especificos';

		//print_r($this->result);

		$dataSave = array(':idSolicitudApoyo' => $id,
						':licenciatura' => null,
						':maestria' => null,
						':doctorado' => null,
						':artRevistaIndizada' => null,
						':artRevistaArbitrada' => null,
						':artDivulgacion' => null,
						':memoriaCongreso' => null,
						':capLibroRevision' => null,
						':libroRevision' => null,
						':libroPublicado' => null,
						':libroPublicado' => null,
						':prototipoRegistro' => null,
						':patenteRegistro' => null,
						':paqueteregistro' => null,
						':otros' => null,
						':articulosMemoria' => null);

		foreach ($data as $key => $value) {
			if( $key == 'colaboradores'){
				foreach ($data[$key]->campos as $key1 => $value1) {
					if( $value1->nombre == 'txtLicProdEntreg' ){
						$dataSave[':licenciatura'] = $value1->value;
					}else if ($value1->nombre == 'txtMaestProdEntreg') {
						$dataSave[':maestria'] = $value1->value;
					}else if ($value1->nombre == 'txtDocProdEntreg') {
						$dataSave[':doctorado'] = $value1->value;
					}else if ($value1->nombre == 'articulosIndizadas') {
						$dataSave[':artRevistaIndizada'] = $value1->value;
					}else if ($value1->nombre == 'articulosArbitradas') {
						$dataSave[':artRevistaArbitrada'] = $value1->value;
					}else if ($value1->nombre == 'articulosDivulgacionEnviados') {
						$dataSave[':artDivulgacion'] = $value1->value;
					}else if ($value1->nombre == 'memoriasCongreso') {
						$dataSave[':memoriaCongreso'] = $value1->value;
					}else if ($value1->nombre == 'capitulosEnviados') {
						$dataSave[':capLibroRevision'] = $value1->value;
					}else if ($value1->nombre == 'librosEnviados') {
						$dataSave[':libroRevision'] = $value1->value;
					}else if ($value1->nombre == 'librosEditadosPublicados') {
						$dataSave[':libroPublicado'] = $value1->value;
					}else if ($value1->nombre == 'prototipoEnviados') {
						$dataSave[':prototipoRegistro'] = $value1->value;
					}else if ($value1->nombre == 'patentesEnviados') {
						$dataSave[':patenteRegistro'] = $value1->value;
					}else if ($value1->nombre == 'paquetesEnviados') {
						$dataSave[':paqueteregistro'] = $value1->value;
					}else if ($value1->nombre == 'otrosEspecificar') {
						$dataSave[':otros'] = $value1->value;
					}else if ($value1->nombre == 'articulosMemoriasEnviados') {
						$dataSave[':articulosMemoria'] = $value1->value;
					}
				}
			}
		}

		//print_r($dataSave);

		$sql = 'CALL spGuardarEntregables(:idSolicitudApoyo, :licenciatura, :maestria, :doctorado, :artRevistaIndizada, :artRevistaArbitrada, :artDivulgacion, :memoriaCongreso, :capLibroRevision, :libroRevision, :libroPublicado, :prototipoRegistro, :patenteRegistro, :paqueteregistro, :otros, :articulosMemoria)';

		$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute($dataSave);

		$this->result = $sth->fetchAll(PDO::FETCH_ASSOC);

		$this->result['guardado'] = 'Entregables';

		//print_r($this->result);


		$sql = 'SELECT idEntregables AS id FROM entregables WHERE idSolicitudApoyo = :idSolicitudApoyo';
		$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':idSolicitudApoyo' => $id));
		$idEnt = $sth->fetchAll(PDO::FETCH_ASSOC);

		//print_r($idEnt[0]['id']);

		$sql = 'SELECT idContribucion AS id FROM contribucion WHERE idEntregables = :idEntregables';
		$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':idEntregables' => $idEnt[0]['id']));
		$idCol = $sth->fetchAll(PDO::FETCH_ASSOC);

		//print_r($idCol);

		$sql = 'DELETE FROM alumnosincorporados WHERE idContribucion = :idContribucion';

		$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':idContribucion' => $idCol[0]['id']));

		$sql = 'DELETE FROM alumnosresidentes WHERE idContribucion = :idContribucion';

		$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':idContribucion' => $idCol[0]['id']));

		$dataSave = array(':idSolicitudApoyo' => $id,
									':nombre' => null);

		$dataSave1 = array(':idSolicitudApoyo' => $id,
									':nombre' => null);

		$tablesInfoAlumnos = $data["colaboradores"]->campos;

		for ($i=0; $i < count($tablesInfoAlumnos) ; $i++) { 

			if( $tablesInfoAlumnos[$i]->nombre == 'incorporarAlumnos' ){

				$tablesInfoAlumnos[$i]->value = json_decode($tablesInfoAlumnos[$i]->value);
				
				for ($j=0; $j < count($tablesInfoAlumnos[$i]->value) ; $j++) { 
					foreach ($tablesInfoAlumnos[$i]->value[$j] as $key => $value) {
						if(explode('-', $key)[0] == 'txtAlumProyectoProdEntreg'){
							$dataSave[':nombre'] = $value;
						}
					}
				//print_r($dataSave);
				$sql = 'CALL spGuardarAlumnosIncorporados(:idSolicitudApoyo, :nombre)';

				$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute($dataSave);

				$this->result = $sth->fetchAll(PDO::FETCH_ASSOC);

				$this->result['guardado'] = 'Alumnos incorporados';

				//print_r($this->result);
				}
			}else if( $tablesInfoAlumnos[$i]->nombre == 'alumnosResidentes' ){

				$tablesInfoAlumnos[$i]->value = json_decode($tablesInfoAlumnos[$i]->value);
				
				for ($j=0; $j < count($tablesInfoAlumnos[$i]->value) ; $j++) { 
					foreach ($tablesInfoAlumnos[$i]->value[$j] as $key => $value) {
						if(explode('-', $key)[0] == 'txtAlumProyectoProdEntreg'){
							$dataSave1[':nombre'] = $value;
						}
					}
				//print_r($dataSave1);
				$sql = 'CALL spGuardarAlumnosResidentes(:idSolicitudApoyo, :nombre)';

				$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute($dataSave1);

				$this->result = $sth->fetchAll(PDO::FETCH_ASSOC);

				$this->result['guardado'] = 'Alumnos residentes';

				//print_r($this->result);
				}
			}	
		}

		$dataSave = array(':requiereFinanciamineto' => null,
						':fuente' => null,
						':idSolicitudApoyo' => $id);

		foreach ($data as $key => $value) {
			if( $key == 'colaboradores'){
				foreach ($data[$key]->campos as $key1 => $value1) {
					if( $value1->nombre == 'rbnFinanciamiento' ){
						$dataSave[':requiereFinanciamineto'] = $value1->value;
					}else if ($value1->nombre == 'financiamiento') {
						$dataSave[':fuente'] = $value1->value;
					}
				}
			}
		}

		//print_r($dataSave);

		$sql = 'CALL spGuardarFinanciamiento(:requiereFinanciamineto, :fuente, :idSolicitudApoyo)';

		$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute($dataSave);

		$this->result = $sth->fetchAll(PDO::FETCH_ASSOC);

		$this->result['guardado'] = 'financiamiento';

		//print_r($this->result);

		$sql = 'DELETE FROM actividades WHERE idSolicitudApoyo = :idSolicitudApoyo';

		$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':idSolicitudApoyo' => $id));

		$dataSave = array(':nombreResponsable' => null,
						':periodo' => null,
						':resultados' => null,
						':partidasSolicitadas' => null,
						':montoSolicitado' => null,
						':descripcionBienes' => null,
						':idSolicitudApoyo' => $id,
						':actividad' => null);

		$tablesInfoProgramaActividades = $data["programaActividades"]->campos;

		for ($i=0; $i < count($tablesInfoProgramaActividades) ; $i++) { 

			if( $tablesInfoProgramaActividades[$i]->nombre == 'tblProgramAct' ){

				$tablesInfoProgramaActividades[$i]->value = json_decode($tablesInfoProgramaActividades[$i]->value);
				
				for ($j=0; $j < count($tablesInfoProgramaActividades[$i]->value) ; $j++) { 
					foreach ($tablesInfoProgramaActividades[$i]->value[$j] as $key => $value) {
						if(explode('-', $key)[0] == 'txtNomResponAct'){
							$dataSave[':nombreResponsable'] = $value;
						}else if (explode('-', $key)[0] == 'txtPeriodoActiv') {
							$dataSave[':periodo'] = $value;
						}else if (explode('-', $key)[0] == 'txtResultEntregables') {
							$dataSave[':resultados'] = $value;
						}else if (explode('-', $key)[0] == 'txtPartidasSol') {
							$dataSave[':partidasSolicitadas'] = $value;
						}else if (explode('-', $key)[0] == 'txtMontoSolicitadoActiv') {
							$dataSave[':montoSolicitado'] = $value;
						}else if (explode('-', $key)[0] == 'txtDesBienes') {
							$dataSave[':descripcionBienes'] = $value;
						}else if (explode('-', $key)[0] == 'txtActividad') {
							$dataSave[':actividad'] = $value;
						}
					}
				//print_r($dataSave);
				$sql = 'CALL spGuardarActividades(:nombreResponsable, :periodo, :resultados, :partidasSolicitadas, :montoSolicitado, :descripcionBienes, :idSolicitudApoyo, :actividad)';

				$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute($dataSave);

				$this->result = $sth->fetchAll(PDO::FETCH_ASSOC);

				$this->result['guardado'] = 'actividades';

				//print_r($this->result);
				}
			}	
		}

		//$sql = 'DELETE FROM actividades WHERE idSolicitudApoyo = :idSolicitudApoyo';

		//$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		//$sth->execute(array(':idSolicitudApoyo' => $id));

		$dataSave = array(':idSolicitudApoyo' => $id,
						':montoSolicitadoMateriales' => null,
						':montoOtorgadoTecMateriales' => null,
						':montoOtorgadoInstitucionesMateriales' => null,
						':totalMateriales' => null,
						':montoSolicitadoServicios' => null,
						':montoOtorgadoTecServicios' => null,
						':montoOtorgadoInstitucionesServicios' => null,
						':totalServicios' => null,
						':totalMontoSolicitado' => null,
						':totalMontoOtorgadoTec' => null,
						':totalMontoOtorgadoInstituciones' => null,
						':total' => null);

		$tablesInfoPresupuesto = $data["programaActividades"]->campos;

		for ($i=0; $i < count($tablesInfoPresupuesto) ; $i++) { 

			if( $tablesInfoPresupuesto[$i]->nombre == 'tblPresupSolicitado' ){

				$tablesInfoPresupuesto[$i]->value = json_decode($tablesInfoPresupuesto[$i]->value);
				
				for ($j=0; $j < count($tablesInfoPresupuesto[$i]->value) ; $j++) { 
					foreach ($tablesInfoPresupuesto[$i]->value[$j] as $key => $value) {
						if(explode('-', $key)[0] == 'txtMaterialesMontoDgest'){
							$dataSave[':montoSolicitadoMateriales'] = $value;
						}else if (explode('-', $key)[0] == 'txtMaterialesMontOtorgarTec') {
							$dataSave[':montoOtorgadoTecMateriales'] = $value;
						}else if (explode('-', $key)[0] == 'txtMaterialesMontOtrasInst') {
							$dataSave[':montoOtorgadoInstitucionesMateriales'] = $value;
						}else if (explode('-', $key)[0] == 'txtMaterialesTotal') {
							$dataSave[':totalMateriales'] = $value;
						}else if (explode('-', $key)[0] == 'txtServiciosMontoDgest') {
							$dataSave[':montoSolicitadoServicios'] = $value;
						}else if (explode('-', $key)[0] == 'txtServiciosMontOtorgarTec') {
							$dataSave[':montoOtorgadoTecServicios'] = $value;
						}else if (explode('-', $key)[0] == 'txtServiciosMontOtrasInst') {
							$dataSave[':montoOtorgadoInstitucionesServicios'] = $value;
						}else if (explode('-', $key)[0] == 'txtServiciosTotal') {
							$dataSave[':totalServicios'] = $value;
						}else if (explode('-', $key)[0] == 'txtTotalMontoDgest') {
							$dataSave[':totalMontoSolicitado'] = $value;
						}else if (explode('-', $key)[0] == 'txtTotalMontOtorgarTec') {
							$dataSave[':totalMontoOtorgadoTec'] = $value;
						}else if (explode('-', $key)[0] == 'txtTotalMontOtrasInst') {
							$dataSave[':totalMontoOtorgadoInstituciones'] = $value;
						}else if (explode('-', $key)[0] == 'txtTotalDeTotales') {
							$dataSave[':total'] = $value;
						}
					}
				}
			}	
		}

		//print_r($dataSave);
		$sql = 'CALL spGuardarPresupuesto(:idSolicitudApoyo, :montoSolicitadoMateriales, :montoOtorgadoTecMateriales, :montoOtorgadoInstitucionesMateriales, :totalMateriales, :montoSolicitadoServicios, :montoOtorgadoTecServicios, :montoOtorgadoInstitucionesServicios, :totalServicios, :totalMontoSolicitado, :totalMontoOtorgadoTec, :totalMontoOtorgadoInstituciones, :total)';

		$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute($dataSave);

		$this->result = $sth->fetchAll(PDO::FETCH_ASSOC);

		$this->result['guardado'] = 'presupuesto';

		//print_r($this->result);

		$sql = 'DELETE FROM actividadesdocencia WHERE idPlanDeTrabajo = :idPlanTrabajo';

		$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':idPlanTrabajo' => $id));

		$dataSave = array(':nombreAsignatura' => null,
							':numEstudiantes' => null,
							':nivelLicenciatura' => null,
							':nivelMaestria' => null,
							':horasTeorica' => null,
							':horasTeoricaPractica' => null,
							':horasPractica' => null,
							':totalHorasSemana' => null,
							':idPlanTrabajo' => $id);

		$tablesInfoActividadesDocencia = $data["planTrabajo"]->campos;

		for ($i=0; $i < count($tablesInfoActividadesDocencia) ; $i++) { 

			if( $tablesInfoActividadesDocencia[$i]->nombre == 'tblActDocencia' ){

				$tablesInfoActividadesDocencia[$i]->value = json_decode($tablesInfoActividadesDocencia[$i]->value);
				
				for ($j=0; $j < count($tablesInfoActividadesDocencia[$i]->value) ; $j++) { 
					foreach ($tablesInfoActividadesDocencia[$i]->value[$j] as $key => $value) {
						if(explode('-', $key)[0] == 'txtPTNomAsig'){
							$dataSave[':nombreAsignatura'] = $value;
						}else if (explode('-', $key)[0] == 'numberPTNoEstudi') {
							$dataSave[':numEstudiantes'] = $value;
						}else if (explode('-', $key)[0] == 'nivelDocente') {
							if($value == 0){
								$dataSave[':nivelLicenciatura'] = 1;
								$dataSave[':nivelMaestria'] = 0;
							}else{
								$dataSave[':nivelLicenciatura'] = 0;
								$dataSave[':nivelMaestria'] = 1;
							}
						}else if (explode('-', $key)[0] == 'numberPTTeorica') {
							$dataSave[':horasTeorica'] = $value;
						}else if (explode('-', $key)[0] == 'numberPTTeoPrac') {
							$dataSave[':horasTeoricaPractica'] = $value;
						}else if (explode('-', $key)[0] == 'numberPTPractica') {
							$dataSave[':horasPractica'] = $value;
						}else if (explode('-', $key)[0] == 'txtPTTotal') {
							$dataSave[':totalHorasSemana'] = $value;
						}
					}
				//print_r($dataSave);
				$sql = 'CALL spGuardarActividadesDocencia(:nombreAsignatura, :numEstudiantes, :nivelLicenciatura, :nivelMaestria, :horasTeorica, :horasTeoricaPractica, :horasPractica, :totalHorasSemana, :idPlanTrabajo)';

				$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute($dataSave);

				$this->result = $sth->fetchAll(PDO::FETCH_ASSOC);

				$this->result['guardado'] = 'acividad docencia';

				//print_r($this->result);
				}
			}	
		}

		$sql = 'DELETE FROM actividadestutoria WHERE idPlanDeTrabajo = :idPlanTrabajo';

		$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':idPlanTrabajo' => $id));

		$dataSave = array(':nombreEstudiante' => null,
							':tipoTutoria' => null,
							':nivelLicenciatura' => null,
							':nivelMaestria' => null,
							':horasTeorica' => null,
							':horasTeoricaPractica' => null,
							':horasPractica' => null,
							':totalHorasSemana' => null,
							':idPlanTrabajo' => $id);

		$tablesInfoActividadesTutoria = $data["planTrabajo"]->campos;

		for ($i=0; $i < count($tablesInfoActividadesTutoria) ; $i++) { 

			if( $tablesInfoActividadesTutoria[$i]->nombre == 'tblActTutoria' ){

				$tablesInfoActividadesTutoria[$i]->value = json_decode($tablesInfoActividadesTutoria[$i]->value);
				
				for ($j=0; $j < count($tablesInfoActividadesTutoria[$i]->value) ; $j++) { 
					foreach ($tablesInfoActividadesTutoria[$i]->value[$j] as $key => $value) {
						if(explode('-', $key)[0] == 'txtPTNomAsig'){
							$dataSave[':nombreEstudiante'] = $value;
						}else if (explode('-', $key)[0] == 'numberPTNoEstudi') {
							$dataSave[':tipoTutoria'] = $value;
						}else if (explode('-', $key)[0] == 'nivelTutorias') {
							if($value == 0){
								$dataSave[':nivelLicenciatura'] = 1;
								$dataSave[':nivelMaestria'] = 0;
							}else{
								$dataSave[':nivelLicenciatura'] = 0;
								$dataSave[':nivelMaestria'] = 1;
							}
						}else if (explode('-', $key)[0] == 'numberPTTeorica') {
							$dataSave[':horasTeorica'] = $value;
						}else if (explode('-', $key)[0] == 'numberPTTeoPrac') {
							$dataSave[':horasTeoricaPractica'] = $value;
						}else if (explode('-', $key)[0] == 'numberPTPractica') {
							$dataSave[':horasPractica'] = $value;
						}else if (explode('-', $key)[0] == 'txtPTTotal') {
							$dataSave[':totalHorasSemana'] = $value;
						}
					}
				//print_r($dataSave);
				$sql = 'CALL spGuardarActividadesTutoria(:nombreEstudiante, :tipoTutoria, :nivelLicenciatura, :nivelMaestria, :horasTeorica, :horasTeoricaPractica, :horasPractica, :totalHorasSemana, :idPlanTrabajo)';

				$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute($dataSave);

				$this->result = $sth->fetchAll(PDO::FETCH_ASSOC);

				$this->result['guardado'] = 'acividad tutoria';

				//print_r($this->result);
				}
			}	
		}

		$sql = 'DELETE FROM actividadesdirecciontesis WHERE idPlanDeTrabajo = :idPlanTrabajo';

		$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':idPlanTrabajo' => $id));

		$dataSave = array(':nombreEstudiante' => null,
							':nombreTesis' => null,
							':nivelLicenciatura' => null,
							':nivelMaestria' => null,
							':fechaTermino' => null,
							':totalHorasSemana' => null,
							':idPlanTrabajo' => $id);

		$tablesInfoActividadesDireccionTesis = $data["planTrabajo"]->campos;

		for ($i=0; $i < count($tablesInfoActividadesDireccionTesis) ; $i++) { 

			if( $tablesInfoActividadesDireccionTesis[$i]->nombre == 'tblActDireTesis' ){

				$tablesInfoActividadesDireccionTesis[$i]->value = json_decode($tablesInfoActividadesDireccionTesis[$i]->value);
				
				for ($j=0; $j < count($tablesInfoActividadesDireccionTesis[$i]->value) ; $j++) { 
					foreach ($tablesInfoActividadesDireccionTesis[$i]->value[$j] as $key => $value) {
						if(explode('-', $key)[0] == 'txtPTNomAsig'){
							$dataSave[':nombreEstudiante'] = $value;
						}else if (explode('-', $key)[0] == 'numberPTNoEstudi') {
							$dataSave[':nombreTesis'] = $value;
						}else if (explode('-', $key)[0] == 'nivelTesis') {
							if($value == 0){
								$dataSave[':nivelLicenciatura'] = 1;
								$dataSave[':nivelMaestria'] = 0;
							}else{
								$dataSave[':nivelLicenciatura'] = 0;
								$dataSave[':nivelMaestria'] = 1;
							}
						}else if (explode('-', $key)[0] == 'datePTFechaTerm') {
							$dataSave[':fechaTermino'] = $value;
						}else if (explode('-', $key)[0] == 'textPTTotalHrs') {
							$dataSave[':totalHorasSemana'] = $value;
						}
					}
				//print_r($dataSave);
				$sql = 'CALL spGuardarActividadesDireccionTesis(:nombreEstudiante, :nombreTesis, :nivelLicenciatura, :nivelMaestria, :fechaTermino, :totalHorasSemana, :idPlanTrabajo)';

				$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute($dataSave);

				$this->result = $sth->fetchAll(PDO::FETCH_ASSOC);

				$this->result['guardado'] = 'acividad direccion de tesis';

				//print_r($this->result);
				}
			}	
		}

		$sql = 'DELETE FROM actividadesinvestigacion WHERE idPlanDeTrabajo = :idPlanTrabajo';

		$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':idPlanTrabajo' => $id));

		$dataSave = array(':nombreProyecto' => null,
							':funcionEnProyecto' => null,
							':productosEsperados' => null,
							':totalHorasSemana' => null,
							':idPlanTrabajo' => $id);

		$tablesInfoActividadesInvestigacion = $data["planTrabajo"]->campos;

		for ($i=0; $i < count($tablesInfoActividadesInvestigacion) ; $i++) { 

			if( $tablesInfoActividadesInvestigacion[$i]->nombre == 'tblActInvest' ){

				$tablesInfoActividadesInvestigacion[$i]->value = json_decode($tablesInfoActividadesInvestigacion[$i]->value);
				
				for ($j=0; $j < count($tablesInfoActividadesInvestigacion[$i]->value) ; $j++) { 
					foreach ($tablesInfoActividadesInvestigacion[$i]->value[$j] as $key => $value) {
						if(explode('-', $key)[0] == 'textPTNomProject'){
							$dataSave[':nombreProyecto'] = $value;
						}else if (explode('-', $key)[0] == 'textPTFuncProject') {
							$dataSave[':funcionEnProyecto'] = $value;
						}else if (explode('-', $key)[0] == 'textPTPoductProject') {
							$dataSave[':productosEsperados'] = $value;
						}else if (explode('-', $key)[0] == 'textPTTotalHrs') {
							$dataSave[':totalHorasSemana'] = $value;
						}
					}
				//print_r($dataSave);
				$sql = 'CALL spGuardarActividadesInvestigacion(:nombreProyecto, :funcionEnProyecto, :productosEsperados, :totalHorasSemana, :idPlanTrabajo)';

				$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute($dataSave);

				$this->result = $sth->fetchAll(PDO::FETCH_ASSOC);

				$this->result['guardado'] = 'actividad investigacion';

				//print_r($this->result);
				}
			}	
		}

		$sql = 'DELETE FROM actividadesgestionacademica WHERE idPlanDeTrabajo = :idPlanTrabajo';

		$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':idPlanTrabajo' => $id));

		$dataSave = array(':funcion' => null,
							':descripcion' => null,
							':productoEsperado' => null,
							':totalHorasSemana' => null,
							':idPlanTrabajo' => $id);

		$tablesInfoActividadesGestionAcademica = $data["planTrabajo"]->campos;

		for ($i=0; $i < count($tablesInfoActividadesGestionAcademica) ; $i++) { 

			if( $tablesInfoActividadesGestionAcademica[$i]->nombre == 'tblActGestAcadem' ){

				$tablesInfoActividadesGestionAcademica[$i]->value = json_decode($tablesInfoActividadesGestionAcademica[$i]->value);
				
				for ($j=0; $j < count($tablesInfoActividadesGestionAcademica[$i]->value) ; $j++) { 
					foreach ($tablesInfoActividadesGestionAcademica[$i]->value[$j] as $key => $value) {
						if(explode('-', $key)[0] == 'textPTNomProject'){
							$dataSave[':funcion'] = $value;
						}else if (explode('-', $key)[0] == 'textPTFuncProject') {
							$dataSave[':descripcion'] = $value;
						}else if (explode('-', $key)[0] == 'textPTPoductProject') {
							$dataSave[':productoEsperado'] = $value;
						}else if (explode('-', $key)[0] == 'textPTTotalHrs') {
							$dataSave[':totalHorasSemana'] = $value;
						}
					}
				//print_r($dataSave);
				$sql = 'CALL spGuardarActividadesGestionAcademica(:funcion, :descripcion, :productoEsperado, :totalHorasSemana, :idPlanTrabajo)';

				$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute($dataSave);

				$this->result = $sth->fetchAll(PDO::FETCH_ASSOC);

				$this->result['guardado'] = 'actividad gestion academica';

				//print_r($this->result);
				}
			}	
		}

		echo 1;
	}
}

?>