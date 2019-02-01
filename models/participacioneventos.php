<?php

require "../config/conexion.php";


class ParticipacionEventos
{

    public function _construct()
    {

    }

    public function insertar($idUsuario,$cvu,$nombre,$fecha,$participacion)
    {
        $sql="SELECT a.nombre FROM participacioneventos a , 
            cvuparticipacioneventos b ,cvu cv WHERE 
            a.idParticipacionEventos = b.idParticipacionEventos AND 
            b.idCvu=cv.idCvu and cv.idUsuarios='$idUsuario' AND a.nombre='$nombre' ";
        $datos=ejecutarConsultaSimpleFila($sql);
        if($datos<=0) { 
            $sqll ="INSERT INTO participacioneventos( nombre, fecha, tipoParticipacion)
                     VALUES ('$nombre','$fecha','$participacion')";
            $registro = ejecutarConsulta_retornarID($sqll);
            echo $sqll;

            $sqlCvu ="INSERT INTO cvuparticipacioneventos (idCvu,idParticipacionEventos)
                        VALUES ('$cvu','$registro')";

            return ejecutarConsulta($sqlCvu);
                

            } 
            else{ 
                return 0;
            }
        
       
    }

    public function editar($idUsuario,$evento,$nombre,$fecha,$participacion)
    {
        $sql="SELECT a.nombre FROM participacioneventos a , 
        cvuparticipacioneventos b ,cvu cv WHERE 
        a.idParticipacionEventos = b.idParticipacionEventos AND 
        b.idCvu=cv.idCvu and cv.idUsuarios='$idUsuario' AND a.nombre='$nombre' ";
        $datos=ejecutarConsultaSimpleFila($sql);
        if($datos<=0) { 
            $sql = " UPDATE reportestecnicos SET nombre='$nombre',fecha='$fecha',tipoParticipacion='$participacion'";
            return ejecutarConsulta($sql);
            } 
            else{ 
                return 0;
            }
        
        
    }

    public function mostrar($tecnico)
    {
        $sql = " SELECT a.nombre, a.fecha,a.tipoParticipacion a.idParticipacionEventos FROM participacioneventos As a 
                where a.idParticipacionEventos ='$evento'
            ";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar($idUsuario)
    {
      
        $sql ="SELECT a.nombre, a.fecha, a.idParticipacionEventos FROM participacioneventos AS a ,cvu AS b, cvuparticipacioneventos AS c WHERE a.idParticipacionEventos = c.idParticipacionEventos
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