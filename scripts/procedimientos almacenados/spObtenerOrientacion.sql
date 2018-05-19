USE `pcicz`;
DROP procedure IF EXISTS `spObtenerOrientacion`;

DELIMITER $$
USE `pcicz`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerOrientacion`()
BEGIN
	
    SELECT idOrientacion, 
		nombre AS nombreOtientacion
    FROM orientacion;

END$$

DELIMITER ;

