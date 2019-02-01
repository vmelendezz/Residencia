<?php

require "../config/conexion.php";


class RedesTematicas{



    public function _construct()
    {

    }

    public function insertar($idUsuario,$nombre,$ingreso){
            $sql ="SELECT idCvu from cvu where idUsuarios='$idUsuario'";
            $cvu = ejecutarConsultaSimpleFila($sql);
            $id = $cvu['idCvu'];
            
    

          $sqlinsert ="INSERT INTO redestematicas(fechaIngreso,idTipoTedesTematicas) 
          VALUES ('$ingreso','$nombre')";
            $idinsert=ejecutarConsulta_retornarID($sqlinsert);

           
             $sqlCvu ="INSERT INTO cvutematicas (idCvu,idRedesTematicas)
              values ('$id','$idinsert')";
            
             return ejecutarConsulta($sqlCvu) ; 

           
    }

    public function editar($idUsuario,$tematicas,$nombre,$ingreso)
    {
        

        $sql = "UPDATE redestematicas SET 
        fechaIngreso='$ingreso',idTipoTedesTematicas='$nombre'
        WHERE idRedesTematicas ='$tematicas'";
        return ejecutarConsulta($sql);

    }

    public function mostrar($tematicas)
    {
        $sql = "SELECT idRedesTematicas as id,fechaIngreso,idTipoTedesTematicas as nombre from redestematicas where
          idTesisDirigidas='$tematicas'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar($idUsuario)
    {
       
        $sql="SELECT a.idRedesTematicas as id, a.fechaIngreso,d.nombre
                FROM redestematicas as a ,cvutematicas as b ,cvu as c,tiporedestematicas as d
                WHERE a.idRedesTematicas=b.idRedesTematicas AND b.idCvu=c.idCvu AND a.idTipoTedesTematicas=d.idTipoRedesTematicas AND c.idUsuarios='$idUsuario'";
       
       
        return ejecutarConsulta($sql);

    }
    public function borrar($tematicas)
    {
        $sql ="DELETE from  cvutematicas WHERE idRedesTematicas ='$tematicas'";
         $a=ejecutarConsulta($sql);
         

         $sqlv ="DELETE from redestematicas WHERE idRedesTematicas ='$tematicas'";
         return ejecutarConsulta($sqlv);

    }
}
?>