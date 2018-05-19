USE `pcicz`;
DROP procedure IF EXISTS `spObtenerInstituciones`;

DELIMITER $$
USE `pcicz`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerInstituciones`(idInst INTEGER)
BEGIN
    
    SELECT nombre AS pNombre
    FROM instituciones
    WHERE idInstitucion = idInst;
    
    SELECT nombre_campus AS pCampus
    FROM campus
    WHERE id_instituciones = idInst;

END$$

DELIMITER ;

