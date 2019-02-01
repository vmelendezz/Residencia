<?php

require "../config/conexion.php";


class Tecnico
{

    public function _construct()
    {

    }

    public function insertar($idUsuario,$cvu,$redes,$institucion,$nombre,$creacion,$asignacion,$nombreResponsable,$ingreso,$primero,$segundo,$total,$area,$campo,$diciplina,$subdiciplina)
    {
        $sql="SELECT a.nombre FROM redesinvestigacion a , 
            cvuinvestigacion b ,cvu cv WHERE 
            a.idRedesInvestigacion = b.idRedesInvestigacion AND 
            b.idCvu=cv.idCvu and cv.idUsuarios='$idUsuario' AND a.nombre='$nombre'";
        $datos=ejecutarConsultaSimpleFila($sql);
        if($datos<=0) { 
            $sqll ="INSERT INTO reportestecnicos(  nombre,intitucion,FechaCreacion,fecheInicio,fehcaAsignacion,totalIntegrantes,idAreaDisiciplina,nombreResponsable,aperllidoPaterno,apellidoMaterno)
                     VALUES ('$nombre','$institucion','$creacion','$ingreso','$asignacion','$total','$idAreaDisiciplina','$','$nombreResponsable','$primero','$segundo')";
            $registro = ejecutarConsulta_retornarID($sqll);

            $sqlCvu ="INSERT INTO cvuinvestigacion (idCvu,idRedesInvestigacion)
                        VALUES ('$cvu','$registro')";

             ejecutarConsulta($sqlCvu);
                

            } 
            else{ 
                return 0;
            }
        
       
    }

    public function editar($idUsuario,$cvu,$redes,$institucion,$nombre,$creacion,$asignacion,$nombreResponsable,$ingreso,$primero,$segundo,$total,$area,$campo,$diciplina,$subdiciplina)
    {
        $sql="SELECT a.nombre FROM redesinvestigacion a , 
            cvuinvestigacion b ,cvu cv WHERE 
            a.idRedesInvestigacion = b.idRedesInvestigacion AND 
            b.idCvu=cv.idCvu and cv.idUsuarios='$idUsuario' AND a.nombre='$nombre'";
        $datos=ejecutarConsultaSimpleFila($sql);
        if($datos<=0) { 
            $sql = " UPDATE redesinvestigacion SET  nombre='$nombre',intitucion='$institucion',FechaCreacion='$creacion',fecheInicio='$ingreso',fehcaAsignacion='$asignacion',totalIntegrantes='$total',idAreaDisiciplina='$',nombreResponsable='$nombreResponsable',aperllidoPaterno='$primero',apellidoMaterno='$segundo' WHERE idRedesInvestigacion ='$redes'";
            return ejecutarConsulta($sql);
            } 
            else{ 
                return 0;
            }
        
        
    }

    public function mostrar($redes)
    {
        $sql = " SELECT * FROM redesinvestigacion  where idRedesInvestigacion ='$redes' ";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar($idUsuario)
    {
      
        $sql ="SELECT a.nombre,a.institucion,a.FechaCreacion,a.fecheInicio, a.totalIntegrantes,a.idRedesInvestigacion
                FROM  redesinvestigacion AS a ,cvu AS b, cvuinvestigacion AS c
                 WHERE a.idRedesInvestigacion = c.idRedesInvestigacion 
                AND c.idCvu=b.idCvu   AND b.idUsuario='$idUsuario'";
        return ejecutarConsulta($sql);

    }
   
    public function borrar($redes)
    {   
        $sql= "DELETE FROM redesinvestigacion WHERE idRedesInvestigacion='$redes'";
        return ejecutarConsulta($sql);
    }


}


?>