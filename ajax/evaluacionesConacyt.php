<?php

if(strlen(session_id())<1)
session_start();


require_once "../models/EvaluacionesConacyt.php";

$evaluaConacyt = new Evaluacionconacyt();

$idUsuario=$_SESSION['idusuario'];
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";

$conacyt=isset($_POST["conacyt"])? limpiarCadena($_POST["conacyt"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$asignacion=isset($_POST["asignacion"])? limpiarCadena($_POST["asignacion"]):"";
$aceptacion=isset($_POST["aceptacion"])? limpiarCadena($_POST["aceptacion"]):"";
$evaluacion=isset($_POST["evaluacion"])? limpiarCadena($_POST["evaluacion"]):"";
$dictamen=isset($_POST["dictamen"])? limpiarCadena($_POST["dictamen"]):"";
$cvu=isset($_POST["cvu"])? limpiarCadena($_POST["cvu"]):"";






switch ($_GET["op"]){

    case 'guardaryeditar':
        if(empty($conacyt)){
           $respuesta=$evaluaConacyt->insertar($idUsuario,$cvu,$nombre,$asignacion,$aceptacion,$evaluacion,$descripcion,$dictamen);
           echo $respuesta ? "Registrado" : "Error al registrar" ;
        }
        else{
            $respuesta=$evaluaConacyt->editar($idUsuario,$conacyt,$nombre,$asignacion,$aceptacion,$evaluacion,$descripcion,$dictamen);
            echo $respuesta ? "Registrado modificado" : "Error al modificar" ;

        }

    break;

    case 'mostrar':
            $respuesta=$evaluaConacyt->mostrar($conacyt);
            echo json_encode($respuesta);
    break;

    case 'borrar':
            $respuesta=$evaluaConacyt->borrar($conacyt);
            echo $respuesta ? "borrado" : "error al borrar" ;
            

    break;

    case 'listar':
            $respuesta=$evaluaConacyt->listar($idUsuario);
            $data= Array();
            while ($reg=$respuesta->fetch_object()){
                $data[]=array(
                    "0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->idEvaluacionConacyt.')"><i class="fa fa-pencil"></i></button>'.
                    ' <button class="btn btn-danger" onclick="borrar('.$reg->idEvaluacionConacyt.')"><i class="fa fa-close"></i></button>',
                                    
                     "1"=>$reg->nombre,
                     "2"=>$reg->fechaAsignacion,
                     "3"=>$reg->fechaAceptacion,
                     "4"=>$reg->fechaEvaluacion,
                     "5"=>$reg->ditamenNombre);
                
            }
            $results = array(
                "sEcho"=>1, //Información para el datatables
                "iTotalRecords"=>count($data), //enviamos el total registros al datatable
                "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
                "aaData"=>$data);
            echo json_encode($results);
    break;

}
?>