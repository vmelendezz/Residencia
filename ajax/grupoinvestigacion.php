<?php

if(strlen(session_id())<1)
session_start();

require_once "../models/Grupoinvestigacion.php";

$grupoInvestigacion = new GrupoInvestigacion();




$idUsuario=$_SESSION['idusuario'];

$investigacion=isset($_POST["investigacion"])? limpiarCadena($_POST["investigacion"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$creacion=isset($_POST["creacion"])? limpiarCadena($_POST["creacion"]):"";
$ingreso=isset($_POST["ingreso"])? limpiarCadena($_POST["ingreso"]):"";
$nombreResponsable=isset($_POST["nombreResponsable"])? limpiarCadena($_POST["nombreResponsable"]):"";
$primero=isset($_POST["primero"])? limpiarCadena($_POST["primero"]):"";
$segundo=isset($_POST["segundo"])? limpiarCadena($_POST["segundo"]):"";
$institucion=isset($_POST["institucion"])? limpiarCadena($_POST["institucion"]):"";
$colaboracion=isset($_POST["colaboracion"])? limpiarCadena($_POST["colaboracion"]):"";
$impacto=isset($_POST["impacto"])? limpiarCadena($_POST["impacto"]):"";
$total=isset($_POST["total"])? limpiarCadena($_POST["total"]):"";
$area=isset($_POST["area"])? limpiarCadena($_POST["area"]):"";
$campo=isset($_POST["campo"])? limpiarCadena($_POST["campo"]):"";
$disciplina=isset($_POST["diciplina"])? limpiarCadena($_POST["diciplina"]):"";
$subdisciplina=isset($_POST["subdiciplina"])? limpiarCadena($_POST["subdiciplina"]):"";
$cvu=isset($_POST["cvu"])? limpiarCadena($_POST["cvu"]):"";






switch ($_GET["op"]){

    case 'guardaryeditar':
        if(empty($id_tecnico)){
           $respuesta=$grupoInvestigacion->insertar($idUsuario,$investigacion,$cvu,$nombre,$creacion,$ingreso,$nombreResponsable,$primero,$segundo,$institucion,$colaboracion,$impacto,$total,$area,$campo,$diciplina,$subdiciplina)

        );
           echo $respuesta ? "Registrado" : "Error al registrar" ;
        }
        else{
            $respuesta=$grupoInvestigacion->editar($idUsuario,$investigacion,$cvu,$nombre,$creacion,$ingreso,$nombreResponsable,$primero,$segundo,$institucion,$colaboracion,$impacto,$total,$area,$campo,$diciplina,$subdiciplina)

        );
            echo $respuesta ? "Registrado modificado" : "Error al modificar" ;

        }

    break;

    case 'mostrar':
            $respuesta=$grupoInvestigacion->mostrar($tecnico);
            echo json_encode($respuesta);
    break;

    case 'borrar':
            $respuesta=$grupoInvestigacion->borrar($tecnico);
            echo $respuesta ? "borrado" : "error al borrar" ;
            

    break;

    case 'listar':
            $respuesta=$grupoInvestigacion->listar($idUsuario);
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