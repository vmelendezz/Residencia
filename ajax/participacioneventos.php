<?php

if(strlen(session_id())<1)
session_start();

require_once "../models/participacioneventos.php";

$eventos = new ParticipacionEventos();

$idUsuario=$_SESSION['idusuario'];

$evento=isset($_POST["evento"])? limpiarCadena($_POST["evento"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$fecha=isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";

$participacion=isset($_POST["participacion"])? limpiarCadena($_POST["participacion"]):"";

$cvu=isset($_POST["cvu"])? limpiarCadena($_POST["cvu"]):"";






switch ($_GET["op"]){

    case 'guardaryeditar':
        if(empty($id_tecnico)){
           $respuesta=$eventos->insertar($idUsuario,$cvu,$nombre,$fecha,$participacion);
           echo $respuesta ? "Registrado" : "Error al registrar" ;
        }
        else{
            $respuesta=$eventos->editar($idUsuario,$evento,$nombre,$fecha,$participacion);
            echo $respuesta ? "Registrado modificado" : "Error al modificar" ;

        }

    break;

    case 'mostrar':
            $respuesta=$eventos->mostrar($evento);
            echo json_encode($respuesta);
    break;

    case 'borrar':
            $respuesta=$eventos->borrar($evento);
            echo $respuesta ? "borrado" : "error al borrar" ;
            

    break;

    case 'listar':
            $respuesta=$eventos->listar($idUsuario);
            $data= Array();
            while ($reg=$respuesta->fetch_object()){
                $data[]=array(
                    "0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->idParticipacionEventos.')"><i class="fa fa-pencil"></i></button>'.
                    ' <button class="btn btn-danger" onclick="borrar('.$reg->idParticipacionEventos.')"><i class="fa fa-close"></i></button>',
                                    
                     "1"=>$reg->nombre,
                     "2"=>$reg->fecha);
                
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