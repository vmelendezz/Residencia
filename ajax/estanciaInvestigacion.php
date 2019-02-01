<?php
if(strlen(session_id())<1)
session_start();
 
require_once "../models/EstanciaInvestigacion.php";
    
    $estancia = new EstanciaInvestigacion();

  

    $idUsuario=$_SESSION['idusuario'];
    $id=isset($_POST["estancia"])? limpiarCadena($_POST["estancia"]):"";
    $nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
    $institucion=isset($_POST["institucion"])? limpiarCadena($_POST["institucion"]):"";
    $fechainicio=isset($_POST["fechainicio"])? limpiarCadena($_POST["fechainicio"]):"";
    $fechafin=isset($_POST["fechafin"])? limpiarCadena($_POST["fechafin"]):"";
    $tipo=isset($_POST["tipo"])? limpiarCadena($_POST["tipo"]):"";
    $logro=isset($_POST["logro"])? limpiarCadena($_POST["logro"]):"";
    $campo=isset($_POST["campo"])? limpiarCadena($_POST["campo"]):"";
    $area=isset($_POST["area"])? limpiarCadena($_POST["area"]):"";
    $disciplina=isset($_POST["disciplina"])? limpiarCadena($_POST["disciplina"]):"";
    $sub=isset($_POST["subdisciplina"])? limpiarCadena($_POST["subdisciplina"]):"";

    
    switch ($_GET["op"]){

        case 'guardaryeditar':
             if(empty($id)){


                 echo $sub;
                 $respuesta=$estancia->insertar($idUsuario,$nombre,$institucion,$fechainicio,$fechafin,$tipo,$logro,$campo,$area,$sub,$disciplina);
                 echo $respuesta ? "Registrado" : "Error al registrar" ;
             }
              else{
                     $respuesta=$usuario->editar($idUsuario,$id,$nombre,$institucion,$fechainicio,$fechafin,$tipo,$logro,$campo,$area,$sub,$disciplina);
                    echo $respuesta ? "Registrado modificado" : "Error al modificar" ;

              }

       break;

         case 'mostrar':
            $respuesta=$estancia->mostrar($id);
             echo json_encode($respuesta);
        break;

        case 'borrar':
            $respuesta=$estancia->borrar($id);
            echo $respuesta ? "borrado" : "Error al borrar" ;

        break;

        case 'listar':
        $respuesta=$estancia->listar($idUsuario);
        $data= Array();

        while ($reg=$respuesta->fetch_object()){
            $data[]=array(
                "0"=>'<button class="btn btn-default" onclick="mostrar('.$reg->id.')"><i class="fa fa-pencil"></i></button>'.
                      '<button class="btn btn-default" onclick="borrar('.$reg->id.')"><i class="fa fa-trash-o"></i></button>', 
                 "1"=>$reg->nombre,
                 "2"=>$reg->fechaInicio,
                 "3"=>$reg->fechaFin,
                 "4"=>$reg->tipo);
            
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