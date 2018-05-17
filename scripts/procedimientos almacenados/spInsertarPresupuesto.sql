USE `pcicz`;
DROP procedure IF EXISTS `spInsertarPresupuesto`;

DELIMITER $$
USE `pcicz`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spInsertarPresupuesto`(pIdSolicitudApoyo INTEGER,
	pConcepto VARCHAR(45),
    pMontoSolicitado DECIMAL(2,0),
    pMontoOtorgadoTec DECIMAL(2,0),
    pMontoOtorgadoInstituciones DECIMAL(2,0),
    pTotal DECIMAL(2,0))
BEGIN
	
    DECLARE codRet INTEGER;
	DECLARE pId INTEGER;
	DECLARE idPres INTEGER;
	
    
		IF EXISTS(SELECT * FROM presupuesto) THEN
			SET idPres = (SELECT idPresupuesto FROM presupuesto ORDER BY idPresupuesto DESC LIMIT 1);
			SET pId = idPres + 1;
		ELSE
			SET pId = 1;
		END IF;
    
	
	IF(pIdSolicitudApoyo != 0) THEN
		INSERT INTO presupuesto 
		VALUES(pId,
			pConcepto,
			pMontoSolicitado,
			pMontoOtorgadoTec,
			pMontoOtorgadoInstituciones,
			pTotal,
			pIdSolicitudApoyo);
	END IF;
	
	IF EXISTS(SELECT * FROM presupuesto WHERE idPresupuesto = pId) THEN
		SET codRet = 0;
	ELSE
		SET codRet = 1;
	END IF;
	
	SELECT codRet;

END$$

DELIMITER ;

