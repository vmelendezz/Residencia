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

	public function getCampus()
	{
		$sql = 'SELECT idCampus AS id, nombreCampus AS nombre FROM campus';

		$result = Array();

		$result['nombre'] = 'cmbxCampus';
		$result['values'] = Array();

		foreach ($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
			array_push ($result['values'], $row);
		}
		
		return $result;
	}

	public function getTitulo($idProtocoloInvestigacion)
	{
		$sql = 'SELECT tituloProyecto AS titulo FROM solicitudapoyo WHERE idSolicitudApoyo = :idProtocoloInvestigacion';

		$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':idProtocoloInvestigacion' => $idProtocoloInvestigacion));
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	public function getObjetivoGeneral($idProtocoloInvestigacion)
	{
		$sql = 'SELECT idObjetivoGeneral As id, descripcion AS nombre WHERE idSolicitudApoyo = :idProtocoloInvestigacion';

		$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':idProtocoloInvestigacion' => $idProtocoloInvestigacion));
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	public function getObjetivosEspecificos($idProtocoloInvestigacion)
	{
		$sql = 'SELECT idObjetivosEspecificos As id, descripcion AS nombre WHERE idSolicitudApoyo = :idProtocoloInvestigacion';

		$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':idProtocoloInvestigacion' => $idProtocoloInvestigacion));
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
}

?>