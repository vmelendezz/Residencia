<?php

require_once "../models/Estadocivil.php";

$estadocivil = new Estadocivil();

$civil=isset($_POST["id_estadocivil"])? limpiarCadena($_POST["id_estadocivil"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";


switch ($_GET["op"]){

    case 'guardaryeditar':
        if(empty($civil)){

           $respuesta=$estadocivil->insertar($nombre);
           echo $respuesta ? "Registrado" : "Error al registrar" ;
        }
        else{
            $respuesta=$estadocivil->editar($civil,$nombre);
            echo $respuesta ? "Registrado modificado" : "Error al modificar" ;

        }

    break;

    case 'mostrar':
            $respuesta=$estadocivil->mostrar($civil);
            echo json_encode($respuesta);
    break;

    case 'borrar':
            $respuesta=$estadocivil->borrar($civil);
            echo $respuesta ? "borrado" : "error al borrar" ;
            

    break;

    case 'listar':
            $respuesta=$estadocivil->listar();
            $data= Array();
            while ($reg=$respuesta->fetch_object()){
                $data[]=array(
                    "0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->idEstadoCivil.')"><i class="fa fa-pencil"></i></button>'.
                    ' <button class="btn btn-danger" onclick="borrar('.$reg->idEstadoCivil.')"><i class="fa fa-close"></i></button>',
                                    
                     "1"=>$reg->nombre);
                
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