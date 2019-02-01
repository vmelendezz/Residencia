<?php

require "../config/conexion.php";


class Estudios{



    public function _construct()
    {

    }

    public function insertar($idUsuario,$niveleEstudio,$tipoInstituto,$nombreInstituto,$nombretitulo,$estatusTitulacion,$opcionesTitulacion,$pais,$numerocedula,$siglasestudios,$fechainicio,$fechafin,$fechaobtencion,$periodo,$campo,$area,$diciplina,$subdiciplina){
            $sql ="SELECT idCvu from cvu where idUsuarios='$idUsuario'";
            $cvu = ejecutarConsultaSimpleFila($sql);
            $id = $cvu['idCvu'];
            
            $sqlarea ="SELECT a.idAreaDisciplina FROM areadisciplinas as a , diciplinasubdisciplina as b WHERE a.idArea='$area' AND a.idCampo='$campo' AND b.idDisciplinaSub =a.idDisciplinaSub AND b.idDisciplina='$disciplina' AND b.idSubDisciplina ='$subdisciplina'";
            $areadis = ejecutarConsultaSimpleFila($sqlarea);
            $idarea = $areadis['idAreaDisciplina'];

          $sqlEstudios ="INSERT INTO `estudiorealizados`(`idNivelEstudio`, `idTipoInstituto`, `instituto`, `noCedula`, `siglasEstudios`, `fechaInicio`, `fechaFin`, `fechaObtencion`, `periodo`, `pais`, `idEstatus`, `idOpcionTitulacion`, `nombreTitulo`, `idAreaDisciplina`)
             VALUES ('$niveleEstudio','$tipoInstituto','$nombreInstituto','$numerocedula','$siglasestudios','$fechainicio','$fechafin','$fechaobtencion','$periodo','$pais','$estatusTitulacion','$opcionesTitulacion','$nombretitulo','$idarea')";
            $idestudio=ejecutarConsulta_retornarID($sqlEstudios);

           
             $sqlEstudiosCvu ="INSERT INTO cvuestudiorealizados (idCvu,idEstudioRealizados)
              values ('$id','$idestudio')";
            echo  $sqlEstudiosCvu;
             return ejecutarConsulta($sqlEstudiosCvu) ; 

           
    }

    public function editar($idUsuario,$estudioRealizados,$niveleEstudio,$tipoInstituto,$nombreInstituto,$nombretitulo,$estatusTitulacion,$opcionesTitulacion,$pais,$numerocedula,$siglasestudios,$fechainicio,$fechafin,$fechaobtencion,$periodo,$campo,$area,$diciplina,$subdiciplina)
    {
        $sql = "UPDATE estudiorealizados SET `idNivelEstudio`='$niveleEstudio',`idTipoInstituto`='$tipoInstituto',`instituto`='$nombreInstituto',`noCedula`='$numerocedula',`siglasEstudios`='$siglasestudios',`fechaInicio`='$fechainicio',`fechaFin`='$fechafin',`fechaObtencion`='$fechaobtencion',`periodo`='$periodo',`pais`='$pais',`idEstatus`='$estatusTitulacion',`idOpcionTitulacion`='$opcionesTitulacion',`nombreTitulo`='$nombretitulo',`idAreaDisciplina`='1' WHERE idEstudioRealizados='$estudioRealizados'";
        return ejecutarConsulta($sql);

    }

    public function mostrar($estudioRealizados)
    {
        $sql = "SELECT  a.idEstudioRealizados As new ,a.idNivelEstudio as nivel, a.idTipoInstituto as institucion, a.instituto, a.noCedula, a.siglasEstudios,
        a.fechaInicio, a.fechaFin, a.fechaObtencion, a.periodo, a.pais, a.idEstatus as estatus, a.idOpcionTitulacion as opcion,
         a.nombreTitulo as titulo, c.idarea  as area , d.idcampo as campo,e.iddiciplina as disciplina,f.idsubdisciplina as subdisciplina,h.idAreaDisciplina
        FROM estudiorealizados as a , area as c,campo as d ,diciplina as e,subdisciplina as f ,diciplinasubdisciplina as g,areadisciplinas as h
        WHERE e.idDiciplina=g.idDisciplina AND f.idsubdisciplina=g.idsubdisciplina and g.idDisciplinaSub=h.idDisciplinaSub AND c.idArea=h.idArea and d.idCampo=h.idCampo AND idEstudioRealizados='$estudioRealizados'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar($idUsuario)
    {
        $sql="SELECT a.idEstudioRealizados as estudioRealizados, a.nombreTitulo,a.fechaInicio,a.fechaFin,d.nombre
                FROM estudiorealizados as a ,cvuestudiorealizados as b ,cvu as c,estatusestudios as d
                WHERE a.idEstudioRealizados=b.idEstudioRealizados AND b.idCvu=c.idCvu AND a.idEstatus=d.idEstatusEstudios AND c.idUsuarios='$idUsuario'";
       
        return ejecutarConsulta($sql);

    }
    public function borrar($estudioRealizados)
    {
        $sql ="DELETE from  cvuestudiorealizados WHERE idEstudioRealizados ='$estudioRealizados'";
         $a=ejecutarConsulta($sql);
         

         $sqlv ="DELETE from  estudiorealizados WHERE idEstudioRealizados ='$estudioRealizados'";
         return ejecutarConsulta($sqlv);

    }
}
?>