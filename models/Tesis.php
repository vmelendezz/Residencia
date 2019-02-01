<?php

require "../config/conexion.php";


class Tesis{



    public function _construct()
    {

    }

    public function insertar($idUsuario,$nombre,$fechaInicio,$fechaFin,$institucion,$estado,$programa,$academico,$grado,$aprobacion,$obtencion,$campo,$area,$disciplina,$subdisciplina){
            $sql ="SELECT idCvu from cvu where idUsuarios='$idUsuario'";
            $cvu = ejecutarConsultaSimpleFila($sql);
            $id = $cvu['idCvu'];
            
            $sqlarea ="SELECT a.idAreaDisciplina FROM areadisciplinas as a , diciplinasubdisciplina as b WHERE a.idArea='$area' AND a.idCampo='$campo' AND b.idDisciplinaSub =a.idDisciplinaSub AND b.idDisciplina='$disciplina' AND b.idSubDisciplina ='$subdisciplina'";
            $areadis = ejecutarConsultaSimpleFila($sqlarea);
            $idarea = $areadis['idAreaDisciplina'];

          $sqlinsert ="INSERT INTO tesisdirigidas(nombreTesis,nombrePrograma,fechaInicio,idAreaDisciplina,fechaFin,idgradoTesis,institucion,CuerpoAcademico,estadoDireccion,numeroAlumnos,fechaAprobacion,fechaObtencionGrado) 
          VALUES ('$nombre','$programa','$fechaInicio','$idarea','$fechaFin','$grado','$institucion','$academico','$estado','$aprobacion','$obtencion')";
            $idestudio=ejecutarConsulta_retornarID($sqlinsert);

           
             $sqlEstudiosCvu ="INSERT INTO cvuestudiorealizados (idCvu,idEstudioRealizados)
              values ('$id','$idestudio')";
            echo  $sqlEstudiosCvu;
             return ejecutarConsulta($sqlEstudiosCvu) ; 

           
    }

    public function editar($idUsuario,$tesis,$nombre,$fechaInicio,$fechaFin,$institucion,$estado,$programa,$academico,$grado,$aprobacion,$obtencion,$campo,$area,$disciplina,$subdisciplina)
    {
        $sqlarea ="SELECT a.idAreaDisciplina FROM areadisciplinas as a , diciplinasubdisciplina as b WHERE a.idArea='$area' AND a.idCampo='$campo' AND b.idDisciplinaSub =a.idDisciplinaSub AND b.idDisciplina='$disciplina' AND b.idSubDisciplina ='$subdisciplina'";
        $areadis = ejecutarConsultaSimpleFila($sqlarea);
        $idarea = $areadis['idAreaDisciplina'];

        $sql = "UPDATE tesisdirigidas SET 
        nombreTesis='$nombre',nombrePrograma='$programa',fechaInicio='$fechaInicio',
        idAreaDisciplina='$idarea',fechaFin='$fechaFin',
        idgradoTesis='$grado',institucion='$institucion',
        CuerpoAcademico='$academico',estadoDireccion='$estado',
        fechaAprobacion='$aprobacion',
        fechaObtencionGrado='$obtencion' WHERE idTesisDirigidas ='$tesis'";
        return ejecutarConsulta($sql);

    }

    public function mostrar($tesis)
    {
        $sql = "SELECT a.idTesisDirigidas as id , a.nombreTesis, a.nombrePrograma, a.fechaInicio, a.idTipoProgramaPnpc,a.fechaFin, a.idgradoTesis as grado, a.institucion, a.CuerpoAcademico, a.estadoDireccion,a.fechaAprobacion, a.fechaObtencionGrado,
        
         c.idarea  as area , d.idcampo as campo,e.iddiciplina as disciplina,f.idsubdisciplina as subdisciplina,h.idAreaDisciplina
        FROM tesisdirigidas as a , area as c,campo as d ,diciplina as e,subdisciplina as f ,diciplinasubdisciplina as g,areadisciplinas as h
        WHERE e.idDiciplina=g.idDisciplina AND f.idsubdisciplina=g.idsubdisciplina and g.idDisciplinaSub=h.idDisciplinaSub AND c.idArea=h.idArea and d.idCampo=h.idCampo AND idTesisDirigidas='$tesis'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar($idUsuario)
    {
        $sql="SELECT a.idTesisDirigidas as id, a.nombreTesis,a.fechaInicio,a.fechaFin,d.nombre
                FROM tesisdirigidas as a ,cvutesis as b ,cvu as c,estadodireccion as d
                WHERE a.idTesisDirigidas=b.idTesisDirigidas AND b.idCvu=c.idCvu AND a.estadoDireccion=d.idEstadoDireccion AND c.idUsuarios='$idUsuario'";
       
        return ejecutarConsulta($sql);

    }
    public function borrar($tesis)
    {
        $sql ="DELETE from  cvutesis WHERE idTesisDirigidas ='$tesis'";
         $a=ejecutarConsulta($sql);
         

         $sqlv ="DELETE from tesisdirigidas WHERE idTesisDirigidas ='$tesis'";
         return ejecutarConsulta($sqlv);

    }
}
?>