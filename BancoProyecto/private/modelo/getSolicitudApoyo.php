<?php  

/**
* 
*/
class GetSolicitudApoyo
{
	
	public $conn = null;
	public $res = null;
	function __construct()
	{
		require "conexion.php";
		$this->conn = new Conexion();
	}

	public function ejecucion($sql, $id)
	{
		$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':idSolicitudApoyo' => $id));
		$this->res = $sth->fetchAll(PDO::FETCH_ASSOC);

	}

	public function getSolicitudApoyo($id)
	{
		$result = array();
		$result['InformacionGeneral'] = array();

		$sql = 'SELECT idInstitucion, tituloProyecto AS titulo, responsable, correoResponsable AS correo, SNI, numeroRegistroSNI AS noSNI, idTipoInvestigacion AS tipoInvestigacion FROM solicitudapoyo WHERE idSolicitudApoyo = :idSolicitudApoyo';

		$this->ejecucion($sql, $id);

		foreach ( $this->res as $row) {
			array_push ($result['InformacionGeneral'], $row);
		}

		$result['ModalidadProyecto'] = array();

		$sql = 'SELECT orientacion, subOrientacion, idPrograma AS ProgramaPorLinea, idLinea AS LineaPorLinea, sniInv AS SNIPorInv, idProgramaInv AS programaPorInv, idLineaInv AS lineaPorInv, promepInv AS promepPorInv, idCuerpoAcademico AS cuerpoAcademico, idProgramaCuerpo AS programaPorCuerpo, idLineaCuerpo AS lineaPorCuerpo, fechaInicio AS fecha, duracion, horasRequeridas, vigencia, orientacionCuerpo FROM solicitudapoyo WHERE idSolicitudApoyo = :idSolicitudApoyo';

		$this->ejecucion($sql, $id);

		foreach ($this->res as $row) {
			array_push($result['ModalidadProyecto'], $row);
		}

		$result['ProfesoresColaboradores'] = array();

		$sql = 'SELECT descripcion AS objetivoGeneral FROM objetivogeneral WHERE idSolicituApoyo = :idSolicitudApoyo';

		$this->ejecucion($sql, $id);

		foreach ($this->res as $row) {
			array_push($result['ProfesoresColaboradores'], $row);
		}

		$sql = 'SELECT descripcion AS objetivosEspecificos FROM objetivosespecificos WHERE idSolicitudApoyo = :idSolicitudApoyo';

		$this->ejecucion($sql, $id);

		foreach ($this->res as $row) {
			array_push($result['ProfesoresColaboradores'], $row);
		}

		$sql = 'SELECT requiereFinanciamiento, fuenteFinanciamiento FROM financiamiento WHERE idSolicitudApoyo = :idSolicitudApoyo';

		$this->ejecucion($sql, $id);

		foreach ($this->res as $row) {
			array_push($result['ProfesoresColaboradores'], $row);
		}

		$result['ProfesoresColaboradores']['colaboradores'] = array();

		$sql = 'SELECT nombre,
					tiempoCompleto,
					correo,
					perfilPromep,
					nivelSNI
				FROM colaboradores WHERE idSolicitudApoyo = :idSolicitudApoyo';

		$this->ejecucion($sql, $id);

		foreach ($this->res as $row) {
			array_push($result['ProfesoresColaboradores']['colaboradores'], $row);
		}

		$result['ProfesoresColaboradores']['entregables']['prodacademica'] = array();

		$sql = 'SELECT idEntregables AS id FROM entregables WHERE idSolicitudApoyo = :idSolicitudApoyo';

		$this->ejecucion($sql, $id);

		$idEntregables = $this->res[0]['id'];

		$sql = 'SELECT artRevistaIndizadas, artRevistArbitrada, artDivulgacion, beneficios AS artMemoria, memoriaCongreso, capLibroRevision, libroRevision, libroPublicado, prototipoRegistro, patenteRegistro, pqtRegistro, otros FROM prodacademica WHERE idEntregables = :idSolicitudApoyo';

		$this->ejecucion($sql, $idEntregables);

		foreach ($this->res as $row) {
			array_push($result['ProfesoresColaboradores']['entregables']['prodacademica'], $row);
		}

		$result['ProfesoresColaboradores']['entregables']['contribucion'] = array();

		$sql = 'SELECT idContribucion AS id, licenciatura, maestria, doctorado FROM contribucion WHERE idEntregables = :idSolicitudApoyo';

		$this->ejecucion($sql, $idEntregables);

		foreach ($this->res as $row) {
			array_push($result['ProfesoresColaboradores']['entregables']['contribucion'], $row);
		}

		$result['ProfesoresColaboradores']['entregables']['contribucion']['incorporarAlumnos'] = array();

		$idContribucion = $this->res[0]['id'];

		$sql = 'SELECT nombre AS alumno FROM alumnosincorporados WHERE idContribucion = :idSolicitudApoyo';

		$this->ejecucion($sql, $idContribucion);

		foreach ($this->res as $row) {
			array_push($result['ProfesoresColaboradores']['entregables']['contribucion']['incorporarAlumnos'], $row);
		}

		$result['ProfesoresColaboradores']['entregables']['contribucion']['alumnosresidentes'] = array();

		$sql = 'SELECT nombre AS alumno FROM alumnosresidentes WHERE idContribucion = :idSolicitudApoyo';

		$this->ejecucion($sql, $idContribucion);

		foreach ($this->res as $row) {
			array_push($result['ProfesoresColaboradores']['entregables']['contribucion']['alumnosresidentes'], $row);
		}

		$result['ProgramaDeActividades'] = array();

		$sql = 'SELECT montoSolicitadoMateriales, montoOtorgadoTecMateriales, montoOtorgadoInstitucionesMateriales, totalMateriales, montoSolicitadoServicios, montoOtorgadoTecServicios, montoOtorgadoInstitucionesServicios, totalServicios, totalMontoSolicitado, totalMontoOtorgadoTec, totalMontoOtorgadoInstituciones, total FROM presupuesto WHERE idSolicitudApoyo = :idSolicitudApoyo';

		$this->ejecucion($sql, $id);

		foreach ($this->res as $row) {
			array_push($result['ProgramaDeActividades'], $row);
		}

		$result['ProgramaDeActividades']['actividades'] = array();

		$sql = 'SELECT nombreResponsable, periodo, resultados, partidaSolicitadas, montoSolicitado, descripcionBienes, actividad FROM actividades WHERE idSolicitudApoyo = :idSolicitudApoyo';

		$this->ejecucion($sql, $id);

		foreach ($this->res as $row) {
			array_push($result['ProgramaDeActividades']['actividades'], $row);
		}

		$result['PlanDeTrabajo']['actividadesDocencia'] = array();

		$sql = 'SELECT nombreAsigantura, noEstudiantes, nivelLicenciatura, nivelMaestria, horasTeorica, horasTeoricaPractica, horasPractica, totalHorasSemana FROM actividadesdocencia WHERE idPlanDeTrabajo = :idSolicitudApoyo';

		$this->ejecucion($sql, $id);

		foreach ($this->res as $row) {
			array_push($result['PlanDeTrabajo']['actividadesDocencia'], $row);
		}

		$result['PlanDeTrabajo']['actividadesTutoria'] = array();

		$sql = 'SELECT nombreEstudiante, tipoTutoria, nivelLicenciatura, nivelMaestria, horasTeorica, horasTeoricaPractica, horasPractica, totalHorasSemana FROM actividadestutoria WHERE idPlanDeTrabajo = :idSolicitudApoyo';

		$this->ejecucion($sql, $id);

		foreach ($this->res as $row) {
			array_push($result['PlanDeTrabajo']['actividadesTutoria'], $row);
		}

		$result['PlanDeTrabajo']['actividadesDireccionTesis'] = array();

		$sql = 'SELECT nombreEstudiante, nombreTesis, nivelLicenciatura, nivelMaestria, fechaTermino, totalHorasSemana FROM actividadesdirecciontesis WHERE idPlanDeTrabajo = :idSolicitudApoyo';

		$this->ejecucion($sql, $id);

		foreach ($this->res as $row) {
			array_push($result['PlanDeTrabajo']['actividadesDireccionTesis'], $row);
		}

		$result['PlanDeTrabajo']['actividadesInvestigacion'] = array();

		$sql = 'SELECT nombreProyecto, funcionEnProyecto, productosEsperados, totalHorasSemana FROM actividadesinvestigacion WHERE idPlanDeTrabajo = :idSolicitudApoyo';

		$this->ejecucion($sql, $id);

		foreach ($this->res as $row) {
			array_push($result['PlanDeTrabajo']['actividadesInvestigacion'], $row);
		}

		$result['PlanDeTrabajo']['actividadesGestionAcademica'] = array();

		$sql = 'SELECT funcion, descripcion, productoEsperado, totalHorasSemana FROM actividadesgestionacademica WHERE idPlanDeTrabajo = :idSolicitudApoyo';

		$this->ejecucion($sql, $id);

		foreach ($this->res as $row) {
			array_push($result['PlanDeTrabajo']['actividadesGestionAcademica'], $row);
		}

		return $result;
	}
}

?>