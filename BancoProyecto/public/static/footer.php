<footer>
	<div style="background: #282a2b;" >
		<div class="container">
			<div class="row">	
				<div class="col-3 col-sm-3 col-md-3">
					<div class="form-group">
						<span><img src="/BancoProyecto/public/imagenes/sep.png"></span>
					</div>
				</div>
				<div class="col-3 col-sm-3 col-md-3">
					<div class="form-group">
						<span><img src="/BancoProyecto/public/imagenes/Jal.png"></span>
					</div>
				</div>
				<div class="col-3 col-sm-3 col-md-3">
					<div class="form-group">
						<span><img src="/BancoProyecto/public/imagenes/TecNM.png"></span>
					</div>
				</div>
				<div class="col-3 col-sm-3 col-md-3">
					<div class="form-group">
						<span><img src="/BancoProyecto/public/imagenes/TecMM.png"></span>
					</div>
				</div>
				<div class="textwidget" style="color: white">
						Camino Arenero No.1101
						<br>Col. El Bajío C.P. 45019, Zapopan Jalisco.
						<br>Tels: 36821180 - 36821182 - 31102129
						<br>Lada sin costo: 01 800 888 ITSZ (4879)
						<br>Email: itsdz@itszapopan.edu.mx
				</div>
			</div>
		</div>
	</div>
</footer>

			
<!-- footer 7.7.1 -->
		<script src="/BancoProyecto/public/js/underscore-min.js"></script>
		<script src="/BancoProyecto/public/js/backbone-min.js"></script>
		<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>-->
		<script src="/BancoProyecto/public/libraries/bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>
	
		<?php
		//7.7.1 si existe alguna cadena almacenada en infoFile['footer'] entonces ¿¿¿corroborar
		if (isset( $this->infoFile['footer'])) {
			// recorro los archivos almacenados en la posición footer ¿¿¿corroborar
			for ($i=0; $i < count(  $this->infoFile['footer'] ); $i++) { 
				echo '<script src="'.$this->infoFile['footer'][$i].'"></script>';
			}
		}
		 ?>
<!-- footer -->
	</body>
</html>