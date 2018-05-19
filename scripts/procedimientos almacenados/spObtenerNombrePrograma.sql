USE `pcicz`;
DROP procedure IF EXISTS `spObtenerNombrePrograma`;

DELIMITER $$
USE `pcicz`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerNombrePrograma`(pIdPrograma INTEGER)
BEGIN
	
    DECLARE codigoRetorno INTEGER;
    
	SELECT nomPrograma AS Nombre
    FROM programas
    WHERE idPrograma = pIdPrograma;
    
    IF EXISTS(SELECT * FROM programas WHERE idPrograma = pIdPrograma) THEN
		SET codigoRetorno = 0;
	ELSE
		SET codigoRetorno = 1;
	END IF;
    
    SELECT codigoRetorno;

END$$

DELIMITER ;

