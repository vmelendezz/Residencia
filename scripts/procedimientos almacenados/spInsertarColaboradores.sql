USE `pcicz`;
DROP procedure IF EXISTS `spInsertarColaboradores`;

DELIMITER $$
USE `pcicz`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spInsertarColaboradores`(
	pIdInvestigador INTEGER,
    pIdSolicitudApoyo INTEGER,
    pColaboradorExterno VARCHAR(255),
    pIdResponsable INTEGER)
BEGIN
	
    DECLARE codigoExito INTEGER DEFAULT 1;
    DECLARE pId INTEGER;
    DECLARE idCol INTEGER;
    
    IF EXISTS(SELECT * FROM colaboradores) THEN
		SET idCol = (SELECT idColaborador FROM colaboradores ORDER BY idColaborador DESC LIMIT 1);
        SET pId = idCol + 1;
	ELSE
		SET pId = 1;
	END IF;
    
    iF (pIdSolicitudApoyo != 0) THEN
    IF NOT EXISTS(SELECT * FROM colaboradores WHERE idSolicitudApoyo = pIdSolicitudApoyo AND idInvestigador = pIdResponsable) THEN
		INSERT INTO colaboradores(idColaborador,
			idInvestigador,
			idSolicitudApoyo)
		VALUES(pId,
			pIdResponsable,
			pIdSolicitudApoyo);
		SET pId = pId + 1;
	END IF;
    
    
    IF (pIdInvestigador != 0) THEN 
		IF NOT EXISTS(SELECT * FROM colaboradores WHERE idInvestigador = pIdInvestigador AND idSolicitudApoyo = pIdSolicitudApoyo) THEN
			INSERT INTO colaboradores(idColaborador,
				idInvestigador,
				idSolicitudApoyo)
			VALUES(pId,
				pIdInvestigador,
				pIdSolicitudApoyo);
			SET codigoExito = 0;
		ELSE
			SET codigoExito = 1;
		END IF;
	ELSEIF (pColaboradorExterno != '') THEN
		INSERT INTO colaboradores(idColaborador,
			idInvestigador,
			idSolicitudApoyo,
            colaboradorExterno)
		VALUES(pId,
			pIdInvestigador,
			pIdSolicitudApoyo,
			pColaboradorExterno);
		SET codigoExito = 0;
	ELSE
		SET codigoExito = 1;
	END IF;
    END IF;
    
    SELECT codigoExito;
    
END$$

DELIMITER ;