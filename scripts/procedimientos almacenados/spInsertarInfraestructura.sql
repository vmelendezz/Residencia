USE `pcicz`;
DROP procedure IF EXISTS `spInsertarInfraestructura`;

DELIMITER $$
USE `pcicz`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spInsertarInfraestructura`(
	pDescripcion VARCHAR(500),
	pIdProtocoloInvestigacion INTEGER)
BEGIN
	
	DECLARE codRet INTEGER;
    DECLARE pId INTEGER;
    DECLARE idInf INTEGER;
    
    IF EXISTS(SELECT * FROM infraestructura) THEN
		SET idInf = (SELECT idInfraestructura FROM infraestructura ORDER BY idInfraestructura DESC LIMIT 1);
		SET pId = idInf + 1;
	ELSE
		SET pId = 1;
	END IF;
    
    IF (pIdProtocoloInvestigacion != 0) THEN 
		INSERT INTO infraestructura
		VALUES (pId, pDescripcion, pIdProtocoloInvestigacion);
	END IF;
    
    IF EXISTS(SELECT * FROM infraestructura WHERE idInfraestructura = pId) THEN
		SET codRet = 0;
	ELSE
		SET codRet = 1;
	END IF;
    
    SELECT codRet;
END$$

DELIMITER ;