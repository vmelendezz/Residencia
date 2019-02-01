<?php  
	include("connect.php");
	$resultado = '';
	if (isset($_POST["query"]))
	{
		// $search = mysql_real_escape_string($connect, $_POST["query"]);
		$search = $_POST["query"];
		$query = 
		"Select * from usuarios where
			correo like '%" . $search . "%' 
			or nombre like '%" . $search . "%'
		";
	}
	else
	{
		$query = "Select * from usuarios order by idUsuarios desc";
	}

	$result = mysqli_query($connect, $query);
	if(mysqli_num_rows($result) > 0)
	{
		while ($row = mysqli_fetch_array($result))
		{	
			$resultado .= 
            '
            <div class="col-md-3">
            <div class="card card-inverse card-primary text-center">
            <div class="card-block">
            <h4 class="card-text">Nombre: ' . $row["nombre"] .'</h4>
                <h3 class="card-title">Correo: ' . $row["correo"] . '</h3>
                <button type="button" class="btn btn-primary" data-toggle="modal" id=' . $row["idUsuarios"] .' data-target="#modal_detalles">
                Más información.                                
                </button>
            </div>
            </div>
            </div>            
            ';
		// $datos = array
	 //    (
	 //        'list' => $resultado
	 //    );
	    // echo json_encode($datos);
	    	echo $resultado;
	    }
   }
	else
	{
		echo '<div class="col-md-3"><p>     No se encontraron cards</p></div>';

	}

?>