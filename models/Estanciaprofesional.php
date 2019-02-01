<?php

require "../config/conexion.php";

class Estancias
{
    public function _construct()
    {
    }

    public function insertar($nombre,$fechainicio,$fechafin,$logro,$tipo_estancia)
    {
        $sql ="INSERT INTO  estancia_profesional (nombre,fechainicio ,fechafin ,logro,tipo_estancia ) 
        values ('$nombre','$fechainicio','$fechafin','$logro','$tipo_estancia')";
        return ejecutarConsulta($sql);
       
    }

    public function editar($id_estancia,$nombre,$fechainicio,$fechafin,$logro,$tipo_estancia)
    {
        $sql = "UPDATE estancia_profesional SET nombre='$nombre',fechainicio='$fechainicio',fechafin='$fechafin',logro='$logro',tipo_estancia='$tipo_estancia'',
                  WHERE id_estancia ='$id_estancia'";
        return ejecutarConsulta($sql);

    }

   
    public function mostrar($id_estancia)
    {
        $sql = " SELECT * FROM estancia_profesional WHERE id_estancia ='$id_estancia' ";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar()
    {
        $sql= "SELECT a.id_estancia,a.nombre,a.fechainicio, a.fechafin, a.logro , e.nombre_estancia FROM estancia_profesional a INNER JOIN tipo_estancia e ON a.tipo_estancia=e.idtipoestancia ";
        return ejecutarConsulta($sql);

    }
   


}


?>