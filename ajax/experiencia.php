<?php
if(strlen(session_id())<1)
session_start();
 
require_once "../models/experiencia.php";
    
    $experienciaDocente = new Experiencia();

    $idusuario=$_SESSION['idusuario'];

 
    $experiencia=isset($_POST["experiencia"])? limpiarCadena($_POST["experiencia"]):"";
    $nivel=isset($_POST["nivel"])? limpiarCadena($_POST["nivel"]):"";
    $periodo=isset($_POST["periodo"])? limpiarCadena($_POST["periodo"]):"";
    $institucion=isset($_POST["institucion"])? limpiarCadena($_POST["institucion"]):"";
    $nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";

    
    switch ($_GET["op"]){

        case 'guardaryeditar':
             if(empty($experiencia)){
                 $respuesta=$experienciaDocente->insertar($idusuario,$nivel,$periodo,$institucion, $nombre);
                 echo $respuesta ? "Registrado" : "Error al registrar" ;
             }
              else{
                     $respuesta=$experienciaDocente->editar($experiencia,$nivel,$periodo,$institucion, $nombre);
                    echo $respuesta ? "Registrado modificado" : "Error al modificar" ;

              }

       break;

         case 'mostrar':
            $respuesta=$experienciaDocente->mostrar($experiencia);
             echo json_encode($respuesta);
        break;

        case 'borrar':
        $respuesta=$experienciaDocente->borrar($experiencia);
        echo $respuesta ? "Registro borrado" : "Error al borrar" ;
    break;

        case 'listar':
        $respuesta=$experienciaDocente->listar($idusuario);
        $data= Array();
        while ($reg=$respuesta->fetch_object()){
            $data[]=array(
                "0"=>'<button class="btn btn-default" onclick="mostrar('.$reg->experiencia.')"><i class="fa fa-pencil"></i></button>'.
                      '<button class="btn btn-default" onclick="borrar('.$reg->experiencia.')"><i class="fa fa-trash-o"></i></button>', 
                 "1"=>$reg->nombre,
                 "2"=>$reg->nombreCurso,
                 "3"=>$reg->experienciaInstitucion,
                 "4"=>$reg->periodo);
            
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