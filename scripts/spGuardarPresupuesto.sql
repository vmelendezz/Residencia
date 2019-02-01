USE `pcicz`;
DROP procedure IF EXISTS `spGuardarPresupuesto`;

DELIMITER $$
USE `pcicz`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGuardarPresupuesto`(
	pIdSolicitudApoyo INTEGER,
    pMontoSolicitadoMateriales DECIMAL(50,2),
    pMontoOtorgadoTecMateriales DECIMAL(50,2),
    pMontoOtorgadoInstitucionesMateriales DECIMAL(50,2),
    pTotalMateriales DECIMAL(50,2),
	pMontoSolicitadoServicios DECIMAL(50,2),
    pMontoOtorgadoTecServicios DECIMAL(50,2),
    pMontoOtorgadoInstitucionesServicios DECIMAL(50,2),
    pTotalServicios DECIMAL(50,2),
	pTotalMontoSolicitado DECIMAL(50,2),
	pTotalMontoOtorgadoTec DECIMAL(50,2),
	pTotalMontoOtorgadoInstituciones DECIMAL(50,2),
	pTotal DECIMAL(50,2))
BEGIN
	
    DECLARE codRet INTEGER;
	
	SET codRet = 1;
	
	IF(pIdSolicitudApoyo != 0)THEN
		IF NOT EXISTS(SELECT * FROM presupuesto WHERE idSolicitudApoyo = pIdSolicitudApoyo) THEN    
			INSERT INTO presupuesto(montoSolicitadoMateriales, montoOtorgadoTecMateriales, montoOtorgadoInstitucionesMateriales,
				totalMateriales, montoSolicitadoServicios, montoOtorgadoTecServicios, montoOtorgadoInstitucionesServicios,
				totalServicios, totalMontoSolicitado, totalMontoOtorgadoTec, totalMontoOtorgadoInstituciones, total, idSolicitudApoyo)
			VALUES(pMontoSolicitadoMateriales,
					pMontoOtorgadoTecMateriales,
					pMontoOtorgadoInstitucionesMateriales,
					pTotalMateriales,
					pMontoSolicitadoServicios,
					pMontoOtorgadoTecServicios,
					pMontoOtorgadoInstitucionesServicios,
					pTotalServicios,
					pTotalMontoSolicitado,
					pTotalMontoOtorgadoTec,
					pTotalMontoOtorgadoInstituciones,
					pTotal,
					pIdSolicitudApoyo);
			
			SET codRet = 0;
		ELSE
			UPDATE presupuesto
			SET montoSolicitadoMateriales = pMontoSolicitadoMateriales, 
				montoOtorgadoTecMateriales = pMontoOtorgadoTecMateriales, 
				montoOtorgadoInstitucionesMateriales = pMontoOtorgadoInstitucionesMateriales,
				totalMateriales = pTotalMateriales, 
				montoSolicitadoServicios = pMontoSolicitadoServicios, 
				montoOtorgadoTecServicios = pMontoOtorgadoTecServicios, 
				montoOtorgadoInstitucionesServicios = pMontoOtorgadoInstitucionesServicios,
				totalServicios = pTotalServicios, 
				totalMontoSolicitado = pTotalMontoSolicitado, 
				totalMontoOtorgadoTec = pTotalMontoOtorgadoTec, 
				totalMontoOtorgadoInstituciones = pTotalMontoOtorgadoInstituciones, 
				total = pTotal
			WHERE idSolicitudApoyo = pIdSolicitudApoyo;
				
			SET codRet = 0;
		END IF;
	END IF;
	
	SELECT codRet;

END$$

DELIMITER ;

