<?php
if(strlen(session_id())<1)
session_start();
 
require_once "../models/Certificadosmedicos.php";
    
    $certificadomedico = new Certificadosmedicos();

    $idUsuario=$_SESSION['idusuario'];
    $idMedico=isset($_POST["medico"])? limpiarCadena($_POST["medico"]):"";
    $folio=isset($_POST["folio"])? limpiarCadena($_POST["folio"]):"";
    $vigenciade=isset($_POST["vigenciade"])? limpiarCadena($_POST["vigenciade"]):"";
    $vigenciaa=isset($_POST["vigenciaa"])? limpiarCadena($_POST["vigenciaa"]):"";
    $especialidad=isset($_POST["especialidad"])? limpiarCadena($_POST["especialidad"]):"";
    $tipo=isset($_POST["tipo"])? limpiarCadena($_POST["tipo"]):"";
    $instituto=isset($_POST["instituto"])? limpiarCadena($_POST["instituto"]):"";

   
    
    switch ($_GET["op"]){

        case 'guardaryeditar':
             if(empty($idMedico)){
                 $respuesta=$certificadomedico->insertar($idUsuario,$folio,$vigenciade,$vigenciaa,$especialidad,$tipo,$instituto);
                 echo $respuesta ? "Registrado" : "Error al registrar" ;
             }
              else{
                echo $idMedico;
                     $respuesta=$certificadomedico->editar($idUsuario,$idMedico,$folio,$vigenciade,$vigenciaa,$especialidad,$tipo,$instituto);
                    echo $respuesta ? "Registrado modificado" : "Error al modificar" ;

              }

       break;

         case 'mostrar':
         
            $respuesta=$certificadomedico->mostrar($idMedico);
           echo json_encode($respuesta);
            
        break;

        case 'borrar':
            $respuesta=$certificadomedico->borrar($idMedico);
            echo $respuesta ? "borrado" : "Error al borrar" ;

        break;

        case 'listar':
        $respuesta=$certificadomedico->listar($idUsuario);
        $data= Array();

        while ($reg=$respuesta->fetch_object()){
            $data[]=array(
                "0"=>'<button class="btn btn-default" onclick="mostrar('.$reg->idMedico.')"><i class="fa fa-pencil"></i></button>'.
                      '<button class="btn btn-default" onclick="borrar('.$reg->idMedico.')"><i class="fa fa-trash-o"></i></button>', 
                 "1"=>$reg->numeroFolio,
                 "2"=>$reg->fechaVigenciaDe,
                 "3"=>$reg->fechaVigenciaA,
                 "4"=>$reg->nombre);
            
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