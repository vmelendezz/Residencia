<?php
//fetch.php;
if (isset($_POST["view"])) 
{
    include("connect.php");
    if ($_POST["view"] != '') {
        $update_query = "UPDATE notifications SET leido=1 WHERE leido=0";
        mysqli_query($connect, $update_query);
    }
    $query = "SELECT * FROM notifications ORDER BY id DESC";
    $result = mysqli_query($connect, $query);
    $output = '';

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $output .= '
    <div class="notificacion" id="notificacion">
   <li>
    <a href="#">
     <strong>' . $row["titulo"] . '</strong><br />
     <small><p class="text-justify">' . $row["descripcion"] . '</p></small>
    </a>
   </li>
   </div>
   <li role="separator" class="divider"></li>
   ';
        }
    } else {
        $output .= '<li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
    }

    $query_1 = "SELECT * FROM notifications WHERE leido=0";
    $result_1 = mysqli_query($connect, $query_1);
    $count = mysqli_num_rows($result_1);
    $data = array(
        'notification' => $output,
        'unseen_notification' => $count
    );
    echo json_encode($data);
}
?>