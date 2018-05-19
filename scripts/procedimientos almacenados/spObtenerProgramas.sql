USE `pcicz`;
DROP procedure IF EXISTS `spObtenerProgramas`;

DELIMITER $$
USE `pcicz`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerProgramas`()
BEGIN

	DECLARE codigoRetorno INTEGER;
    
    SELECT idProgramLinea AS idProgramaLinea,
		idPrograma
	FROM programlineas;
    
    IF EXISTS(SELECT * FROM programlineas) THEN
		 SET codigoRetorno = 0;
	ELSE
		SET codigoRetorno = 1;
	END IF;
    
    SELECT codigoRetorno;

END$$

DELIMITER ;

