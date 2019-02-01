<?php

require "../config/conexion.php";


class Lenguas{



    public function _construct()
    {

    }

    public function insertar($idUsuario,$grado,$institucion,$nombrelengua,$conferido,$nivel,$lectura,$escritura,$certificacion,$evaluacion,$documento,$vigenciainicio,$vigenciafin,$puntos){
            $sql ="SELECT idCvu from cvu where idUsuarios='$idUsuario'";
            $cvu = ejecutarConsultaSimpleFila($sql);
            $id = $cvu['idCvu'];

          $sqlidiomas ="INSERT INTO lenguasindigenas( lengua, GradoDominio, nivelConversacion, nivelLectura, nivelEscritura, Certificacion, fechaEvaluacion, documento, VigenciaInicio, VigenciaFin, Puntos)
                         VALUES ('$nombrelengua','$grado','$nivel','$lectura','$escritura','$certificacion','$evaluacion','$documento','$vigenciainicio','$vigenciafin','$puntos')";
            $ididioma=ejecutarConsulta_retornarID($sqlidiomas);
            
             $sqllenguacvu ="INSERT INTO cvulenguasindigenas (idCvu,idLenguasIndigenas)
              values ('$id','$ididioma')";
            
             return ejecutarConsulta($sqllenguacvu) ;
           
    }

    public function editar($idUsuario,$lengua,$grado,$conferido,$idioma,$nombrelengua,$nivel,$lectura,$escritura,$certificacion,$evaluacion,$documento,$vigenciainicio,$vigenciafin,$puntos)
    {
        echo $vigenciafin;
        $sql = "UPDATE lenguasindigenas SET lengua='$nombrelengua',GradoDominio='$grado',nivelConversacion='$nivel',nivelLectura='$lectura',nivelEscritura='$escritura',Certificacion='$certificacion',fechaEvaluacion='$evaluacion',documento='$documento',VigenciaInicio='$vigenciainicio',VigenciaFin='$vigenciafin',Puntos='$puntos'
        WHERE  idLenguasIndigenas='$lengua'";
        return ejecutarConsulta($sql);

    }

    public function mostrar($lengua)
    {
        $sql = " SELECT idLenguasIndigenas as lenguas, lengua as nombrelengua, GradoDominio, nivelConversacion, nivelLectura, nivelEscritura, Certificacion, fechaEvaluacion, documento, VigenciaInicio, VigenciaFin, Puntos
         FROM lenguasindigenas  WHERE  idLenguasIndigenas ='$lengua'";
         echo $sql;
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar($idUsuario)
    {
        $sql="SELECT a.idLenguasIndigenas as lengua, a.lengua as nombre ,a.VigenciaInicio,a.VigenciaFin
                FROM lenguasindigenas as a ,cvulenguasindigenas as b ,cvu as c
                WHERE a.idLenguasIndigenas = b.idLenguasIndigenas AND b.idCvu=c.idCvu AND c.idUsuarios='$idUsuario'";
       
        return ejecutarConsulta($sql);

    }
    public function borrar($estudioRealizados)
    {
        $sql ="DELETE from  cvu_estudio_realizados WHERE id_Estudio_Realizados ='$id_Estudio_Realizados'";
         $a=ejecutarConsulta($sql);

         $sqlv ="DELETE from  estudio_realizados WHERE id_Estudio_Realizados ='$id_Estudio_Realizados'";
         return ejecutarConsulta($sqlv);

    }
}
?>
    