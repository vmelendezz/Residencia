<?php

require "../config/conexion.php";


class Profesional{



    public function _construct()
    {

    }

    public function insertar($funcion,$idusuario,$actual,$puesto,$periodo,$institucion, $nombrepuesto){
        $sql ="SELECT idCvu from cvu where idUsuarios='$idusuario'";
            $cvu = ejecutarConsultaSimpleFila($sql);
            $id = $cvu['idCvu'];
           
         $sqlprofesional ="INSERT INTO experienciaprofesional( institucion, funcion, periodo, idActualAnterior, idPuesto) 
         VALUES ('$institucion','$funcion','$periodo','$actual','$puesto')";
            $idprofesional= ejecutarConsulta_retornarID($sqlprofesional);
            echo $sqlprofesional;
            
           
             $sqlfinal ="INSERT INTO cvuexperiencia (idCvu,idExperienciaProfesional) 
             values ('$id','$idprofesional')";
             return ejecutarConsulta($sqlfinal)  ;

           
    }

    public function editar($funcion,$idusuario,$profesional,$actual,$puesto,$periodo,$institucion, $nombrepuesto)
    {
        $sql = "UPDATE experienciaprofesional SET institucion='$institucion',funcion='$nombrepuesto',periodo='$periodo',
        idActualAnterior='$actual',idPuesto='$puesto'
         WHERE  idExperienciaProfesional='$profesional'";
        return ejecutarConsulta($sql);

    }

    public function mostrar($profesional)
    {
        $sql = " SELECT a.idExperienciaProfesional as id,a.periodo ,a.funcion,a.institucion,
                a.idPuesto as puesto,a.idActualAnterior as actual
        FROM experienciaprofesional as a   WHERE a.idExperienciaProfesional='$profesional'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar($idusuario)
    {
        $sql ="SELECT a.idExperienciaProfesional as profesional,b.nombre,a.funcion,a.institucion
         From actualanterior as b ,experienciaprofesional as a ,cvuexperiencia as c , cvu as d
         where a.idExperienciaProfesional=c.idExperienciaProfesional and b.idActualAnterior=a.idActualAnterior and c.idCvu=d.idCvu  and d.idUsuarios='$idusuario'";
        return ejecutarConsulta($sql);

    }
    public function borrar($profesional)
    {
        $sql ="DELETE from  cvu_estudio_realizados WHERE idExperienciaProfesional ='$profesional'";
         $a=ejecutarConsulta($sql);

         $sqlv ="DELETE from  experienciaprofesional WHERE idExperienciaProfesional ='$profesional'";
         return ejecutarConsulta($sqlv);

    }
}
?>