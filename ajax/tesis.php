<?php
if(strlen(session_id())<1)
session_start();
 
require_once "../models/Tesis.php";
    
    $tesisDirigidas = new Tesis();

	
 
  


    $idUsuario=$_SESSION['idusuario'];

   
 
    $tesis=isset($_POST["tesis"])? limpiarCadena($_POST["tesis"]):"";
    $nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
    $fechaInicio=isset($_POST["fechaInicio"])? limpiarCadena($_POST["fechaInicio"]):"";
    $fechaFin=isset($_POST["fechaFin"])? limpiarCadena($_POST["fechaFin"]):"";
    $institucion=isset($_POST["institucion"])? limpiarCadena($_POST["institucion"]):"";
    $estado=isset($_POST["estado"])? limpiarCadena($_POST["estado"]):"";
    $programa=isset($_POST["programa"])? limpiarCadena($_POST["programa"]):"";
    $academico=isset($_POST["academico"])? limpiarCadena($_POST["academico"]):"";
    $grado=isset($_POST["grado"])? limpiarCadena($_POST["grado"]):"";
    $aprobacion=isset($_POST["aprobacion"])? limpiarCadena($_POST["aprobacion"]):"";
    $obtencion=isset($_POST["obtencion"])? limpiarCadena($_POST["obtencion"]):"";
    $campo=isset($_POST["campo"])? limpiarCadena($_POST["campo"]):"";
    $area=isset($_POST["area"])? limpiarCadena($_POST["area"]):"";
    $disciplina=isset($_POST["disciplina"])? limpiarCadena($_POST["disciplina"]):"";
    $subdisciplina=isset($_POST["subdisciplina"])? limpiarCadena($_POST["subdisciplina"]):"";

    
    switch ($_GET["op"]){

        case 'guardaryeditar':
             if(empty($tesis)){


                 
                 $respuesta=$tesisDirigidas->insertar($idUsuario,$nombre,$fechaInicio,$fechaFin,$institucion,$estado,$programa,$academico,$grado,$aprobacion,$obtencion,$campo,$area,$disciplina,$subdisciplina);
                   
                 echo $respuesta ? "Registrado" : "Error al registrar" ;
             }
              else{
                     $respuesta=$tesisDirigidas->editar($idUsuario,$tesis,$nombre,$fechaInicio,$fechaFin,$institucion,$estado,$programa,$academico,$grado,$aprobacion,$obtencion,$campo,$area,$disciplina,$subdisciplina);
                    echo $respuesta ? "Registrado modificado" : "Error al modificar" ;

              }

       break;

         case 'mostrar':
            $respuesta=$tesisDirigidas->mostrar($tesis);
             echo json_encode($respuesta);
        break;

        case 'borrar':
            $respuesta=$tesisDirigidas->borrar($tesis);
            echo $respuesta ? "borrado" : "Error al borrar" ;

        break;

        case 'listar':
        $respuesta=$tesisDirigidas->listar($idUsuario);
        $data= Array();

        while ($reg=$respuesta->fetch_object()){
            $data[]=array(
                "0"=>'<button class="btn btn-default" onclick="mostrar('.$reg->id.')"><i class="fa fa-pencil"></i></button>'.
                      '<button class="btn btn-default" onclick="borrar('.$reg->id.')"><i class="fa fa-trash-o"></i></button>', 
                 "1"=>$reg->nombreTesis,
                 "2"=>$reg->fechaInicio,
                 "3"=>$reg->fechaFin,
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