USE `pcicz`;
DROP procedure IF EXISTS `spGuardarSolicitudApoyo`;

DELIMITER $$
USE `pcicz`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGuardarSolicitudApoyo`(
	pIdSolicitudApoyo INTEGER,
	pTitulo VARCHAR(255),
    pDescripcion VARCHAR(255),
    pIdtipoInvestigacion INTEGER,
    pOrientacion VARCHAR(45),
    pIdPrograma INTEGER,
    pIdLinea INTEGER,
    pFechaInicio DATE,
    pDuracion INTEGER,
    pHorasRequeridas INTEGER,
    pResponsable VARCHAR(45),
	pIdProgramaInv INTEGER,
    pIdLineaInv INTEGER,
	pIdProgramaCuerpo INTEGER,
    pIdLineaCuerpo INTEGER,
	pCorreoResponsable VARCHAR(45),
	pSubOrientacion VARCHAR(45),
	pIdInvestigador INTEGER,
	pIdCuerpoAcademico INTEGER,
	pSniInv INTEGER,
	pPromepInv INTEGER,
	pIdInstitucion INTEGER,
	pSNI BOOLEAN,
	pNumeroRegistroSNI INTEGER,
	pVigenciaNombramiento INTEGER,
	pOrientacionCuerpo INTEGER
)
BEGIN

	DECLARE codRet INTEGER;
    DECLARE pId INTEGER;
    DECLARE idSol INTEGER;
	
	SET codRet = 1;
	
	IF(pIdtipoInvestigacion <= 0)THEN
		SET pIdtipoInvestigacion = NULL;
	END IF;
	IF(pIdPrograma <= 0)THEN
		SET pIdPrograma = NULL;
	END IF;
	IF(pIdLinea <= 0)THEN
		SET pIdLinea = NULL;
	END IF;
	IF(pIdProgramaInv <= 0)THEN
		SET pIdProgramaInv = NULL;
	END IF;
	IF(pIdLineaInv <= 0)THEN
		SET pIdLineaInv = NULL;
	END IF;
	IF(pIdProgramaCuerpo <= 0)THEN
		SET pIdProgramaCuerpo = NULL;
	END IF;
	IF(pIdLineaCuerpo <= 0)THEN
		SET pIdLineaCuerpo = NULL;
	END IF;
	IF(pIdCuerpoAcademico <= 0)THEN
		SET pIdCuerpoAcademico = NULL;
	END IF;
	IF(pIdInstitucion <= 0)THEN
		SET pIdInstitucion = NULL;
	END IF;
    
	IF(pIdSolicitudApoyo = 0) THEN
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
			idTipoInvestigacion,
			Orientacion,
			idPrograma,
			idLinea,
			fechaInicio, 
			duracion,
			horasRequeridas,
			responsable,
			idProgramaInv,
			idLineaInv,
			idProgramaCuerpo,
			idLineaCuerpo,
			correoResponsable,
			subOrientacion,
			idInvestigador,
			idCuerpoAcademico,
			sniInv,
			promepInv,
			idInstitucion,
			SNI,
			numeroRegistroSNI,
			vigencia,
			orientacionCuerpo)
		VALUES(
			pId,
			pTitulo,
			pDescripcion,
			pIdtipoInvestigacion,
			pOrientacion,
			pIdPrograma,
			pIdLinea,
			pFechaInicio,
			pDuracion,
			pHorasRequeridas,
			pResponsable,
			pIdProgramaInv,
			pIdLineaInv,
			pIdProgramaCuerpo,
			pIdLineaCuerpo,
			pCorreoResponsable,
			pSubOrientacion,
			pIdInvestigador,
			pIdCuerpoAcademico,
			pSniInv,
			pPromepInv,
			pIdInstitucion,
			pSNI,
			pNumeroRegistroSNI,
			pVigenciaNombramiento,
			pOrientacionCuerpo);
			
		SET codRet = 0;
	ELSE	
		IF NOT EXISTS(SELECT * FROM solicitudapoyo WHERE idSolicitudApoyo = pIdSolicitudApoyo) THEN
			INSERT INTO solicitudapoyo (
				idSolicitudApoyo,
				tituloProyecto,
				descripcion,
				idTipoInvestigacion,
				Orientacion,
				idPrograma,
				idLinea,
				fechaInicio, 
				duracion,
				horasRequeridas,
				responsable,
				idProgramaInv,
				idLineaInv,
				idProgramaCuerpo,
				idLineaCuerpo,
				correoResponsable,
				subOrientacion,
				idInvestigador,
				idCuerpoAcademico,
				sniInv,
				promepInv,
				idInstitucion,
				SNI,
				numeroRegistroSNI,
				vigencia,
				orientacionCuerpo)
			VALUES(
				pIdSolicitudApoyo,
				pTitulo,
				pDescripcion,
				pIdtipoInvestigacion,
				pOrientacion,
				pIdPrograma,
				pIdLinea,
				pFechaInicio,
				pDuracion,
				pHorasRequeridas,
				pResponsable,
				pIdProgramaInv,
				pIdLineaInv,
				pIdProgramaCuerpo,
				pIdLineaCuerpo,
				pCorreoResponsable,
				pSubOrientacion,
				pIdInvestigador,
				pIdCuerpoAcademico,
				pSniInv,
				pPromepInv,
				pIdInstitucion,
				pSNI,
				pNumeroRegistroSNI,
				pVigenciaNombramiento,
				pOrientacionCuerpo);
		ELSE
			UPDATE solicitudapoyo
			SET tituloProyecto = pTitulo, descripcion = pDescripcion, idTipoInvestigacion = pIdtipoInvestigacion,
				orientacion = pOrientacion, idPrograma = pIdPrograma, idLinea = pIdLinea, fechaInicio = pFechaInicio, 
				duracion = pDuracion, horasRequeridas = pHorasRequeridas, responsable = pResponsable, idProgramaInv = pIdProgramaInv,
				idLineaInv = pIdLineaInv, idProgramaCuerpo = pIdProgramaCuerpo,	idLineaCuerpo = pIdLineaCuerpo, 
				correoResponsable = pCorreoResponsable, subOrientacion = pSubOrientacion, idInvestigador = pIdInvestigador,
				idCuerpoAcademico = pIdCuerpoAcademico, sniInv = pSniInv, promepInv = pPromepInv, idInstitucion = pIdInstitucion,
				SNI = pSNI, numeroRegistroSNI = pNumeroRegistroSNI, vigencia = pVigenciaNombramiento, orientacionCuerpo = pOrientacionCuerpo
			WHERE idSolicitudApoyo = pIdSolicitudApoyo;
		END IF;
		
		SET pId = pIdSolicitudApoyo;
		SET codRet = 0;
	END IF;
    
    SELECT pId AS id, codRet;

END$$

DELIMITER ;

