<?php


    require_once "../models/Estanciaprofesional.php";
    
    $estancia = new Estancias();

  

    $id_usuario=isset($_POST["id_usuario"])? limpiarCadena($_POST["id_usuario"]):"";
    $id_estancia=isset($_POST["estancia"])? limpiarCadena($_POST["estancia"]):"";
    $nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
    $fechainicio=isset($_POST["inicio"])? limpiarCadena($_POST["inicio"]):"";
    $fechafin=isset($_POST["fin"])? limpiarCadena($_POST["fin"]):"";
    $logro=isset($_POST["logros"])? limpiarCadena($_POST["logros"]):"";
    $tipo_estancia=isset($_POST["instancia"])? limpiarCadena($_POST["instancia"]):"";
    
    switch($_GET["op"]){
    
        case 'guardaryeditar':
            if(empty($id_estancia)){
               $respuesta=$estancia->insertar($nombre,$fechainicio,$fechafin,$logro,$tipo_estancia);
               echo $respuesta ? "Registrado" : "Error al registrar" ;
            }
            else{
                $respuesta=$estancia->editar($id_estancia,$id_estancia,$nombre,$fechainicio,$fechafin,$logro,$tipo_estancia);
                echo $respuesta ? "Registrado modificado" : "Error al modificar" ;
    
            }
    
        break;
    
        case 'mostrar':
                $respuesta=$estancia->mostrar($id_usuario);
                echo json_encode($respuesta);
        
    
        case 'listar':
                $respuesta=$estancia->listar();
                $data= Array();
    
                while ($reg=$respuesta->fetch_object()){
                    $data[]=array(
                        "0"=>($reg->estatus_usuario)?'<button class="btn btn-warning" onclick="mostrar('.$reg->id_usuario.')"><i class="fa fa-pencil"></i></button>'.
                        ' <button class="btn btn-danger" onclick="desactivar('.$reg->id_usuario.')"><i class="fa fa-close"></i></button>':
                        '<button class="btn btn-warning" onclick="mostrar('.$reg->id_usuario.')"><i class="fa fa-pencil"></i></button>'.
                        ' <button class="btn btn-primary" onclick="activar('.$reg->id_usuario.')"><i class="fa fa-check"></i></button>',                
                         "1"=>$reg->email,
                         "2"=>$reg->nombre_usuario,
                         "3"=>$reg->apellido_paterno,
                         "4"=>$reg->apellido_materno,
                         "5"=>$reg->Curp,
                         "6"=>($reg->estatus_usuario)?'<span class="center p1 bg-green" > Activado </span>':
                                                        '<span class"label bg-red"> Desactivado </span>',
                         "7"=>$reg->nombre);
                    
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
