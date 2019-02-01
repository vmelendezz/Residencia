<?php
if(strlen(session_id())<1)
session_start();
 
require_once "../models/redesTematicas.php";
    
    $redesTematica = new RedesTematicas();

	
 
  


    $idUsuario=$_SESSION['idusuario'];

   
 
    $nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
    $tematicas=isset($_POST["tematicas"])? limpiarCadena($_POST["tematicas"]):"";
    $ingreso=isset($_POST["ingreso"])? limpiarCadena($_POST["ingreso"]):"";
    
    
    switch ($_GET["op"]){

        case 'guardaryeditar':
             if(empty($tesis)){


                 
                 $respuesta=$redesTematica->insertar($idUsuario,$nombre,$ingreso);
                   
                 echo $respuesta ? "Registrado" : "Error al registrar" ;
             }
              else{
                     $respuesta=$redesTematica->editar($idUsuario,$tematicas,$nombre,$ingreso);
                    echo $respuesta ? "Registrado modificado" : "Error al modificar" ;

              }

       break;

         case 'mostrar':
            $respuesta=$redesTematica->mostrar($tematicas);
             echo json_encode($respuesta);
        break;

        case 'borrar':
            $respuesta=$redesTematica->borrar($tematicas);
            echo $respuesta ? "borrado" : "Error al borrar" ;

        break;

        case 'listar':
        $respuesta=$redesTematica->listar($idUsuario);
        $data= Array();

        while ($reg=$respuesta->fetch_object()){
            $data[]=array(
                "0"=>'<button class="btn btn-default" onclick="mostrar('.$reg->id.')"><i class="fa fa-pencil"></i></button>'.
                      '<button class="btn btn-default" onclick="borrar('.$reg->id.')"><i class="fa fa-trash-o"></i></button>', 
                 "1"=>$reg->nombre,
                 "2"=>$reg->fechaIngreso);
            
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