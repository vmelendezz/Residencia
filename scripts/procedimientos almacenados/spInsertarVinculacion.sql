USE `pcicz`;
DROP procedure IF EXISTS `spInsertarVinculacion`;

DELIMITER $$
USE `pcicz`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spInsertarVinculacion`(
	pNombreEmpresa VARCHAR(45),
	pTipoCooperacion VARCHAR(45),
	pResponsabilidad MEDIUMTEXT,
	pUsuariosPotenciales MEDIUMTEXT,
	pOtrasEmpresas VARCHAR(500),
	pIdProtocoloInvestigacion INTEGER)
BEGIN
	
	DECLARE codRet INTEGER;
    DECLARE pId INTEGER;
    DECLARE idVin INTEGER;
    
    IF EXISTS(SELECT * FROM vinculacion) THEN
		SET idVin = (SELECT idVinculacion FROM vinculacion ORDER BY idVinculacion DESC LIMIT 1);
		SET pId = idVin + 1;
	ELSE
		SET pId = 1;
	END IF;
    
    IF (pIdProtocoloInvestigacion != 0) THEN 
		INSERT INTO vinculacion
		VALUES (pId, pNombreEmpresa, pTipoCooperacion, pResponsabilidad, pUsuariosPotenciales, pOtrasEmpresas, pIdProtocoloInvestigacion);
	END IF;
    
    IF EXISTS(SELECT * FROM vinculacion WHERE idVinculacion = pId) THEN
		SET codRet = 0;
	ELSE
		SET codRet = 1;
	END IF;
    
    SELECT codRet;
END$$

DELIMITER ;