<?php

if(strlen(session_id())<1)
session_start();

require_once "../models/Infobasic.php";

$infrobasic = new InfoBasic();

$idUsuario=$_SESSION['idusuario'];

$cvu=isset($_POST["cvu"])? limpiarCadena($_POST["cvu"]):"";
$campus=isset($_POST["Campus"])? limpiarCadena($_POST["Campus"]):"";
$departamento=isset($_POST["departamento"])? limpiarCadena($_POST["departamento"]):"";


switch ($_GET["op"]){

    case 'guardaryeditar':
        if(empty($cvu)){

           $respuesta=$infrobasic->insertar($idUsuario,$campus,$departamento);
           echo $respuesta ? "Registrado" : "Error al registrar" ;
        }
        else{
            $respuesta=$infrobasic->editar($cvu,$campus,$departamento);
            echo $respuesta ? "Registrado modificado" : "Error al modificar" ;

        }

    break;

    case 'mostrar':
            $respuesta=$infrobasic->mostrar($idUsuario);
            echo json_encode($respuesta);
    break;


  

}
?>