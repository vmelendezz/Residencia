USE `pcicz`;
DROP procedure IF EXISTS `spInsertarObjetivoEspecifico`;

DELIMITER $$
USE `pcicz`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spInsertarObjetivoEspecifico`(pObjEsp TEXT, pIdSolicitudApoyo INTEGER)
BEGIN
	
    DECLARE codRet INTEGER;
    DECLARE pId INTEGER;
    DECLARE idOE INTEGER;
    
    IF EXISTS(SELECT * FROM objetivosespecificos) THEN
		SET idOE = (SELECT idObjetivosEspecificos FROM objetivosespecificos ORDER BY idObjetivosEspecificos DESC LIMIT 1);
        SET pId = idOE + 1;
	ELSE
		SET pId = 1;
	END IF;
    
    IF(pIdSolicitudApoyo != 0) THEN
		INSERT INTO objetivosespecificos(idObjetivosEspecificos,
			descripcion,
			idSolicitudApoyo)
		VALUES (pId,
			pObjEsp,
			pIdSolicitudApoyo);
	END IF;
    
	IF EXISTS(SELECT * FROM objetivosespecificos WHERE idObjetivosEspecificos = pId) THEN
		SET codRet = 0;
	ELSE
		SET codRet = 1;
	END IF;
    
    SELECT codRet;
    
END$$

DELIMITER ;

