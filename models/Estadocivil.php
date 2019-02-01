<?php

require "../config/conexion.php";


class Estadocivil
{

    public function _construct()
    {

    }

    public function insertar($nombre)
    {
        $sql="SELECT nombre FROM estadocivil where nombre= '$nombre' ";
        $datos=ejecutarConsultaRows($sql);
        if($datos>0) { 
            return 0;

            } 
            else{ 
                $sqll ="INSERT INTO  estadocivil (nombre) values ('$nombre')";
            return ejecutarConsulta($sqll);
            }
        
       
    }

    public function editar($idEstadoCivil,$nombre)
    {
        $sql="SELECT nombre FROM estadocivil where nombre= '$nombre' and idEstadoCivil !='$idEstadoCivil' ";
        $datos=ejecutarConsultaRows($sql);
        if($datos > 0) { 
            return 0;
            echo "hola";
            } 
            else{ 
                $sql = "UPDATE estadocivil SET nombre='$nombre' WHERE idEstadoCivil ='$idEstadoCivil'";
             return ejecutarConsulta($sql);
            }
        
        

    }

    public function mostrar($idEstadoCivil)
    {
        $sql = " SELECT * FROM estadocivil WHERE idEstadoCivil ='$idEstadoCivil'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar()
    {
        $sql= "SELECT * FROM estadocivil ";
        return ejecutarConsulta($sql);

    }
    public function select()
    {
        $sql= "SELECT * FROM estadocivil ";
        return ejecutarConsulta($sql);

    }
    public function borrar($idEstadoCivil)
    {   
        $sql= "DELETE FROM estadocivil WHERE idEstadoCivil='$idEstadoCivil'";
        return ejecutarConsulta($sql);
    }


}


?>