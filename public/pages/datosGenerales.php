<!DOCTYPE html>
<html lang="en">
<?php 
	include('../static/head.php');
?>
<body>
	<div class="container">
		<form>
			<h1>Datos generales</h1>
			<div class="row">
				<div class="col-12 col-sm-6 col-md-4">
					<div class="form-group">
						<label for="CURP">CURP*:</label>
						<input type="text" class="form-control" placeholder="Ingresa tu CURP" id="CURP" name="curp">
					</div>
				</div>
				<div class="col-12 col-sm-6 col-md-4">
					<div class="form-group">
						<label for="NOMBRE">Nombre(s)*:</label>
						<input type="text" class="form-control" placeholder="Nombre" id="NOMBRE" name="nombre">
					</div>
				</div>
				<div class="col-12 col-sm-6 col-md-4">	
					<div class="form-group">
						<label for="PATERNO">Primer apellido*:</label>
						<input type="text" class="form-control" placeholder="Ingresa tu apellido paterno" id="PATERNO" name="paterno">
					</div>
				</div>
				<div class="col-12 col-sm-6 col-md-4">
					<div class="form-group">
						<label for="MATERNO">Segundo apellido*:</label>
						<input type="text" class="form-control" placeholder="Ingresa tu apellido materno" id="MATERNO" name="materno">
					</div>
				</div>
				<div class="col-12 col-sm-6 col-md-4">
					<div class="form-group">
						<label for="FNACIMIENTO">Fecha de nacimiento*:</label>
						<input type="text" class="form-control" placeholder="DD/MM/AA" id="FNACIMIENTO" name="fnacimiento">
					</div>
				</div>
				<div class="col-12 col-sm-6 col-md-4">
					<div class="form-group">
						<label for="SEXO">Sexo*:</label>
						<select class="form-control">
							<option>Masculino</option>
							<option>Femenino</option>
						</select>
					</div>
				</div>
				<div class="col-12 col-sm-6 col-md-4">
					<div class="form-group">
						<label for="PAIS">País de nacimiento*:</label>
						<select class="form-control">
							<option value="MEX">México</option>
						</select>
					</div>
				</div>
				<div class="col-12 col-sm-6 col-md-4">
					<div class="form-group">
						<label for="EFEDERATIVA">Entidad federativa*:</label>
						<select class="form-control">
							<option value="JAL">Jalisco</option>
						</select>
					</div>
				</div>
				<div class="col-12 col-sm-6 col-md-4">
					<div class="form-group">
						<label for="RFC">RFC*:</label>
						<input type="text" class="form-control" placeholder="Clave RFC" id="RFC" name="rfc">
					</div>
				</div>
				<div class="col-12 col-sm-6 col-md-4">
					<div class="form-group">
						<label for="ECONYUGAL">Estado conyugal*:</label>
						<select class="form-control">
							<option value="1">Casado</option>
						</select>
					</div>
				</div>
				<div class="col-12 col-sm-6 col-md-4">
					<div class="form-group">
						<label for="NACIONALIDAD">Nacionalidad*:</label>
						<select class="form-control">
							<option value="MEXICANA">Mexicana</option>
						</select>
					</div>
				</div>
				<div class="col-12 col-sm-6 col-md-4">
					<div class="form-group">
						<label for="NCVU">Número de CVU*:</label>
						<input type="text" class="form-control" placeholder="Número de CVU" id="NCVU" name="ncvu">
					</div>
				</div>
			</div>
		</form>
	</div>	
	
<?php 
	include('../static/head.php');
?>
</body>
</html>