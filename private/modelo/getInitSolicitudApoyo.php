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

	public function getInstituciones(){
		require "conexion.php";
		$conn = new Conexion();
		
		$sql = 'SELECT * FROM instituciones';

		$result = Array();

		$result[0] = 'cmbxInstitucion';
		$result[0] = Array();

		foreach ($conn->query($sql, PDO::FETCH_ASSOC) as $row) {
			array_push ($result[0], $row);
		}

		return $result;
	}

	public function getResponsable($idResponsable)
	{
		require "conexion.php";
		$conn = new conexion();

		$sql = 'CALL spObtenerUsuarioResponsable(:idResponsable)';

		$sth = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':idResponsable' => $idResponsable));
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	public function getProgramas()
	{
		require "conexion.php";
		$conn = new Conexion();
		
		$sql = 'SELECT * FROM programas';

		$result = Array();

		$result[0] = 'cmbxProgramas';
		$result[0] = Array();

		foreach ($conn->query($sql, PDO::FETCH_ASSOC) as $row) {
			array_push ($result[0], $row);
		}

		return $result;
	}

	public function getLineas($idPrograma)
	{
		require "conexion.php";
		$conn = new conexion();

		$sql = 'CALL spObtenerLineas(:idPrograma)';

		$sth = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':idPrograma' => $idPrograma));
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	public function getCuerpoAcademico()
	{
		require "conexion.php";
		$conn = new Conexion();
		
		$sql = 'SELECT idcuerpoAcademico, nombre FROM cuerpoacademico';

		$result = Array();

		$result[0] = 'cmbxCuerpoAcademico';
		$result[0] = Array();

		foreach ($conn->query($sql, PDO::FETCH_ASSOC) as $row) {
			array_push ($result[0], $row);
		}

		return $result;
	}
}
//informacion sobre cargaa

//guardar

//consultar
?>