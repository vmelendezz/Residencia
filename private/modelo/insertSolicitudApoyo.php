<?php 

/**
* 
*/
class SolicitudApoyo
{
	
	function __construct()
	{
		# code...
	}

	public function insertInfoGeneral($titulo, $descripcion,
		$fecha, $idTipoInvestigacion, $idOrientacion, $idPrograma,
		$idLinea, $fechaInicio, $duracion, $fechaFinal, $idResponsable,
		$idProgramaInv, $idLineaInv, $idProgramaCuerpo, $idLineaCuerpo)
	{
		require "conexion.php";
		$conn = new conexion();

		$sql = 'CALL spInsertarSolicitudApoyo(:titulo, :descripcion,
		:fecha, :idTipoInvestigacion, :idOrientacion, :idPrograma,
		:idLinea, :fechaInicio, :duracion, :fechaFinal, :idResponsable,
		:idProgramaInv, :idLineaInv, :idProgramaCuerpo, :idLineaCuerpo)';

		$sth = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':titulo' => $titulo,
							':descripcion' => $descripcion,
							':fecha' => $fecha, 
							':idTipoInvestigacion' => $idTipoInvestigacion, 
							':idOrientacion' => $idOrientacion, 
							':idPrograma' => $idPrograma,
							':idLinea' => $idLinea, 
							':fechaInicio' => $fechaInicio, 
							':duracion' => $duracion, 
							':fechaFinal' => $fechaFinal, 
							':idResponsable' => $idResponsable,
							':idProgramaInv' => $idProgramaInv,
							':idLineaInv' => $idLineaInv,
							':idProgramaCuerpo' => $idProgramaCuerpo,
							':idLineaCuerpo' => $idProgramaCuerpo));

		$result = $sth->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	public function insertObjetivoGeneral($objetivoGeneral, $idSolicitudApoyo)
	{
		require "conexion.php";
		$conn = new conexion();

		$sql = 'CALL spInsertarObjetivoGeneral(:objetivoGeneral, :idSolicitudApoyo)';

		$sth = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':objetivoGeneral' => $objetivoGeneral,
							':idSolicitudApoyo' => $idSolicitudApoyo));

		$result = $sth->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	public function insertPresupuesto($idSolicitudApoyo, $concepto, $montoSolicitado,
			$montoOtorgadoTec, $montoOtorgadoInstituciones, $total)
	{
		require "conexion.php";
		$conn = new conexion();

		$sql = 'CALL spInsertarPresupuesto(:idSolicitudApoyo, :concepto, :montoSolicitado,
					:montoOtorgadoTec, :montoOtorgadoInstituciones, :total)';

		$sth = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':idSolicitudApoyo' => $idSolicitudApoyo,
							':concepto' => $concepto,
							':montoSolicitado' => $montoSolicitado,
							':montoOtorgadoTec' => $montoOtorgadoTec,
							':montoOtorgadoInstituciones' => $montoOtorgadoInstituciones,
							':total' => $total));

		$result = $sth->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	public function insertActividades($nombreResponsable, $periodo, $resultados,
			$partidasSolicitadas, $montoSolicitado, $descripcionBienes, $idSolicitudApoyo, $actividades)
	{
		require "conexion.php";
		$conn = new conexion();

		$sql = 'CALL spInsertarActividades(:nombreResponsable, :periodo, :resultados,
					:partidasSolicitadas, :montoSolicitado, :descripcionBienes, :idSolicitudApoyo, :actividades)';

		$sth = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':nombre' => $nombre,
							':periodo' => $periodo,
							':resultados' => $resultados,
							':partidasSolicitadas' => $partidasSolicitadas,
							':montoSolicitado' => $montoSolicitado,
							':descripcionBienes' => $descripcionBienes,
							':idSolicitudApoyo' => $idSolicitudApoyo,
							':actividades' => $actividades));

		$result = $sth->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	public function insertColaboradores($idInvestigador,
			$idSolicitudApoyo, $colaboradorExterno, $idResponsable)
	{
		require "conexion.php";
		$conn = new conexion();

		$sql = 'CALL spInsertarColaboradores(:idInvestigador, :idSolicitudApoyo,
					:colaboradorExterno, :idResponsable)';

		$sth = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':idInvestigador' => $idInvestigador,
							':idSolicitudApoyo' => $idSolicitudApoyo,
							'colaboradorExterno' => $colaboradorExterno,
							':idResponsable' => $idResponsable));

		$result = $sth->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	public function insertEntregables($idSolicitudApoyo, $licenciatura, $maestria, $doctorado,
			$incorporacionAlumnos, $alumnosResidentes, $artRevistasIndizadas, $artRevistaArbitrada,
			$artDivulgacion, $memoriaCongreso, $capLibroRevision, $libroRevision, $libroPublicado,
			$prototipoRegistro, $patenteRegistro, $paqueteRegistro, $otros, $beneficios)
	{
		require "conexion.php";
		$conn = new conexion();

		$sql = 'CALL spInsertarEntregables(:idSolicitudApoyo, :licenciatura, :maestria, :doctorado,
					:incorporacionAlumnos, :alumnosResidentes, :artRevistasIndizadas, :artRevistaArbitrada,
					:artDivulgacion, :memoriaCongreso, :capLibroRevision, :libroRevision, :libroPublicado,
					:prototipoRegistro, :patenteRegistro, :paqueteRegistro, :otros, :beneficios)';

		$sth = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':idSolicitudApoyo' => $idSolicitudApoyo,
							':licenciatura' => $licenciatura,
							':maestria' => $maestria,
							':doctorado' => $doctorado,
							':incorporacionAlumnos' => $incorporacionAlumnos,
							':alumnosResidentes' => $alumnosResidentes,
							':artRevistasIndizadas' => $artRevistasIndizadas,
							':artRevistaArbitrada' => $artRevistaArbitrada,
							':artDivulgacion' => $artDivulgacion,
							':memoriaCongreso' => $memoriaCongreso,
							':capLibroRevision' => $capLibroRevision,
							':libroRevision' => $libroRevision,
							':libroPublicado' => $libroPublicado,
							':prototipoRegistro' => $prototipoRegistro,
							':patenteRegistro' => $patenteRegistro,
							':paqueteRegistro' => $paqueteRegistro,
							':otros' => $otros,
							':beneficios' => $beneficios));

		$result = $sth->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	public function insertFinanciamiento($fuente, $idSolicitudApoyo)
	{
		require "conexion.php";
		$conn = new conexion();

		$sql = 'CALL spInsertarFinanciamiento(:fuente, :idSolicitudApoyo)';

		$sth = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':fuente' => $fuente,
							':idSolicitudApoyo' => $idSolicitudApoyo));

		$result = $sth->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	public function insertobjetivoEspecifico($objEsp, $idSolicitudApoyo)
	{
		require "conexion.php";
		$conn = new conexion();

		$sql = 'CALL spInsertarObjetivoEspecifico(:objEsp, :idSolicitudApoyo)';

		$sth = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':objEsp' => $objEsp,
							':idSolicitudApoyo' => $idSolicitudApoyo));

		$result = $sth->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
}

?>