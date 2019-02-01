USE `pcicz`;
DROP procedure IF EXISTS `spInicializarSolicitudApoyo`;

DELIMITER $$
USE `pcicz`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spInicializarSolicitudApoyo`(
	pId BOOLEAN,
	pTitulo VARCHAR(255),
	pIdInvestigador INTEGER)
BEGIN
	
	CALL spGuardarSolicitudApoyo(pId, pTitulo, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, pIdInvestigador, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
	CALL spGuardarEntregables(pId, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
	CALL spGuardarFinanciamiento(NULL, NULL, pId);
	CALL spGuardarPresupuesto(pId, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
	
END$$

DELIMITER ;