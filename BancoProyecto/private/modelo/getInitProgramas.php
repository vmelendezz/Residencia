<?php 

/**
* 
*/
class Programas
{

	public $conn = null;
	function __construct()
	{
		require_once  "conexion.php";
		$this->conn = new Conexion();
	}

	public function getPrograma($id){
		$sql = 'SELECT idPrograma AS id, nomPrograma AS nombre FROM programas WHERE idPrograma='.$id;

		$result = Array();

		$result['values'] = Array();

		foreach ($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
			array_push ($result['values'], $row);
		}
		
		return $result;
	}

	public function getProgramaLinea($id){
		$sql = 'select lineas.idLinea AS id, lineas.nombre from  lineas where lineas.idLinea = '.$id.';';

		$query =  $this->conn->prepare($sql);

		$result = Array();

		$result['values'] = Array();
		foreach ($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
			array_push ($result['values'], $row);
		}
		
		return $result;
	}

	public function getProgramaInv($id){
		$sql = 'SELECT idProgramasCuerpoAcademico AS id, nombre FROM programascuerpoacademico WHERE idProgramasCuerpoAcademico='.$id;

		$result = Array();

		$result['values'] = Array();

		foreach ($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
			array_push ($result['values'], $row);
		}
		
		return $result;
	}

	public function getProgramaInvLinea($id){
		$sql = 'select lineascuerpoacademico.idlineasCuerpoAcademico AS id, lineascuerpoacademico.nombre from lineascuerpoacademico where lineascuerpoacademico.idlineasCuerpoAcademico = '.$id.';';

		$query =  $this->conn->prepare($sql);

		$result = Array();

		$result['values'] = Array();
		foreach ($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
			array_push ($result['values'], $row);
		}
		
		return $result;
	}

	public function getProgramas()
	{
		$sql = 'SELECT idPrograma AS id, nomPrograma AS nombre FROM programas';

		$result = Array();

		$result['values'] = Array();

		foreach ($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
			array_push ($result['values'], $row);
		}
		
		return $result;
	}

	public function getProgramasCuerpoacademico()
	{
		$sql = 'SELECT idProgramasCuerpoAcademico AS id, nombre FROM programascuerpoacademico';

		$result = Array();

		$result['values'] = Array();

		foreach ($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
			array_push ($result['values'], $row);
		}
		
		return $result;
	}

	public function getProgramasProcesoConsolidacion(){
		$sql = 'SELECT idProgramaInvConsolidar AS id, nombre FROM programainvconsolidar';

		$result = Array();

		$result['values'] = Array();

		foreach ($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
			array_push ($result['values'], $row);
		}
		
		return $result;
	}

	public function addProgramas($nombre)
	{
		$sql = 'INSERT INTO programas (nomPrograma, descripcion) VALUES ( ?, ?);';

		$query =  $this->conn->prepare($sql);

		$query ->execute( array($nombre, $nombre) );

		$result['rengolesAfectados'] = $query->rowCount();

		return $result;
	}

	public function addProgramasCuerpoAcademico($nombre)
	{
		$sql = 'INSERT INTO programascuerpoacademico (nombre, descripcion) VALUES ( ?, ?);';

		$query =  $this->conn->prepare($sql);

		$query ->execute( array($nombre, $nombre) );

		$result['rengolesAfectados'] = $query->rowCount();

		return $result;
	}

	public function addProcesoConsolidacion($nombre)
	{
		$sql = 'INSERT INTO programainvconsolidar (nombre, descripcion) VALUES ( ?, ?);';

		$query =  $this->conn->prepare($sql);

		$query ->execute( array($nombre, $nombre) );

		$result['rengolesAfectados'] = $query->rowCount();

		return $result;
	}

	public function eliminarProgramaLinea($id)
	{
		$sql = 'DELETE FROM programas WHERE idPrograma = ?';
		$query =  $this->conn->prepare($sql);
		$query ->execute( array($id) );
		$result['rengolesAfectados'] = $query->rowCount();
		return $result;
	}

	public function eliminarProgramaCuerpoAcademico($id)
	{
		$sql = 'DELETE FROM programascuerpoacademico WHERE idProgramasCuerpoAcademico = ?';
		$query =  $this->conn->prepare($sql);
		$query ->execute( array($id) );
		$result['rengolesAfectados'] = $query->rowCount();
		return $result;
	}

	public function eliminarProcesoConsolidacion($id)
	{
		$sql = 'DELETE FROM programainvconsolidar WHERE idProgramaInvConsolidar = ?';
		$query =  $this->conn->prepare($sql);
		$query ->execute( array($id) );
		$result['rengolesAfectados'] = $query->rowCount();
		return $result;
	}

	public function actualizarProgramaLinea($id, $nombre)
	{
		$sql = 'Update programas Set nomPrograma = ? Where idPrograma = ?';
		$query =  $this->conn->prepare($sql);
		$query->execute( array($nombre, $id) );


		$result['rengolesAfectados'] = $query->rowCount();

		return $result;
	}

	public function actualizarProgramaCuerpoAcademico($id, $nombre)
	{
		$sql = 'Update programascuerpoacademico Set nombre = ? Where idProgramasCuerpoAcademico = ?';
		$query =  $this->conn->prepare($sql);
		$query->execute( array($nombre, $id) );


		$result['rengolesAfectados'] = $query->rowCount();

		return $result;
	}

	public function actualizarProcesoConsolidacion($id, $nombre)
	{
		$sql = 'Update programainvconsolidar Set nombre = ? Where idProgramaInvConsolidar = ?';
		$query =  $this->conn->prepare($sql);
		$query->execute( array($nombre, $id) );


		$result['rengolesAfectados'] = $query->rowCount();

		return $result;
	}

	public function getLineas($id){
		$sql = 'select lineas.idLinea AS id, lineas.nombre from programlineas inner join lineas on programlineas.idLinea = lineas.idLinea where programlineas.idPrograma = '.$id.';';

		$query =  $this->conn->prepare($sql);

		$result = Array();

		$result['values'] = Array();
		foreach ($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
			array_push ($result['values'], $row);
		}
		
		return $result;
	}

	public function getCuerpoAcademico($id){
		$sql = 'select lineascuerpoacademico.idlineasCuerpoAcademico AS id, lineascuerpoacademico.nombre from programalineacuerpoacademico inner join lineascuerpoacademico on programalineacuerpoacademico.idLineaCuerpoAcademico = lineascuerpoacademico.idlineasCuerpoAcademico where programalineacuerpoacademico.idProgramaCuerpoAcademico = '.$id.';';

		$query =  $this->conn->prepare($sql);

		$result = Array();

		$result['values'] = Array();
		foreach ($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
			array_push ($result['values'], $row);
		}
		
		return $result;
	}

	public function getProcesoConsolidacion($id){
		$sql = 'select lineasinvconsolidar.idLineasInvConsolidar AS id, lineasinvconsolidar.nombre from programalineainvconsolidar inner join lineasinvconsolidar on programalineainvconsolidar.idLineaInvConsolidar = lineasinvconsolidar.idLineasInvConsolidar where programalineainvconsolidar.idProgramaInvConsolidar = '.$id.';';

		$query =  $this->conn->prepare($sql);

		$result = Array();

		$result['values'] = Array();
		foreach ($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
			array_push ($result['values'], $row);
		}
		
		return $result;
	}

	public function addLineas($programa, $nombre){
		$sql = 'INSERT INTO lineas (nombre, descripcion) VALUES ( ?, ?);';
		$query =  $this->conn->prepare($sql);
		$query->execute( array($nombre, $nombre) );
		$lastID =  $this->conn->lastInsertId(); 

		$sql = 'INSERT INTO programlineas (idPrograma, idLinea) VALUES ( ?, ?);';
		$query =  $this->conn->prepare($sql);
		$query->execute( array($programa, $lastID ) );
		$result['rengolesAfectados'] = $query->rowCount();

		return $result;
	}

	public function addCuerpoAcademico($programa, $nombre){
		$sql = 'INSERT INTO lineascuerpoacademico (nombre, descripcion) VALUES ( ?, ?);';
		$query =  $this->conn->prepare($sql);
		$query->execute( array($nombre, $nombre) );
		$lastID =  $this->conn->lastInsertId(); 

		$sql = 'INSERT INTO programalineacuerpoacademico (idProgramaCuerpoAcademico, idLineaCuerpoAcademico) VALUES ( ?, ?);';
		$query =  $this->conn->prepare($sql);
		$query->execute( array($programa, $lastID ) );
		$result['rengolesAfectados'] = $query->rowCount();

		return $result;
	}

	public function addLineaProcesoConsolidacion($programa, $nombre){
		$sql = 'INSERT INTO lineasinvconsolidar (nombre, descripcion) VALUES ( ?, ?);';
		$query =  $this->conn->prepare($sql);
		$query->execute( array($nombre, $nombre) );
		$lastID =  $this->conn->lastInsertId(); 

		$sql = 'INSERT INTO programalineainvconsolidar (idProgramaInvConsolidar, idLineaInvConsolidar) VALUES ( ?, ?);';
		$query =  $this->conn->prepare($sql);
		$query->execute( array($programa, $lastID ) );
		$result['rengolesAfectados'] = $query->rowCount();

		return $result;
	}

	public function modificarLineas($id, $nombre)
	{
		$sql = 'Update lineas Set nombre = ? Where idLinea = ?';
		$query =  $this->conn->prepare($sql);
		$query->execute( array($nombre, $id) );


		$result['rengolesAfectados'] = $query->rowCount();

		return $result;
	}

	public function modificarCuerpoAcademico($id, $nombre)
	{
		$sql = 'Update lineascuerpoacademico Set nombre = ? Where idlineasCuerpoAcademico = ?';
		$query =  $this->conn->prepare($sql);
		$query->execute( array($nombre, $id) );


		$result['rengolesAfectados'] = $query->rowCount();

		return $result;
	}


	public function modificarLineaProcesoConsolidacion($id, $nombre)
	{
		$sql = 'Update lineasinvconsolidar Set nombre = ? Where idLineasInvConsolidar = ?';
		$query =  $this->conn->prepare($sql);
		$query->execute( array($nombre, $id) );


		$result['rengolesAfectados'] = $query->rowCount();

		return $result;
	}

	public function eliminarLineas($id)
	{
		$sql = 'DELETE FROM lineas WHERE idLinea = ?';
		$query =  $this->conn->prepare($sql);
		$query ->execute( array($id) );
		$result['rengolesAfectados'] = $query->rowCount();
		return $result;
	}

	public function eliminarCuerpoAcademico($id)
	{
		$sql = 'DELETE FROM lineascuerpoacademico WHERE idlineasCuerpoAcademico = ?';
		$query =  $this->conn->prepare($sql);
		$query ->execute( array($id) );
		$result['rengolesAfectados'] = $query->rowCount();
		return $result;
	}

	public function eliminarLineaProcesoConsolidacion($id)
	{
		$sql = 'DELETE FROM lineasinvconsolidar WHERE idLineasInvConsolidar = ?';
		$query =  $this->conn->prepare($sql);
		$query ->execute( array($id) );
		$result['rengolesAfectados'] = $query->rowCount();
		return $result;
	}

}

?>