<?php

require "../config/conexion.php";


class EstanciaInvestigacion{



    public function _construct()
    {

    }

    public function insertar($idUsuario,$nombre,$institucion,$fechainicio,$fechafin,$tipo,$logro,$campo,$area,$sub,$disciplina){
            $sql ="SELECT a.idCvu from cvu as a where idUsuarios='$idUsuario'";
            $cvu = ejecutarConsultaSimpleFila($sql);
            $id = $cvu['idCvu'];

            
            
            $sqlarea ="SELECT a.idAreaDisciplina FROM areadisciplinas as a , diciplinasubdisciplina as b 
            WHERE a.idArea='$area'
             AND b.idSubDisciplina='$sub' 
             AND a.idDisciplinaSub =b.idDisciplinaSub
             AND b.idDisciplina='$disciplina' AND 
             a.idCampo ='$campo'";
            $areadis = ejecutarConsultaSimpleFila($sqlarea);
            $idarea = $areadis['idAreaDisciplina'];
            echo $sqlarea;
            echo "hola";
            
            
           


          $sqlInsert ="INSERT INTO estanciasprofesional(nombre, institucion, fechaInicio, FechaFin, logro, idAreaDisciplina, idTipoInstancia)
           VALUES ('$nombre','$institucion','$fechainicio','$fechafin','$logro','$idarea','$tipo')";
            $idInsert=ejecutarConsulta_retornarID($sqlInsert);
            echo $sqlInsert;
           
             $sqlEstudiosCvu ="INSERT INTO cvuestanciasprofesional (idCvu,idEstanciasProfesional)
              values ('$id','$idInsert')";
            echo  $sqlEstudiosCvu;
             return ejecutarConsulta($sqlEstudiosCvu) ; 

           
    }

    public function editar($idUsuario,$id,$nombre,$institucion,$fechainicio,$fechafin,$tipo,$logro,$campo,$area,$sub,$disciplina)
    {
        $sql = "UPDATE estanciasprofesional SET nombre='$nombre',institucion='$institucion',fechaInicio='$fechainicio',FechaFin='$fechafin',
        logro='logros',idAreaDisciplina='$idarea',idTipoInstancia='$tipo' 
        WHERE idEstanciasProfesional ='$id' ";
        return ejecutarConsulta($sql);

    }

    public function mostrar($id)
    {
        $sql = "SELECT  a.idEstanciasProfesional as id, a.nombre, a.institucion, a.fechaInicio, a.FechaFin, a.logro, a.idTipoInstancia,
        
         c.idarea  as area , d.idcampo as campo,e.iddiciplina as disciplina,f.idsubdisciplina as subdisciplina,h.idAreaDisciplina
        FROM estanciasprofesional as a , area as c,campo as d ,diciplina as e,subdisciplina as f ,diciplinasubdisciplina as g,areadisciplinas as h
        WHERE e.idDiciplina=g.idDisciplina AND f.idsubdisciplina=g.idsubdisciplina and g.idDisciplinaSub=h.idDisciplinaSub AND c.idArea=h.idArea and d.idCampo=h.idCampo AND idEstanciasProfesional='$id'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar($idUsuario)
    {
        $sql="SELECT a.idEstanciasProfesional as id, a.nombre,a.fechaInicio,a.fechaFin,d.nombre as tipo
                FROM estanciasprofesional as a ,cvuestanciasprofesional as b ,cvu as c,tipoinstancia as d
                WHERE a.idEstanciasProfesional=b.idEstanciasProfesional AND b.idCvu=c.idCvu AND a.idTipoInstancia=d.idTipoInstancia AND c.idUsuarios='$idUsuario'";
       
        return ejecutarConsulta($sql);

    }
    public function borrar($id)
    {
        $sql ="DELETE from  cvuestanciasprofesional WHERE idEstanciasProfesional ='$id'";
         $a=ejecutarConsulta($sql);
         

         $sqlv ="DELETE from  estanciasprofesional WHERE idEstanciasProfesional ='$id'";
         return ejecutarConsulta($sqlv);

    }
}
?>