<?php

require "../config/conexion.php";


class ArchivotecmmPDf{



    public function _construct()
    {

    }

    public function datosGEnerales($idUsuario)
    {
        $sql="SELECT a.correo,a.nombre,a.apellidoPaterno,a.apellidoMaterno,b.fechaNacimiento from usuarios as a , datosgenerales as b , cvu AS c WHERE c.idUsuarios ='$idUsuario' and c.idCvu = b.idCvu ";

         return ejecutarConsultaSimpleFila($sql);

    }

           
         
    

    public function estudioslicenciatura($idUsuario)
    {
        $sql="SELECT a.nombreTitulo, a.instituto ,a.periodo,a.fechaObtencion,a.noCedula
        from estudiorealizados as a , cvu as b , cvuestudiorealizados as c 
        WHERE b.idCvu=c.idCvu AND b.idUsuarios ='$idUsuario'  And a.idNivelEstudio ='1' and
         a.idEstudioRealizados = c.idEstudioRealizados ";

         return ejecutarConsultaSimpleFila($sql);

    }

    public function estudiosEspecializacion($idUsuario)
    {
        $sql="SELECT a.nombreTitulo, a.instituto ,a.periodo,a.fechaObtencion,a.noCedula
        from estudiorealizados as a , cvu as b , cvuestudiorealizados as c 
        WHERE b.idCvu=c.idCvu AND b.idUsuarios ='$idUsuario'  And a.idNivelEstudio ='2' and
         a.idEstudioRealizados = c.idEstudioRealizados ";

         return ejecutarConsultaSimpleFila($sql);

    }
        

    public function estudiosMaestria($idUsuario)
    {
        $sql="SELECT a.nombreTitulo, a.instituto ,a.periodo,a.fechaObtencion,a.noCedula
        from estudiorealizados as a , cvu as b , cvuestudiorealizados as c 
        WHERE b.idCvu=c.idCvu AND b.idUsuarios ='$idUsuario'  And a.idNivelEstudio ='3' and
         a.idEstudioRealizados = c.idEstudioRealizados ";

         return ejecutarConsultaSimpleFila($sql);

    }

    public function estudiosDoctorado($idUsuario)
    {
        $sql="SELECT a.nombreTitulo, a.instituto ,a.periodo,a.fechaObtencion,a.noCedula
        from estudiorealizados as a , cvu as b , cvuestudiorealizados as c 
        WHERE b.idCvu=c.idCvu AND b.idUsuarios ='$idUsuario'  And a.idNivelEstudio ='4' and
         a.idEstudioRealizados = c.idEstudioRealizados ";

         return ejecutarConsultaSimpleFila($sql);

    }

    public function estudiosPosdoctorado($idUsuario)
    {
        $sql="SELECT a.nombreTitulo, a.instituto ,a.periodo,a.fechaObtencion,a.noCedula
        from estudiorealizados as a , cvu as b , cvuestudiorealizados as c 
        WHERE b.idCvu=c.idCvu AND b.idUsuarios ='$idUsuario'  And a.idNivelEstudio ='5' and
         a.idEstudioRealizados = c.idEstudioRealizados ";

         return ejecutarConsultaSimpleFila($sql);

    }

    public function experienciaDocentePosgrado($idUsuario)
    {
        $sql="SELECT a.nombreCurso, a.nombreEspecialidad ,a.experienciaInstitucion, a.periodo
         from experienciadocente as a , cvu as b , cvuexperienciadocente as c 
         WHERE b.idCvu=c.idCvu AND b.idUsuarios ='$idUsuario' 
        and a.idTipoNivel='1' AND a.idExperienciaDocente =c.idExperienciaDocente
        ";

         return ejecutarConsultaSimpleFila($sql);

    }

    public function experienciaDocenteLicenciatura($idUsuario)
    {
        $sql="SELECT a.nombreCurso, a.nombreEspecialidad ,a.experienciaInstitucion, a.periodo
         from experienciadocente as a , cvu as b , cvuexperienciadocente as c 
         WHERE b.idCvu=c.idCvu AND b.idUsuarios ='$idUsuario' 
        and a.idTipoNivel='2' AND a.idExperienciaDocente =c.idExperienciaDocente
        ";

         return ejecutarConsultaSimpleFila($sql);

    }

    public function profesional($idUsuario)
    {
        $sql="SELECT a.funcion, a.institucion ,a.periodo, a.idPuesto 
        from experienciaprofesional as a , cvu as b , cvuexperiencia as c
         WHERE b.idCvu=c.idCvu AND b.idUsuarios ='$idUsuario' AND a.idExperienciaProfesional =c.idExperienciaProfesional
        ";

         return ejecutarConsultaSimpleFila($sql);

    }

    public function proyectosinvesticacion($idUsuario)
    {
        $sql="SELECT a.nombre,a.monto,a.idFuenteFinciamineto , a.fechaInicio,a.fechaFin,a.resultados
         from proyectosinvestigacion as a , cvu as b , cvuproyectos as c 
         WHERE b.idCvu=c.idCvu AND b.idUsuarios ='$idUsuario' 
        AND a.idProyectosInvestigacion =c.idProyectosInvestigacion
        ";

         return ejecutarConsultaSimpleFila($sql);

    }

    public function premios($idUsuario)
    {
        $sql="SELECT a.NombreDistincion,a.institucion,a.fecha
         from distincionesnoconacyt as a , cvu as b , cvudistincionesnoconacyt as c 
         WHERE b.idCvu=c.idCvu AND b.idUsuarios ='$idUsuario' 
        AND a.idDistincionesNoConacyt =c.idDistincionesNoConacyt
        ";

         return ejecutarConsultaSimpleFila($sql);

    }

    
    public function tesis($idUsuario)
    {
        $sql="SELECT a.nombreTesis, a.nombreAlumno ,a.apellidoPaterno, a.apellidoMaterna,a.institucion ,a.nombrePrograma , a.fechaInicio ,a.fechaFin from tesisdirigidas as a , cvu as b , cvutesis as c WHERE b.idCvu=c.idCvu AND b.idUsuarios ='$idUsuario' AND a.idTesisDirigidas = c.idTesisDirigidas";

         return ejecutarConsultaSimpleFila($sql);

    }
    public function paticipacionEventos($idUsuario)
    {
        $sql="SELECT a.nombre, a.periodo ,d.nombre as asociacion 
        from asociaciones as a , cvu as b , cvuasociones as c ,tipomembresia as d
        WHERE b.idCvu=c.idCvu AND b.idUsuarios ='$idUsuario' AND a.idTipoMembresia=d.idTipoMenbresia And
         a.idAsociaciones = c.idAsociaciones ";

         return ejecutarConsultaSimpleFila($sql);

    }
        
          
           
   

}

  
?>
    