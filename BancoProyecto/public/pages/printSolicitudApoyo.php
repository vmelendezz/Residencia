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

require "./private/modelo/getSolicitudApoyo.php";
$info = new GetSolicitudApoyo();

$resultado = $info->getSolicitudApoyo($_GET['id']);

?>

<div class="container">
	<img class="logo" src="/BancoProyecto/public/imagenes/logo.jpg">
	<h1 class="title-1" style="margin-top: 60px;" align="center">FORMATO CONCENTRADOR DE SOLICITUD DE APOYO (CI-01/2018)</h1>
	<h5 style="margin-top: 30px";>Antes de proporcionar la información solicitada, lea cuidadosamente cada uno de los rubros que contiene la presente solicitud, ya que en caso de presentarse incompleta, será rechazada.</h3>
	<div class="row">
		<div class="col-12 col-md-12 col-sm-12" align="right">
			Fecha de Elaboración: <span>06/12/2017</span>
		</div>
		<div class="col-12 col-md-12 col-sm-12 border border-dark" align="left" style="margin-top: 30px">
			NOMBRE DE LA INSTITUCIÓN: <span>INSTITUTO TECNOLÓGICO JOSÉ MARIO MOLINA PASQUEL Y HENRIQUEZ</span>
		</div>
		<hr>
		<div class="col-12 col-md-12 col-sm-12">
			<div class="row">
				<div class="col-12 col-sm-6 col-md-6 border border-dark">
					<div style="margin-top: 10px;">Responsable del Proyecto: <span>
						<?= ($resultado['InformacionGeneral'][0]['responsable'] != null)?
								$resultado['InformacionGeneral'][0]['responsable'] : ''; ?>
					</span></div>
					<div style="margin-top: 10px;">Correo electrónico: <span>
						<?= ($resultado['InformacionGeneral'][0]['correo'] != null)?
								$resultado['InformacionGeneral'][0]['correo'] : ''; ?>
					</span></div>
					<div style="margin-top: 10px;">SNI: <span>
						Si ( <?= ($resultado['InformacionGeneral'][0]['SNI'] != null)?
								'X' : ''; ?> ) 
						No. de Registro: <?= ($resultado['InformacionGeneral'][0]['SNI'] != null)?
								$resultado['InformacionGeneral'][0]['noSNI'] : ''; ?>
						No ( <?= ($resultado['InformacionGeneral'][0]['SNI'] == null)?
								'X' : ''; ?> )</span></div>
				</div>
				<div class="col-12 col-sm-6 col-md-6 border border-dark" align="center">
					Título del Proyecto: 
					<div>
						<?= ($resultado['InformacionGeneral'][0]['titulo'] != null)?
								$resultado['InformacionGeneral'][0]['titulo'] : ''; ?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-12 col-sm-12 border border-dark">
			<div style="margin-top: 10px;">Tipo de investigación:  <span>
				Básica   ( <?= ($resultado['InformacionGeneral'][0]['tipoInvestigacion'] == '1')?
								'X' : ''; ?> )
				Aplicada   ( <?= ($resultado['InformacionGeneral'][0]['tipoInvestigacion'] == '2')?
								'X' : ''; ?> )
				Desarrollo Tecnológico   (<?= ($resultado['InformacionGeneral'][0]['tipoInvestigacion'] == '3')?
								'X' : ''; ?>)
				Educativa ( <?= ($resultado['InformacionGeneral'][0]['tipoInvestigacion'] == '4')?
								'X' : ''; ?>)</span></div>
		</div>
		<div class="col-12 col-md-12 col-sm-12">
			<h3 style="margin-top: 30px;" align="center">MODALIDAD DEL PROYECTO</h3>
		</div>
		<div class="col-12 col-sm-12 col-md-12 border border-dark">
			<h5 align="center" style="margin-top: 10px">3.1 Por línea de investigación </h5>
		</div>
		<div class="col-12 col-sm-12 col-md-12">
			<div class="row">
				<div class="col-12 col-sm-6 col-md-6 border border-dark">
					<div align="center">Licenciatura  (<?= ($resultado['ModalidadProyecto'][0]['orientacion'] == '1')? 'X' : ''; ?>)</div>
				</div>
				<div class="col-12 col-sm-6 col-md-6 border border-dark no-padding">
					<div class=" border border-dark" align="center">Posgrado (<?= ($resultado['ModalidadProyecto'][0]['orientacion'] == '2')? 'X' : ''; ?>)</div>
					<div class="row">
						<div class="col- col-sm-6 col-md-6" align="center" style="margin-top: 10px;">
							<span >Habilitado (<?= ($resultado['ModalidadProyecto'][0]['subOrientacion'] == '1')? 'X' : ''; ?>)</span>
						</div>
						<div class="col- col-sm-6 col-md-6" align="center" style="margin-top: 10px;">
							<span> PNPC (<?= ($resultado['ModalidadProyecto'][0]['subOrientacion'] == '2')? 'X' : ''; ?>)</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-12 border border-dark">
				Nombre del Programa Educativo en donde se desarrollará el proyecto: 
				<span>
					<?php 

						if( $resultado['ModalidadProyecto'][0]['ProgramaPorLinea'] != null ){
							require "./private/modelo/getInitProgramas.php";
							$programas = new Programas();

							$resultadoProgramas = $programas->getPrograma($resultado['ModalidadProyecto'][0]['ProgramaPorLinea']);

							echo $resultadoProgramas['values'][0]['nombre'];
						}

					?>
				</span>
			<div style="margin-top: 10px;">Línea de investigación o de trabajo: 
				<span>
					<?php 

						if( $resultado['ModalidadProyecto'][0]['LineaPorLinea'] != null ){
							$programasLineas = new Programas();

							$resultadoProgramasLineas = $programasLineas->getProgramaLinea($resultado['ModalidadProyecto'][0]['LineaPorLinea']);

							echo $resultadoProgramasLineas['values'][0]['nombre'];
						}

					?>
				</span>
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-12 border border-dark">
			<h5 align="center" style="margin-top: 10px">3.2 Investigador en proceso de consolidación</h5>
		</div>
		<div class="col-12 col-sm-12 col-md-12 border border-dark">
			<div class="row">
				<div class="col-4 col-sm-4 col-md-4 border border-dark">
					<div>No de registro SNI: <span><?= ($resultado['ModalidadProyecto'][0]['SNIPorInv'] != null)? $resultado['ModalidadProyecto'][0]['SNIPorInv'] : ''; ?></span> </div>
					<div>No de registro PRODEP: <span><?= ($resultado['ModalidadProyecto'][0]['promepPorInv'] != null)? $resultado['ModalidadProyecto'][0]['promepPorInv'] : ''; ?></span> </div>
					<div style="margin-top: 20px";>Vigencia de nombramiento: <span><?= ($resultado['ModalidadProyecto'][0]['vigencia'] != null)? $resultado['ModalidadProyecto'][0]['vigencia'] : ''; ?></span> </div>
				</div>
				<div class="col-4 col-sm-4 col-md-4 border border-dark">
					<div>Nombre del Programa Educativo: 
						<span>
							<?php 

								if( $resultado['ModalidadProyecto'][0]['programaPorInv'] != null ){
									$programasInv = new Programas();

									$resultadoProgramasInv = $programasInv->getProgramaInv($resultado['ModalidadProyecto'][0]['programaPorInv']);

									echo $resultadoProgramasInv['values'][0]['nombre'];
								}

							?>
						</span>
					</div>
				</div>
				<div class="col-4 col-sm-4 col-md-4 border border-dark">
					<div>Línea de investigación o de trabajo: 						
						<?php 

							if( $resultado['ModalidadProyecto'][0]['lineaPorInv'] != null ){
								$programasInvLinea = new Programas();

								$resultadoProgramasInv = $programasInvLinea->getProgramaInvLinea($resultado['ModalidadProyecto'][0]['lineaPorInv']);

								echo $resultadoProgramasInv['values'][0]['nombre'];
							}

						?>

					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-12">
					<h5 align="center" style="margin-top: 10px">3.3. Cuerpos académicos en consolidación o consolidado</h5>
				</div>
				<div class="col-12 col-sm-12 col-md-12" align="center">
					<div class="row">
						<div class="col-3 col-sm-3 col-md-3" align="center">
							<span>Licenciatura (<?= ($resultado['ModalidadProyecto'][0]['orientacionCuerpo'] == '0')?
								'X' : ''; ?>)</span>
						</div>
						<div class="col-3 col-sm-3 col-md-3" align="center">
							<span>Posgrado (<?= ($resultado['ModalidadProyecto'][0]['orientacionCuerpo'] == '1')?
								'X' : ''; ?>)</span>
						</div>
						<div class="col-3 col-sm-3 col-md-3" align="center">
							<span>Habilitado (<?= ($resultado['ModalidadProyecto'][0]['orientacionCuerpo'] == '2')?
								'X' : ''; ?>)</span>
						</div>
						<div class="col-3 col-sm-3 col-md-3" align="center">
							<span>PNPC (<?= ($resultado['ModalidadProyecto'][0]['orientacionCuerpo'] == '3')?
								'X' : ''; ?>)</span>
						</div>
					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-12">
					<div  style="margin-top: 15px">Nombre del cuerpo académico: <span><?= ($resultado['ModalidadProyecto'][0]['cuerpoAcademico'] != null)? $resultado['ModalidadProyecto'][0]['cuerpoAcademico'] : ''; ?></span> </div>
					<div style="margin-top: 15px">Nombre del Programa Educativo en donde se desarrollará el proyecto:  <span><?= ($resultado['ModalidadProyecto'][0]['programaPorCuerpo'] != null)? $resultado['ModalidadProyecto'][0]['programaPorCuerpo'] : ''; ?></span> </div>
					<div style="margin-top: 15px">Línea de investigación o de trabajo: <span><?= ($resultado['ModalidadProyecto'][0]['lineaPorCuerpo'] != null)? $resultado['ModalidadProyecto'][0]['lineaPorCuerpo'] : ''; ?></span> </div>
				</div>
				<div class="col-12 col-sm-12 col-md-12 border border-dark" style="margin-top: 15px">
					<div style="margin-top: 10px">Fecha propuesta de inicio: <span><?= ($resultado['ModalidadProyecto'][0]['fecha'] != null)? $resultado['ModalidadProyecto'][0]['fecha'] : ''; ?></span></div>
					<div style="margin-top: 10px">Duración del proyecto (en meses): <span><?= ($resultado['ModalidadProyecto'][0]['duracion'] != null)? $resultado['ModalidadProyecto'][0]['duracion'] : ''; ?></span></div>
					<div style="margin-top: 10px">Horas requeridas para el desarrollo del proyecto (HSM): <span><?= ($resultado['ModalidadProyecto'][0]['horasRequeridas'] != null)? $resultado['ModalidadProyecto'][0]['horasRequeridas'] : ''; ?></span></div>
					<div style="margin-top: 20px"><h6>Nota: La fecha de inicio y término del proyecto se establecerá a partir de la aprobación del proyecto.</h6></div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-12 col-sm-12 col-md-12">
		<div class="row">
			<div style="margin-top: 15px;" class="col-12 col-sm-12 col-md-12" align="center">
				<h6>CI-01-2018</h6>
			</div>
			<div class="col-12 col-sm-12 col-md-12" align="center">
				<h6> Convocatoria de Apoyo a Proyectos de investigación científica aplicada, pura, académicos, desarrollo tecnológico e innovación 2018</h6>
			</div>
		</div>
	</div>
	<div class="col-12 col-md-12 col-sm-12">
		<h3 align="center">Profesores Colaboradores en el proyecto</h3>
	</div>
	<div class="col-12 col-sm-12 col-md-12">
		<table id="table-colaboradores" class="table table-bordered tablasPrint">
			<thead class="thead-dark">
				<tr>
					<th scope="col"">Nombre</th>
					<th scope="col" colspan="2">Profesor  TC</th>
					<th scope="col">Correo electrónico</th>
					<th scope="col" colspan="2">Perfil PROMEP</th>
					<th scope="col">Nivel SNI/No. CVU</th>
				</tr>
				<tr>
					<th></th>
					<th>Si</th>
					<th>No</th>
					<th></th>
					<th>Si</th>
					<th>No</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php for ($i=0; $i < count( $resultado['ProfesoresColaboradores']['colaboradores'] ) ; $i++) { ?>
					<tr>
						<td><?= $resultado['ProfesoresColaboradores']['colaboradores'][$i]['nombre'] ?></td>
						<td><?= ($resultado['ProfesoresColaboradores']['colaboradores'][$i]['tiempoCompleto'] == '1')? 'X' : ''; ?></td>
						<td><?= ($resultado['ProfesoresColaboradores']['colaboradores'][$i]['tiempoCompleto'] == '0')? 'X' : ''; ?></td>
						<td><?= $resultado['ProfesoresColaboradores']['colaboradores'][$i]['correo'] ?></td>
						<td><?= ($resultado['ProfesoresColaboradores']['colaboradores'][$i]['perfilPromep'] == '1')? 'X' : ''; ?></td>
						<td><?= ($resultado['ProfesoresColaboradores']['colaboradores'][$i]['perfilPromep'] == '0')? 'X' : ''; ?></td>
						<td><?= $resultado['ProfesoresColaboradores']['colaboradores'][$i]['nivelSNI'] ?></td>	
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
	<div class="col-12 col-sm-12 col-md-12">
		<table class="table table-bordered tablasPrint">
			<thead class="thead-dark">
				<tr>
					<th style="text-align: center;">Objetivos del proyecto</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td scope="row">1.- General
						<div><?= ($resultado['ProfesoresColaboradores'][0]['objetivoGeneral'] != null)? $resultado['ProfesoresColaboradores'][0]['objetivoGeneral'] : ''; ?></div>
					</td>
					
				</tr>
				<tr>
					<td scope="row">2. Específicos
						<div><?= ($resultado['ProfesoresColaboradores'][1]['objetivosEspecificos'] != null)? $resultado['ProfesoresColaboradores'][1]['objetivosEspecificos'] : ''; ?></div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="col-12 col-sm-12 col-md-12">
		<table class="table table-bordered tablasPrint">
			<thead class="thead-dark">
				<tr>
					<th colspan="2" style="text-align: center;">Productos entregables</th>
				</tr>
				<tr>
					<th style="width: 50%;">Contribución en la formación de recursos humanos
					Especificar si se titularán o estarán en proceso de tesis
					y/o proyecto de residencia</th>
					<th>Productividad académica</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<div>Licenciatura: <span><?= ($resultado['ProfesoresColaboradores']['entregables']['contribucion'][0]['licenciatura'] != null)? $resultado['ProfesoresColaboradores']['entregables']['contribucion'][0]['licenciatura'] : ''; ?></span></div>
						<div>Maestria: <span><?= ($resultado['ProfesoresColaboradores']['entregables']['contribucion'][0]['maestria'] != null)? $resultado['ProfesoresColaboradores']['entregables']['contribucion'][0]['maestria'] : ''; ?></span></div>
						<div>Doctorado: <span><?= ($resultado['ProfesoresColaboradores']['entregables']['contribucion'][0]['doctorado'] != null)? $resultado['ProfesoresColaboradores']['entregables']['contribucion'][0]['doctorado'] : ''; ?></span></div>
							<table id="table-alumnos" class="table table-bordered tablasPrint">
								<thead>
									<tr>
										<th colspan="2" style="text-align: center;">Incorporación de alumnos de licenciatura al proyecto
										</th>
									</tr>
								</thead>
								<tbody>
									<?php for ($i=0; $i < count( $resultado['ProfesoresColaboradores']['entregables']['contribucion']['incorporarAlumnos'] ) ; $i++) { ?>
										<tr>
											<td><?= $resultado['ProfesoresColaboradores']['entregables']['contribucion']['incorporarAlumnos'][$i]['alumno'] ?></td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
							<table  id="table-residentes" class="table table-bordered tablasPrint">
								<thead>
									<tr>
										<th colspan="2" style="text-align: center;">Alumnos residentes</label>
										</th>
									</tr>
								</thead>
								<tbody>
									<?php for ($i=0; $i < count( $resultado['ProfesoresColaboradores']['entregables']['contribucion']['alumnosresidentes'] ) ; $i++) { ?>
										<tr>
											<td><?= $resultado['ProfesoresColaboradores']['entregables']['contribucion']['alumnosresidentes'][$i]['alumno'] ?></td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</td>
					<td>
						<div>Artículos científicos en revistas indizadas enviados: <span><?= ($resultado['ProfesoresColaboradores']['entregables']['prodacademica'][0]['artRevistaIndizadas'] != null)? $resultado['ProfesoresColaboradores']['entregables']['prodacademica'][0]['artRevistaIndizadas'] : ''; ?></span></div>
						<div>Artículos científicos en revistas arbitradas enviados:<span><?= ($resultado['ProfesoresColaboradores']['entregables']['prodacademica'][0]['artRevistArbitrada'] != null)? $resultado['ProfesoresColaboradores']['entregables']['prodacademica'][0]['artRevistArbitrada'] : ''; ?></span></div>
						<div>Artículos de divulgación enviados: <span><?= ($resultado['ProfesoresColaboradores']['entregables']['prodacademica'][0]['artDivulgacion'] != null)? $resultado['ProfesoresColaboradores']['entregables']['prodacademica'][0]['artDivulgacion'] : ''; ?></span></div>
						<div>Artículos en memorias en congreso enviados: <span><?= ($resultado['ProfesoresColaboradores']['entregables']['prodacademica'][0]['artMemoria'] != null)? $resultado['ProfesoresColaboradores']['entregables']['prodacademica'][0]['artMemoria'] : ''; ?></span></div>
						<div>Memorias en extenso en congresos: <span><?= ($resultado['ProfesoresColaboradores']['entregables']['prodacademica'][0]['memoriaCongreso'] != null)? $resultado['ProfesoresColaboradores']['entregables']['prodacademica'][0]['memoriaCongreso'] : ''; ?></span></div>
						<div>Capítulos de libros enviados para revisión: <span><?= ($resultado['ProfesoresColaboradores']['entregables']['prodacademica'][0]['capLibroRevision'] != null)? $resultado['ProfesoresColaboradores']['entregables']['prodacademica'][0]['capLibroRevision'] : ''; ?></span></div>
						<div>Libros enviados para revisión: <span><?= ($resultado['ProfesoresColaboradores']['entregables']['prodacademica'][0]['libroRevision'] != null)? $resultado['ProfesoresColaboradores']['entregables']['prodacademica'][0]['libroRevision'] : ''; ?></span></div>
						<div>Libros editados y publicados: <span><?= ($resultado['ProfesoresColaboradores']['entregables']['prodacademica'][0]['libroPublicado'] != null)? $resultado['ProfesoresColaboradores']['entregables']['prodacademica'][0]['libroPublicado'] : ''; ?></span></div>
						<div>Prototipos enviados para registro: <span><?= ($resultado['ProfesoresColaboradores']['entregables']['prodacademica'][0]['prototipoRegistro'] != null)? $resultado['ProfesoresColaboradores']['entregables']['prodacademica'][0]['prototipoRegistro'] : ''; ?></span></div>
						<div>Patentes enviadas para registro: <span><?= ($resultado['ProfesoresColaboradores']['entregables']['prodacademica'][0]['patenteRegistro'] != null)? $resultado['ProfesoresColaboradores']['entregables']['prodacademica'][0]['patenteRegistro'] : ''; ?></span></div>
						<div>Paquetes tecnológicos enviados para registro: <span><?= ($resultado['ProfesoresColaboradores']['entregables']['prodacademica'][0]['pqtRegistro'] != null)? $resultado['ProfesoresColaboradores']['entregables']['prodacademica'][0]['pqtRegistro'] : ''; ?></span></div>
						<div>Otros (especifique):<span><?= ($resultado['ProfesoresColaboradores']['entregables']['prodacademica'][0]['otros'] != null)? $resultado['ProfesoresColaboradores']['entregables']['prodacademica'][0]['otros'] : ''; ?></span></div>						
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="col-12 col-sm-12 col-md-12">
		<table class="table table-bordered tablasPrint">
			<thead class="thead-dark">
				<tr>
					<th colspan="2" style="text-align: center;">EL DESARROLLO DEL PROYECTO REQUIERE FINANCIAMIENTO</th>
				</tr>
				<tr>
					<th style="text-align: center;">
						<div class="form-check" style="margin: auto;">Si <span>(<?= ($resultado['ProfesoresColaboradores'][2]['requiereFinanciamiento'] == '1')?
								'X' : ''; ?>)</span></div>
					</th>
					<th style="text-align: center;">
						<div class="form-check" style="margin: auto;">No <span>(<?= ($resultado['ProfesoresColaboradores'][2]['requiereFinanciamiento'] == '2')?
								'X' : ''; ?>)</span></div>
					</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td colspan="2">
						<div >FUENTE DE FINANCIAMIENTO: <span><?= ($resultado['ProfesoresColaboradores'][2]['fuenteFinanciamiento'] != null)? $resultado['ProfesoresColaboradores'][2]['fuenteFinanciamiento'] : ''; ?></span></div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="col-12 col-sm-12 col-md-12">
		<h3 class=" col-12 col-sm-12 col-md-12" style="margin-top: 30px;" align="center">Programa de actividades</h3>
		<table id="tableProgramActividades" class="table table-bordered tablasPrint">
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
			<tbody>

				<?php for ($i=0; $i < count( $resultado['ProgramaDeActividades']['actividades'] ) ; $i++) { ?>
					<tr>
						<td class="count" >1</td>
						<td><div name="txtNomResponAct"><?= $resultado['ProgramaDeActividades']['actividades'][$i]['nombreResponsable'] ?></div></td>
						<td><div name="txtActividad"><?= $resultado['ProgramaDeActividades']['actividades'][$i]['actividad'] ?></div></td>
						<td><div name="txtPeriodoActiv"><?= $resultado['ProgramaDeActividades']['actividades'][$i]['periodo'] ?></div></td>
						<td><div name="txtResultEntregables"><?= $resultado['ProgramaDeActividades']['actividades'][$i]['resultados'] ?></div></td>
						<td><div name="txtPartidasSol"><?= $resultado['ProgramaDeActividades']['actividades'][$i]['partidaSolicitadas'] ?></div></td>
						<td><div name="txtMontoSolicitadoActiv"><?= $resultado['ProgramaDeActividades']['actividades'][$i]['montoSolicitado'] ?></div></td>
						<td><div name="txtDesBienes"><?= $resultado['ProgramaDeActividades']['actividades'][$i]['descripcionBienes'] ?></div></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
		<div class="col-12 col-sm-12 col-md-12">
			<h6 style="text-align: center;">Nota: En caso de que el desarrollo del proyecto requiera financiamiento o apoyo complementarios llenar la tabla siguiente basada en el clasificador por objeto y tipo de gasto para la administración pública del estado de Jalisco.</h6>
		</div>
		<div class="col-12 col-sm-12 col-md-12">
			<h3 style="text-align: center;">Concentrado del presupuesto solicitado</h3>
		</div>
		<div class="col-12 col-sm-12 col-md-12">
			<table id="tablePresupSolicitado" class="table table-bordered tablasPrint">
				<thead class="thead-dark">
					<tr>
						<th>Concepto</th>
						<th>Monto Solicitado a la DGEST</th>
						<th>Monto a otorgar por el Tecnológico </th>
						<th>Monto a otorgar por otras instituciones</th>
						<th>TOTAL</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Materiales y suministros</td>
						<td><div  name="txtMaterialesMontoDgest"><span><?= ($resultado['ProgramaDeActividades'][0]['montoSolicitadoMateriales'] != null)? $resultado['ProgramaDeActividades'][0]['montoSolicitadoMateriales'] : ''; ?></span></div></td>
						<td><div  name="txtMaterialesMontOtorgarTec"><span><?= ($resultado['ProgramaDeActividades'][0]['montoOtorgadoTecMateriales'] != null)? $resultado['ProgramaDeActividades'][0]['montoOtorgadoTecMateriales'] : ''; ?></span></div></td>
						<td><div  name="txtMaterialesMontOtrasInst"><span><?= ($resultado['ProgramaDeActividades'][0]['montoOtorgadoInstitucionesMateriales'] != null)? $resultado['ProgramaDeActividades'][0]['montoOtorgadoInstitucionesMateriales'] : ''; ?></span></div></td>
						<td><div  name="txtMaterialesTotal"><span><?= ($resultado['ProgramaDeActividades'][0]['totalMateriales'] != null)? $resultado['ProgramaDeActividades'][0]['totalMateriales'] : ''; ?></span></div></td>
					</tr>
					<tr>
						<td>Servicios generales</td>
						<td><div  name="txtServiciosMontoDgest"><span><?= ($resultado['ProgramaDeActividades'][0]['montoSolicitadoServicios'] != null)? $resultado['ProgramaDeActividades'][0]['montoSolicitadoServicios'] : ''; ?></span></div></td>
						<td><div  name="txtServiciosMontOtorgarTec"><span><?= ($resultado['ProgramaDeActividades'][0]['montoOtorgadoTecServicios'] != null)? $resultado['ProgramaDeActividades'][0]['montoOtorgadoTecServicios'] : ''; ?></span></div></td>
						<td><div  name="txtServiciosMontOtrasInst"><span><?= ($resultado['ProgramaDeActividades'][0]['montoOtorgadoInstitucionesServicios'] != null)? $resultado['ProgramaDeActividades'][0]['montoOtorgadoInstitucionesServicios'] : ''; ?></span></div></td>
						<td><div  name="txtServiciosTotal"><span><?= ($resultado['ProgramaDeActividades'][0]['totalServicios'] != null)? $resultado['ProgramaDeActividades'][0]['totalServicios'] : ''; ?></span></div></td>
					</tr>
					<tr>
						<td>TOTAL</td>
						<td><div  name="txtTotalMontoDgest"><span><?= ($resultado['ProgramaDeActividades'][0]['totalMontoSolicitado'] != null)? $resultado['ProgramaDeActividades'][0]['totalMontoSolicitado'] : ''; ?></span></div></td>
						<td><div  name="txtTotalMontOtorgarTec"><span><?= ($resultado['ProgramaDeActividades'][0]['totalMontoOtorgadoTec'] != null)? $resultado['ProgramaDeActividades'][0]['totalMontoOtorgadoTec'] : ''; ?></span></div></td>
						<td><div  name="txtTotalMontOtrasInst"><span><?= ($resultado['ProgramaDeActividades'][0]['totalMontoOtorgadoInstituciones'] != null)? $resultado['ProgramaDeActividades'][0]['totalMontoOtorgadoInstituciones'] : ''; ?></span></div></td>
						<td><div  name="txtTotalDeTotales"><span><?= ($resultado['ProgramaDeActividades'][0]['total'] != null)? $resultado['ProgramaDeActividades'][0]['total'] : ''; ?></span></div></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="col-12 col-sm-12 col-md-12 border border-dark">
		<div class="row">
			<div class="col-6 col-sm-6 col-md-6 border border-dark">
				<h6 style="text-align: center;">Profesor-Investigador Responsable</h6>
				<h6 style="text-align: center; margin-top: 100px;">Nombre y Firma</h6>
			</div>
			<div class="col-6 col-sm-6 col-md-6 border border-dark">
				<h6 style="text-align: center;">Presidente del Comité de Investigación del TecMM</h6>
				<h6 style="text-align: center;margin-top: 70px;">Mtro. Luis Escobar Hernández</h6>
				<h6 style="text-align: center;">Nombre y Firma</h6>
			</div>
		</div>
	</div>
</div>