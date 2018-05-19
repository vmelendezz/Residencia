USE `pcicz`;
DROP procedure IF EXISTS `spInsertarLugarDesarrollo`;

DELIMITER $$
USE `pcicz`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spInsertarLugarDesarrollo`(
	pIdProtocoloInvestigacion INTEGER,
	pNombreSeccion VARCHAR(255),
	pDireccionExacta VARCHAR(255),
	pRequierePruebasCampo BOOLEAN,
	pEstado VARCHAR(255),
	pRegion VARCHAR(255),
	pZona VARCHAR(255),
	pMunicipio VARCHAR(255),
	pDistanciaKM INTEGER)
BEGIN
	
	DECLARE codRet INTEGER;
    DECLARE pId INTEGER;
    DECLARE idLug INTEGER;
    
    IF EXISTS(SELECT * FROM lugardesarrollo) THEN
		SET idLug = (SELECT idLugarDesarrollo FROM lugardesarrollo ORDER BY idLugarDesarrollo DESC LIMIT 1);
		SET pId = idLug + 1;
	ELSE
		SET pId = 1;
	END IF;
    
    IF (pIdProtocoloInvestigacion != 0) THEN 
		INSERT INTO lugardesarrollo
		VALUES (pId, pIdProtocoloInvestigacion, pNombreSeccion, pDireccionExacta, pRequierePruebasCampo, pEstado, pRegion, pZona, pMunicipio, pDistanciaKM);
	END IF;
    
    IF EXISTS(SELECT * FROM lugardesarrollo WHERE idLugarDesarrollo = pId) THEN
		SET codRet = 0;
	ELSE
		SET codRet = 1;
	END IF;
    
    SELECT codRet;
END$$

DELIMITER ;