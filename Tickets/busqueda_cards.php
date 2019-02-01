<?php 
	include("connect.php");
	$resultado = '';
	if (isset($_POST["query"]))
	{
		// $search = mysql_real_escape_string($connect, $_POST["query"]);
		$search = $_POST["query"];
		$query = 
		"Select * from notifications where
			titulo like '%" . $search . "%' 
			or descripcion like '%" . $search . "%'
		";
	}
	else
	{
		$query = "Select * from notifications order by id desc";
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
                <h4 class="card-title">' . $row["titulo"] . '</h4>
                <p class="card-text">' . $row["descripcion"] .'</p>
                <a href="#" class="btn btn-primary" id="' . $row["id"] .'">Leer más</a>
            </div>
            </div>
            </div>            
            ';
        }
		// $datos = array
	 //    (
	 //        'list' => $resultado
	 //    );
	    // echo json_encode($datos);
	    echo $resultado;
	}
	else
	{
		echo '<div class="col-md-3"><p>     No se encontraron cards</p></div>';

	}

?>