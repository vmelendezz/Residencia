USE `pcicz`;
DROP procedure IF EXISTS `spInsertarEntregables`;

DELIMITER $$
USE `pcicz`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spInsertarEntregables`(pIdSolicitudApoyo INTEGER,
	pLicenciatura VARCHAR(255),
    pMaestria VARCHAR(255),
    pDoctorado VARCHAR(255),
    pIncorporacionAlumnos VARCHAR(255),
    pAlumnosResidentes VARCHAR(255),
    pArtRevistaIndizadas VARCHAR(255),
	pArtRevistaArbitrada VARCHAR(255),
	pArtDivulgacion VARCHAR(255),
	pMemoriaCongreso VARCHAR(255),
	pCapLibroRevision VARCHAR(255),
	pLibroRevision VARCHAR(255),
	pLibroPublicado VARCHAR(255),
	pPrototipoRegistro VARCHAR(255),
	pPatenteRegistro VARCHAR(255),
	pPaqueteRegistro VARCHAR(255),
	pOtros VARCHAR(255),
	pBeneficios VARCHAR(255))
BEGIN

	DECLARE codRet INTEGER;
	DECLARE pId INTEGER;
	DECLARE idEnt INTEGER;
	
	IF EXISTS(SELECT * FROM entregables) THEN
		SET idEnt = (SELECT idEntregables FROM entregables ORDER BY idEntregables DESC LIMIT 1);
		SET pId = idEnt + 1;
	ELSE
		SET pId = 1;
	END IF;
	
    IF(pIdSolicitudApoyo != 0) THEN
	INSERT INTO entregables(idEntregables, idSolicitudApoyo)
	VALUES(pId, pIdSolicitudApoyo);
	
	INSERT INTO contribucion 
	VALUES(pId,
		pLicenciatura,
		pMaestria,
		pDoctorado,
		pIncorporacionAlumnos,
		pAlumnosResidentes,
		pId);
	
	INSERT INTO prodacademica
	VALUES(pId,
		pArtRevistaIndizadas,
		pArtRevistaArbitrada,
		pArtDivulgacion,
		pMemoriaCongreso,
		pCapLibroRevision,
		pLibroRevision,
		pLibroPublicado,
		pPrototipoRegistro,
		pPatenteRegistro,
		pPaqueteRegistro,
		pOtros,
		pId,
		pBeneficios);
	END IF;
    
	IF EXISTS(SELECT * FROM entregables WHERE idEntregables = pId) THEN
		SET codRet = 0;
	ELSE
		SET codRet = 1;
	END IF;
	
	SELECT codRet;
END$$

DELIMITER ;