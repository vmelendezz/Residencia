<?php

require "../config/conexion.php";


class RedesInvestigacion
{

    public function _construct()
    {

    }

    public function insertar($idUsuario,$redes,$institucion,$nombre,$creacion,$asignacion,$nombreResponsable,$ingreso,$primero,$segundo,$total,$area,$campo,$disciplina,$subdisciplina)
    {
        $sqlcvu ="SELECT idCvu from cvu where idUsuarios='$idUsuario'";
            $cvu = ejecutarConsultaSimpleFila($sqlcvu);
            $id = $cvu['idCvu'];
            
            $sqlarea ="SELECT a.idAreaDisciplina FROM areadisciplinas as a , diciplinasubdisciplina as b WHERE a.idArea='$area' AND a.idCampo='$campo' AND b.idDisciplinaSub =a.idDisciplinaSub AND b.idDisciplina='$disciplina' AND b.idSubDisciplina ='$subdisciplina'";
            $areadis = ejecutarConsultaSimpleFila($sqlarea);
            $idarea = $areadis['idAreaDisciplina'];

        $sql="SELECT a.nombre FROM redesinvestigacion a , 
            cvuinvestigacion b ,cvu cv WHERE 
            a.idRedesInvestigacion = b.idRedesInvestigacion AND 
            b.idCvu=cv.idCvu and cv.idUsuarios='$idUsuario' AND a.nombre='$nombre'";
        $datos=ejecutarConsultaRows($sql);
        if($datos<=0) { 
            $sqll ="INSERT INTO redesinvestigacion( nombre,institucion,FechaCreacion,fecheInicio,fehcaAsignacion,totalIntegrantes,idAreaDisciplina,nombreResponsable,aperllidoPaterno,apellidoMaterno) VALUES ('$nombre','$institucion','$creacion','$ingreso','$asignacion','$total','1','$nombreResponsable','$primero','$segundo')";
            $registro = ejecutarConsulta_retornarID($sqll);
            
            $sqlCvu ="INSERT INTO cvuinvestigacion (idCvu,idRedesInvestigacion)
                        VALUES ('$id','$registro')";
            
            return ejecutarConsulta($sqlCvu);
                

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
        $sql = " SELECT a.idRedesInvestigacion as id, a.nombre, a.FechaCreacion, a.fecheInicio, a.fehcaAsignacion, a.institucion, a.totalIntegrantes as total,a.idAreaDisciplina, a.nombreResponsable as responsable, a.aperllidoPaterno, a.apellidoMaterno
         FROM redesinvestigacion as a where idRedesInvestigacion ='$redes' ";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar($idUsuario)
    {
      
        $sql ="SELECT a.nombre,a.institucion,a.FechaCreacion,a.fecheInicio, a.totalIntegrantes,a.idRedesInvestigacion
                FROM  redesinvestigacion AS a ,cvu AS b, cvuinvestigacion AS c
                 WHERE a.idRedesInvestigacion = c.idRedesInvestigacion 
                AND c.idCvu=b.idCvu   AND b.idUsuarios='$idUsuario'";
        return ejecutarConsulta($sql);

    }
   
    public function borrar($redes)
    {    $sql= "DELETE FROM cvuinvestigacion WHERE idRedesInvestigacion='$redes'";
        $a= ejecutarConsulta($sql);
        $sql= "DELETE FROM redesinvestigacion WHERE idRedesInvestigacion='$redes'";
        return ejecutarConsulta($sql);
    }


}


?>