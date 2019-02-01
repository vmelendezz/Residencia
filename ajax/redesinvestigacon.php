<?php

if(strlen(session_id())<1)
session_start();

require_once "../models/Tecnico.php";

$ReporteTecnico = new Tecnico();

    $("#nombre").val("");
    $("#creacion").val("");
    $("#ingreso").val("");
    $("#asignacion").val("");
    $("#primero").val("");
    $("#segundo").val("");
    $("#total").val("");
    $("#area").val("");
    $("#campo").val("");
    $("#diciplina").val("");
    $("#subdiciplina").val("");
    $("#cvu").val("");

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
$diciplina=isset($_POST["diciplina"])? limpiarCadena($_POST["diciplina"]):"";
$subdiciplina=isset($_POST["subdiciplina"])? limpiarCadena($_POST["subdiciplina"]):"";

$cvu=isset($_POST["cvu"])? limpiarCadena($_POST["cvu"]):"";






switch ($_GET["op"]){

    case 'guardaryeditar':
        if(empty($id_tecnico)){
           $respuesta=$ReporteTecnico->insertar($idUsuario,$cvu,$redes,$institucion,$nombre,$asignacion,$creacion,$nombreResponsable,$ingreso,$primero,$segundo,$total,$area,$campo,$diciplina,$subdiciplina)

        );
           echo $respuesta ? "Registrado" : "Error al registrar" ;
        }
        else{
            $respuesta=$ReporteTecnico->editar($idUsuario,$cvu,$redes,$institucion,$nombre,$asignacion,$creacion,$nombreResponsable,$ingreso,$primero,$segundo,$total,$area,$campo,$diciplina,$subdiciplina)

        );
            echo $respuesta ? "Registrado modificado" : "Error al modificar" ;

        }

    break;

    case 'mostrar':
            $respuesta=$ReporteTecnico->mostrar($tecnico);
            echo json_encode($respuesta);
    break;

    case 'borrar':
            $respuesta=$ReporteTecnico->borrar($tecnico);
            echo $respuesta ? "borrado" : "error al borrar" ;
            

    break;

    case 'listar':
            $respuesta=$ReporteTecnico->listar($idUsuario);
            $data= Array();
            while ($reg=$respuesta->fetch_object()){
                $data[]=array(
                    "0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->idReportesTecnicos.')"><i class="fa fa-pencil"></i></button>'.
                    ' <button class="btn btn-danger" onclick="borrar('.$reg->idReportesTecnicos.')"><i class="fa fa-close"></i></button>',
                                    
                     "1"=>$reg->nombre);
                     "2"=>$reg->institucion),
                     "3"=>$reg->fechaEntrega),
                     "4"=>$reg->fechaPublicacion),
                     "5"=>$reg->numeroPaginas);
                
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