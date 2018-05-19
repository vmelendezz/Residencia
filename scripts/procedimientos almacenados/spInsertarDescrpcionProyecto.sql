USE `pcicz`;
DROP procedure IF EXISTS `spInsertarDescrpcionProyecto`;

DELIMITER $$
USE `pcicz`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spInsertarDescrpcionProyecto`(
	pResumen LONGTEXT,
    pIntroduccion LONGTEXT,
    pAntecedentes LONGTEXT,
    pMarcoTeorico LONGTEXT,
    pMetas LONGTEXT,
    pImpactoBeneficio LONGTEXT,
    pMetodologia LONGTEXT,
	pReferencias MEDIUMTEXT,
	pIdProtocoloInvestigacion INTEGER)
BEGIN
	
	DECLARE codRet INTEGER;
    DECLARE pId INTEGER;
    DECLARE idDes INTEGER;
    
    IF EXISTS(SELECT * FROM descripcionproyecto) THEN
		SET idDes = (SELECT idDescripcionProyecto FROM descripcionproyecto ORDER BY idDescripcionProyecto DESC LIMIT 1);
		SET pId = idDes + 1;
	ELSE
		SET pId = 1;
	END IF;
    
    IF (pIdProtocoloInvestigacion != 0) THEN 
		INSERT INTO descripcionproyecto
		VALUES (pId, pResumen, pIntroduccion, pAntecedentes, pMarcoTeorico, pMetas, pImpactoBeneficio, pMetodologia, pReferencias, pIdProtocoloInvestigacion);
	END IF;
    
    IF EXISTS(SELECT * FROM descripcionproyecto WHERE idDescripcionProyecto = pId) THEN
		SET codRet = 0;
	ELSE
		SET codRet = 1;
	END IF;
    
    SELECT codRet;
END$$

DELIMITER ;