<?php

require "../config/conexion.php";


class Tecnico
{

    public function _construct()
    {

    }

    public function insertar($idUsuario,$cvu,$nombre,$institucion,$fechaEntrega,$fechaPublicacion,$paginas,$descripcion,$objetivos,$palabraclave1,$palabraclave2,$palabraclave3,$origen,$apoyoConacyt,$fondo)
    {
        
        $sql="SELECT a.nombre FROM reportestecnicos a , 
            cvutecnico b ,cvu cv WHERE 
            a.idReportesTecnicos = b.idReportesTecnicos AND 
            b.idCvu=cv.idCvu and cv.idUsuarios='$idUsuario' AND a.nombre='$nombre' ";
            echo $sql;
        $datos=ejecutarConsultaSimpleFila($sql);

        $sqlc="SELECT idCvu from cvu where idUsuarios='$idUsuario'";
       
       
        if($datos<=0) { 
            
            $sqll ="INSERT INTO reportestecnicos( nombre,institucion, fechaEntrega, fechaPublicacion, numeroPaginas, descripcion, objetivos, palabraclave1, palabraclave2, palabraclave3, idOrigenReporteTecnico, apoyoConacyt, fondo)
                     VALUES ('$nombre','$institucion','$fechaEntrega','$fechaPublicacion','$paginas','$descripcion','$objetivos','$palabraclave1','$palabraclave2','$palabraclave3','1','$apoyoConacyt','$fondo')";
             
            $registro = ejecutarConsulta_retornarID($sqll);

            $sqlCvu ="INSERT INTO cvutecnico (idCvu,idReportesTecnicos)
                        VALUES ('$cvu','$registro')";
              
              return ejecutarConsulta($sqlCvu);
                

            } 
            else{ 
                return 0;
            }
        
       
    }

    public function editar($idUsuario,$tecnico,$institucion,$fechaEntrega,$fechaPublicacion,$paginas,$descripcion,$objetivos,$palabraclave1,$palabraclave2,$palabraclave3,$origen,$apoyoConacyt,$fondo)
    {
        $sql="SELECT a.nombre FROM reportestecnicos a , 
            cvutecnico b ,cvu cv WHERE 
            a.reportestecnicos = b.cvutecnico AND 
            b.idCvu=cv.idCvu and cv.idUsuarios='$idUsuario' ";
        $datos=ejecutarConsultaSimpleFila($sql);
        if($datos<=0) { 
            $sql = " UPDATE reportestecnicos SET intitucion='$institucion',fechaEntrega='$fechaEntrega',fechaPublicacion='$fechaPublicacion',numeroPaginas='$paginas',descripcion='$descripcion',objetivos='$objetivos',palabraclave1='$palabraclave1',palabraclave2='$palabraclave2',palabraclave3='$palabraclave3',idOrigenReporteTecnico='$origen',apoyoConacyt='$apoyoConacyt' ,fondo='$fondo' WHERE idReportesTecnicos ='$tecnico'";
            return ejecutarConsulta($sql);
            } 
            else{ 
                return 0;
            }
        
        
    }

    public function mostrar($tecnico)
    {
        $sql = " SELECT a.idReportesTecnicos,a.institucion, a.fechaEntrega, a.fechaPublicacion, a.numeroPaginas, a.descripcion, a.objetivos, a.palabraclave1, a.palabraclave2, a.palabraclave3, b.nombre, a.apoyoConacyt, a.fondo FROM reportestecnicos As a ,origenReportetecnico AS b WHERE a.idOrigenReporteTecnico=b.idOrigenReporteTecnico AND a.idReportesTecnicos ='$tecnico'";
        return ejecutarConsulta()($sql);
    }

    public function listar($idUsuario)
    {
      
        $sql ="SELECT a.nombre,a.institucion,a.fechaEntrega,a.fechaPublicacion, a.numeroPaginas,a.idReportesTecnicos
                FROM  reportestecnicos AS a ,cvu AS b, cvutecnico AS c
                 WHERE a.idReportesTecnicos = c.idReportesTecnicos 
                AND c.idCvu=b.idCvu   AND b.idUsuarios='$idUsuario'";
        return ejecutarConsulta($sql);

    }
   
    public function borrar($tecnico)
    {   
        $sql= "DELETE FROM reportestecnicos WHERE idReportesTecnicos='$tecnico'";
        return ejecutarConsulta($sql);
    }


}


?>