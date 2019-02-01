<?php

if(strlen(session_id())<1)
session_start();

require_once "../models/DatosGenerales.php";

$datos = new DatosGenerales();

$idUsuario=$_SESSION['idusuario'];

$dato=isset($_POST["datos"])? limpiarCadena($_POST["datos"]):"";
$rfc=isset($_POST["rfc"])? limpiarCadena($_POST["rfc"]):"";
$sexo=isset($_POST["sexo"])? limpiarCadena($_POST["sexo"]):"";
$fecha=isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";
$pais=isset($_POST["pais"])? limpiarCadena($_POST["pais"]):"";
$nacionalidad=isset($_POST["nacionalidad"])? limpiarCadena($_POST["nacionalidad"]):"";
$entidad=isset($_POST["entidad"])? limpiarCadena($_POST["entidad"]):"";
$conacyt=isset($_POST["conacyt"])? limpiarCadena($_POST["conacyt"]):"";
$promep=isset($_POST["promep"])? limpiarCadena($_POST["promep"]):"";
$tecmm=isset($_POST["tecmm"])? limpiarCadena($_POST["tecmm"]):"";


switch ($_GET["op"]){

    case 'guardaryeditar':
        if(empty($dato)){

           $respuesta=$datos->insertar($idUsuario,$rfc,$sexo,$fecha,$pais,$nacionalidad,$entidad,$conacyt,$promep,$tecmm);
           echo $respuesta ? "Registrado" : "Error al registrar" ;
        }
        else{
            $respuesta=$datos->editar($dato,$idUsuario,$rfc,$sexo,$fecha,$pais,$nacionalidad,$entidad,$conacyt,$promep,$tecmm);
            echo $respuesta ? "Registrado modificado" : "Error al modificar" ;

        }

    break;

    case 'mostrar':
            $respuesta=$datos->mostrar($idUsuario);
            echo json_encode($respuesta);
    break;


  

}
?>