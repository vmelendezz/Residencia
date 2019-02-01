USE `pcicz`;
DROP procedure IF EXISTS `spInicializarProtocoloInvestigacion`;

DELIMITER $$
USE `pcicz`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spInicializarProtocoloInvestigacion`(
	pId BOOLEAN,
	pTitulo VARCHAR(255),
	pIdInvestigador INTEGER)
BEGIN
	
	CALL spGuardarDescrpcionProyecto(pTitulo, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, pIdInvestigador, pId, NULL);
	CALL spGuardarInfraestructura(NULL, pId);
	CALL spGuardarLugarDesarrollo(pId, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
	CALL spGuardarReferencias(NULL, NULL, NULL, NULL, pId);
	CALL spGuardarVinculacion(NULL, NULL, NULL, NULL, pId);
	
END$$

DELIMITER ;