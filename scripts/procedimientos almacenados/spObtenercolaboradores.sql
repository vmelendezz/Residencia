USE `pcicz`;
DROP procedure IF EXISTS `spObtenercolaboradores`;

DELIMITER $$
USE `pcicz`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenercolaboradores`(pIdSolicitudApoyo INTEGER)
BEGIN
	
    DECLARE pIdColaborador INTEGER;
    DECLARE pIdInvestigador INTEGER;
    DECLARE pColaboradorExterno VARCHAR(255);
    DECLARE pNombreInvestigador VARCHAR(255);
    DECLARE noMasRegistros INT DEFAULT 0;
    
    DECLARE CursorCol CURSOR FOR 
		SELECT idColaborador, idInvestigador, colaboradorExterno FROM colaboradores WHERE idSolicitudApoyo = pIdSolicitudApoyo;
        
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET noMasRegistros = 1;
    
    DROP TEMPORARY TABLE IF EXISTS ColaboradoresPorSolicitud;
    CREATE TEMPORARY TABLE ColaboradoresPorSolicitud (idCol INTEGER, nomCol VARCHAR(255));
    
    OPEN CursorCol;
    
    bucle: LOOP
		
		FETCH CursorCol INTO pIdColaborador, pIdInvestigador, pColaboradorExterno;
        IF (NoMasRegistros = 1) THEN
			LEAVE bucle;
		END IF;
        
        IF (pIdInvestigador = 0) THEN
			SET pNombreInvestigador = pColaboradorExterno;
		ELSE
			SET pNombreInvestigador = fObtenerUsuario(pIdInvestigador);
		END IF;
        
		INSERT ColaboradoresPorSolicitud VALUES (pIdColaborador, pNombreInvestigador);
        
    END LOOP bucle;
    
    CLOSE CursorCol;
    
    SELECT * FROM ColaboradoresPorSolicitud;
    
    DROP TEMPORARY TABLE IF EXISTS ColaboradoresPorSolicitud;
    
END$$

DELIMITER ;

