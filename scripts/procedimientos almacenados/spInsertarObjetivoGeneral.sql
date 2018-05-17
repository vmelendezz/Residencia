USE `pcicz`;
DROP procedure IF EXISTS `spInsertarObjetivoGeneral`;

DELIMITER $$
USE `pcicz`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spInsertarObjetivoGeneral`(pObjGral TEXT, pIdSolicitudApoyo INTEGER)
BEGIN
	DECLARE codRet INTEGER;
    DECLARE pId INTEGER;
    DECLARE idOG INTEGER;
    
    IF EXISTS(SELECT * FROM objetivogeneral) THEN
		SET idOG = (SELECT idObjetivoGeneral FROM objetivogeneral ORDER BY idObjetivoGeneral DESC LIMIT 1);
        SET pId = idOG + 1;
	ELSE
		SET pId = 1;
	END IF;
    
    IF(pIdSolicitudApoyo !=0) THEN
		INSERT INTO objetivogeneral(idObjetivoGeneral,
			descripcion,
			idSolicituApoyo)
		VALUES (pId,
			pObjGral,
			pIdSolicitudApoyo);
	END IF;
    
	IF EXISTS(SELECT * FROM objetivogeneral WHERE idObjetivoGeneral = pId) THEN
		SET codRet = 0;
	ELSE
		SET codRet = 1;
	END IF;
    
    SELECT codRet;
END$$

DELIMITER ;

