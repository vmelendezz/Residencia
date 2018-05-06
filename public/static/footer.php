<!-- footer 7.7.1 -->
		<script src="/public/js/jquery-3.3.1.min.js"></script>
		<script src="/public/js/underscore-min.js"></script>
		<script src="/public/js/backbone-min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="/public/libraries/bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>
	
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