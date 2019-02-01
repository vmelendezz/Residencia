<?php

require "../config/conexion.php";


class CursoImpartido{



    public function _construct()
    {

    }

    public function insertar($idUsuario,$curso,$institucion,$nombre,$programa,$horas,$year,$fechainicio,$fechafin,$campo,$area,$disciplina,$subdisciplina){
            $sql ="SELECT idCvu from cvu where idUsuarios='$idUsuario'";
            $cvu = ejecutarConsultaSimpleFila($sql);
            $id = $cvu['idCvu'];
            
            $sqlarea ="SELECT a.idAreaDisciplina FROM areadisciplinas as a , diciplinasubdisciplina as b WHERE a.idArea='$area' AND a.idCampo='$campo' AND b.idDisciplinaSub =a.idDisciplinaSub AND b.idDisciplina='$disciplina' AND b.idSubDisciplina ='$subdisciplina'";
            $areadis = ejecutarConsultaSimpleFila($sqlarea);
            $idarea = $areadis['idAreaDisciplina'];

          $sqlinsert ="INSERT INTO cursoimpartido( institucion, nombrePrograma, nombreCurso, year, horasTotal, fechaInicio, fecchaFin, idAreaDisciplina, idTipoProgramaPnpc) 
            VALUES ('$institucion','$programa','$nombre','$year','$year','$fechainicio','$fechafin','$idarea','1')";
            $idinsert=ejecutarConsulta_retornarID($sqlinsert);

           
             $sqlCvu ="INSERT INTO cvucursoimpartido (idCvu,idCursoImpartido)
              values ('$id','$idinsert')";
            
             return ejecutarConsulta($sqlCvu) ; 

           
    }

    public function editar($idUsuario,$curso,$institucion,$nombre,$programa,$horas,$year,$fechainicio,$fechafin,$campo,$area,$disciplina,$subdisciplina)
    {

        $sqlarea ="SELECT a.idAreaDisciplina FROM areadisciplinas as a , diciplinasubdisciplina as b WHERE a.idArea='$area' AND a.idCampo='$campo' AND b.idDisciplinaSub =a.idDisciplinaSub AND b.idDisciplina='$disciplina' AND b.idSubDisciplina ='$subdisciplina'";
            $areadis = ejecutarConsultaSimpleFila($sqlarea);
            $idarea = $areadis['idAreaDisciplina'];

        $sql = "UPDATE cursoimpartido SET institucion='$institucion', nombrePrograma='$programa', 
        nombreCurso='$nombre', year='$year', horasTotal='$horas', fechaInicio='$fechainicio', 
        fecchaFin='$fechafin', idAreaDisciplina='$idarea', idTipoProgramaPnpc='1' WHERE idCursoImpartido ='$curso'";
        return ejecutarConsulta($sql);

    }

    public function mostrar($curso)
    {

                                                                                                  

        $sql = "SELECT  a.idCursoImpartido As id ,a.institucion, a.nombrePrograma as programa, a.nombreCurso as nombre , a.horasTotal as horas, a.fechaInicio,a.fecchaFin as fechafin,a.year 
        , c.idarea  as area , d.idcampo as campo,e.iddiciplina as disciplina,f.idsubdisciplina as subdisciplina
        FROM cursoimpartido as a , area as c,campo as d ,diciplina as e,subdisciplina as f ,diciplinasubdisciplina as g,areadisciplinas as h
        WHERE e.idDiciplina=g.idDisciplina AND f.idsubdisciplina=g.idsubdisciplina and g.idDisciplinaSub=h.idDisciplinaSub AND c.idArea=h.idArea and d.idCampo=h.idCampo AND idCursoImpartido='$curso'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar($idUsuario)
    {
        $sql="SELECT a.idCursoImpartido as id, a.nombreCurso,a.nombrePrograma,a.fechaInicio,a.fecchaFin
                FROM cursoimpartido as a ,	cvucursoimpartido as b ,cvu as c
                WHERE a.idCursoImpartido=b.idCursoImpartido AND b.idCvu=c.idCvu AND c.idUsuarios='$idUsuario'";
       
        return ejecutarConsulta($sql);

    }
    public function borrar($curso)
    {
        $sql ="DELETE from  cvucursoimpartido WHERE idCursoImpartido ='$curso'";
         $a=ejecutarConsulta($sql);
         

         $sqlv ="DELETE from  cursoimpartido WHERE idCursoImpartido ='$curso'";
         return ejecutarConsulta($sqlv);

    }
}
?>