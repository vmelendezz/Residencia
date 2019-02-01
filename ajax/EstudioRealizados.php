<?php
if(strlen(session_id())<1)
session_start();
 
require_once "../models/EstudioRealizados.php";
    
    $estudios = new Estudios();

	

    $idUsuario=$_SESSION['idusuario'];
    $estudioRealizados=isset($_POST["estudiosRealizado"])? limpiarCadena($_POST["estudiosRealizado"]):"";
    $niveleEstudio=isset($_POST["nivel"])? limpiarCadena($_POST["nivel"]):"";
    $tipoInstituto=isset($_POST["tipoinstituto"])? limpiarCadena($_POST["tipoinstituto"]):"";
    $nombreInstituto=isset($_POST["instituto"])? limpiarCadena($_POST["instituto"]):"";
    $nombretitulo=isset($_POST["titulo"])? limpiarCadena($_POST["titulo"]):"";
    $estatusTitulacion=isset($_POST["estatus"])? limpiarCadena($_POST["estatus"]):"";
    $opcionesTitulacion=isset($_POST["opciones"])? limpiarCadena($_POST["opciones"]):"";
    $pais=isset($_POST["pais"])? limpiarCadena($_POST["pais"]):"";

    $numerocedula=isset($_POST["nocedula"])? limpiarCadena($_POST["nocedula"]):"";
    $siglasestudios=isset($_POST["siglasestudios"])? limpiarCadena($_POST["siglasestudios"]):"";
    $fechainicio=isset($_POST["fechainicio"])? limpiarCadena($_POST["fechainicio"]):"";
    $fechafin=isset($_POST["fechafin"])? limpiarCadena($_POST["fechafin"]):"";
    $fechaobtencion=isset($_POST["fechaobtencion"])? limpiarCadena($_POST["fechaobtencion"]):"";
    $periodo=isset($_POST["periodo"])? limpiarCadena($_POST["periodo"]):"";

    $campo=isset($_POST["campo"])? limpiarCadena($_POST["campo"]):"";
    $area=isset($_POST["area"])? limpiarCadena($_POST["area"]):"";
    $disciplina=isset($_POST["disciplina"])? limpiarCadena($_POST["disciplina"]):"";
    $subdisciplina=isset($_POST["subdisciplina"])? limpiarCadena($_POST["subdisciplina"]):"";

    
    switch ($_GET["op"]){

        case 'guardaryeditar':
             if(empty($estudioRealizados)){


                 
                 $respuesta=$estudios->insertar($idUsuario,$niveleEstudio,$tipoInstituto,$nombreInstituto,$nombretitulo,$estatusTitulacion,$opcionesTitulacion,$pais,$numerocedula,$siglasestudios,$fechainicio,$fechafin,$fechaobtencion,$periodo,$campo,$area,$disciplina,$subdisciplina);
                   
                 echo $respuesta ? "Registrado" : "Error al registrar" ;
             }
              else{
                     $respuesta=$usuario->editar($idUsuario,$estudioRealizados,$niveleEstudio,$tipoInstituto,$nombreInstituto,$nombretitulo,$estatusTitulacion,$opcionesTitulacion,$pais,$numerocedula,$siglasestudios,$fechainicio,$fechafin,$fechaobtencion,$periodo,$campo,$area,$disciplina,$subdisciplina);
                    echo $respuesta ? "Registrado modificado" : "Error al modificar" ;

              }

       break;

         case 'mostrar':
            $respuesta=$estudios->mostrar($estudioRealizados);
             echo json_encode($respuesta);
        break;

        case 'borrar':
            $respuesta=$estudios->borrar($estudioRealizados);
            echo $respuesta ? "borrado" : "Error al borrar" ;

        break;

        case 'listar':
        $respuesta=$estudios->listar($idUsuario);
        $data= Array();

        while ($reg=$respuesta->fetch_object()){
            $data[]=array(
                "0"=>'<button class="btn btn-default" onclick="mostrar('.$reg->estudioRealizados.')"><i class="fa fa-pencil"></i></button>'.
                      '<button class="btn btn-default" onclick="borrar('.$reg->estudioRealizados.')"><i class="fa fa-trash-o"></i></button>', 
                 "1"=>$reg->nombreTitulo,
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