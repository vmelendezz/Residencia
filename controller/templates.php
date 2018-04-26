<?php 

class Templates
{
	public $infoFile = null;
	function __construct($archivo)
	{
		$this->infoFile = $archivo;
		$this->chargeFile ();
	}

	function chargeFile ()
	{
		include ('./public/static/head.php');
		include ( $this->infoFile['rute'] );

		for ($i=0; $i < count(  $this->infoFile['files'] ); $i++) { 
			include ( $this->infoFile['files'][$i] );
		}
		
		include ('./public/static/footer.php');
	}
}
 ?>