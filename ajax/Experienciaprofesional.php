<?php
if(strlen(session_id())<1)
session_start();
 
require_once "../models/Experienciaprofesional.php";
    
    $experienciaprofesional = new Profesional();

    $idusuario=$_SESSION['idusuario'];


 
    $profesional=isset($_POST["profesional"])? limpiarCadena($_POST["profesional"]):"";
    $actual=isset($_POST["actual"])? limpiarCadena($_POST["actual"]):"";
    $puesto=isset($_POST["puesto"])? limpiarCadena($_POST["puesto"]):"";
    $periodo=isset($_POST["periodo"])? limpiarCadena($_POST["periodo"]):"";
    $institucion=isset($_POST["institucion"])? limpiarCadena($_POST["institucion"]):"";
    $funcion=isset($_POST["funcion"])? limpiarCadena($_POST["funcion"]):"";

    $nombrepuesto=isset($_POST["nombrepuesto"])? limpiarCadena($_POST["nombrepuesto"]):"";

    
    switch ($_GET["op"]){

        case 'guardaryeditar':
             if(empty($profesional)){
                 $respuesta=$experienciaprofesional->insertar($funcion,$idusuario,$actual,$puesto,$periodo,$institucion, $nombrepuesto);
                 echo $respuesta ? "Registrado" : "Error al registrar" ;
             }
              else{
                     $respuesta=$experienciaprofesional->editar($funcion,$idusuario,$profesional,$actual,$puesto,$periodo,$institucion, $nombrepuesto);
                    echo $respuesta ? "Registrado modificado" : "Error al modificar" ;

              }

       break;

         case 'mostrar':
            $respuesta=$experienciaprofesional->mostrar($profesional);
             echo json_encode($respuesta);
        break;
        case 'borrar':
            $respuesta=$experienciaprofesional->borrar($profesional);
             echo json_encode($respuesta);
        break;

        case 'listar':
        $respuesta=$experienciaprofesional->listar($idusuario);
        $data= Array();
        while ($reg=$respuesta->fetch_object()){
            $data[]=array(
                "0"=>'<button class="btn btn-default" onclick="mostrar('.$reg->profesional.')"><i class="fa fa-pencil"></i></button>'.
                      '<button class="btn btn-default" onclick="borrar('.$reg->profesional.')"><i class="fa fa-trash-o"></i></button>', 
                 "1"=>$reg->nombre,
                 "2"=>$reg->funcion,
                 "3"=>$reg->institucion );    
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