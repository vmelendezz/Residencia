<?php 

/**
* 
*/
class ProtocoloInvestigacion
{
	
	function __construct()
	{
		# code...
	}

	public function insertDescripcionProyecto($resumen, $introduccion, $antecentes, $marcoTeorico,
				$metas, $impactoBeneficio, $metodologia, $referencias, $idProtocoloInvestigacion)
	{
		require "conexion.php";
		$conn = new conexion();

		$sql = 'CALL spInsertarDescrpcionProyecto(:resumen, :introduccion, :antecentes, :marcoTeorico,
				:metas, :impactoBeneficio, :metodologia, :referencias, :idProtocoloInvestigacion)';

		$sth = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array('resumen' => $resumen,
							':introduccion' => $introduccion,
							':antecentes' => $antecentes,
							':marcoTeorico' => $marcoTeorico,
							':metas' => $metas,
							':impactoBeneficio' => $impactoBeneficio,
							':metodologia' => $metodologia,
							':referencias' => $referencias,
							':idProtocoloInvestigacion' => $idProtocoloInvestigacion));


		$result = $sth->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	public function insertInfraestructura($descripcion, $idProtocoloInvestigacion)
	{
		require "conexion.php";
		$conn = new conexion();


		$sql = 'CALL spInsertarInfraestructura(:descripcion, :idProtocoloInvestigacion)';

		$sth = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':descripcion' => $descripcion,
							':idProtocoloInvestigacion' => $idProtocoloInvestigacion));

		$result = $sth->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	public function insertLugarDesarrollo($idProtocoloInvestigacion, $nombreSeccion, $direccionExacta,
				$requierePruebasCampo, $estado, $region, $zona, $municipio, $distanciaKM)
	{
		require "conexion,php";
		$conn = new conexion();

		$sql = 'CALL spInsertarLugarDesarrollo(:idProtocoloInvestigacion, :nombreSeccion, :direccionExacta,
				:requierePruebasCampo, :estado, :region, :zona, :municipio, :distanciaKM)';

		$sth = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
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
		require "conexion.php";
		$conn = new conexion();

		$sql = 'CALL spInsertarVinculacion(:nombreEmpresa, :tipoCooperacion, :responsabilidad, :usuariosPotenciales,
				:otrasEmpresas, :idProtocoloInvestigacion)';

		$sth = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':nombreEmpresa' => $nombreEmpresa,
							':tipoCooperacion' => $tipoCooperacion,
							':responsabilidad' => $responsabilidad,
							':usuariosPotenciales' => $usuariosPotenciales,
							':otrasEmpresas' => $otrasEmpresas,
							':idProtocoloInvestigacion' => $idProtocoloInvestigacion));

		$result = $sth->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
}

?>