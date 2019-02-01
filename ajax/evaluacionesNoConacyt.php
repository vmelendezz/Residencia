<?php

if(strlen(session_id())<1)
session_start();

require_once "../models/EvaluacionesNoConacyt.php";

$eveluanoconacyt = new EvalucionnoConacyt();

$idUsuario=$_SESSION['idusuario'];

$noConacyt=isset($_POST["noConacyt"])? limpiarCadena($_POST["noConacyt"]):"";
$institucion=isset($_POST["institucion"])? limpiarCadena($_POST["institucion"]):"";
$fechaInicio=isset($_POST["fechaInicio"])? limpiarCadena($_POST["fechaInicio"]):"";
$fechaFin=isset($_POST["fechaFin"])? limpiarCadena($_POST["fechaFin"]):"";
$cargo=isset($_POST["cargo"])? limpiarCadena($_POST["cargo"]):"";
$evaluacion=isset($_POST["evaluacion"])? limpiarCadena($_POST["evaluacion"]):"";
$dictamen=isset($_POST["dictamen"])? limpiarCadena($_POST["dictamen"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$producto=isset($_POST["producto"])? limpiarCadena($_POST["producto"]):"";
$cvu=isset($_POST["cvu"])? limpiarCadena($_POST["cvu"]):"";






switch ($_GET["op"]){

    case 'guardaryeditar':
        if(empty($noConacyt)){
           $respuesta=$eveluanoconacyt->insertar($idUsuario,$cvu,$noConacyt,$institucion,$fechaInicio,$fechaFin,$cargo,$evaluacion,$dictamen,$nombre,$descripcion,$producto
        );
           echo $respuesta ? "Registrado" : "Error al registrar" ;
        }
        else{
            $respuesta=$eveluanoconacyt->editar($idUsuario,$cvu,$noConacyt,$institucion,$fechaInicio,$fechaFin,$cargo,$evaluacion,$dictamen,$nombre,$descripcion,$producto
        );
            echo $respuesta ? "Registrado modificado" : "Error al modificar" ;

        }

    break;

    case 'mostrar':
            $respuesta=$eveluanoconacyt->mostrar($noConacyt);
            echo json_encode($respuesta);
    break;

    case 'borrar':
            $respuesta=$eveluanoconacyt->borrar($noConacyt);
            echo $respuesta ? "borrado" : "error al borrar" ;
            

    break;

    case 'listar':
            $respuesta=$eveluanoconacyt->listar($idUsuario);
            $data= Array();
            while ($reg=$respuesta->fetch_object()){
                $data[]=array(
                    "0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->idEvaluacionnoConacyt.')"><i class="fa fa-pencil"></i></button>'.
                    ' <button class="btn btn-danger" onclick="borrar('.$reg->idEvaluacionnoConacyt.')"><i class="fa fa-close"></i></button>',
                                    
                     "1"=>$reg->nombre, 
                     "2"=>$reg->cargo,
                     "3"=>$reg->fechaInicio,
                     "4"=>$reg->fechaFin);
                
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