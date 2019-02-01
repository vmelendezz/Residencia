<?php
if(strlen(session_id())<1)
session_start();
 
require_once "../models/Lenguas.php";
    
    $lenguasindi = new Lenguas();


    	


    $idUsuario=$_SESSION['idusuario'];
    $institucion=isset($_POST["institucion"])? limpiarCadena($_POST["institucion"]):"";

    $lengua=isset($_POST["lengua"])? limpiarCadena($_POST["lengua"]):"";
    $nombrelengua=isset($_POST["nombrelengua"])? limpiarCadena($_POST["nombrelengua"]):"";
    $nivel=isset($_POST["nivel"])? limpiarCadena($_POST["nivel"]):"";
    $lectura=isset($_POST["lectura"])? limpiarCadena($_POST["lectura"]):"";
    $escritura=isset($_POST["escritura"])? limpiarCadena($_POST["escritura"]):"";
    $conferido=isset($_POST["conferido"])? limpiarCadena($_POST["conferido"]):"";
    $certificacion=isset($_POST["certificacion"])? limpiarCadena($_POST["certificacion"]):"";
    $evaluacion=isset($_POST["evaluacion"])? limpiarCadena($_POST["evaluacion"]):"";
    $documento=isset($_POST["documento"])? limpiarCadena($_POST["documento"]):"";
    $vigenciainicio=isset($_POST["vigenciainicio"])? limpiarCadena($_POST["vigenciainicio"]):"";
    $vigenciafin=isset($_POST["vigenciafin"])? limpiarCadena($_POST["vigenciafin"]):"";
    $puntos=isset($_POST["puntos"])? limpiarCadena($_POST["puntos"]):"";
    $grado=isset($_POST["grado"])? limpiarCadena($_POST["grado"]):"";


    
    switch ($_GET["op"]){

        case 'guardaryeditar':
             if(empty($lengua)){
                 
                 $respuesta=$lenguasindi->insertar($idUsuario,$grado,$institucion,$nombrelengua,$conferido,$nivel,$lectura,$escritura,$certificacion,$evaluacion,$documento,$vigenciainicio,$vigenciafin,$puntos);
                   
                 echo $respuesta ? "Registrado" : "Error al registrar" ;
             }
              else{
                     $respuesta=$lenguasindi->editar($idUsuario,$lengua,$grado,$institucion,$conferido,$idioma,$nombrelengua,$nivel,$lectura,$escritura,$certificacion,$evaluacion,$documento,$vigenciainicio,$vigenciafin,$puntos);
               
                    echo $respuesta ? "Registrado modificado" : "Error al modificar" ;

              }

       break;

         case 'mostrar':
            $respuesta=$lenguasindi->mostrar($lengua);
             echo json_encode($respuesta);
        break;

        case 'listar':
        $respuesta=$lenguasindi->listar($idUsuario);
        $data= Array();
        while ($reg=$respuesta->fetch_object()){
            
            $data[]=array(
                
                "0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->lengua.')"><i class="fa fa-pencil"></i></button>'.
                      '<button class="btn btn-warning" onclick="mostrar('.$reg->lengua.')"><i class="fa fa-pencil"></i></button>', 
                 "1"=>$reg->nombre,
                 "2"=>$reg->VigenciaInicio,
                 "3"=>$reg->VigenciaFin);
            
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