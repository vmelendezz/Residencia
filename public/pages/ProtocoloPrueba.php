<!DOCTYPE html>
<html>

<?php 
	include('../static/head.php');
?>


<body>
	<div class="container">
		<div style="text-align: center;">
			<h1 class="title-1">PROTOCOLO DE INVESTIGACIÓN (CI-02/2018)</h1>
		</div>
		<div class="row">
			<div class="col-12 col-sm-12 col-md-12">
				<div class="form-group">
					<div class=" col-12 col-sm-12 col-md-12" style="margin-top: 30px; text-align: center;">
						<H4>Nombre de la Intitución</H4>
						<H5>INSTITUTO TECNOLÓGICO JOSÉ MARIO MOLINA PASQUEL Y HENRÍQUEZ</H5>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-12 col-md-12">
				<div class="form-group">
					<label for="RESPONSABLE">Campus:</label>
					<select class="form-control">
						<option>Selecciona una opción</option>
					</select>
				</div>
			</div>
			<div class="col-12 col-sm-12 col-md-12">
				<div class="form-group">
					<label for="TITULO">Título del proyecto:</label>
					<input type="text" class="form-control" placeholder="Titulo que llevará el proyecto" id="TITULO" name="titulo">
				</div>
			</div>
			<div class="col-12 col-sm-12 col-md-12" style="margin-top: 20px; text-align: center;">
				<h4>1.	DESCRIPCIÓN DEL PROYECTO</h4>
			</div>
			<div class="col-12 col-sm-12 col-md-12 row">
				1.1	Resumen
				<div class="col-12 col-sm-12 col-md-12 row">
					Describa de manera general la problemática que abordará en su proyecto de investigación, cómo la pretende resolver y sus posibles resultados, máximo una cuartilla.
					<div class="col-12 col-sm-12 col-md-12">
						<div class="form-group">
							<textarea  type="text" class="form-control" id="RESUMEN" row="26" name="textAreaResumen"></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-12 col-md-12 row">
				1.2	Introducción (Máximo tres cuartillas)
				<div class="col-12 col-sm-12 col-md-12">
					<div class="form-group">
						<textarea  type="text" class="form-control" id="INTRODUCCION" row="76" name="textAreaIntroduccion"></textarea>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-12 col-md-12 row">
				1.3	Antecedentes
				<div class="col-12 col-sm-12 col-md-12 row">
					Refiera los antecedentes y avances científicos y/o tecnológicos que soportan la investigación a desarrollar (máximo tres cuartillas)
					<div class="col-12 col-sm-12 col-md-12">
						<div class="form-group">
							<textarea  type="text" class="form-control" id="ANTECEDENTES" row="76" name="textAreaAntecedentes"></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-12 col-md-12 row">
				1.4	Marco teórico 
				<div class="col-12 col-sm-12 col-md-12 row">
					Fundamento teórico que respalda el trabajo de investigación (máximo 5 cuartillas).
					<div class="col-12 col-sm-12 col-md-12">
						<div class="form-group">
							<textarea  type="text" class="form-control" id="MTEORICO" row="130" name="textAreaMteorico"></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-12 col-md-12">
					<table class="table table-bordered">
						<thead class="thead-dark">
							<tr>
								<th style="text-align: center;">1.5 Objetivos</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td scope="row">1.- General
									<textarea  type="text" class="form-control" id="OBJETIVOS" row="26" name="textAreaObjetivos"></textarea>
								</td>
							</tr>
							<tr>
								<td scope="row">2. Específicos
									<textarea  type="text" class="form-control" id="OBJETIVOS" row="26" name="textAreaObjetivos"></textarea>
								</td>
							</tr>
						</tbody>
					</table>
			</div>
			<div class="col-12 col-sm-12 col-md-12 row">
				1.6 Metas  
				<div class="col-12 col-sm-12 col-md-12 row">
					Especifique los resultados a obtener en forma cuantitativa; máximo una cuartilla.
					<div class="col-12 col-sm-12 col-md-12">
						<div class="form-group">
							<textarea  type="text" class="form-control" id="META" row="26" name="textAreaMeta"></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-12 col-md-12 row">
				1.7 Impacto o beneficio en la solución a un problema relacionado con el sector productivo, la institución o la generación del conocimiento científico o tecnológico.  
				<div class="col-12 col-sm-12 col-md-12 row">
					Sustente la realización de su proyecto respecto a la magnitud del problema, la trascendencia de su estudio, su factibilidad, vulnerabilidad e impacto social, congruencia con la línea de investigación e impacto en el programa educativo (permanencia o ingreso a PNPC, SNI, etc.), máximo dos cuartillas.
					<div class="col-12 col-sm-12 col-md-12">
						<div class="form-group">
							<textarea  type="text" class="form-control" id="IMPACTO" row="52" name="textAreaImpacto"></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-12 col-md-12 row">
				1.8 Metodología   
				<div class="col-12 col-sm-12 col-md-12 row">
					Explique el o los procedimientos científico-metodológicos a seguir para cumplir los objetivos y metas del proyecto, indicando las pruebas estadísticas, diseño experimental y técnicas a utilizar (máximo dos cuartillas).
					<div class="col-12 col-sm-12 col-md-12">
						<div class="form-group">
							<textarea  type="text" class="form-control" id="METODOLOGIA" row="52" name="textAreaMetodologia"></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-12 col-md-12 row">
				1.9 Programa de actividades, calendarización y presupuesto solicitado.
				<div class="col-12 col-sm-12 col-md-12 row">
					Utilice el formato especificado en el documento concentrador y considere solamente las partidas indicadas en el mismo.
				</div>
				PLAN DE TRABAJO -------- PENDIENTE
				<div class="col-12 col-sm-12 col-md-12">
					<table class="table table-bordered">
						<thead class="thead-dark">
							<tr>
								<th scope="col">No.</th>
								<th scope="col">Nombre del responsable de la actividad</th>
								<th scope="col">Actividad</th>
								<th scope="col">Periodo de realización indicar mes (es)</th>
								<th scope="col">Resultados entregables de la actividad</th>
								<th scope="col">Partidas solicitadas</th>
								<th scope="col">Monto solicitado</th>
								<th scope="col">Descripción de los bienes</th>
							</tr>
						</thead>
						<body>
							<tr>
								<td>1.-</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>2.-</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>3.-</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>4.-</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>5.-</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>6.-</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>7.-</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>8.-</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>9.-</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>10.-</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						</body>
					</table>
				</div>
			</div>
			<div class="col-12 col-md-12 col-sm-12 row">
				1.10 Productos entregables
			</div>
			<div class="col-12 col-md-12 col-sm-12 row">
				Especifique los productos y beneficios a obtener, máximo una cuartilla.
			</div>
			<div class="col-12 col-md-12 col-sm-12">
				<textarea  type="text" class="form-control" id="PRODUCTOS" row="26" name="textAreaProductos"></textarea>
			</div>
			<div class="col-12 col-md-12 col-sm-12 row">
				1.11 Vinculación con el Sector Productivo. 
			</div>
			<div class="col-12 col-md-12 col-sm-12 row">
				Especifique el nombre de la empresa y tipo de cooperación que existirá, así como la responsabilidad en los resultados del proyecto.  Anexe carta compromiso, o mencione los usuarios potenciales de los resultados de su investigación así como la vinculación que se tiene con otras instituciones y su entorno. 
			</div>
			<div class="col-12 col-md-12 col-sm-12" style="margin-top: 20px">
				<div class="form-group">
					<label for="NOMEMPRESA">Nombre de la empresa</label>
					<input type="text" name="nomempresa" placeholder="Ingrese el nombre de la empresa" class="form-control" id="NOMEMPRESA" />
				</div>
			</div>
			<div class="col-12 col-md-12 col-sm-12" style="margin-top: 20px">
				<div class="form-group">
					<label for="TIPOCOOPERACION">Tipo de cooperación</label>
					<textarea  type="text" class="form-control" id="TIPOCOOPERACION" row="26" name="textAreaTipoCooperacion"></textarea>
				</div>
			</div>
			<div class="col-12 col-md-12 col-sm-12" style="margin-top: 20px">
				<div class="form-group">
					<label for="RESPONSABILIDAD">Responsabilidad en los resultados del proyecto</label>
					<textarea  type="text" class="form-control" id="RESPONSABILIDAD" row="26" name="textAreaResponsabilidad"></textarea>
				</div>
			</div>
			<div class="col-12 col-md-12 col-sm-12">
				<div class="form-group">
					<label for="CarComprOresponsables">Anexe carta compromiso o usuarios potenciales</label>
					<div class="col-12 col-md-12 col-sm-12 row">
							<input type="file" class="form-control-file" id="CARTACOMPROMISO">
					</div>
					<div class="col-12 col-md-12 col-sm-12 row" style="margin-top: 20px">
						<textarea  type="text" class="form-control" id="USUARIOSPOTENCIALES" row="26" name="textAreaUsuariosPotenciales" placeholder="Usuarios potenciales"></textarea>	
					</div>
				</div>				
			</div>
			<div class="col-12 col-md-12 col-sm-12 row">
				1.12 Referencias
			</div>
			<div class="col-12 col-md-12 col-sm-12 row">
				Enuncie las referencias consultadas para la descripción del estado del campo o del arte, planteamiento y desarrollo del proyecto. 
			</div>
			<div class="col-12 col-md-12 col-sm-12" style="margin-top: 20px">
				<div class="form-group">
					<label for="REFERENCIAS">Referencias</label>
					<textarea type="text" name="referencias" class="form-control" id="REFERENCIAS" row="26"></textarea>
				</div>
				<div class="form-group">
					<label for="CAMPOARTE">Descripción del estado del campo o del arte</label>
					<textarea type="text" name="campoarte" class="form-control" id="CAMPOARTE" row="26"></textarea>
				</div>
				<div class="form-group">
					<label for="PLANTEAMIENTO">Planteamiento</label>
					<textarea type="text" name="plateamiento" class="form-control" id="PLANTEAMIENTO" row="26"></textarea>
				</div>
				<div class="form-group">
					<label for="DESARROLLO">Desarrollo del proyecto</label>
					<textarea type="text" name="desarrollo" class="form-control" id="DESARROLLO" row="26"></textarea>
				</div>
			</div>
			<div class="col-12 col-sm-12 col-md-12" style="margin-top: 20px; text-align: center;">
				<h4>2.	LUGAR(ES) EN DONDE SE VA A DESARROLLAR EL PROYECTOLUGAR(ES) EN DONDE SE VA A DESARROLLAR EL PROYECTO</h4>
			</div>
			<div class="col-12 col-md-12 col-sm-12">
				Especifique el nombre de la Sección, Departamento, Taller o Laboratorio en que se realizará el proyecto, mencionando la dirección exacta del lugar.  Si el proyecto requiere de pruebas de campo, indique: estado, región, zona y municipio, así como la distancia en Km. con respecto al plantel. 
			</div>
			<div class="col-12 col-md-12 col-sm-12" style="margin-top: 20px">
				<label for="NOMBRELUGTRAB">Nombre de la Sección/Departamento/Taller/Laboratorio</label>
				<input type="text" class="form-control" id="NOMBRELUGTRAB" name="nombrelugtrab">
			</div>
			<div class="col-12 col-md-12 col-sm-12">
				<label for="DIRECCION">Dirección exacta</label>
				<input type="text" class="form-control" id="DIRECCION" name="direccionlugtrab">
			</div>
			<div class="col-12 col-sm-12 col-md-12 row" style="margin-top: 20px">
				<div class="col-3">¿Requiere pruebas de campo?</div>
				<div class="form-check col-2">
   				    <input type="checkbox" class="form-check-input" id="CheckSipruebas">
    				<label class="form-check-label" for="CheckSipruebas">Si</label>
 				</div>
				<div class="form-check col-2">
   				    <input type="checkbox" class="form-check-input" id="CheckNoPruebas">
    				<label class="form-check-label" for="CheckNoPruebas">No</label>
 				</div>
 			</div>
 			<div class="col-12 col-sm-12 col-md-12 row" style="margin-top: 20px">
 				<div class="col-6 col-sm-6 col-md-6 form-group">
 					<label for="ESTADO">Estado:</label>
					<select class="form-control">
						<option>Selecciona una opción</option>
						<option>Estado 1</option>
						<option>Estado 2</option>
					</select>
 				</div>
 				<div class="col-6 col-sm-6 col-md-6 form-group">
 					<label for="REGION">Región:</label>
 					<input type="text" class="form-control" id="REGION" name="region">
 				</div>
 			</div>
 			<div class="col-12 col-sm-12 col-md-12 row" style="margin-top: 20px">
 				<div class="col-6 col-sm-6 col-md-6 form-group">
 					<label for="ZONA">Zona:</label>
 					<input type="text" class="form-control" id="ZONA" name="zona">
 				</div>
 				<div class="col-6 col-sm-6 col-md-6 form-group">
 					<label for="MUNICIPIO">Municipio:</label>
 					<input type="text" class="form-control" id="MUNICIPIO" name="municipio">
 				</div>
 			</div>
 			<div class="col-12 col-sm-12 col-md-12 row" style="margin-top: 20px">
 				<div class="col-6 col-sm-6 col-md-2">
 					<label for="DISTANCIAKM">Distancia en Km:</label>
 				</div>
 				<div class="col-6 col-sm-6 col-md-10">
 					<input type="text" class="form-control" id="DISTANCIAKM" name="distanciakm">
 				</div>
 			</div>
 			<div class="col-12 col-sm-12 col-md-12" style="margin-top: 20px; text-align: center;">
				<h4>3.  INFRAESTRUCTURA</h4>
			</div>
			<div class="col-12 col-sm-12 col-md-12">
				Mencione la infraestructura disponible en el plantel para el desarrollo del proyecto. Indique si va a hacer uso de las instalaciones en otras instituciones o dependencias.
				<textarea type="text" name="infraestructura" class="form-control" id="INFRAESTRUCTURA" row="10"></textarea>
			</div>
			<div class="col-12 col-sm-12 col-md-12" style="margin-top: 20px; text-align: center;">
				Se deberán proporcionar informes de avances semestrales y final, en donde se incluya el cumplimiento de las metas comprometidas en función de los productos entregables.  El cual será un criterio de evaluación para apoyos posteriores.
			</div>
		</div>
	</div>
</body>
<?php 
	include('../static/footer.php');
?>

</html>