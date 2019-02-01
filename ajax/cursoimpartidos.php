<?php
if(strlen(session_id())<1)
session_start();
 
require_once "../models/Cursoimpartidos.php";
    
    $cursos = new CursoImpartido();

	

    $idUsuario=$_SESSION['idusuario'];

    

    $curso=isset($_POST["curso"])? limpiarCadena($_POST["curso"]):"";
    $institucion=isset($_POST["institucion"])? limpiarCadena($_POST["institucion"]):"";
    $nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
    $programa=isset($_POST["programa"])? limpiarCadena($_POST["programa"]):"";
    $horas=isset($_POST["horas"])? limpiarCadena($_POST["horas"]):"";
    $year=isset($_POST["year"])? limpiarCadena($_POST["year"]):"";
    $fechainicio=isset($_POST["fechainicio"])? limpiarCadena($_POST["fechainicio"]):"";
    $fechafin=isset($_POST["fechafin"])? limpiarCadena($_POST["fechafin"]):"";
    
    $campo=isset($_POST["campo"])? limpiarCadena($_POST["campo"]):"";
    $area=isset($_POST["area"])? limpiarCadena($_POST["area"]):"";
    $disciplina=isset($_POST["disciplina"])? limpiarCadena($_POST["disciplina"]):"";
    $subdisciplina=isset($_POST["sub"])? limpiarCadena($_POST["sub"]):"";

    
    switch ($_GET["op"]){

        case 'guardaryeditar':
             if(empty($curso)){


                 
                 $respuesta=$cursos->insertar($idUsuario,$institucion,$nombre,$programa,$horas,$year,$fechainicio,$fechafin,$campo,$area,$disciplina,$subdisciplina);
                   
                 echo $respuesta ? "Registrado" : "Error al registrar" ;
             }
              else{
                     $respuesta=$cursos->editar($idUsuario,$curso,$institucion,$nombre,$programa,$horas,$year,$fechainicio,$fechafin,$campo,$area,$disciplina,$subdisciplina);
                    echo $respuesta ? "Registrado modificado" : "Error al modificar" ;

              }

       break;

         case 'mostrar':
            $respuesta=$cursos->mostrar($curso);
             echo json_encode($respuesta);
        break;

        case 'borrar':
            $respuesta=$cursos->borrar($curso);
            echo $respuesta ? "borrado" : "Error al borrar" ;

        break;

        case 'listar':
        $respuesta=$cursos->listar($idUsuario);
        $data= Array();

        while ($reg=$respuesta->fetch_object()){
            $data[]=array(
                "0"=>'<button class="btn btn-default" onclick="mostrar('.$reg->id.')"><i class="fa fa-pencil"></i></button>'.
                      '<button class="btn btn-default" onclick="borrar('.$reg->id.')"><i class="fa fa-trash-o"></i></button>', 
                 "1"=>$reg->nombreCurso,
                 "2"=>$reg->nombrePrograma,
                 "3"=>$reg->fechaInicio,
                 "4"=>$reg->fecchaFin);
            
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