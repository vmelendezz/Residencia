USE `pcicz`;
DROP procedure IF EXISTS `spObtenerLineasCuerpoAcademico`;

DELIMITER $$
USE `pcicz`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerLineasCuerpoAcademico`(pIdPrograma INTEGER)
BEGIN
	
   select l.idLineasCuerpoAcademico, l.nombre, l.descripcion from programalineacuerpoacademico pl
	inner join lineascuerpoacademico l on pl.idLineaCuerpoAcademico = l.idLineasCuerpoAcademico
    where pl.idProgramaCuerpoAcademico = pIdPrograma; 

END$$

DELIMITER ;

