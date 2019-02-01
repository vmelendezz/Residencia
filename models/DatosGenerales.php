<?php

require "../config/conexion.php";


class DatosGenerales{



    public function _construct()
    {

    }

    public function insertar($idUsuario,$rfc,$sexo,$fecha,$pais,$nacionalidad,$entidad,$conacyt,$promep,$tecmm){
            
        $sql="SELECT idCvu from cvu where idUsuarios='$idUsuario'";
        $cvu=ejecutarConsultaSimpleFila($sql);
        $id=$cvu['idCvu'];
        echo $id;
          $sqlbasic ="INSERT INTO datosgenerales( idContacto, rfc, sexo, fechaNacimiento, paisNacimineto, idDomicinio, nacionalidad, entidadFederativa, numeroConacyt, numeroPromep, numeroTecmm, idCvu)
           VALUES('1','$rfc','$sexo','$fecha','$pais','1','$nacionalidad','$entidad','$conacyt','$promep','$tecmm','$id')";
           return ejecutarConsulta($sqlbasic);

        }

    public function editar($dato,$idUsuario,$rfc,$sexo,$fecha,$pais,$nacionalidad,$entidad,$conacyt,$promep,$tecmm){
        
        $sql="UPDATE datosgenerales SET idContacto='1',rfc='$rfc',sexo='$sexo',fechaNacimiento='$fecha',
        paisNacimineto='$pais',idDomicinio='1',nacionalidad='$nacionalidad',entidadFederativa='$entidad',
        numeroConacyt='$conacyt',numeroPromep='$promep',numeroTecmm='$tecmm'
         WHERE idDatosGenerales ='$dato'";

        
        return ejecutarConsulta($sql);

       

    }
           
         
    public function mostrar($idUsuario)
    {
        $sql="SELECT a.idDatosGenerales as dato, a.idContacto, a.rfc, a.sexo, a.fechaNacimiento,a.paisNacimineto, a.idDomicinio, a.nacionalidad, a.entidadFederativa, a.numeroConacyt, a.numeroPromep, a.numeroTecmm, a.idCvu 
        FROM datosgenerales  as a , cvu as b WHERE a.idCvu=b.idCvu AND b.idUsuarios ='$idUsuario' ";

         return ejecutarConsultaSimpleFila($sql);

    }
           
   

}

  
?>
    