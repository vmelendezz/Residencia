USE `pcicz`;
DROP procedure IF EXISTS `spObtenerNombreLineas`;

DELIMITER $$
USE `pcicz`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerNombreLineas`(pIdLinea INTEGER)
BEGIN
	
    DECLARE codigoRetorno INTEGER;
    
	SELECT nombre AS Nombre
    FROM lineas
    WHERE idLinea = pIdLinea;
    
    IF EXISTS(SELECT * FROM lineas WHERE idLinea = pIdLinea) THEN
		SET codigoRetorno = 0;
	ELSE
		SET codigoRetorno = 1;
	END IF;
    
    SELECT codigoRetorno;

END$$

DELIMITER ;

