<?php
require "../config/conexion.php";

 class Variablesglobanes{

    public function _construct()
    {

    }

    public function selectNivelEstudios()
    {
        $sql= "SELECT * FROM niveldeestudio ";
        return ejecutarConsulta($sql);
        $datos =ejecutarConsulta($sql);
        echo $datos;

    }

 
    // Estas 4 funciones son una misma 
    public function selectipoinsti()
    {
        $sql= "SELECT * FROM tipoinstituto ";
        return ejecutarConsulta($sql);

    }
    
  
    

    // fin de la consultas de la primera pagina

  
    
     
    public function cvuusar($idUsuario)
    {
        $sql="SELECT idCvu from cvu  WHERE idUsuarios='$idUsuario'";
        return ejecutarConsulta($sql);
        $datos =ejecutarConsultaArray($sql);
        echo $datos;

    }
    // Selecion de area campo diciplina subdiciplina
    public function area()
    {
        $sql="SELECT * from  area ";
        return ejecutarConsulta($sql);
        
    }
    public function campo($area)
    {
        $sql="SELECT a.idCampo,a.nombreCampo from campo as a , areadisciplinas as b where b.idArea ='$area' and a.idCampo=b.idCampo ";
        return ejecutarConsulta($sql);
        
    }

    public function disciplina($campo)
    {
        $sql="SELECT a.idDiciplina,a.nombre from diciplina as a ,areadisciplinas as b , diciplinasubdisciplina as c
        where  a.idDiciplina=c.idDisciplina and c.idDisciplinaSub=b.idDisciplinaSub and b.idCampo='$campo' ";
        return ejecutarConsulta($sql);
    }


    public function subdiciplina($discilina)
    {
        $sql="SELECT a.idSubDisciplina,a.nombre
         from subdisciplina as a ,areadisciplinas as b , diciplinasubdisciplina as c
          where a.idSubDisciplina=c.idSubDisciplina and c.idDisciplinaSub=b.idDisciplinaSub and c.idDisciplina='$discilina'";
         return ejecutarConsulta($sql);
    }

    // Estudios Realizados

    public function selectEstatus(Type $var = null)
    {
        $sql="SELECT * from  estatusestudios ";
        return ejecutarConsulta($sql);
    }

    public function selectTitulacion(Type $var = null)
    {
        $sql="SELECT * from  opcionestitulacion ";
        return ejecutarConsulta($sql);
    }

    // otra Tabla formacion Academica

    public function selectFormacion()
    {
        $sql="SELECT * from  formacioncontinua ";
        return ejecutarConsulta($sql);
    }
    // certificacion medica 
    public function tipoCertificacion()
    {
        $sql="SELECT * from  tipocertificacion ";
        return ejecutarConsulta($sql);
    }

    public function tipoespecialidad()
    {
        $sql="SELECT * from  tipoespecialidad ";
        return ejecutarConsulta($sql);
    }

    // Tabla tesis
    
    public function selectgradotesis()
    {
        $sql="SELECT * from  gradotesis ";
        return ejecutarConsulta($sql);
    }

    public function estadodireccion()
    {
        $sql="SELECT * from  estadodireccion ";
        return ejecutarConsulta($sql);
    }

    public function selectidioma()
    {
        $sql="SELECT * from  tablaidiomas ";
        return ejecutarConsulta($sql);
    }

    /// info basic
    public function selectdepartamendo($campus)
    {
        $sql="SELECT a.idDepartamento,a.nombre from departamento as a , campusdepartamento as b
         WHERE a.idDepartamento=b.idDepartamento and b.idCampus='$campus'";
        return ejecutarConsulta($sql);
    }

    public function selectcampus()
    {
        $sql="SELECT idCampus,nombreCampus FROM campus";
        return ejecutarConsulta($sql);
    }

    // Experiencia Docente 

    public function selecttiponivel()
    {
        $sql="SELECT idTipoNivel,nombre FROM tiponivel";
        return ejecutarConsulta($sql);
    }
   
        // Experiencia Profesional

        public function selectactual()
        {
            $sql="SELECT * FROM actualanterior";
            return ejecutarConsulta($sql);
        }

        public function selectpuesto()
        {
            $sql="SELECT * FROM tipopuesto";
            return ejecutarConsulta($sql);
        }
        

        // estancia profecional

        public function selectinstancia()
        {
            $sql="SELECT * FROM tipoinstancia";
            return ejecutarConsulta($sql);
        }
        
        // 
        public function tiporedtematico()
        {
            $sql="SELECT * FROM tiporedestematicas";
            return ejecutarConsulta($sql);
        }






    
 }

?>