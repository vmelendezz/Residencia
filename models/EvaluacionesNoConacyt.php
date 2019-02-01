<?php

require "../config/conexion.php";


class EvalucionnoConacyt
{

    public function _construct()
    {

    }

    public function insertar($idUsuario,$cvu,$noConacyt,$institucion,$fechaInicio,$fechaFin,$cargo,$evaluacion,$dictamen,$nombre,$descripcion,$producto)

    {
        $sql="SELECT a.nombre FROM evaluacionnoconacyt a , 
            cvunoconacyt b ,cvu cv WHERE 
            a.idEvaluacionnoConacyt = b.idEvaluacionNoConacyt AND 
            b.idCvu=cv.idCvu and cv.idUsuarios='$idUsuario' AND a.nombre='$nombre' ";
        $datos=ejecutarConsultaSimpleFila($sql);
        if($datos<=0) { 

            $sqll ="INSERT INTO evaluacionnoconacyt(nombre, institucion,fechaInicio,fechaFin,cargo,idTipoEvaluacion,idProductoEvaluado,idDictamenConacyt,descripcion)
                     VALUES ('$nombre','$institucion','$fechaInicio','$fechaFin','$cargo','$evaluacion','$producto','$dictamen','$descripcion')";
            $registro = ejecutarConsulta_retornarID($sqll);

            echo $sqll;
            $sqlCvu ="INSERT INTO cvunoconacyt (idCvu,idEvaluacionnoConacyt)
                        VALUES ('$cvu','$registro')";

             return ejecutarConsulta($sqlCvu);
             echo $sqlCvu;

            } 
            else{ 
                return 0;
            }
        
       
    }

    public function editar($idUsuario,$cvu,$noConacyt,$institucion,$fechaInicio,$fechaFin,$cargo,$evaluacion,$dictamen,$nombre,$descripcion,$producto)
    {
        $sql="SELECT a.nombre FROM evaluacionnoconacyt a , 
             cvunoconacyt b ,cvu cv WHERE 
             a.idEvaluacionnoConacyt = b.idEvaluacionNoConacyt AND 
             b.idCvu=cv.idCvu and cv.idUsuarios='$idUsuario' AND a.nombre='$nombre' ";
        $datos=ejecutarConsultaSimpleFila($sql);
        if($datos<=0) { 
            $sql = " UPDATE evaluacionnoconacyt SET nombre='$nombre',intitucion='$institucion',fechaInicio='$fechaInicio',fechaFin='$fechaFin',cargo='$cargo',idTipoEvaluacion='$evaluacion',idProductoEvaluado='$producto',idDictamenConacyt='$dictamen',descripcion='$descripcion'";
            return ejecutarConsulta($sql);
            } 
            else{ 
                return 0;
            }
        
        
    }

    public function mostrar($noConacyt)
    {
        $sql = " SELECT * from evaluacionnoconacyt WHERE idEvaluacionnoConacyt ='$noConacyt' ";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar($idUsuario)
    {
      
        $sql ="SELECT a.nombre,a.fechaInicio,a.fechaFin,a.cargo,a.idEvaluacionnoConacyt
                FROM  evaluacionnoconacyt AS a ,cvu AS b, cvunoconacyt AS c
                 WHERE a.idEvaluacionnoConacyt = c.idEvaluacionnoConacyt 
                AND c.idCvu=b.idCvu   AND b.idUsuarios='$idUsuario'";
        return ejecutarConsulta($sql);

    }
   
    public function borrar($tecnico)
    {   
        $sql= "DELETE FROM evaluacionnoconacyt WHERE idEvaluacionnoConacyt='$noConacyt'";
        return ejecutarConsulta($sql);
    }


}


?>