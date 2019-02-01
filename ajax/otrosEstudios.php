<?php
if(strlen(session_id())<1)
session_start();
 
require_once "../models/OtrosEstudios.php";
    
    $otros = new OtrosEstudios();

    $idUsuario=$_SESSION['idusuario'];
    $formacion=isset($_POST["Formacion"])? limpiarCadena($_POST["Formacion"]):"";
    $continua=isset($_POST["continua"])? limpiarCadena($_POST["continua"]):"";
    $nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
    $nombreInstituto=isset($_POST["institucion"])? limpiarCadena($_POST["institucion"]):"";
    $year=isset($_POST["year"])? limpiarCadena($_POST["year"]):"";
    $horas=isset($_POST["horas"])? limpiarCadena($_POST["horas"]):"";


    $campo=isset($_POST["campo"])? limpiarCadena($_POST["campo"]):"";
    $area=isset($_POST["area"])? limpiarCadena($_POST["area"]):"";
    $disciplina=isset($_POST["diciplina"])? limpiarCadena($_POST["diciplina"]):"";
    $subdisciplina=isset($_POST["subdiciplina"])? limpiarCadena($_POST["subdiciplina"]):"";

    
    switch ($_GET["op"]){

        case 'guardaryeditar':
             if(empty($formacion)){
                 
                 $respuesta=$otros->insertar($idUsuario,$continua,$nombre,$nombreInstituto,$year,$horas,$campo,$area,$disciplina,$subdisciplina);
                   
                 echo $respuesta ? "Registrado" : "Error al registrar" ;
             }
              else{
                     $respuesta=$usuario->editar($idUsuario,$formacion,$continua,$nombre,$nombreInstituto,$year,$horas,$campo,$area,$disciplina,$subdisciplina);
                    echo $respuesta ? "Registrado modificado" : "Error al modificar" ;

              }

       break;

         case 'mostrar':
            $respuesta=$otros->mostrar($formacion);
             echo json_encode($respuesta);
        break;

        case 'borrar':
        $respuesta=$otros->mostrar($formacion);
         echo json_encode($respuesta);
        break;

        case 'listar':
        $respuesta=$otros->listar($idUsuario);
        $data= Array();
        while ($reg=$respuesta->fetch_object()){
            
            $data[]=array(
                
                "0"=>'<button class="btn btn-default" onclick="mostrar('.$reg->formacion.')"><i class="fa fa-pencil"></i></button>'.
                      '<button class="btn btn-default" onclick="borrar('.$reg->formacion.')"><i class="fa fa-trash-o"></i></button>', 
                 "1"=>$reg->nombre,
                 "2"=>$reg->year,
                 "3"=>$reg->horas,
                 "4"=>$reg->nombreFormacion);
            
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