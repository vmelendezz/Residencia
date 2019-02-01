<?php

if(isset($_POST["view"]))
{
    include("connect.php");
    $query = "SELECT * FROM notifications ORDER BY id DESC";
    $result = mysqli_query($connect, $query);
    $resultado = '';
    // si hay datos encontrados
    if (mysqli_num_rows($result) > 0) 
    {
        // se recorre todo el arreglo obtenido para retornar los datos para las cards
        while ($row = mysqli_fetch_array($result))
        {
            // todo esto es lo que retorna a ajax
            $resultado .= 
            '
            <div class="col-md-3">
            <div class="card card-inverse card-primary text-center">
            <div class="card-block">
                <h4 class="card-title">' . $row["titulo"] . '</h4>
                <p class="card-text">' . $row["descripcion"] .'</p>
                <button type="button" class="btn btn-primary" data-toggle="modal" id=' . $row["id"] .' data-target="#modal_detalles">
                Leer más.                                
                </button>
            </div>
            </div>
            </div>            
            ';
        }    
    }
    else
    {
        $resultado .= '<li><a href="#" class="text-bold text-italic">No se encontraron tickets</a></li>';
    }
    $data = array
    (
        'list' => $resultado
    );
    echo json_encode($data);
}
?>