<?php

require "../config/conexion.php";


class Idiomas{



    public function _construct()
    {

    }

    public function insertar($idUsuario,$grado,$institucion,$nombreidioma,$conferido,$nivel,$lectura,$escritura,$certificacion,$evaluacion,$documento,$vigenciainicio,$vigenciafin,$puntos){
            $sql ="SELECT idCvu from cvu where idUsuarios='$idUsuario'";
            $cvu = ejecutarConsultaSimpleFila($sql);
            $id = $cvu['idCvu'];
            echo $nombreidioma;

          $sqlidiomas ="INSERT INTO idiomas(institucion, idioma, GradoDominio, nivelConversacion, nivelLectura, nivelEscritura, Certificacion, fechaEvaluacion, documento, VigenciaInicio, VigenciaFin, Puntos, nivelConferido)
                         VALUES ('$institucion','$nombreidioma','$grado','$nivel','$lectura','$escritura','$certificacion','$evaluacion','$documento','$vigenciainicio','$vigenciafin','$puntos','$conferido')";
            $ididioma=ejecutarConsulta_retornarID($sqlidiomas);
           
            echo "$ididioma";
           
             $sqlidiomacvu ="INSERT INTO cvuIdiomas (idCvu,idIdiomas)
              values ('$id','$ididioma')";
            echo  $sqlidiomacvu;
             return ejecutarConsulta($sqlidiomacvu) ;  

           
    }

    public function editar($idUsuario,$institucion,$idioma,$grado,$conferido,$nombre,$nivel,$lectura,$escritura,$certificacion,$evaluacion,$documento,$vigenciainicio,$vigenciafin,$puntos)
    {
        echo $vigenciafin;
        $sql = "UPDATE idiomas SET institucion='$institucion',idioma='$nombre',GradoDominio='$grado',nivelConversacion='$nivel',nivelLectura='$lectura',nivelEscritura='$escritura',Certificacion='$certificacion',fechaEvaluacion='$evaluacion',documento='$documento',
                VigenciaInicio='$vigenciainicio',VigenciaFin='$vigenciafin',Puntos='$puntos',nivelConferido='$conferido' WHERE idIdiomas='$idioma'";
        return ejecutarConsulta($sql);

    }

    public function mostrar($idioma)
    {
        $sql = " SELECT idIdiomas as idiomas, institucion, idioma as nombre, GradoDominio, nivelConversacion, nivelLectura, nivelEscritura, Certificacion, fechaEvaluacion, documento, VigenciaInicio, VigenciaFin, Puntos, nivelConferido
                 FROM idiomas WHERE  idIdiomas ='$idioma'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar($idUsuario)
    {
        $sql="SELECT a.idIdiomas as idiomas, a.idioma as nombre ,a.VigenciaInicio,a.VigenciaFin
                FROM idiomas as a ,cvuIdiomas as b ,cvu as c
                WHERE a.idIdiomas = b.idIdiomas AND b.idCvu=c.idCvu AND c.idUsuarios='$idUsuario'";
       
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
    