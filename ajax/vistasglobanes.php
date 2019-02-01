<?php
if(strlen(session_id())<1)
session_start();
$idUsuario=$_SESSION['idusuario'];

require_once "../models/Variablesglobanes.php";


$vistas = new Variablesglobanes();


    switch($_GET["op"]){

        
        case 'selectNivelEstudios':
        $respuesta=$vistas->selectNivelEstudios();
        echo '<option value="0"> Elige una opcion</option>';
        while ($reg = $respuesta->fetch_object())
        {
           echo '<option value=' .$reg->idNivelEstudio. '>' .$reg->nombre.'</option>';
            }

        break;
       

        case 'selectipoinsti':
                $respuesta=$vistas->selectipoinsti();
                echo '<option value="0"> Elige una opcion</option>';
                while ($reg = $respuesta->fetch_object())
                {
                   echo '<option value=' .$reg->idTipoInstituto. '>' .$reg->nombre.'</option>';
               }
        
        break;
        
            // Selecion de area campo diciplina subdiciplina


        case 'area':
              $respuesta=$vistas->area();
              echo '<option value="0"> Elige una opcion</option>';
               while ($reg = $respuesta->fetch_object())
                {
                    
                   echo '<option value=' .$reg->idArea. '>' .$reg->nombre.'</option>';
               }
       
        break;
        
        case 'campo':

            $area=$_POST["area"];

            $respuesta=$vistas->campo($area);
            echo '<option value="0"> Elige una opcion</option>';
            while ($reg = $respuesta->fetch_object())
            {
                echo '<option value=' .$reg->idCampo. '>' .$reg->nombreCampo .'</option>';
            }

        break;

        case 'disciplina':

            $campo=$_POST["campos"];
            $respuesta=$vistas->disciplina($campo);
            echo '<option value="0"> Elige una opcion</option>';
            while ($reg = $respuesta->fetch_object())
            {
                echo '<option value=' .$reg->idDiciplina. '>' .$reg->nombre .'</option>';
            }

        break;

        case 'subdisciplina':

        $disciplina=$_POST["disciplina"];
        $respuesta=$vistas->disciplina($disciplina);
        echo '<option value="0"> Elige una opcion</option>';
        while ($reg = $respuesta->fetch_object())
        {
            echo '<option value=' .$reg->idSubDisciplina. '>' .$reg->nombre .'</option>';
        }

    break;




        // 
        case 'EstatusEstudios':
            $respuesta=$vistas->selectEstatus();
            echo '<option value="0"> Elige una opcion</option>';
            while ($reg = $respuesta->fetch_object())
            {
                 echo '<option value=' .$reg->idEstatusEstudios. '>' .$reg->nombre.'</option>';
            }
 
        break;
        case 'titulacion':
            $respuesta=$vistas->selectTitulacion();
            echo '<option value="0"> Elige una opcion</option>';
            while ($reg = $respuesta->fetch_object())
            {  

                 echo '<option value=' .$reg->idOpcionesTitulacion. '>' .$reg->nombre.'</option>';
            }
 
        break;

        // certificacion medica 

        case 'tipocertificacion':
            $respuesta=$vistas->tipoCertificacion();
            echo '<option value="0"> Elige una opcion</option>';
            while ($reg = $respuesta->fetch_object())
            {
                 echo '<option value=' .$reg->idTipoCertificacion. '>' .$reg->nombre.'</option>';
            }
 
        break;
        case 'tipoespecialidad':
            $respuesta=$vistas->tipoespecialidad();
            echo '<option value="0"> Elige una opcion</option>';
            while ($reg = $respuesta->fetch_object())
            {
                 echo '<option value=' .$reg->idtTipoEspecialidad. '>' .$reg->nombre.'</option>';
            }
 
        break;

            // otra Tabla formacion Academica
        case 'formacion':
            $respuesta=$vistas->selectFormacion();
            echo '<option value="0"> Elige una opcion</option>';
            while ($reg = $respuesta->fetch_object())
            {
                 echo '<option value=' .$reg->idFormacion. '>' .$reg->nombreFormacion.'</option>';
            }
 
        break;

            // Tabla tesis
            case 'gradotesis':
                $respuesta=$vistas->selectgradotesis();
                echo '<option value="0"> Elige una opcion</option>';
                while ($reg = $respuesta->fetch_object())
                {
                     echo '<option value=' .$reg->idGradoTesis. '>' .$reg->nombre.'</option>';
                }
     
            break;


            case 'estadotesis':
                $respuesta=$vistas->estadodireccion();
                echo '<option value="0"> Elige una opcion</option>';
                while ($reg = $respuesta->fetch_object())
                {
                     echo '<option value=' .$reg->idEstadoDireccion. '>' .$reg->nombre.'</option>';
                }
     
            break;


            

             // Tabla tesis
             case 'idiomas':
             $respuesta=$vistas->selectidioma();
             echo '<option value="0"> Elige una opcion</option>';
             while ($reg = $respuesta->fetch_object())
             {
                  echo '<option value=' .$reg->idTablaIdioma. '>' .$reg->nombre.'</option>';
             }
  
         break;


           // Tabla tesis
           case 'departamento':
           
           $campus=$_POST["elegido"];
           
           echo '<option value="0"> Elige una opcion</option>';
           $respuesta=$vistas->selectdepartamendo($campus);

           while ($reg = $respuesta->fetch_object())
           {
                echo '<option value=' .$reg->idDepartamento. '>' .$reg->nombre.'</option>';
           }

       break;

       // Tabla tesis
       case 'campus':

       $respuesta=$vistas->selectcampus();
       echo '<option value="0"> Elige una opcion</option>';
       while ($reg = $respuesta->fetch_object())
       {
            echo '<option value=' .$reg->idCampus. '>' .$reg->nombreCampus.'</option>';
       }
       break;
       // Experiencia docente 
      
       case 'tiponivel':

       $respuesta=$vistas->selecttiponivel();
       echo '<option value="0"> Elige una opcion</option>';
       while ($reg = $respuesta->fetch_object())
       {
            echo '<option value=' .$reg->idTipoNivel. '>' .$reg->nombre.'</option>';
       }
       break;

       //  Experiencia Profesional

       case 'actual':

       $respuesta=$vistas->selectactual();
       echo '<option value="0"> Elige una opcion</option>';
       while ($reg = $respuesta->fetch_object())
       {
            echo '<option value=' .$reg->idActualAnterior. '>' .$reg->nombre.'</option>';
       }
       break;

       case 'puesto':

       $respuesta=$vistas->selectpuesto();
       echo '<option value="0"> Elige una opcion</option>';
       while ($reg = $respuesta->fetch_object())
       {
            echo '<option value=' .$reg->idTipoPuesto. '>' .$reg->nombre.'</option>';
       }
       break;


    // estancia profecional

    case 'tipoEstancia':

       $respuesta=$vistas->selectinstancia();
       echo '<option value="0"> Elige una opcion</option>';
       while ($reg = $respuesta->fetch_object())
       {
            echo '<option value=' .$reg->idTipoInstancia. '>' .$reg->nombre.'</option>';
       }
       break;

    // Red tematica

    case 'tiporedtematico':

       $respuesta=$vistas->tiporedtematico();
       echo '<option value="0"> Elige una opcion</option>';
       while ($reg = $respuesta->fetch_object())
       {
            echo '<option value=' .$reg->idTipoRedesTematicas. '>' .$reg->nombre.'</option>';
       }
       break;







  

                
    
        
       


    }

?>