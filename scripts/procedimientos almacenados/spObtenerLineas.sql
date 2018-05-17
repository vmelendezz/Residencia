USE `pcicz`;
DROP procedure IF EXISTS `spObtenerLineas`;

DELIMITER $$
USE `pcicz`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerLineas`(pIdPrograma INTEGER)
BEGIN
	
    SELECT l.idLinea, l.nombre, l.descripcion FROM programlineas pl
	INNER JOIN lineas l ON pl.idLinea = l.idLinea
    WHERE pl.idPrograma = pIdPrograma;

END$$

DELIMITER ;

