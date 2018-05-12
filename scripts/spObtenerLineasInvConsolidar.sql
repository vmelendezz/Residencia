USE `pcicz`;
DROP procedure IF EXISTS `spObtenerLineasInvConsolidar`;

DELIMITER $$
USE `pcicz`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerLineasInvConsolidar`(pIdPrograma INTEGER)
BEGIN
	
   select l.idLineasInvConsolidar, l.nombre, l.descripcion from programalineainvconsolidar pl
	inner join lineasinvconsolidar l on pl.idLineaInvConsolidar = l.idLineasInvConsolidar
    where pl.idProgramaInvConsolidar = pIdPrograma; 

END$$

DELIMITER ;
