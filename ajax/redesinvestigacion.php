<?php

if(strlen(session_id())<1)
session_start();

require_once "../models/Redesinvestigacion.php";

$redesinvestigacion = new RedesInvestigacion();

   

$idUsuario=$_SESSION['idusuario'];

$redes=isset($_POST["redes"])? limpiarCadena($_POST["redes"]):"";
$institucion=isset($_POST["institucion"])? limpiarCadena($_POST["institucion"]):"";

$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$creacion=isset($_POST["creacion"])? limpiarCadena($_POST["creacion"]):"";

$nombreResponsable=isset($_POST["nombreResponsable"])? limpiarCadena($_POST["nombreResponsable"]):"";
$ingreso=isset($_POST["ingreso"])? limpiarCadena($_POST["ingreso"]):"";

$asignacion=isset($_POST["asignacion"])? limpiarCadena($_POST["asignacion"]):"";

$primero=isset($_POST["primero"])? limpiarCadena($_POST["primero"]):"";
$segundo=isset($_POST["segundo"])? limpiarCadena($_POST["segundo"]):"";
$total=isset($_POST["total"])? limpiarCadena($_POST["total"]):"";
$area=isset($_POST["area"])? limpiarCadena($_POST["area"]):"";
$campo=isset($_POST["campo"])? limpiarCadena($_POST["campo"]):"";
$disciplina=isset($_POST["diciplina"])? limpiarCadena($_POST["diciplina"]):"";
$subdisciplina=isset($_POST["subdiciplina"])? limpiarCadena($_POST["subdiciplina"]):"";







switch ($_GET["op"]){

    case 'guardaryeditar':
        if(empty($redes)){
           $respuesta=$redesinvestigacion->insertar($idUsuario,$redes,$institucion,$nombre,$asignacion,$creacion,$nombreResponsable,$ingreso,$primero,$segundo,$total,$area,$campo,$disciplina,$subdisciplina);
           echo $respuesta ? "Registrado" : "Error al registrar" ;
        }
        else{
            $respuesta=$redesinvestigacion->editar($idUsuario,$redes,$institucion,$nombre,$asignacion,$creacion,$nombreResponsable,$ingreso,$primero,$segundo,$total,$area,$campo,$disciplina,$subdisciplina);
            echo $respuesta ? "Registrado modificado" : "Error al modificar" ;

        }

    break;

    case 'mostrar':
            $respuesta=$redesinvestigacion->mostrar($redes);
            echo json_encode($respuesta);
    break;

    case 'borrar':
            $respuesta=$redesinvestigacion->borrar($redes);
            echo $respuesta ? "borrado" : "error al borrar" ;
            

    break;

    case 'listar':
            $respuesta=$redesinvestigacion->listar($idUsuario);
            $data= Array();
            while ($reg=$respuesta->fetch_object()){
                $data[]=array(
                    "0"=>'<button class="btn btn-default" onclick="mostrar('.$reg->idRedesInvestigacion.')"><i class="fa fa-pencil"></i></button>'.
                    ' <button class="btn btn-default" onclick="borrar('.$reg->idRedesInvestigacion.')"><i class="fa fa-trash-o"></i></button>',
                                    
                     "1"=>$reg->nombre,
                     "2"=>$reg->institucion,
                     "3"=>$reg->FechaCreacion,
                     "4"=>$reg->fecheInicio,
                     "5"=>$reg->totalIntegrantes);
                
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