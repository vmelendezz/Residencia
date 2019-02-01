<?php 

/**
* 
*/
class ProtocoloInvestigacion
{
	
	public $conn = null;
	function __construct()
	{
		require "conexion.php";
		$this->conn = new Conexion();
	}

	public function insertDescripcionProyecto($resumen, $introduccion, $antecentes, $marcoTeorico,
				$metas, $impactoBeneficio, $metodologia, $referencias, $idProtocoloInvestigacion)
	{
		$sql = 'CALL spInsertarDescrpcionProyecto(:resumen, :introduccion, :antecentes, :marcoTeorico,
				:metas, :impactoBeneficio, :metodologia, :idProtocoloInvestigacion)';

		$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array('resumen' => $resumen,
							':introduccion' => $introduccion,
							':antecentes' => $antecentes,
							':marcoTeorico' => $marcoTeorico,
							':metas' => $metas,
							':impactoBeneficio' => $impactoBeneficio,
							':metodologia' => $metodologia,
							':idProtocoloInvestigacion' => $idProtocoloInvestigacion));


		$result = $sth->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	public function insertInfraestructura($descripcion, $idProtocoloInvestigacion)
	{
		$sql = 'CALL spInsertarInfraestructura(:descripcion, :idProtocoloInvestigacion)';

		$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':descripcion' => $descripcion,
							':idProtocoloInvestigacion' => $idProtocoloInvestigacion));

		$result = $sth->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	public function insertLugarDesarrollo($idProtocoloInvestigacion, $nombreSeccion, $direccionExacta,
				$requierePruebasCampo, $estado, $region, $zona, $municipio, $distanciaKM)
	{
		$sql = 'CALL spInsertarLugarDesarrollo(:idProtocoloInvestigacion, :nombreSeccion, :direccionExacta,
				:requierePruebasCampo, :estado, :region, :zona, :municipio, :distanciaKM)';

		$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':idProtocoloInvestigacion' => $idProtocoloInvestigacion,
							':nombreSeccion' => $nombreSeccion,
							':direccionExacta' => $direccionExacta,
							':requierePruebasCampo' => $requierePruebasCampo,
							':estado' => $estado,
							':region' => $region,
							':zona' => $zona,
							':municipio' => $municipio,
							':distanciaKM' => $distanciaKM));

		$result = $sth->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	public function InsertVinculacion($nombreEmpresa, $tipoCooperacion, $responsabilidad, $usuariosPotenciales,
				$otrasEmpresas, $idProtocoloInvestigacion)
	{
		$sql = 'CALL spInsertarVinculacion(:nombreEmpresa, :tipoCooperacion, :responsabilidad, :usuariosPotenciales,
				:otrasEmpresas, :idProtocoloInvestigacion)';

		$sth = $thiis->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':nombreEmpresa' => $nombreEmpresa,
							':tipoCooperacion' => $tipoCooperacion,
							':responsabilidad' => $responsabilidad,
							':usuariosPotenciales' => $usuariosPotenciales,
							':otrasEmpresas' => $otrasEmpresas,
							':idProtocoloInvestigacion' => $idProtocoloInvestigacion));

		$result = $sth->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	public function InsertReferencias($referencia, $estadoCampoArte, $planteamiento, 
				$desarrolloProyecto, $idProtocoloInvestigacion)
	{
		$sql = 'CALL spInsertarReferencias(:referencia, :estadoCampoArte, :planteamiento,
				:desarrolloProyecto, :idProtocoloInvestigacion)';

		$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':referencia' => $referencia,
							':estadoCampoArte' => $estadoCampoArte,
							':planteamiento' => $planteamiento,
							':desarrolloProyecto' => $desarrolloProyecto,
							':idProtocoloInvestigacion' => $idProtocoloInvestigacion));

		$result = $sth->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
}

?>