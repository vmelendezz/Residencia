<?php

if(strlen(session_id())<1)
session_start();

require_once "../models/participacionactualizacionprogeducativo.php";

$partiproedu = new ParticipacionActualizacionProgramaeducativo();

$idUsuario=$_SESSION['idusuario'];


$participacion=isset($_POST["participacion"])? limpiarCadena($_POST["participacion"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$gradoIntervencion=isset($_POST["gradoIntervencion"])? limpiarCadena($_POST["gradoIntervencion"]):"";
$fechaImplementacion=isset($_POST["fechaImplementacion"])? limpiarCadena($_POST["fechaImplementacion"]):"";
$archivo=isset($_POST["archivo"])? limpiarCadena($_POST["archivo"]):"";

$cvu=isset($_POST["cvu"])? limpiarCadena($_POST["cvu"]):"";






switch ($_GET["op"]){

    case 'guardaryeditar':
        if(empty($participacion)){
           $respuesta=$partiproedu->insertar($idUsuario,$cvu,$nombre,$gradoIntervencion,$fechaImplementacion,$archivo);
           echo $respuesta ? "Registrado" : "Error al registrar" ;
        }
        else{
            $respuesta=$partiproedu->editar($participacion,$idUsuario,$nombre,$gradoIntervencion,$fechaImplementacion,$archivo);
            echo $respuesta ? "Registrado modificado" : "Error al modificar" ;

        }

    break;

    case 'mostrar':
            $respuesta=$partiproedu->mostrar($participacion);
            echo json_encode($respuesta);
    break;

    case 'borrar':
            $respuesta=$partiproedu->borrar($participacion);
            echo $respuesta ? "borrado" : "error al borrar" ;
            

    break;

    case 'listar':
            $respuesta=$partiproedu->listar($idUsuario);
            $data= Array();
            while ($reg=$respuesta->fetch_object()){
                $data[]=array(
                    "0"=>'<button class="btn btn-default" onclick="mostrar('.$reg->idparti.')"><i class="fa fa-pencil"></i></button>'.
                    ' <button class="btn btn-default" onclick="borrar('.$reg->idparti.')"><i class="fa fa-trash-o"></i></button>',
                                    
                     "1"=>$reg->nombre,
                     "2"=>$reg->gradoIntervencion,
                     "3"=>$reg->fechaImplementacion);
                
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