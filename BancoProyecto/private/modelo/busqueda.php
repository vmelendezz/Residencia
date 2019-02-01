<?php  

/**
* 
*/
class Busqueda
{
	public $conn = null;
	function __construct()
	{
		require "conexion.php";
		$this->conn = new Conexion();
	}

	public function getProyectos($id)
	{
		$sql = 'SELECT idSolicitudApoyo AS id, tituloProyecto AS titulo FROM solicitudapoyo WHERE idInvestigador = :idInvestigador';

		$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':idInvestigador' => $id));
		$res = $sth->fetchAll(PDO::FETCH_ASSOC);

		$result = Array();

		$result['nombre'] = 'proyectos';
		$result['values'] = Array();

		foreach ( $res as $row) {
			array_push ($result['values'], $row);
		}

		return $result;
	}

	public function getProyecto($id)
	{
		$sql = 'SELECT idSolicitudApoyo AS id, tituloProyecto AS titulo FROM solicitudapoyo WHERE idInvestigador = :idInvestigador';

		$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':idPrograma' => $id));
		$res = $sth->fetchAll(PDO::FETCH_ASSOC);

		$result = Array();

		$result['nombre'] = 'proyectos';
		$result['values'] = Array();

		foreach ( $res as $row) {
			array_push ($result['values'], $row);
		}

		return $result;
	}

	public function getConvocatorias()
	{
		$sql = 'SELECT idConvocatoria AS id, nombre, descripcion FROM convocatorias';

		$result = Array();

		$result['nombre'] = 'convocatorias';
		$result['values'] = Array();

		$res = $this->conn->query($sql, PDO::FETCH_ASSOC);
		foreach ( $res as $row) {
			array_push ($result['values'], $row);
		}

		return $result;
	}

	public function ligarConvocatoriaProyecto($idConvocatoria, $idProyecto)
	{
		$sql = 'INSERT INTO ligaconvocatoriaproyecto(idConvocatoria, idSolicitudApoyo)
				VALUES (:idConvocatoria, :idProyecto)';

		$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':idConvocatoria' => $idConvocatoria,
							':idProyecto' => $idProyecto));
	}

	public function getProyectosDeConvocatoria($idConvocatoria)
	{
		$sql = 'CALL spObtenerProyectosDeConvocatoria(:idConvocatoria)';

		$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':idConvocatoria' => $idConvocatoria));
		$res = $sth->fetchAll(PDO::FETCH_ASSOC);

		$result = Array();

		$result['nombre'] = 'proyectos de convocatoria';
		$result['values'] = Array();

		foreach ( $res as $row) {
			array_push ($result['values'], $row);
		}

		return $result;
	}

	public function eliminarLigaConvocatoriaProyecto($idProyecto)
	{
		$sql = 'DELETE FROM ligaconvocatoriaproyecto WHERE idSolicitudApoyo = :idProyecto';

		$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':idProyecto' => $idProyecto));
	}

	public function eliminarProyecto($idProyecto)
	{
		$sql = 'DELETE FROM solicitudapoyo WHERE idSolicitudApoyo = :idProyecto';

		$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':idProyecto' => $idProyecto));
		return $sth->rowCount();
	}
}

?>