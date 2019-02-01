<?php


if(isset($_POST["view"])) 
{
   
        //inicia la conexión a la base de datos
        $conexion = new PDO('mysql:host=localhost;dbname=pcicz', 'root', '123');
        //Cambiar las opciones de pdo para que muestre errores de mysql y no continue la ejecución
        // si está mal la sintaxis de la consulta
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        // consulta a ejecutar en la base de datos
        $consulta = "SELECT * FROM notifications ORDER BY id DESC limit 10";
        // preparamos la consulta
        $statement = $conexion->prepare($consulta);
        // ejecutamos la consulta 
        $statement->execute();
        // guardamos los resultados obtenidos 
        $resultado = $statement->fetchAll();
        $salida = '';
        // si no hay elementos en la base de notificaciones
        if(!empty($resultado))
        {
        while ($row = mysqli_fetch_array($resultado))
        {
                $salida = '
                <li>
                 <a href="#">
                  <strong>'.$result["titulo"].'</strong><br />
                  <small><em>'.$result["descripcion"].'</em></small>
                 </a>
                </li>
                <li class="divider"></li>
                ';                                
        }
        }
        else
        {
            $salida .= '<li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
        }

        // contar el numero de notificaciones sin leer 
        $consulta = "SELECT count(*) FROM notifications where leido = 0";   
        $statement = $conexion->prepare($consulta);
        $statement->execute();
        $number_of_rows = $statement->fetchColumn();
        $data = array
        (
        'notification' => $salida,
        'unseen_notification' => $number_of_rows
        );     
        // enviar los datos a ajax en formato json
        echo json_encode($data);
}
?>