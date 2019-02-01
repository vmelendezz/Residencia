<?php

require "../config/conexion.php";


class OtrosEstudios{



    public function _construct()
    {

    }

    public function insertar($idUsuario,$continua,$nombre,$nombreInstituto,$year,$horas,$campo,$area,$disciplina,$subdisciplina){
            $sql ="SELECT idCvu from cvu where idUsuarios='$idUsuario'";
            $cvu = ejecutarConsultaSimpleFila($sql);
            $id = $cvu['idCvu'];
            echo $id;
            $sqlarea ="SELECT a.idAreaDisciplina FROM areadisciplinas as a , diciplinasubdisciplina as b WHERE a.idArea='$area' AND a.idCampo='$campo' AND b.idDisciplinaSub =a.idDisciplinaSub AND b.idDisciplina='$disciplina' AND b.idSubDisciplina ='$subdisciplina'";
            $areadis = ejecutarConsultaSimpleFila($sqlarea);
            $idarea = $areadis['idCvu'];

             $sqlEstudios ="INSERT INTO otroestudios(nombre, instituto, idFormacion, idAreaDisciplina,year,horas) 
                    VALUES ('$nombre','$nombreInstituto','$continua','1','$year','$horas')";
            $idestudio=ejecutarConsulta_retornarID($sqlEstudios);

            echo "$sqlEstudios";
           
             $sqlEstudiosCvu ="INSERT INTO cvuotrosestudios (idCvu,idOtrosEstudios)
              values ('$id','$idestudio')";
            echo  $sqlEstudiosCvu;
             return ejecutarConsulta($sqlEstudiosCvu) ; 

           
    }

    public function editar($idUsuario,$formacion,$continua,$nombre,$nombreInstituto,$year,$horas,$campo,$area,$diciplina,$subdiciplina)
    {
        $sql = "UPDATE otroestudios SET nombre='$nombre',instituto='$nombreInstituto',idFormacion='$continua',horas='$horas',year='$year',idAreaDisciplina='1'
                 WHERE idOtrosEstudios='$formacion'";
        return ejecutarConsulta($sql);

    }

    public function mostrar($formacion)
    {
        $sql = "SELECT a.idOtrosEstudios as otroestudio, a.nombre, a.instituto, a.idFormacion as formacion, a.year, a.horas , c.idarea as area , d.idcampo as campo,e.iddiciplina as disciplina,f.idsubdisciplina as subdisciplina 
        FROM otroestudios as a,area as c,campo as d ,diciplina as e,subdisciplina as f ,diciplinasubdisciplina as g,areadisciplinas as h 
        WHERE idOtrosEstudios ='$formacion' and e.idDiciplina=g.idDisciplina AND f.idsubdisciplina=g.idsubdisciplina and g.idDisciplinaSub=h.idDisciplinaSub AND c.idArea=h.idArea and d.idCampo=h.idCampo";
        return ejecutarConsultaSimpleFila($sql);
    }

    
    public function listar($idUsuario)
    {
        $sql="SELECT a.idOtrosEstudios as formacion, a.nombre,a.year,a.horas,d.nombreFormacion
                FROM otroestudios as a ,cvuotrosestudios as b ,cvu as c,formacioncontinua as d
                WHERE a.idOtrosEstudios=b.idOtrosEstudios AND b.idCvu=c.idCvu AND a.idFormacion=d.idFormacion AND c.idUsuarios='$idUsuario'";
        return ejecutarConsulta($sql);
        
    }
    public function borrar($formacion)
    {
        $sql ="DELETE from  cvuotrosestudios WHERE idOtrosEstudios ='$formacion'";
         $a=ejecutarConsulta($sql);

         $sqlv ="DELETE from  otroestudios WHERE idOtrosEstudios ='$formacion'";
         return ejecutarConsulta($sqlv);

    }
}
?>