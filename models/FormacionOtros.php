<?php

require "../config/conexion.php";


class FormacionOtros{



    public function _construct()
    {

    }

    public function insertar($idUsuario,$continua,$nombre,$nombreInstituto,$year,$horas,$campo,$area,$diciplina,$subdiciplina){
            $sql ="SELECT idCvu from cvu where idUsuarios='$idUsuario'";
            $cvu = ejecutarConsultaSimpleFila($sql);
            $id = $cvu['idCvu'];
            echo $id;

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
        $sql = " SELECT * FROM otroestudios WHERE idOtrosEstudios ='$formacion'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar($idUsuario)
    {
        $sql="SELECT a.idOtrosEstudios as formacion, a.nombre,a.year,a.horas,d.nombreFormacion
                FROM otroestudios as a ,cvuotrosestudios as b ,cvu as c,formacioncontinua as d
                WHERE a.idOtrosEstudios=b.idOtrosEstudios AND b.idCvu=c.idCvu AND a.idFormacion=d.idFormacion AND c.idUsuarios='$idUsuario'";
        return ejecutarConsulta($sql);
        
    }
    public function borrar($id_Estudio_Realizados,$id_cvu)
    {
        $sql ="DELETE from  cvu_estudio_realizados WHERE id_Estudio_Realizados ='$id_Estudio_Realizados'";
         $a=ejecutarConsulta($sql);

         $sqlv ="DELETE from  estudio_realizados WHERE id_Estudio_Realizados ='$id_Estudio_Realizados'";
         return ejecutarConsulta($sqlv);

    }
}
?>