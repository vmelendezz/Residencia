
<!-- contenido de la pagina 7.5.1 pero solo las secciones sin el contenido de los formularios-->
	<div class="container">
		
		<h1 class="title-1" style="margin-top: 30px;" align="center">FORMATO CONCENTRADOR DE SOLICITUD DE APOYO (CI-01/2018)</h1>
		<h5>Antes de proporcionar la información solicitada, lea cuidadosamente cada uno de los rubros que contiene la presente solicitud, ya que en caso de presentarse incompleta, será rechazada.</h3>
		<div class="col-12 col-md-12 col-sm-12" align="right">
			<button id="cleanForm" type="button" class="btn btn-info">Limpiar campos</button>
		</div>
		<!-- es el contenido visual de la pagina con estilos de bootstrap, el cual secciona el contenido del formulario -->
		<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" id="tabInfoGeneral" data-toggle="pill" href="#info-general" role="tab" aria-controls="pills-home" aria-selected="true">Información general</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="tabModProyecto" data-toggle="pill" href="#Modalidad-del-proyecto" role="tab" aria-controls="pills-profile" aria-selected="false">Modalidad del Proyecto</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="tabPofCol" data-toggle="pill" href="#ColaboradoresP" role="tab" aria-controls="pills-profile" aria-selected="false">Profesores Colaboradores del proyecto</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="tabPrograma" data-toggle="pill" href="#Concentrado" role="tab" aria-controls="pills-profile" aria-selected="false">Programa de actividades</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="tabPlanTrabajo" data-toggle="pill" href="#PlanDeTrabajo" role="tab" aria-controls="pills-profile" aria-selected="false">Plan de trabajo</a>
			</li>
		</ul>
		<!-- el href de tablist debe coincidir con el id de tabContent -->
		<div class="tab-content" id="pills-tabContent">
			<div class="tab-pane fade show active" id="info-general" role="tabpanel" aria-labelledby="pills-home-tab"></div>
			<div class="tab-pane fade" id="Modalidad-del-proyecto" role="tabpanel" aria-labelledby="pills-profile-tab"></div>
			<div class="tab-pane fade show" id="ColaboradoresP" role="tabpanel" aria-labelledby="pills-home-tab"></div>
			<div class="tab-pane fade" id="Concentrado" role="tabpanel" aria-labelledby="pills-profile-tab"></div>
			<div class="tab-pane fade" id="PlanDeTrabajo" role="tabpanel" aria-labelledby="pills-profile-tab"></div>
		</div>
	</div>
	<!-- alerta para mostrar los errores, los estilos estan en la carpeta css-->
	<div class="alert alert-danger" role="alert" style="display: none;">
	  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
	  <span class="sr-only">Error:</span>
	  <span id="erroresForm"></span>
	</div>