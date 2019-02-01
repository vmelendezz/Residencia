<?php 

/**
* 
*/
class SolicitudApoyo 
{
	public $conn = null;
	function __construct()
	{
		require "conexion.php";
		$this->conn = new Conexion();
	}

	public function getInstituciones(){
		
		$sql = 'SELECT idInstitucion AS id, nombre AS nombre FROM instituciones';

		$result = Array();

		$result['nombre'] = 'cmbxInstitucion';
		$result['values'] = Array();

		foreach ($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
			array_push ($result['values'], $row);
		}

		return $result;
	}

	public function getResponsable($idResponsable)
	{
		$sql = 'CALL spObtenerUsuarioResponsable(:idResponsable)';

		$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':idResponsable' => $idResponsable));
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	public function getProgramas_lineaInvestigacion()
	{
		
		$sql = 'SELECT 	idPrograma AS id, nomPrograma AS nombre FROM programas';

		$result = Array();

		$result['nombre'] = 'cmbxProgramEdu';
		$result['values'] = Array();

		$res = $this->conn->query($sql, PDO::FETCH_ASSOC);
		foreach ( $res as $row) {
			array_push ($result['values'], $row);
		}

		return $result;
	}

	public function getPorLineaNomProgram()
	{
		
		$sql = 'CALL spObtenerLineas(:idPrograma)';

		$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':idPrograma' => $_GET['id']));
		$res = $sth->fetchAll(PDO::FETCH_ASSOC);

		$result = Array();

		$result['nombre'] = 'cmbxLineInvest';
		$result['values'] = Array();

		foreach ( $res as $row) {
			array_push ($result['values'], $row);
		}

		return $result;
	}

	public function getProgramas_investigadorProceso()
	{
		
		$sql =  'SELECT idProgramaInvConsolidar AS id, nombre FROM programainvconsolidar';

		$result = Array();

		$result['nombre'] = 'cmbxNameProgramEdu';
		$result['values'] = Array();

		$res = $this->conn->query($sql, PDO::FETCH_ASSOC);
		foreach ( $res as $row) {
			array_push ($result['values'], $row);
		}

		return $result;
	}

	public function getPorInvesNomProgram()
	{
		
		$sql = 'CALL spObtenerLineasInvConsolidar(:idPrograma)';

		$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':idPrograma' => $_GET['id']));
		$res = $sth->fetchAll(PDO::FETCH_ASSOC);

		$result = Array();

		$result['nombre'] = 'cmbxLineInvestOrTrab';
		$result['values'] = Array();

		foreach ( $res as $row) {
			array_push ($result['values'], $row);
		}

		return $result;
	}

	public function getProgramas_cuerpoAcademico()
	{
		
		$sql = 'SELECT idProgramasCuerpoAcademico AS id, nombre FROM programascuerpoacademico';

		$result = Array();

		$result['nombre'] = 'cmbxProgramEducativo';
		$result['values'] = Array();

		$res = $this->conn->query($sql, PDO::FETCH_ASSOC);
		foreach ( $res as $row) {
			array_push ($result['values'], $row);
		}

		return $result;
	}
	
	public function getPorCuerpAcadNomProgram()
	{
		
		$sql = 'CALL spObtenerLineasCuerpoAcademico(:idPrograma)';

		$sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':idPrograma' => $_GET['id']));
		$res = $sth->fetchAll(PDO::FETCH_ASSOC);

		$result = Array();

		$result['nombre'] = 'cmbxLineInvestCuerpo';
		$result['values'] = Array();

		foreach ( $res as $row) {
			array_push ($result['values'], $row);
		}

		return $result;
	}

	public function getnameCuerpoAcademico_cuerpoAcademico()
	{
		
		$sql = 'SELECT 	idCuerpoAcademico AS id, nombre FROM cuerpoacademico';

		$result = Array();

		$result['nombre'] = 'cmbxNameCuerpoAc';
		$result['values'] = Array();

		$res = $this->conn->query($sql, PDO::FETCH_ASSOC);
		foreach ( $res as $row) {
			array_push ($result['values'], $row);
		}

		return $result;
	}

}
//informacion sobre cargaa

//guardar

//consultar
?>