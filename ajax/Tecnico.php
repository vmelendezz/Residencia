<?php

if(strlen(session_id())<1)
session_start();

require_once "../models/Tecnico.php";

$ReporteTecnico = new Tecnico();

$idUsuario=$_SESSION['idusuario'];
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";

$tecnico=isset($_POST["tecnico"])? limpiarCadena($_POST["tecnico"]):"";
$institucion=isset($_POST["institucion"])? limpiarCadena($_POST["institucion"]):"";
$fechaEntrega=isset($_POST["fechaEntrega"])? limpiarCadena($_POST["fechaEntrega"]):"";
$fechaPublicacion=isset($_POST["fechaPublicacion"])? limpiarCadena($_POST["fechaPublicacion"]):"";
$paginas=isset($_POST["paginas"])? limpiarCadena($_POST["paginas"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$objetivos=isset($_POST["objetivos"])? limpiarCadena($_POST["objetivos"]):"";
$palabraclave1=isset($_POST["palabraclave1"])? limpiarCadena($_POST["palabraclave1"]):"";
$palabraclave2=isset($_POST["palabraclave2"])? limpiarCadena($_POST["palabraclave2"]):"";
$palabraclave3=isset($_POST["palabraclave3"])? limpiarCadena($_POST["palabraclave3"]):"";
$origen=isset($_POST["origen"])? limpiarCadena($_POST["origen"]):"";
$apoyoConacyt=isset($_POST["apoyoConacyt"])? limpiarCadena($_POST["apoyoConacyt"]):"";
$fondo=isset($_POST["fondo"])? limpiarCadena($_POST["fondo"]):"";
$cvu=isset($_POST["cvu"])? limpiarCadena($_POST["cvu"]):"";






switch ($_GET["op"]){

    case 'guardaryeditar':
        if(empty($tecnico)){
            echo "$cvu + inicio";
           $respuesta=$ReporteTecnico->insertar($idUsuario,$cvu,$nombre,$institucion,$fechaEntrega,$fechaPublicacion,$paginas,$descripcion,$objetivos,$palabraclave1,$palabraclave2,$palabraclave3,$origen,$apoyoConacyt,$fondo);
           echo $respuesta ? "Registrado" : "Error al registrar" ;
        }
        else{
            $respuesta=$ReporteTecnico->editar($idUsuario,$cvu,$nombre,$tecnico,$institucion,$fechaEntrega,$fechaPublicacion,$paginas,$descripcion,$objetivos,$palabraclave1,$palabraclave2,$palabraclave3,$origen,$apoyoConacyt,$fondo);
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
                                    
                     "1"=>$reg->nombre,
                     "2"=>$reg->institucion,
                     "3"=>$reg->fechaEntrega,
                     "4"=>$reg->fechaPublicacion,
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