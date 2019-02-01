<?php

require "../config/conexion.php";


class LineGeneral
{

    public function _construct()
    {

    }

    public function insertar($idUsuario,$cvu,$nombre,$horas,$actividades)
    {
        $sql="SELECT a.nombre FROM lineageneracion a , 
            cvulineas b ,cvu cv WHERE 
            a.idLineaGeneracion	 = b.idLineaGeneracion	 AND 
            b.idCvu=cv.idCvu and cv.idUsuarios='$idUsuario' AND a.nombre='$nombre' ";
        $datos=ejecutarConsultaSimpleFila($sql);
        if($datos<=0) { 
            
            $sqll ="INSERT INTO lineageneracion( nombre, horas, actividades)
                     VALUES ('$nombre','$horas','$actividades')";
            $registro = ejecutarConsulta_retornarID($sqll);
            
            echo $sqll;
            $sqlCvu ="INSERT INTO cvulineas (idCvu,idLineaGeneracion)
                        VALUES ('$cvu','$registro')";
             echo $sqlCvu;
            return ejecutarConsulta($sqlCvu);
                

            } 
            else{ 
                echo "ff";
                return 0;
            }
        
       
    }

    public function editar($idUsuario,$linea,$nombre,$horas,$actividades)
    {
        $sql="SELECT a.nombre FROM lineageneracion a , 
            cvulineas b ,cvu cv WHERE 
            a.idLineaGeneracion	 = b.idLineaGeneracion	 AND 
            b.idCvu=cv.idCvu and cv.idUsuarios='$idUsuario' AND a.nombre='$nombre' ";
        $datos=ejecutarConsultaSimpleFila($sql);
        if($datos<=0) { 
            $sql = " UPDATE lineageneracion SET nombre='$nombre',horas='$horas',actividades='$actividades' where idLineaGeneracion='$linea'";
            return ejecutarConsulta($sql);
            } 
            else{ 
                return 0;
            }
        
        
    }

    public function mostrar($linea)
    {
        $sql = " SELECT * FROM lineageneracion 
                where idLineaGeneracion ='$linea'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar($idUsuario)
    {
      
        $sql ="SELECT a.nombre, a.horas,a.idLineaGeneracion  FROM lineageneracion AS a ,cvu AS b, cvulineas AS c 
        WHERE a.idLineaGeneracion = c.idLineaGeneracion
         AND c.idCvu=b.idCvu AND b.idUsuarios='$idUsuario'";
        return ejecutarConsulta($sql);

    }
    public function borrar($tecnico)
    {   
        $sql= "DELETE FROM reportestecnicos WHERE idReportesTecnicos='$tecnico'";
        return ejecutarConsulta($sql);
    }


}


?>