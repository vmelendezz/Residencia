<?php

require "../config/conexion.php";


class Experiencia{



    public function _construct()
    {

    }

    public function insertar($idUsuario, $nivel,$periodo,$institucion, $nombre){
        $sql ="SELECT idCvu from cvu where idUsuarios='$idUsuario'";
            $cvu = ejecutarConsultaSimpleFila($sql);
            $id = $cvu['idCvu'];
           
         $sqlexperiencia ="INSERT INTO  experienciadocente (periodo,nombreCurso,idTipoNivel,experienciaInstitucion)
             values ('$periodo', '$nombre','$nivel', '$institucion')";
            $idexperiecia= ejecutarConsulta_retornarID($sqlexperiencia);
            
           
             $sqlfinal ="INSERT INTO cvuexperienciadocente (idCvu,idExperienciaDocente) 
             values ('$id','$idexperiecia')";
             return ejecutarConsulta($sqlfinal)  ;

           
    }

    public function editar($experiencia,$nivel,$periodo,$institucion, $nombre)
    {
        $sql = "UPDATE experienciadocente SET idTipoNivel='$nivel',periodo='$periodo', experienciaInstitucion='$institucion', nombreCurso='$nombre'
         WHERE idExperienciaDocente='$experiencia'";
        return ejecutarConsulta($sql);

    }

    public function mostrar($experiencia)
    {
       
        $sql = " SELECT a.idExperienciaDocente as experiencia, a.nombreCurso ,a.periodo ,a.idTipoNivel ,a.experienciaInstitucion
        FROM experienciadocente as a WHERE a.idExperienciaDocente='$experiencia'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar($idusuario)
    {
        $sql ="SELECT a.idExperienciaDocente as experiencia,a.nombreCurso  ,a.periodo,b.nombre,a.experienciaInstitucion
         FROM experienciadocente as a  , cvuexperienciadocente as c ,cvu d, tiponivel as b
          WHERE a.idExperienciaDocente = c.idExperienciaDocente AND c.idCvu=d.idCvu AND a.idTipoNivel=b.idTipoNivel and d.idUsuarios='$idusuario'";
        return ejecutarConsulta($sql);

    }
    public function borrar($experiencia)
    {
        $sql ="DELETE from  cvuexperienciadocente WHERE idExperienciaDocente ='$experiencia'";
         $a=ejecutarConsulta($sql);

         $sqlv ="DELETE from  experienciadocente WHERE idExperienciaDocente ='$experiencia'";
         return ejecutarConsulta($sqlv);

    }
}
?>