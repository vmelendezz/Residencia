USE `pcicz`;
DROP procedure IF EXISTS `spobtenerTiposInvesigacion`;

DELIMITER $$
USE `pcicz`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spobtenerTiposInvesigacion`()
BEGIN

	SELECT idTipoInvestigacion, 
		nombre AS nombreTipoInv
    from tipoinvestigacion;

END$$

DELIMITER ;

