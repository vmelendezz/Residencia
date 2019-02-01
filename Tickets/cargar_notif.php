<?php
// si se mando una solicitud para cargar la vista
if (isset($_POST["view"])) 
{
    include("connect.php");
    // si el atributo view contiene notificaciones sin leer, se cambian a 0 para confirmar la lectura
    if ($_POST["view"] != '') 
    {
        $update_query = "UPDATE notifications SET leido=1 WHERE leido=0";
        mysqli_query($connect, $update_query);
    }
    // se obtienen todas las notificaciones de la base de datos ordenandolas por las más nuevas
    $query = "SELECT * FROM notifications ORDER BY id DESC";
    // se ejecuta la consulta
    $result = mysqli_query($connect, $query);
    // la variable salida es utilizada para mandar los datos a un arreglo 
    $output = '';
    // si se encuentra más de una fila, es por que sí hay datos
    if (mysqli_num_rows($result) > 0) 
    {
        // se recorre todo el arreglo obtenido para retornar los datos para la barra
        while ($row = mysqli_fetch_array($result)) {
            $output .= '
    <div class="notificacion" id="notificacion">
   <li>
    <a href="#">
     <strong>' . $row["titulo"] . '</strong><br />
     <div>
     <small><p class="text-justify">' . $row["descripcion"] . '</p></small>
     </div>
    </a>
   </li> 
   </div>
   <li role="separator" class="divider"></li>
   ';
        }
    } else {
        $output .= '<li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
    }
    // obtner el numero de notificaciones sin leer
    $query_1 = "SELECT * FROM notifications WHERE leido=0";
    $result_1 = mysqli_query($connect, $query_1);
    $count = mysqli_num_rows($result_1);
    // crear el arreglo para convertirlo a json y retornarlo
    $data = array(
        'notification' => $output,
        'unseen_notification' => $count
    );
    echo json_encode($data);
}
?>