<?php 

class Templates
{ 
	//variables globales
	public $infoFile = null;
	//7.1 creo un metodo que recibe como parametro archivo que contiene los de infoFile porque cuando declaramos la instancia del objeto Templates en index.php mandamos como parametro infoRute que contiene todo lo de infoFile.
	function __construct($archivo)
	{
		//7.2 se guarda el contenido en una variable llamada infoFile para poderla utilizar en todo nuestro archivo
		$this->infoFile = $archivo;
		//7.3 se ejecuta el metodo
		$this->chargeFile ();
	}

	function chargeFile ()
	{
		//head 7.4 me voy al archivo
		include ('./public/static/head.php');

		//main (contenido de la pagina)
		//7.5 se manda llamar lo que tiene infoPage en la posición rute, me voy a rute
		include ( $this->infoFile['rute'] );
		//mando llamar files que necesita el template
		// 7.6 se recorren todos los archivos guardados en la posicion files
		for ($i=0; $i < count(  $this->infoFile['files'] ); $i++) { 
			//7.6.1 se cargan los archivos guardados en la posicion files
			include ( $this->infoFile['files'][$i] );
		}
		//footer 7.7 me voy al archivo
		include ('./public/static/footer.php');
	}
}
 ?>