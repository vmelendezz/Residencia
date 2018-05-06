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

	public function getInitInfoGeneral(){
		require "conexion.php";
		$conn = new Conexion();
		
		$sql = 'SELECT * FROM instituciones';

		$result = Array();

		$result['cmbxInstitucion'] = Array();

		foreach ($conn->query($sql, PDO::FETCH_ASSOC) as $row) {
			array_push ($result['cmbxInstitucion'], $row);
		}

		return $result;
	}
}
//informacion sobre cargaa

//guardar

//consultar
?>