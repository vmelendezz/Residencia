<?php

require "../config/conexion.php";


class Evaluacionconacyt
{

    public function _construct()
    {

    }

    public function insertar($idUsuario,$cvu,$nombre,$asignacion,$aceptacion,$evaluacion,$descripcion,$dictamen)

    {
        $sql="SELECT a.nombre FROM evaluacionconacyt a , 
            cvuconacyt b ,cvu cv WHERE 
            a.idEvaluacionConacyt = b.idEvaluacionConacyt AND 
            b.idCvu=cv.idCvu and cv.idUsuarios='$idUsuario' AND a.nombre='$nombre' ";
        $datos=ejecutarConsultaSimpleFila($sql);
        if($datos<=0) { 
            $sqll ="INSERT INTO evaluacionconacyt( nombre,fechaAsignacion,fechaAceptacion,fechaEvaluacion,Descripcion,idDictamenConacyt)
                     VALUES ('$nombre','$asignacion','$aceptacion','$evaluacion','$descripcion','$dictamen')";
            $registro = ejecutarConsulta_retornarID($sqll);
            
            $sqlCvu ="INSERT INTO cvuconacyt (idCvu,idEvaluacionConacyt)
                        VALUES ('$cvu','$registro')";
           
            return ejecutarConsulta($sqlCvu);
                

            } 
            else{ 
                return 0;
            }
        
       
    }

    public function editar($idUsuario,$conacyt,$nombre,$asignacion,$aceptacion,$evaluacion,$descripcion,$dictamen)
    {
        $sql="SELECT a.nombre FROM evaluacionconacyt a , 
            cvuconacyt b ,cvu cv WHERE 
            a.idEvaluacionConacyt = b.idEvaluacionConacyt AND 
            b.idCvu=cv.idCvu and cv.idUsuarios='$idUsuario' AND a.nombre='$nombre' ";
        $datos=ejecutarConsultaSimpleFila($sql);
        if($datos<=0) { 
            $sql = " UPDATE evaluacionnoconacyt SET nombre='$nombre',fechaAsignacion='$asignacion',fechaAceptacion='$aceptacion',fechaEvaluacion='$evaluacion',Descripcion='$descripcion',idDictamenConacyt='$dictamen'";
            return ejecutarConsulta($sql);
            } 
            else{ 
                return 0;
            }
        
        
    }

    public function mostrar($conacyt)
    {
        $sql = " SELECT * from evaluacionconacyt WHERE idEvaluacionConacyt ='$noConacyt' ";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar($idUsuario)
    {
      
        $sql ="SELECT a.idEvaluacionConacyt,a.nombre,a.fechaAsignacion,a.fechaAceptacion,a.fechaEvaluacion,d.nombre As ditamenNombre
                FROM  evaluacionconacyt AS a ,cvu AS b, cvuconacyt AS c ,dictamenconacyt As d
                 WHERE a.idEvaluacionConacyt = c.idEvaluacionConacyt AND a.idDictamenConacyt=d.idDictamenConacyt
                AND c.idCvu=b.idCvu   AND b.idUsuarios='$idUsuario'";
        return ejecutarConsulta($sql);

    }
   
    public function borrar($conacyt)
    {   
        $sql= "DELETE FROM evaluacionnoconacyt WHERE idEvaluacionnoConacyt='$conacyt'";
        return ejecutarConsulta($sql);
    }


}


?>