<?php

require "../config/conexion.php";


class InfoBasic{



    public function _construct()
    {

    }

    public function insertar($idUsuario,$campus,$departamento){

        $sql="SELECT idCampusDepartamento from campusdepartamento where idCampus='$campus' and idDepartamento='$departamento'";
            $cvu = ejecutarConsultaSimpleFila($sql);
            $id = $cvu['idCampusDepartamento'];

          $sqlbasic ="INSERT INTO cvu(idCampusDepartamento,idUsuarios)
                         VALUES ('$id','$idUsuario')";
           return ejecutarConsulta($sqlbasic);

        }

    public function editar($cvu,$campus,$departamento){
        $sqlcd="SELECT idCampusDepartamento
         FROM campusdepartamento
          WHERE idCampus='$campus' and idDepartamento='$departamento'";

          $deca = ejecutarConsultaSimpleFila($sqlcd);
          $id=$deca["idCampusDepartamento"];
        $sql="UPDATE cvu SET idCampusDepartamento='$id' WHERE idCvu='$cvu'";

        
        return ejecutarConsulta($sql);

       

    }
           
         
    public function mostrar($idUsuario)
    {
        $sql="SELECT a.idCvu as cvu,b.idDepartamento,c.idCampus 
        from cvu as a,departamento as b ,campus as c,campusdepartamento as d
         where a.idCampusDepartamento = d.idCampusDepartamento AND d.idCampus=c.idCampus AND d.idDepartamento= b.idDepartamento
         AND a.idUsuarios ='$idUsuario' ";

         return ejecutarConsultaSimpleFila($sql);

    }
           
   

}

  
?>
    