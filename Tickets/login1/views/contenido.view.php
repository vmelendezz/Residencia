<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Dashboard</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Roboto:300,400,500" rel="stylesheet">
	<link rel="stylesheet" href="css/fontello.css">
	<link rel="stylesheet" href="css/estilos.css">
	<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
	<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="barra-lateral col-12 col-sm-auto">
				<div class="logo">
					<h2>Dashboard</h2>
				</div>
				<nav class="menu d-flex d-sm-block justify-content-center flex-wrap">
					<a href="#"><i class="icon-home"></i><span>Inicio</span></a>
					<a href="entradas.php"><i class="icon-doc-text"></i><span>Entradas</span></a> 
					<a href="#"><i class="icon-users"></i><span>Usuarios</span></a>
					<a href="#"><i class="icon-cog-alt"></i><span>Configuracion</span></a>
					<a href="cerrar.php"><i class="icon-logout"></i><span>Salir</span></a>
				</nav>
			</div>

			<main class="main col">
				<div class="row">
					<div class="columna col-lg-12">
						<div class="widget nueva_entrada">
							<h3 class="titulo">Nueva Entrada</h3>
							<form action="guardar.php" method="post" name ="contenido">
								<input type="text" placeholder="Titulo de la entrada" name ="titulo" id="titulo">
								<textarea name="contenido" id= "contenido" placeholder="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat."></textarea>
								<div class="d-flex justify-content-end">
								<input type="url" placeholder="Link con la información" name ="link" id="link">
								<!-- boton para guardar en la base de datos la entrada -->
									<button onclick="contenido.submit()"><i class="icon icon-edit"></i> Guardar</button>
								</div>
							</form>
						</div>
					</div>

					<div class="widget comentarios col-lg-12">
							<h3 class="titulo">Comentarios pendientes</h3>
							<div class="contenedor">
								<div class="comentario d-flex flex-wrap">
									<div class="foto">
										<a href="#">
											<img src="img/persona1.jpg" width="100" alt="">
										</a>
									</div>
									<div class="texto">
										<a href="#">Jhon Doe</a>
										<!-- usado para especificar comentarios en tickets -->
										<p>en <a href="#">Ticket Ejemplo</a></p>
										<p class="texto-comentario">
											Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis natus ex inventore provident modi id distinctio non minus, magni quia officiis, vel debitis doloremque ratione, consequuntur omnis hic voluptatem asperiores?
										</p>
									</div>
									<div class="botones d-flex justify-content-start flex-wrap w-100">
										<button class="aprobar"><i class="icono icon-ok"></i>Aprobar</button>
										<button class="eliminar"><i class="icono icon-cancel"></i>Eliminar</button>
										<!-- <button class="bloquear"><i class="icono icon-flag"></i>Bloquear Usuario</button> -->
									</div>
								</div>	

								<div class="comentario d-flex flex-wrap">
									<div class="foto">
										<a href="#">
											<img src="img/persona2.jpg" width="100" alt="">
										</a>
									</div>
									<div class="texto">
										<a href="#">Jhon Doe</a>
										<p>en <a href="#">Ticket Ejemplo</a></p>
										<p class="texto-comentario">
											Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis natus ex inventore provident modi id distinctio non minus, magni quia officiis, vel debitis doloremque ratione, consequuntur omnis hic voluptatem asperiores?
										</p>
									</div>
									<div class="botones d-flex justify-content-start flex-wrap w-100">
										<button class="aprobar"><i class="icono icon-ok"></i>Aprobar</button>
										<button class="eliminar"><i class="icono icon-cancel"></i>Eliminar</button>
										<!-- <button class="bloquear"><i class="icono icon-flag"></i>Bloquear Usuario</button> -->
									</div>
								</div>

								<div class="comentario d-flex flex-wrap">
									<div class="foto">
										<a href="#">
											<img src="img/persona3.jpg" width="100" alt="">
										</a>
									</div>
									<div class="texto">
										<a href="#">Jhon Doe</a>
										<p>en <a href="#">Ticket Ejemplo</a></p>
										<p class="texto-comentario">
											Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis natus ex inventore provident modi id distinctio non minus, magni quia officiis, vel debitis doloremque ratione, consequuntur omnis hic voluptatem asperiores?
										</p>
									</div>
									<div class="botones d-flex justify-content-start flex-wrap w-100">
										<button class="aprobar"><i class="icono icon-ok"></i>Aprobar</button>
										<button class="eliminar"><i class="icono icon-cancel"></i>Eliminar</button>
										<!-- <button class="bloquear"><i class="icono icon-flag"></i>Bloquear Usuario</button> -->
									</div>
								</div>				
							</div>
						</div>
					</div>
				</div>
			</main>
		</div>
	</div>
	
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>