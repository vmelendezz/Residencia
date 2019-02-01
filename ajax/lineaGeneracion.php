<?php

if(strlen(session_id())<1)
session_start();

require_once "../models/LineaGeneracion.php";

$lineageneral = new LineGeneral();

$idUsuario=$_SESSION['idusuario'];

$linea=isset($_POST["linea"])? limpiarCadena($_POST["linea"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$horas=isset($_POST["horas"])? limpiarCadena($_POST["horas"]):"";

$actividades=isset($_POST["actividades"])? limpiarCadena($_POST["actividades"]):"";

$cvu=isset($_POST["cvu"])? limpiarCadena($_POST["cvu"]):"";






switch ($_GET["op"]){

    case 'guardaryeditar':
        if(empty($linea)){
            
           $respuesta=$lineageneral->insertar($idUsuario,$cvu,$nombre,$horas,$actividades);
           echo $respuesta ? "Registrado" : "Error al registrar" ;
        }
        else{
            $respuesta=$lineageneral->editar($idUsuario,$linea,$nombre,$horas,$actividades);
            echo $respuesta ? "Registrado modificado" : "Error al modificar" ;

        }

    break;

    case 'mostrar':
            $respuesta=$lineageneral->mostrar($linea);
            echo json_encode($respuesta);
    break;

    case 'borrar':
            $respuesta=$lineageneral->borrar($linea);
            echo $respuesta ? "borrado" : "error al borrar" ;
            

    break;

    case 'listar':
            $respuesta=$lineageneral->listar($idUsuario);
            $data= Array();
            while ($reg=$respuesta->fetch_object()){
                $data[]=array(
                    "0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->idLineaGeneracion.')"><i class="fa fa-pencil"></i></button>'.
                    ' <button class="btn btn-danger" onclick="borrar('.$reg->idLineaGeneracion.')"><i class="fa fa-close"></i></button>',
                                    
                     "1"=>$reg->nombre,
                     "2"=>$reg->horas);
                
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