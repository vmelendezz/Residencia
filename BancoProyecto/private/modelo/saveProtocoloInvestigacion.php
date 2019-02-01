<?php  

/**
* 
*/
class SaveProtocoloInvestigacion
{
	
	public $conn2 = null;
	public $conn = null;
	public $result;
	function __construct()
	{
		require "conexion.php";
		$this->conn2 = new conexion();
	}


	public function SaveProtocoloInvestigacion($data, $id, $idInvestigador)
	{
		//print_r($data);
		$dataSave = array();
		$dataSave = array(	':titulo' => null,
							':resumen' => null,
							':introduccion' => null,
							':antecedentes' => null,
							':marcoTeorico' => null,
							':metas' => null,
							':impactoBeneficio' => null,
							':metodologia' => null,
							':productosEntregables' => null,
							':idInvestigador' => $idInvestigador,
							':idProtocoloInvestigacion' => $id,
							':idCampus' => null);

		foreach ($data as $key => $value) {
			if($key == 'dataDescProyecto'){
				foreach ($data[$key]->campos as $key1 => $value1){
					if( $value1->nombre == 'titulo' ){
						$dataSave[':titulo'] = $value1->value;
					}else if( $value1->nombre == 'textAreaResumen' ){
						$dataSave[':resumen'] = $value1->value;
					}else if( $value1->nombre == 'textAreaIntroduccion' ){
						$dataSave[':introduccion'] = $value1->value;
					}else if( $value1->nombre == 'textAreaAntecedentes' ){
						$dataSave[':antecedentes'] = $value1->value;
					}else if( $value1->nombre == 'textAreaMteorico' ){
						$dataSave[':marcoTeorico'] = $value1->value;
					}else if( $value1->nombre == 'cmbxCampus' ){
						$dataSave[':idCampus'] = $value1->value;
					}
				}
			}else if ($key == 'dataObjProyecto') {
				foreach ($data[$key]->campos as $key1 => $value1){
					if( $value1->nombre == 'textAreaMeta' ){
						$dataSave[':metas'] = $value1->value;
					}else if( $value1->nombre == 'textAreaImpacto' ){
						$dataSave[':impactoBeneficio'] = $value1->value;
					}else if( $value1->nombre == 'textAreaMetodologia' ){
						$dataSave[':metodologia'] = $value1->value;
					}else if( $value1->nombre == 'textAreaProductos' ){
						$dataSave[':productosEntregables'] = $value1->value;
					}
				}
			}
		}

		$sql = 'CALL spGuardarDescrpcionProyecto(:titulo, :resumen, :introduccion, :antecedentes, :marcoTeorico, :metas, :impactoBeneficio, :metodologia, :productosEntregables, :idInvestigador, :idProtocoloInvestigacion, :idCampus)';

		$sth = $this->conn2->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute($dataSave);

		$this->result['guardado'] = 'Descripcion del proyecto';
		$this->result = $sth->fetchAll(PDO::FETCH_ASSOC);

		//print_r($this->result);

		$id = $this->result[0]['id'];

		$dataSave1 = array(':id' => $id,
							':titulo' => $dataSave[':titulo'],
							':idAdmin' => $idInvestigador);

		$sql = 'CALL spInicializarSolicitudApoyo(:id, :titulo, :idAdmin)';

		$sth = $this->conn2->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute($dataSave1);
		

		$dataSave = array(	':objetivoGeneral' => null,
							':idProtocoloInvestigacion' => $id);

		foreach ($data as $key => $value) {
			if($key == 'dataObjProyecto'){
				foreach ($data[$key]->campos as $key1 => $value1){
					if( $value1->nombre == 'textAreaObjetivos' ){
						$dataSave[':objetivoGeneral'] = $value1->value;
					}
				}
			}
		}

		$sql = 'CALL spGuardarObjetivoGeneral(:objetivoGeneral, :idProtocoloInvestigacion)';

		$sth = $this->conn2->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute($dataSave);

		$this->result['guardado'] = 'Objetivo general';
		$this->result = $sth->fetchAll(PDO::FETCH_ASSOC);

		//print_r($this->result);

		$dataSave = array(	':objetivosEspecificos' => null,
							':idProtocoloInvestigacion' => $id);

		foreach ($data as $key => $value) {
			if($key == 'dataObjProyecto'){
				foreach ($data[$key]->campos as $key1 => $value1){
					if( $value1->nombre == 'textAreaObjetivosEspecificos' ){
						$dataSave[':objetivosEspecificos'] = $value1->value;
					}
				}
			}
		}

		$sql = 'CALL spGuardarObjetivoEspecifico(:objetivosEspecificos, :idProtocoloInvestigacion)';

		$sth = $this->conn2->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute($dataSave);

		$this->result['guardado'] = 'Objetivos especificos';
		$this->result = $sth->fetchAll(PDO::FETCH_ASSOC);

		//print_r($this->result);

		$dataSave = array(	':nombreEmpresa' => null,
							':tipoCooperacion' => null,
							':responsabilidad' => null,
							':usuariosPotenciales' => null,
							':idProtocoloInvestigacion' => $id);

		foreach ($data as $key => $value) {
			if($key == 'dataDatEmpresa'){
				foreach ($data[$key]->campos as $key1 => $value1){
					if( $value1->nombre == 'txtnomempresa' ){
						$dataSave[':nombreEmpresa'] = $value1->value;
					}else if( $value1->nombre == 'textAreaTipoCooperacion' ){
						$dataSave[':tipoCooperacion'] = $value1->value;
					}else if( $value1->nombre == 'textAreaResponsabilidad' ){
						$dataSave[':responsabilidad'] = $value1->value;
					}else if( $value1->nombre == 'textAreaUsuariosPotenciales' ){
						$dataSave[':usuariosPotenciales'] = $value1->value;
					}
				}
			}
		}

		//print_r($dataSave);

		$sql = 'CALL spGuardarVinculacion(:nombreEmpresa, :tipoCooperacion, :responsabilidad, :usuariosPotenciales, :idProtocoloInvestigacion)';

		$sth = $this->conn2->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute($dataSave);


		$this->result['guardado'] = 'Vinculacion';
		$this->result = $sth->fetchAll(PDO::FETCH_ASSOC);

		//print_r($this->result);

		$dataSave = array(	':referencia' => null,
							':estadoCampoArte' => null,
							':planteamiento' => null,
							':desarrolloProyecto' => null,
							':idProtocoloInvestigacion' => $id);

		foreach ($data as $key => $value) {
			if($key == 'dataDatEmpresa'){
				foreach ($data[$key]->campos as $key1 => $value1){
					if( $value1->nombre == 'referencias' ){
						$dataSave[':referencia'] = $value1->value;
					}else if( $value1->nombre == 'campoarte' ){
						$dataSave[':estadoCampoArte'] = $value1->value;
					}else if( $value1->nombre == 'plateamiento' ){
						$dataSave[':planteamiento'] = $value1->value;
					}else if( $value1->nombre == 'desarrollo' ){
						$dataSave[':desarrolloProyecto'] = $value1->value;
					}
				}
			}
		}

		$sql = 'CALL spGuardarReferencias(:referencia, :estadoCampoArte, :planteamiento, :desarrolloProyecto, :idProtocoloInvestigacion)';

		$sth = $this->conn2->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute($dataSave);

		$this->result['guardado'] = 'Referencias';
		$this->result = $sth->fetchAll(PDO::FETCH_ASSOC);

		//print_r($this->result);

		$dataSave = array(	':idProtocoloInvestigacion' => $id,
							':nombreSeccion' => null,
							':direccionExacta' => null,
							':requierePruebasCampo' => null,
							':estado' => null,
							':region' => null,
							':zona' => null,
							':municipio' => null,
							':distanciaKM' => null);

		foreach ($data as $key => $value) {
			if($key == 'dataLugarInfra'){
				foreach ($data[$key]->campos as $key1 => $value1){
					if( $value1->nombre == 'txtnombrelugtrab' ){
						$dataSave[':nombreSeccion'] = $value1->value;
					}else if( $value1->nombre == 'txtdireccionlugtrab' ){
						$dataSave[':direccionExacta'] = $value1->value;
					}else if( $value1->nombre == 'pruebas' ){
						$dataSave[':requierePruebasCampo'] = $value1->value;
					}else if( $value1->nombre == 'txtEstado' ){
						$dataSave[':estado'] = $value1->value;
					}else if( $value1->nombre == 'txtregion' ){
						$dataSave[':region'] = $value1->value;
					}else if( $value1->nombre == 'txtzona' ){
						$dataSave[':zona'] = $value1->value;
					}else if( $value1->nombre == 'txtmunicipio' ){
						$dataSave[':municipio'] = $value1->value;
					}else if( $value1->nombre == 'txtdistanciakm' ){
						$dataSave[':distanciaKM'] = $value1->value;
					}
				}
			}
		}

		//print_r($dataSave);

		$sql = 'CALL spGuardarLugarDesarrollo(:idProtocoloInvestigacion, :nombreSeccion, :direccionExacta, :requierePruebasCampo, :estado, :region, :zona, :municipio, :distanciaKM)';

		$sth = $this->conn2->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute($dataSave);

		$this->result['guardado'] = 'Lugar de desarrollo';
		$this->result = $sth->fetchAll(PDO::FETCH_ASSOC);

		//print_r($this->result);

		$dataSave = array(	':descripcion' => null,
							':idProtocoloInvestigacion' => $id);

		foreach ($data as $key => $value) {
			if($key == 'dataLugarInfra'){
				foreach ($data[$key]->campos as $key1 => $value1){
					if( $value1->nombre == 'infraestructura' ){
						$dataSave[':descripcion'] = $value1->value;
					}
				}
			}
		}

		$sql = 'CALL spGuardarInfraestructura(:descripcion, :idProtocoloInvestigacion)';

		$sth = $this->conn2->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute($dataSave);

		$this->result['guardado'] = 'Infraestructura';
		$this->result = $sth->fetchAll(PDO::FETCH_ASSOC);

		//print_r($this->result);

		$sql = 'DELETE FROM documentosproyecto WHERE idProtocoloInvestigacion = :idProtocoloInvestigacion';

		$sth = $this->conn2->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':idProtocoloInvestigacion' => $id));

		$dataSave = array(	':idProtocoloInvestigacion' => $id,
							':ruta' => null,
							':nombre' => null);

		foreach ($data as $key => $value) {
			if($key == 'dataDatEmpresaFiles'){
				//print_r($data[$key]);
				foreach ($data[$key] as $key1 => $value1){
					if($value1 != null){
						$dataSave[':ruta'] = $value1->id;
						$dataSave[':nombre'] = $value1->nombre;
						
						$sql = 'CALL spGuardarDocumentosProyecto(:idProtocoloInvestigacion, :ruta, :nombre)';

						$sth = $this->conn2->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
						$sth->execute($dataSave);

						$this->result['guardado'] = 'Infraestructura';
						$this->result = $sth->fetchAll(PDO::FETCH_ASSOC);

						//print_r($this->result);					
					}
				}
			}
		}

		echo 1;
	}
}

?>