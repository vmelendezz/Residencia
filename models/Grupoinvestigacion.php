<?php

require "../config/conexion.php";


class GrupoInvestigacion
{

    public function _construct()
    {

    }

    public function insertar($idUsuario,$investigacion,$cvu,$nombre,$creacion,$ingreso,$nombreResponsable,$primero,$segundo,$institucion,$colaboracion,$impacto,$total,$area,$campo,$diciplina,$subdiciplina)

    {
        $sql="SELECT a.nombre FROM grupoinvestigacion a , 
            cvugrupoinvestigacion b ,cvu cv WHERE 
            a.idGrupoInvestigacion = b.idGrupoInvestigacion AND 
            b.idCvu=cv.idCvu and cv.idUsuarios='$idUsuario' AND a.nombre='$nombre'";
        $datos=ejecutarConsultaSimpleFila($sql);
        if($datos<=0) { 
            $sqll ="INSERT INTO grupoinvestigacion(  nombre,intitucion,fechaInicio,fechaIngreso,totaInves,idAreaDisiciplina,nombreResponsable,aperllidoPaterno,apellidoMaterno,impacto,colaboracion)
                     VALUES ('$nombre','$institucion','$creacion','$ingreso','$total','$idAreaDisiciplina','$nombreResponsable','$primero','$segundo','$impacto','$colaboracion')";
            $registro = ejecutarConsulta_retornarID($sqll);

            $sqlCvu ="INSERT INTO cvugrupoinvestigacion (idCvu,idGrupoInvestigacion)
                        VALUES ('$cvu','$registro')";

             ejecutarConsulta($sqlCvu);
                

            } 
            else{ 
                return 0;
            }
        
       
    }

    public function editar($idUsuario,$investigacion,$cvu,$nombre,$creacion,$ingreso,$nombreResponsable,$primero,$segundo,$institucion,$colaboracion,$impacto,$total,$area,$campo,$diciplina,$subdiciplina)

    {
        $sql="SELECT a.nombre FROM grupoinvestigacion a , 
        cvugrupoinvestigacion b ,cvu cv WHERE 
        a.idGrupoInvestigacion = b.idGrupoInvestigacion AND 
        b.idCvu=cv.idCvu and cv.idUsuarios='$idUsuario' AND a.nombre='$nombre'";

        $datos=ejecutarConsultaSimpleFila($sql);
        if($datos<=0) { 
            $sql = " UPDATE grupoinvestigacion SET  nombre='$nombre',intitucion='$institucion',fechaInicio='$creacion',fechaIngreso='$ingreso',totaInves='$total',idAreaDisiciplina='$',nombreResponsable='$nombreResponsable',aperllidoPaterno='$primero',apellidoMaterno='$segundo',impacto='$impacto',colaboracion='$colaboracion' WHERE idGrupoInvestigacion ='$investigacion'";
            return ejecutarConsulta($sql);
            } 
            else{ 
                return 0;
            }
        
        
    }

    public function mostrar($investigacion)
    {
        $sql = " SELECT * FROM grupoinvestigacion  where idGrupoInvestigacion ='$investigacion' ";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar($idUsuario)
    {
      
        $sql ="SELECT a.nombre,a.institucion,a.fecheInicio, a.fechaIngreso,a.idGrupoInvestigacion,a.totaInves
                FROM  grupoinvestigacion AS a ,cvu AS b, cvugrupoinvestigacion AS c
                 WHERE a.idGrupoInvestigacion = c.idGrupoInvestigacion 
                AND c.idCvu=b.idCvu   AND b.idUsuario='$idUsuario'";
        return ejecutarConsulta($sql);

    }
   
    public function borrar($redes)
    {   
        $sql= "DELETE FROM grupoinvestigacion WHERE idRedesInvestigacion='$investigacion'";
        return ejecutarConsulta($sql);
    }


}


?>