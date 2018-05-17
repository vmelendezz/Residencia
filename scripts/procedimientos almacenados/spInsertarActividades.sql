USE `pcicz`;
DROP procedure IF EXISTS `spInsertarActividades`;

DELIMITER $$
USE `pcicz`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spInsertarActividades`(
	pNombreResponsable VARCHAR(45),
    pPeriodo VARCHAR(45),
    pResultados MEDIUMTEXT,
    pPartidasSolicitadas VARCHAR(255),
    pMontoSolicitado DECIMAL(2,0),
    pDescripcionBienes MEDIUMTEXT,
    pIdSolicitudApoyo INTEGER,
	pActividad VARCHAR(45))
BEGIN
	
	DECLARE codRet INTEGER;
    DECLARE pId INTEGER;
    DECLARE idAct INTEGER;
    
    IF EXISTS(SELECT * FROM actividades) THEN
		SET idAct = (SELECT idActividades FROM actividades ORDER BY idActividades DESC LIMIT 1);
		SET pId = idAct + 1;
	ELSE
		SET pId = 1;
	END IF;
    
    IF (pIdSolicitudApoyo != 0) THEN 
		INSERT INTO actividades
		VALUES (pId, pNombreResponsable, pPeriodo, pResultados, pPartidasSolicitadas, pMontoSolicitado, pDescripcionBienes, pIdSolicitudApoyo, pActividad);
	END IF;
    
    IF EXISTS(SELECT * FROM actividades WHERE idActividades = pId) THEN
		SET codRet = 0;
	ELSE
		SET codRet = 1;
	END IF;
    
    SELECT codRet;
END$$

DELIMITER ;
