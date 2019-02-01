<!-- head.php 7.4.1 -->
<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
			<link rel="stylesheet" href="/BancoProyecto/public/libraries/bootstrap-4.0.0/dist/css/bootstrap.min.css">
			<link rel="stylesheet" href="/BancoProyecto/public/css/style.css">
			<title><?php echo $this->infoFile['title']; ?></title>
			<script src="/BancoProyecto/public/js/jquery-3.3.1.min.js"></script>
		</head>
		<body>
		<nav class="navbar navbar-expand-lg navbar">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarText">
				<ul class="navbar-nav mr-auto">
					<div class="btn-group">
						<?php if( $_SESSION['tipoUSuario'] == '2'){ ?>
							<a href="/BancoProyecto/Convocatorias">
					  			<button type="button" class="btn btn-secondary">
					  				<a href="/BancoProyecto/Administrador">
								  		<li>
											Administrar Banco
										</li>
									</a>
							  	</button>
						  	</a>
					  	<?php } ?>
					  <!--<a href="/BancoProyecto/Convocatorias">
			  			<button type="button" class="btn btn-secondary">
					  		<li>
								Convocatorias
							</li>
					  	</button>
					  </a>-->
					  <a href="/BancoProyecto/ProyectosRegistrados">
						  <button type="button" class="btn btn-secondary">
						  	<li>
						  		Proyectos registrados
						  	</li>
						  </button>
					  </a>
					  <div class="btn-group">
					    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
					       Registrar proyecto
					    </button>
					    <div class="dropdown-menu">
					      <a class="dropdown-item active" href="/BancoProyecto/SolicitudApoyo">Solicitud de Apoyo</a>
					      <a class="dropdown-item active" href="/BancoProyecto/Protocolo"">Protocolo de investigación</a>
					    </div>
					  </div>
					</div>
				</ul>
			</div>
		</nav>
<!-- head.php -->