USE `pcicz`;
DROP procedure IF EXISTS `spInsertarFinanciamiento`;

DELIMITER $$
USE `pcicz`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spInsertarFinanciamiento`(pFuente VARCHAR(255),
    pIdSolicitudApoyo INTEGER)
BEGIN
	
    DECLARE codRet INTEGER;
    DECLARE pId INTEGER;
    DECLARE idFin INTEGER;
    
    IF EXISTS(SELECT * FROM financiamiento) THEN
		SET idFin = (SELECT idFinanciamiento FROM financiamiento ORDER BY idFinanciamiento DESC LIMIT 1);
		SET pId = idFin + 1;
	ELSE
		SET pId = 1;
	END IF;
    
    IF(pIdSolicitudApoyo != 0) THEN
		INSERT INTO financiamiento
		VALUES (pId, pFuente, pIdSolicitudApoyo);
    END IF;
    
    IF EXISTS(SELECT * FROM financiamiento WHERE idFinanciamiento = pId) THEN
		SET codRet = 0;
	ELSE
		SET codRet = 1;
	END IF;
    
    SELECT codret;
END$$

DELIMITER ;