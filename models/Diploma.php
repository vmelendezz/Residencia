<?php

require "../config/conexion.php";


class Diploma
{

    public function _construct()
    {

    }

    public function insertar($idUsuario,$diploma,$nombre,$institucion,$nombreCurso,$year,$horasTotal,$area,$campo,$disciplina,$sub)
    {
        
        $sql="SELECT a.nombre FROM diplomasimpartidos a , 
            cvudiplomasimpartidos b ,cvu cv WHERE 
            a.idDiplomasImpartidos = b.idDiplomasImpartidos AND 
            b.idCvu=cv.idCvu and cv.idUsuarios='$idUsuario' and a.nombre='$nombre' ";

        $datos= ejecutarConsultaRows($sql);
        if($datos<=0) { 
            
            $sqlarea ="SELECT a.idAreaDisciplina FROM areadisciplinas as a , diciplinasubdisciplina as b WHERE a.idArea='$area' AND a.idCampo='$campo' AND b.idDisciplinaSub =a.idDisciplinaSub AND b.idDisciplina='$disciplina' AND b.idSubDisciplina ='$disciplina'";
            $area = ejecutarConsultaSimpleFila($sqlarea);
            $idarea = $area['idAreaDisciplina'];

            $sql ="SELECT idCvu from cvu where idUsuarios='$idUsuario'";
            $cvu = ejecutarConsultaSimpleFila($sql);
            $id = $cvu['idCvu'];
        

            $sqll ="INSERT INTO diplomasimpartidos( institucion, nombre, nombreCursoAsig, year, horasTotal, idAreaDisciplina)
                     VALUES ('$institucion','$nombre','$nombreCurso','$year','$horasTotal','$idarea')";
            $registro = ejecutarConsulta_retornarID($sqll);
            echo $registro;
            $sqlCvu ="INSERT INTO cvudiplomasimpartidos (idCvu,idDiplomasImpartidos)
                        VALUES ('$id','$registro')";
            return ejecutarConsulta($sqlCvu);
                

            } 
            else{ 
                return 0;
            }
        
       
    }

    public function editar($idUsuario,$diploma,$nombre,$institucion,$nombreCurso,$year,$horasTotal,$area,$campo,$diciplina,$subdisciplina)
    {
        $sql="SELECT a.nombre FROM diplomasimpartidos a , 
            cvudiplomasimpartidos b ,cvu cv WHERE 
            a.idDiplomasImpartidos = b.idDiplomasImpartidos AND 
            b.idCvu=cv.idCvu and cv.idUsuarios='$idUsuario' ";
        $datos=ejecutarConsultaRows($sql);
        if($datos<=0) { 
            $sql = " UPDATE idDiplomasImpartidos SET nombre='$nombre',intiticion='$institucion',paterno='$paterno',=materno'$materno',nombreCurso='$nombreCurso',year='$year',horasTotal='$horasTotal',$area,$campo,$diciplina,$subdisciplina";
            return ejecutarConsulta($sql);
            } 
            else{ 
                return 0;
            }
        
        
    }

    public function mostrar($diploma)
    {
        $sql = " SELECT a.idDiplomasImpartidos as id ,a.nombre,a.institucion,a.nombreCursoAsig,a.year,a.horasTotal,
        c.idarea  as area , d.idcampo as campo,e.iddiciplina as disciplina,f.idsubdisciplina as subdisciplina,h.idAreaDisciplina
         FROM DiplomasImpartidos as a , area as c,campo as d ,diciplina as e,subdisciplina as f ,diciplinasubdisciplina as g,areadisciplinas as h
        WHERE e.idDiciplina=g.idDisciplina AND f.idsubdisciplina=g.idsubdisciplina and g.idDisciplinaSub=h.idDisciplinaSub AND c.idArea=h.idArea and d.idCampo=h.idCampo AND
        a.idDiplomasImpartidos ='$diploma'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar($idUsuario)
    {
        
        $sql ="SELECT a.nombre, a.institucion, a.year, a.horastotal, a.idDiplomasImpartidos as id
                FROM  diplomasimpartidos AS a ,cvu AS b, cvudiplomasimpartidos AS c
                 WHERE a.idDiplomasImpartidos = c.idDiplomasImpartidos 
                AND c.idCvu=b.idCvu   AND b.idUsuarios='$idUsuario'";
                
        return ejecutarConsulta($sql);

    }
   
    public function borrar($diploma)
    {   
        $sqlcvu="DELETE from cvudiplomasimpartidos where idDiplomasImpartidos='$diploma'";
        $a=ejecutarConsulta($sqlcvu);

        $sql= "DELETE FROM diplomasimpartidos WHERE idDiplomasImpartidos='$diploma'";
        return ejecutarConsulta($sql);
    }


}


?>