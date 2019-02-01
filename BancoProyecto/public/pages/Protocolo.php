
<!-- contenido de la pagina 7.5.1 pero solo las secciones sin el contenido de los formularios-->
	<div class="container">

		<h1 class="title-1" style="margin-top: 30px;" align="center">PROTOCOLO DE INVESTIGACIÓN (CI-02/2018)</h1>
		<div class="col-12 col-md-12 col-sm-12" align="right">
			<button id="cleanForm" type="button" class="btn btn-info">Limpiar campos</button>
		</div>
		<!-- es el contenido visual de la pagina con estilos de bootstrap, el cual secciona el contenido del formulario -->
		<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style="">
			<li class="nav-item">
				<a class="nav-link active" id="tabDescripProyect" data-toggle="pill" href="#DesProyecto" role="tab" aria-controls="pills-home" aria-selected="true">Descripción del proyecto</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="tabObjetivos" data-toggle="pill" href="#ObjProyecto" role="tab" aria-controls="pills-profile" aria-selected="false">Objetivos del Proyecto</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="tabDatosEmpresa" data-toggle="pill" href="#DatosEmpresa" role="tab" aria-controls="pills-profile" aria-selected="false">Datos de la Empresa</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="tabLugarInfra" data-toggle="pill" href="#LugarInfra" role="tab" aria-controls="pills-profile" aria-selected="false">Lugar e Infraestructura</a>
			</li>
		</ul>
		<!-- el href de tablist debe coincidir con el id de tabContent -->
		<div class="tab-content" id="pills-tabContent">
			<div class="tab-pane fade show active" id="DesProyecto" role="tabpanel" aria-labelledby="pills-home-tab"></div>
			<div class="tab-pane fade" id="ObjProyecto" role="tabpanel" aria-labelledby="pills-profile-tab"></div>
			<div class="tab-pane fade show" id="DatosEmpresa" role="tabpanel" aria-labelledby="pills-home-tab"></div>
			<div class="tab-pane fade" id="LugarInfra" role="tabpanel" aria-labelledby="pills-profile-tab"></div>
		</div>
	</div>
	<!-- alerta para mostrar los errores, los estilos estan en la carpeta css-->
	<div class="alert alert-danger" role="alert" style="display: none;">
	  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
	  <span class="sr-only">Error:</span>
	  <span id="erroresForm"></span>
	</div>
