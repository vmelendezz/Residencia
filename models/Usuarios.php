<?php

require "../config/conexion.php";

class Usuarios
{
    public function _construct()
    {
    }

    public function insertar($email,$clave,$nombre_usuario,$apellido_paterno,$apellido_materno,$Curp,$idestado_civil)
    {
        $sql = "SELECT correo FROM usuarios WHERE correo='$email'";
        $datos = ejecutarConsultaRows($sql);
        if($datos > 0) { 
                
                return 0;
            
            } 
            else{ 
                $sqll ="INSERT INTO  usuarios ( correo, password, nombre, apellidoPaterno, apellidoMaterno, curp, estatusUsuario, idTipoUsuario, idEstadoCivil) 
                values ('$email','$clave','$nombre_usuario','$apellido_paterno','$apellido_materno','$Curp','1','1','$idestado_civil')";
                return ejecutarConsulta($sqll);
            }
      
       
    }

    public function editar($idUsuarios,$email,$clave,$nombre_usuario,$apellido_paterno,$apellido_materno,$Curp,$idestado_civil)
    {

        $sql="SELECT correo FROM usuarios WHERE correo ='$email' and idUsuarios != '$idUsuarios'";
        $datos = ejecutarConsultaRows($sql);
        if($datos > 0) { 
                
                return 0;
            
            } else{
                $sqll = "UPDATE usuarios SET correo='$email',password='$clave',nombre='$nombre_usuario',apellidoPaterno='$apellido_paterno',apellidoMaterno='$apellido_materno',curp='$Curp', idEstadoCivil='$idestado_civil'  WHERE idUsuarios  ='$idUsuarios'";
                return ejecutarConsulta($sqll);

            }
        

    }

    public function desactivar ($idUsuarios)
    {
        $sql = "UPDATE usuarios SET estatusUsuario='0' where idUsuarios  ='$idUsuarios'";
        return ejecutarConsulta($sql);
    }
    public function activar ($idUsuarios)
    {
        $sql = "UPDATE usuarios SET estatusUsuario='1' where idUsuarios  ='$idUsuarios' ";
        return ejecutarConsulta($sql);
    }

    public function mostrar($idUsuarios)
    {
        $sql = " SELECT * FROM usuarios WHERE idUsuarios ='$idUsuarios' ";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar()
    {
        $sql= "SELECT a.idUsuarios, a.correo,a.password,a.nombre,a.apellidoPaterno,a.apellidoMaterno,a.curp, a.idEstadoCivil,a.estatusUsuario, e.nombre As civil FROM usuarios a INNER JOIN estadocivil e ON a.idEstadoCivil=e.idEstadoCivil where a.idTipoUsuario='1'";
        return ejecutarConsulta($sql);

    }
    public function verificar($emails,$passwords)
    {
        
        $sql ="SELECT idUsuarios, password, correo, nombre, idTipoUsuario FROM usuarios where correo='$emails' and password='$passwords'";
        return ejecutarConsulta($sql);

    }


}


?>