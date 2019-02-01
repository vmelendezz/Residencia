<?php
    session_start();


    require_once "../models/Usuarios.php";
    
    $usuario = new Usuarios();

    $idUsuarios=isset($_POST["usuarionew"])? limpiarCadena($_POST["usuarionew"]):"";
    $email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";
    $password=isset($_POST["password"])? limpiarCadena($_POST["password"]):"";
    $nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
    $apellidoPaterno=isset($_POST["paterno"])? limpiarCadena($_POST["paterno"]):"";
    $apellidoMaterno=isset($_POST["materno"])? limpiarCadena($_POST["materno"]):"";
    $Curp=isset($_POST["Curp"])? limpiarCadena($_POST["Curp"]):"";
    $idestado_civil=isset($_POST["id_estadocivil"])? limpiarCadena($_POST["id_estadocivil"]):"";
    
    switch($_GET["op"]){
    
        case 'guardaryeditar':

            if(empty($idUsuarios)){
                $clave=hash("SHA256",$password);


                if(preg_match(' /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/ ',$email)&& 
                   preg_match (' /^([aA-zZÁÉÍÓÚñáéíóú]+[\s]*)+$/ ',$nombre)
                   && preg_match(' /^[a-zA-ZÁÉÍÓÚñáéíóú]+$/ ',$apellidoMaterno )
                   && preg_match(' /^[a-zA-ZÁÉÍÓÚñáéíóú]+$/ ' ,$apellidoPaterno)
                   && preg_match(' /^[0-9a-zA-Z]+$/ ',$Curp) && 
                   $idestado_civil != null 
                   && $clave !=null
                    )
                {


                    $respuesta=$usuario->insertar($email,$clave,$nombre,$apellidoPaterno,$apellidoMaterno,$Curp,$idestado_civil);
                    echo $respuesta ;

                } else {
                    $respuesta=0;
                    echo $respuesta ? "":"Datos no cumplen con los criterios";
                }
                
            }
            else{
                $clave=hash("SHA256",$password);

                $respuesta=$usuario->editar($idUsuarios,$email,$clave,$nombre,$apellidoPaterno,$apellidoMaterno,$Curp,$idestado_civil);
                echo $respuesta ? "Registrado modificado" : "Error al modificar" ;
    
            }
    
        break;
    
        case 'mostrar':
                $respuesta=$usuario->mostrar($idUsuarios);
                echo json_encode($respuesta);
        break;

        case 'desactivar':
                $respuesta=$usuario->desactivar($idUsuarios);
                echo $respuesta ? "usuario desactivado" : "Error al  desactivar usuario " ;
        break;

        case 'activar':
               $respuesta=$usuario->activar($idUsuarios);
               echo $respuesta ? "usuario activado" : "Error al activado usuario" ;
        break;

        case 'selectEstado':
            require_once "../models/Estadocivil.php";
            $estado_civil = new Estadocivil();
                 $respuesta=$estado_civil->select();
                 while ($reg = $respuesta->fetch_object())
				{
					echo '<option value=' .$reg->idEstadoCivil. '>' .$reg->nombre.'</option>';
				}
                
        break;
    
        case 'listar':
                $respuesta=$usuario->listar();
                $data= Array();
                while ($reg=$respuesta->fetch_object()){
                    $data[]=array(
                        "0"=>($reg->estatusUsuario)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idUsuarios.')"><i class="fa fa-pencil"></i></button>'.
                        ' <button class="btn btn-danger" onclick="desactivar('.$reg->idUsuarios.')"><i class="fa fa-close"></i></button>':
                        '<button class="btn btn-warning" onclick="mostrar('.$reg->idUsuarios.')"><i class="fa fa-pencil"></i></button>'.
                        ' <button class="btn btn-primary" onclick="activar('.$reg->idUsuarios.')"><i class="fa fa-check"></i></button>',                
                         "1"=>$reg->correo,
                         "2"=>$reg->nombre,
                         "3"=>$reg->apellidoPaterno,
                         "4"=>$reg->apellidoMaterno,
                         "5"=>$reg->curp,
                         "6"=>($reg->estatusUsuario)?'<span class="center p1 bg-green" > Activado </span>':
                                                        '<span class"label bg-red"> Desactivado </span>',
                         "7"=>$reg->civil);
                    
                }
                $results = array(
                    "sEcho"=>1, //Información para el datatables
                    "iTotalRecords"=>count($data), //enviamos el total registros al datatable
                    "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
                    "aaData"=>$data);
                echo json_encode($results);
        break;

        case'verificar':
            $emails=$_POST['emails'];
            $passwords=$_POST['passwords'];
            
            
            if(preg_match(' /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/ ',$emails)&&
            preg_match('/^[a-zA-Z0-9]+$/',$passwords) ){
                   
                //    $clave=hash("SHA256",$passwords);

                    $respuesta=$usuario->verificar($emails,$passwords);
                    $fetch=$respuesta->fetch_object();
                    if(isset($fetch)){   
                        $_SESSION['idusuario']=$fetch->idUsuarios;
                        $_SESSION['email']=$fetch->correo;
                        $_SESSION['nombreusuario']=$fetch->nombre;
                        $_SESSION['tipoUSuario']=$fetch->idTipoUsuario;
                    }
                echo json_encode($fetch);
                 
            } else{
                echo json_encode(null);
            }
        break;

        case 'salir':
            session_unset(); // limpiar variables de sesion
            session_destroy();
            header("location: ../index.php");

        break;
        
    
    }


?>