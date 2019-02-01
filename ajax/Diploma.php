<?php

if(strlen(session_id())<1)
session_start();
require_once "../models/Diploma.php";

$diplomas = new Diploma();


$idUsuario=$_SESSION['idusuario'];

$diploma=isset($_POST["diploma"])? limpiarCadena($_POST["diploma"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$institucion=isset($_POST["institucion"])? limpiarCadena($_POST["institucion"]):"";
$sub=isset($_POST["subdisciplina"])? limpiarCadena($_POST["subdisciplina"]):"";
$nombreCurso=isset($_POST["nombreCurso"])? limpiarCadena($_POST["nombreCurso"]):"";
$year=isset($_POST["year"])? limpiarCadena($_POST["year"]):"";
$horasTotal=isset($_POST["horasTotal"])? limpiarCadena($_POST["horasTotal"]):"";
$area=isset($_POST["area"])? limpiarCadena($_POST["area"]):"";
$campo=isset($_POST["campo"])? limpiarCadena($_POST["campo"]):"";
$disciplina=isset($_POST["disciplina"])? limpiarCadena($_POST["disciplina"]):"";








switch ($_GET["op"]){

    case 'guardaryeditar':
        if(empty($diploma)){
           $respuesta=$diplomas->insertar($idUsuario,$diploma,$nombre,$institucion,$nombreCurso,$year,$horasTotal,$area,$campo,$disciplina,$sub);
           echo $respuesta ? "Registrado" : "Error al registrar" ;
        }
        else{
            $respuesta=$diplomas->editar($diploma,$nombre,$institucion,$nombreCurso,$year,$horasTotal,$area,$campo,$disciplina,$subdisciplina);
            echo $respuesta ? "Registrado modificado" : "Error al modificar" ;

        }

    break;

    case 'mostrar':
            $respuesta=$diplomas->mostrar($diploma);
            echo json_encode($respuesta);
    break;

    case 'borrar':
            $respuesta=$diplomas->borrar($diploma);
            echo $respuesta ? "borrado" : "error al borrar" ;
            

    break;

    case 'listar':
            $respuesta=$diplomas->listar($idUsuario);
            $data= Array();
            while ($reg=$respuesta->fetch_object()){
                $data[]=array(
                    "0"=>'<button class="btn btn-default" onclick="mostrar('.$reg->id.')"><i class="fa fa-pencil"></i></button>'.
                    ' <button class="btn btn-default" onclick="borrar('.$reg->id.')"><i class="fa fa-trash-o"></i></button>',
                                    
                     "1"=>$reg->nombre,
                     "2"=>$reg->institucion,
                     "3"=>$reg->year,
                     "4"=>$reg->horastotal);
                
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