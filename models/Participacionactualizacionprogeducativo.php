<?php

require "../config/conexion.php";


class ParticipacionActualizacionProgramaeducativo
{

    public function _construct()
    {

    }

    public function insertar($idUsuario,$cvu,$nombre,$gradoIntervencion,$fechaImplementacion,$archivo)
    {
        $sqlcvu ="SELECT idCvu from cvu where idUsuarios='$idUsuario'";
        $cvu = ejecutarConsultaSimpleFila($sqlcvu);
        $id = $cvu['idCvu'];

        $sql="SELECT a.nombre FROM participacionactualizacionprogeducativo a , 
            cvuparticipacionactualizacionprogeducativo b ,cvu cv WHERE 
            a.idParticipacionActualizacionEducativo = b.idPartiActProgEduc AND 
            b.idCvu=cv.idCvu and cv.idUsuarios='$idUsuario' AND a.nombre='$nombre' ";
        $datos=ejecutarConsultaRows($sql);
        if($datos<=0) { 
            $sqll ="INSERT INTO participacionactualizacionprogeducativo ( nombre, gradoIntervencion, fechaImplementacion, resumenProyectoPdf) 
                                VALUES ( '$nombre', '$gradoIntervencion', '$fechaImplementacion', '$archivo')";
            $registro = ejecutarConsulta_retornarID($sqll);
            echo $sqll;

            $sqlCvu ="INSERT INTO cvuparticipacionactualizacionprogeducativo (idCvu,idPartiActProgEduc)
                        VALUES ('$id','$registro')";
                        

             return ejecutarConsulta($sqlCvu);
                

            } 
            else{ 
                return 0;
            }
        
       
    }

    public function editar($idUsuario,$participacion,$nombre,$gradoIntervencion,$fechaImplementacion,$archivo)
    {
        $sql="SELECT a.nombre FROM participacionactualizacionprogeducativo a , 
            cvuparticipacionactualizacionprogeducativo b ,cvu cv WHERE 
            a.idParticipacionActualizacionEducativo = b.idPartiActProgEduc AND 
            b.idCvu=cv.idCvu and cv.idUsuarios='$idUsuario' AND a.nombre='$nombre' ";
        $datos=ejecutarConsultaSimpleFila($sql);
        if($datos<=0) { 
            $sql = " UPDATE participacionactualizacionprogeducativo SET nombre='$nombre',gradoIntervencion='$gradoIntervencion',fechaImplementacion='$fechaImplementacion',resumenProyectoPdf='$archivo' where idParticipacionActualizacionEducativo='$participacion' ";
            return ejecutarConsulta($sql);
            } 
            else{ 
                return 0;
            }
        
        
    }

    public function mostrar($participacion)
    {
        $sql = " SELECT * FROM participacionactualizacionprogeducativo WHERE idParticipacionActualizacionEducativo ='$participacion' ";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar($idUsuario)
    {
      
        $sql ="SELECT a.nombre, a.gradoIntervencion, a.fechaImplementacion,a.idParticipacionActualizacionEducativo as idparti
                FROM  participacionactualizacionprogeducativo AS a ,cvu AS b, cvuparticipacionactualizacionprogeducativo AS c
                 WHERE a.idParticipacionActualizacionEducativo = c.idPartiActProgEduc 
                     AND c.idCvu=b.idCvu   AND b.idUsuarios='$idUsuario'";
        return ejecutarConsulta($sql);

    }
    public function borrar($participacion)
    {
        $sql= "DELETE FROM cvuparticipacionactualizacionprogeducativo WHERE idPartiActProgEduc='$participacion'";
        return ejecutarConsulta($sql);

        $sql= "DELETE FROM participacionactualizacionprogeducativo WHERE idParticipacionActualizacionEducativo='$participacion'";
        return ejecutarConsulta($sql);
    }


}


?>