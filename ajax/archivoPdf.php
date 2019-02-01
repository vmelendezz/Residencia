<?php


if(strlen(session_id())<1)
session_start();

require_once "../models/ArchivoPdf.php";

$datos = new ArchivotecmmPDf();

$idUsuario=$_SESSION['idusuario'];

switch ($_GET["op"]){

    case 'generales':
            $respuesta=$datos->datosGEnerales($idUsuario);
            echo json_encode($respuesta);
    break;

}

?>