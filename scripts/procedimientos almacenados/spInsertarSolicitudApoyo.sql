USE `pcicz`;
DROP procedure IF EXISTS `spInsertarSolicitudApoyo`;

DELIMITER $$
USE `pcicz`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spInsertarSolicitudApoyo`(
	pTitulo VARCHAR(255),
    pDescripcion VARCHAR(255),
    pFecha DATE,
    pIdtipoInvestigacion INTEGER,
    pIdOrientacion INTEGER,
    pIdPrograma INTEGER,
    pIdLinea INTEGER,
    pFechaInicio DATE,
    pDuracion INTEGER,
    pFechaFinal DATE,
    pIdResponsable INTEGER,
	pIdProgramaInv INTEGER,
    pIdLineaInv INTEGER,
	pIdProgramaCuerpo INTEGER,
    pIdLineaCuerpo INTEGER
)
BEGIN

	DECLARE pCodigoExito INTEGER;
    DECLARE pId INTEGER;
    DECLARE idSol INTEGER;
    
    IF EXISTS(SELECT * FROM solicitudapoyo) THEN
		SET idSol = (SELECT idSolicitudApoyo FROM solicitudapoyo ORDER BY idSolicitudApoyo DESC LIMIT 1);
        SET pId = idSol + 1;
	ELSE
		SET pId = 1;
	END IF;
	
    INSERT INTO solicitudapoyo (
		idSolicitudApoyo,
		tituloProyecto,
        descripcion,
        fecha,
        idTipoInvestigacion,
        idOrientacion,
        idPrograma,
        idLinea,
        fechaInicio, 
        duracion,
        fechaFin,
        idResponsable,
		idProgramaInv,
        idLineaInv,
		idProgramaCuerpo,
        idLineaCuerpo)
	VALUES(
		pId,
		pTitulo,
		pDescripcion,
		pFecha,
		pIdtipoInvestigacion,
		pIdOrientacion,
		pIdPrograma,
		pIdLinea,
		pFechaInicio,
		pDuracion,
		pFechaFinal,
		pIdResponsable,
		pIdProgramaInv,
		pIdLineaInv,
		pIdProgramaCuerpo,
		pIdLineaCuerpo);
    
    IF EXISTS(SELECT * FROM solicitudapoyo WHERE idSolicitudApoyo = pId) THEN
		SET pCodigoexito = 0;
	ELSE
		SET pCodigoexito = 1;
	END IF;
    
    SELECT pcodigoExito;

END$$

DELIMITER ;

