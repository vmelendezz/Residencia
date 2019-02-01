<?php


$idUsuario=$_SESSION['idusuario'];

require "../config/conexion.php";


class Certificadosmedicos{



    public function _construct()
    {

    }

    public function insertar($idUsuario,$folio,$vigenciade,$vigenciaa,$especialidad,$tipo,$instituto){
            $sql ="SELECT idCvu from cvu where idUsuarios='$idUsuario'";
            $cvu = ejecutarConsultaSimpleFila($sql);
            $id = $cvu['idCvu'];
          

          $sqlinsert ="INSERT INTO certificacionesmedicas( numeroFolio, fechaVigenciaDe, fechaVigenciaA, consejoOtorga, especialidad, tipoCertificacion)
           VALUES ('$folio','$vigenciade','$vigenciaa','$instituto','$especialidad','$tipo')";
            $idinsert=ejecutarConsulta_retornarID($sqlinsert);

           
             $sqlCvu ="INSERT INTO cvucertificacionesmedicas (idCvu,idCertificacionesmedicas)
              values ('$id','$idinsert')";
             return ejecutarConsulta($sqlCvu) ; 

           
    }

    public function editar($idUsuario,$idMedico,$folio,$vigenciade,$vigenciaa,$especialidad,$tipo,$instituto)
    {
        $sql = "UPDATE certificacionesmedicas SET numeroFolio='$folio',fechaVigenciaDe='$vigenciade',fechaVigenciaA='$vigenciaa',especialidad='$especialidad',
        consejoOtorga='$instituto',tipoCertificacion='$tipo' where idCertificacionesmedicas='$idMedico'";
        return ejecutarConsulta($sql);

    }

    public function mostrar($idMedico)
    {
        $sql = "SELECT a.idCertificacionesmedicas as idMedico , a.numeroFolio, a.fechaVigenciaDe, a.fechaVigenciaA, a.consejoOtorga as otorga, a.especialidad, a.tipoCertificacion as tipo
        FROM certificacionesmedicas  as a WHERE a.idCertificacionesmedicas='$idMedico' ";
        
        return ejecutarConsultaSimpleFila($sql);
        
    }

    public function listar($idUsuario)
    {
        $sql="SELECT a.idCertificacionesmedicas as idMedico, a.numeroFolio, a.fechaVigenciaDe, a.fechaVigenciaA, b.nombre 
            FROM certificacionesmedicas as a , tipocertificacion as b , cvu as c , cvucertificacionesmedicas as d 
             WHERE a.tipoCertificacion=b.idTipoCertificacion AND a.idCertificacionesmedicas=d.idCertificacionesmedicas AND d.idCvu=c.idCvu AND c.idCvu='$idUsuario'";
       
        return ejecutarConsulta($sql);

    }
    public function borrar($idMedico)
    {
        $sql ="DELETE from  cvucertificacionesmedicas 
        WHERE idCertificacionesmedicas ='$idMedico' ";
        $a= ejecutarConsulta($sql);
         $sqlv ="DELETE from  certificacionesmedicas WHERE idCertificacionesmedicas ='$idMedico' ";
         return  ejecutarConsulta($sqlv);

    }
}
?>