<style>
	@media print{
		img.logo{
			width: 100%;
		}
		table.tablasPrint th, table.tablasPrint td{
			border: 1px solid black !important;
			color: black !important;
		}
	}
</style>

<?php 

require "./private/modelo/getProtocoloInvestigacion.php";
$info = new GetProtocoloInvestigacion();

$resultado = $info->getProtocoloInvestigacion($_GET['id']);

?>

<div class="container">
	<img class="logo" src="/BancoProyecto/public/imagenes/logo.jpg">
	<div class="col-12 col-sm-12 col-md-12" align="center">
		<div><h1>PROTOCOLO DE INVESTIGACIÓN</h1></div>
		<div><h1>(CI-02/2018)</h1></div>
		<div class=" col-12 col-sm-12 col-md-12" style="margin-top: 30px"; align="left">
			<H4>Nombre de la Intitución</H4>
			<H5>INSTITUTO TECNOLÓGICO JOSÉ MARIO MOLINA PASQUEL Y HENRÍQUEZ</H5>
		</div>
	</div>
	<div class="col-12 col-sm-12 col-md-12">
		<div class="form-group">
			<div>Campus: 
				<span>
					<?php 
							require_once  "./private/modelo/conexion.php";
							$conn = new Conexion();

							$sql = 'SELECT nombreCampus AS nombre FROM pcicz.campus WHERE idCampus='.$resultado['DescripcionProyecto'][1]['idCampus'];

							$result = Array();

							$result['values'] = Array();

							foreach ($conn->query($sql, PDO::FETCH_ASSOC) as $row) {
								array_push ($result['values'], $row);
							}
							
							print_r($result['values'][0]['nombre']);
					?>		
				</span>
			</div>
		</div>
	</div>
	<div class="col-12 col-sm-12 col-md-12">
		<div class="form-group">
			<div name="titulo">Título del proyecto: <span><?= $resultado['DescripcionProyecto'][0]['titulo']?></span></div>
		</div>
	</div>
	<div class="col-12 col-sm-12 col-md-12" style="margin-top: 20px; text-align: center;">
		<h4>1.	DESCRIPCIÓN DEL PROYECTO</h4>
	</div>
	<div class="col-12 col-sm-12 col-md-12 row">
		<h6>1.1	Resumen</h6>
		<div class="col-12 col-sm-12 col-md-12 row">
			<div class="col-12 col-sm-12 col-md-12">
				<div name="textAreaResumen"><span><?= $resultado['DescripcionProyecto'][1]['resumen']?></span></div>
			</div>
		</div>
	</div>
	<div class="col-12 col-sm-12 col-md-12 row" style="margin-top: 20px">
		<h6>1.2	Introducción (Máximo tres cuartillas)</h6>
		<div class="col-12 col-sm-12 col-md-12">
			<span><?= $resultado['DescripcionProyecto'][1]['introduccion']?></span>
		</div>
	</div>
	<div class="col-12 col-sm-12 col-md-12 row" style="margin-top: 20px">
		<h6>1.3	Antecedentes</h6>
		<div class="col-12 col-sm-12 col-md-12"><span><?= $resultado['DescripcionProyecto'][1]['antecedentes']?></span></div>
	</div>
	<div class="col-12 col-sm-12 col-md-12 row" style="margin-top: 20px">
		<h6>1.4	Marco teórico</h6> 
		<div class="col-12 col-sm-12 col-md-12"><span><?= $resultado['DescripcionProyecto'][1]['marcoTeorico']?></span>
		</div>
	</div>
	<table class="table table-bordered">
		<thead class="thead-dark tablasPrint">
			<tr>
				<th style="text-align: center;">1.5 Objetivos</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><h6>1.- General</h6>
					<div name="textAreaObjetivos">
						<span><?= $resultado['objetivosDelProyecto'][0]['objetivoGeneral']?></span>
					</div>
				</td>
			</tr>
			<tr>
				<td><h6>2. Específicos</h6>
					<div name="textAreaObjetivosEspecificos">
						<span><?= $resultado['objetivosDelProyecto'][1]['objetivosEspecificos']?></span>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
	<div class="col-12 col-sm-12 col-md-12" style="margin-top: 20px">
		<h6>1.6 Metas</h6>
		<div  name="textAreaMeta">
			<span><?= $resultado['objetivosDelProyecto'][2]['metas']?></span>
		</div>
	</div>
	<div class="col-12 col-sm-12 col-md-12" style="margin-top: 20px">
		<h6>1.7 Impacto o beneficio en la solución a un problema relacionado con el sector productivo, la institución o la generación del conocimiento científico o tecnológico.</h6>
		<div name="textAreaImpacto"><?= $resultado['objetivosDelProyecto'][2]['impactoBeneficio']?></span></div>
	</div>
	<div class="col-12 col-sm-12 col-md-12" style="margin-top: 20px">
	<h6>1.8 Metodología</h6>
		<div name="textAreaMetodologia"><span><?= $resultado['objetivosDelProyecto'][2]['metodologia']?></span></div>
	</div>
	<div class="col-12 col-md-12 col-sm-12" style="margin-top: 20px">
		<h6>1.9 Productos entregables</h6>
		<div name="textAreaProductos">
			<span><?= $resultado['DescripcionProyecto'][1]['productosEntregables']?></span>
		</div>
	</div>
	<div class="col-12 col-md-12 col-sm-12" style="margin-top: 20px">
		<h6>1.10 Vinculación con el Sector Productivo.</h6> 
	</div>
	<div class="col-12 col-md-12 col-sm-12">
		<div name="txtnomempresa"><h6>Nombre de la empresa: </h6><span><?= $resultado['DatosDeLaEmpresa'][0]['nombreEmpresa']?></span></div>
	</div>
	<div class="col-12 col-md-12 col-sm-12" style="margin-top: 20px">
			<div name="textAreaTipoCooperacion"><h6>Tipo de cooperación: </h6><span><?= $resultado['DatosDeLaEmpresa'][0]['tipoCooperacion']?></span></div>
	</div>
	<div class="col-12 col-md-12 col-sm-12" style="margin-top: 20px">
		<div name="textAreaResponsabilidad"><h6>Responsabilidad en los resultados del proyecto: </h6><span><?= $resultado['DatosDeLaEmpresa'][0]['responsabilidad']?></span>
		</div>
	</div>
	<div class="col-12 col-md-12 col-sm-12" style="margin-top: 20px">
		<div><h6>Carta compromiso: </h6><span><?php for ($i=0; $i < count( $resultado['DatosDeLaEmpresa']['Documentos']) ; $i++) { ?>
						<?= $resultado['DatosDeLaEmpresa']['Documentos'][$i]['nombre']?><br>
				<?php } ?></span>
		</div>
	</div>
	<div class="col-12 col-md-12 col-sm-12" style="margin-top: 20px">
		<div name="textAreaUsuariosPotenciales"><h6>Usuarios potenciales: </h6><span><?= $resultado['DatosDeLaEmpresa'][0]['usuariosPotenciables']?></span></div>
	</div>

	<div class="col-12 col-md-12 col-sm-12 row" style="margin-top: 20px">
		<h6>1.11 Referencias</h6>
	</div>
	<div class="col-12 col-md-12 col-sm-12 row">
			Enuncie las referencias consultadas para la descripción del estado del campo o del arte, planteamiento y desarrollo del proyecto. 
	</div>
	<div class="col-12 col-md-12 col-sm-12">
		<div style="margin-top: 20px">Referencias: <span><?= $resultado['DatosDeLaEmpresa'][1]['referencia']?></span> </div>
		<div style="margin-top: 20px">Descripción del estado del campo o del arte: <span><?= $resultado['DatosDeLaEmpresa'][1]['estadoCampoArte']?></span> </div>
		<div style="margin-top: 20px">Planteamiento: <span><?= $resultado['DatosDeLaEmpresa'][1]['planteamiento']?></span> </div>
		<div style="margin-top: 20px">Desarrollo del proyecto: <span><?= $resultado['DatosDeLaEmpresa'][1]['desarrolloProyecto']?></span> </div>
	</div>
	<div class="col-12 col-sm-12 col-md-12" style="margin-top: 20px; text-align: center;">
		<h4>2.	LUGAR(ES) EN DONDE SE VA A DESARROLLAR EL PROYECTOLUGAR(ES) EN DONDE SE VA A DESARROLLAR EL PROYECTO</h4>
	</div>
	<div class="col-12 col-md-12 col-sm-12" style="margin-top: 20px">
		<div name="txtnombrelugtrab">Nombre de la Sección/Departamento/Taller/Laboratorio: 
			<span><?= $resultado['LugarEInfraestructura'][0]['nombreSeccion']?></span>
		</div>
	</div>
	<div class="col-12 col-md-12 col-sm-12">
		<div name="txtdireccionlugtrab">Dirección exacta: <span><?= $resultado['LugarEInfraestructura'][0]['diereccionExacta']?></span></div>
	</div>
	<div class="col-12 col-sm-12 col-md-12 row" style="margin-top: 20px">
		<div class="col-12">¿Requiere pruebas de campo? Si <span>(<?= ($resultado['LugarEInfraestructura'][0]['requierePruebasCampo'] == '1')? 'X' : ''; ?>)</span> No <span>(<?= ($resultado['LugarEInfraestructura'][0]['requierePruebasCampo'] == '0')? 'X' : ''; ?>)</span></div>
		<div class="col-12 col-sm-12 col-md-12 row" style="margin-top: 20px">
			<div class="col-6 col-sm-6 col-md-6">
				<div for="txtestado">Estado:<span><?= $resultado['LugarEInfraestructura'][0]['estado']?></span></div>
			</div>
			<div class="col-6 col-sm-6 col-md-6 form-group">
				<div name="txtregion">Región: <span><?= $resultado['LugarEInfraestructura'][0]['region']?></span></div>
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-12 row" style="margin-top: 20px">
			<div class="col-6 col-sm-6 col-md-6 form-group">
				<div name="txtzona">Zona: <span><?= $resultado['LugarEInfraestructura'][0]['zona']?></span></div>
			</div>
			<div class="col-6 col-sm-6 col-md-6 form-group">
				<div name="txtmunicipio">Municipio: <span><?= $resultado['LugarEInfraestructura'][0]['municipio']?></span></div>
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-12" style="margin-top: 20px">
			<div name="txtdistanciakm">Distancia en Km: <span><?= $resultado['LugarEInfraestructura'][0]['distanciaKM']?></span></div>
		</div>
		<div class="col-12 col-sm-12 col-md-12" style="margin-top: 20px; text-align: center;">
		<h4>3.  INFRAESTRUCTURA</h4>
	</div>
	<div class="col-12 col-sm-12 col-md-12">
		<div name="infraestructura">
			<h6>Mencione la infraestructura disponible en el plantel para el desarrollo del proyecto. Indique si va a hacer uso de las instalaciones en otras instituciones o dependencias:</h6>
			<span><?= $resultado['LugarEInfraestructura'][1]['infraestructura']?></span>
		</div>
	</div>
	<div class="col-12 col-sm-12 col-md-12" style="margin-top: 20px; text-align: center;">
		Se deberán proporcionar informes de avances semestrales y final, en donde se incluya el cumplimiento de las metas comprometidas en función de los productos entregables.  El cual será un criterio de evaluación para apoyos posteriores.
	</div>
	<div class="col-12 col-sm-12 col-md-12" style="margin-top: 20px;">
		<div class="row">
			<div class="col-6 col-sm-6 col-md-6"></div>
			<div class="col-6 col-sm-6 col-md-6 border border-dark">
				<h6 style="text-align: center;">Profesor-Investigador Responsable</h6>
				<h6 style="text-align: center; margin-top: 100px;">Nombre y Firma</h6>
			</div>
		</div>
	</div>
	<div class="col-12 col-sm-12 col-md-12" style="margin-top: 20px;">
		<h6>Se deberán proporcionar informes de avances semestrales y final, en donde se incluya el cumplimiento de las metas comprometidas en función de los productos entregables.  El cual será un criterio de evaluación para apoyos posteriores.</h6>
	</div>
</div>