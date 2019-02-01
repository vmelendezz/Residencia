USE `pcicz`;
DROP procedure IF EXISTS `spGuardarDescrpcionProyecto`;

DELIMITER $$
USE `pcicz`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGuardarDescrpcionProyecto`(
	pTitulo VARCHAR(45),
	pResumen LONGTEXT,
    pIntroduccion LONGTEXT,
    pAntecedentes LONGTEXT,
    pMarcoTeorico LONGTEXT,
    pMetas LONGTEXT,
    pImpactoBeneficio LONGTEXT,
    pMetodologia LONGTEXT,
	pProductosEntregables MEDIUMTEXT,
	pIdInvestigador INTEGER,
	pIdProtocoloInvestigacion INTEGER,
	pIdCampus INTEGER)
BEGIN
	
	DECLARE codRet INTEGER;
    DECLARE pId INTEGER;
	
	SET codRet = 1;
	
	IF(pIdCampus <= 0)THEN
		SET pIdCampus = NULL;
	END IF;
	
	IF(pIdProtocoloInvestigacion = 0)THEN
		SET pId = (SELECT idSolicitudApoyo FROM solicitudapoyo ORDER BY idSolicitudApoyo DESC LIMIT 1) + 1;
		INSERT INTO solicitudapoyo(idSolicitudApoyo, tituloProyecto, idInvestigador) VALUES (pId, pTitulo, pIdInvestigador);
		SET pIdProtocoloInvestigacion = pId;
	END IF;
    
	IF NOT EXISTS(SELECT * FROM descripcionproyecto WHERE idProtocoloInvestigacion = pIdProtocoloInvestigacion) THEN
		INSERT INTO descripcionproyecto(resumen, introduccion, antecedentes, marcoTeorico, metas, impactoBeneficio, metodologia, productosEntregables, idProtocoloInvestigacion, idCampus)
		VALUES (pResumen, pIntroduccion, pAntecedentes, pMarcoTeorico, pMetas, pImpactoBeneficio, pMetodologia, pProductosEntregables, pIdProtocoloInvestigacion, pIdCampus);
		
		SET codRet = 0;
	ELSE
		UPDATE solicitudapoyo
		SET tituloProyecto = pTitulo, idInvestigador = pIdInvestigador
		WHERE idSolicitudApoyo = pIdProtocoloInvestigacion;
	
		UPDATE descripcionproyecto
		SET resumen = pResumen, introduccion = pIntroduccion, antecedentes = pAntecedentes, marcoTeorico = pMarcoTeorico,
			metas = pMetas, impactoBeneficio = pImpactoBeneficio, metodologia = pMetodologia, productosEntregables = pProductosEntregables, idCampus = pIdCampus
		WHERE idProtocoloInvestigacion = pIdProtocoloInvestigacion;
		
		SET codRet = 0;
	END IF;
    
	SET pId = pIdProtocoloInvestigacion;
    SELECT pId AS id, codRet;
END$$

DELIMITER ;