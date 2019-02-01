<?php  

/**
* 
*/
class GetProtocoloInvestigacion
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
		$sth->execute(array(':idProtocoloInvestigacion' => $id));
		$this->res = $sth->fetchAll(PDO::FETCH_ASSOC);

	}

	public function getProtocoloInvestigacion($id)
	{
		$result = array();

		$result['DescripcionProyecto'] = array();

		$sql = 'SELECT tituloProyecto AS titulo FROM solicitudapoyo WHERE idSolicitudApoyo = :idProtocoloInvestigacion';

		$this->ejecucion($sql, $id);

		foreach ($this->res as $row) {
			array_push($result['DescripcionProyecto'], $row);
		}

		$sql = 'SELECT resumen, introduccion, antecedentes, marcoTeorico, productosEntregables, idCampus FROM descripcionproyecto WHERE idProtocoloInvestigacion = :idProtocoloInvestigacion';

		$this->ejecucion($sql, $id);

		foreach ($this->res as $row) {
			array_push($result['DescripcionProyecto'], $row);
		}

		$result['objetivosDelProyecto'] = array();

		$sql = 'SELECT descripcion AS objetivoGeneral FROM objetivogeneral WHERE idSolicituApoyo = :idProtocoloInvestigacion';

		$this->ejecucion($sql, $id);

		foreach ($this->res as $row) {
			array_push($result['objetivosDelProyecto'], $row);
		}

		$sql = 'SELECT descripcion AS objetivosEspecificos FROM objetivosespecificos WHERE idSolicitudApoyo = :idProtocoloInvestigacion';

		$this->ejecucion($sql, $id);

		foreach ($this->res as $row) {
			array_push($result['objetivosDelProyecto'], $row);
		}

		$sql = 'SELECT metas, impactoBeneficio, metodologia, productosEntregables FROM descripcionproyecto WHERE idProtocoloInvestigacion = :idProtocoloInvestigacion';

		$this->ejecucion($sql, $id);

		foreach ($this->res as $row) {
			array_push($result['objetivosDelProyecto'], $row);
		}

		$result['DatosDeLaEmpresa'] = array();

		$sql = 'SELECT nombreEmpresa, tipoCooperacion, responsabilidad, usuariosPotenciables FROM vinculacion WHERE idProtocoloInvestigacion = :idProtocoloInvestigacion';

		$this->ejecucion($sql, $id);

		foreach ($this->res as $row) {
			array_push($result['DatosDeLaEmpresa'], $row);
		}

		$sql = 'SELECT referencia, estadoCampoArte, planteamiento, desarrolloProyecto FROM referencias WHERE idProtocoloInvestigacion = :idProtocoloInvestigacion';

		$this->ejecucion($sql, $id);

		foreach ($this->res as $row) {
			array_push($result['DatosDeLaEmpresa'], $row);
		}

		$result['DatosDeLaEmpresa']['Documentos'] = array();

		$sql = 'SELECT ruta, nombre FROM documentosproyecto WHERE idProtocoloInvestigacion = :idProtocoloInvestigacion';

		$this->ejecucion($sql, $id);

		foreach ($this->res as $row) {
			array_push($result['DatosDeLaEmpresa']['Documentos'], $row);
		}

		$result['LugarEInfraestructura'] = array();

		$sql = 'SELECT nombreSeccion, diereccionExacta, requierePruebasCampo, estado, region, zona, municipio, distanciaKM FROM lugardesarrollo WHERE idProtocoloInstigacion = :idProtocoloInvestigacion';

		$this->ejecucion($sql, $id);

		foreach ($this->res as $row) {
			array_push($result['LugarEInfraestructura'], $row);
		}

		$sql = 'SELECT descripcion AS infraestructura FROM infraestructura WHERE idProtocoloInvestigacion = :idProtocoloInvestigacion';

		$this->ejecucion($sql, $id);

		foreach ($this->res as $row) {
			array_push($result['LugarEInfraestructura'], $row);
		}

		//print_r($result);

		return $result;
	}
}

?>