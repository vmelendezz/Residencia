USE `pcicz`;
DROP procedure IF EXISTS `spObtenerUsuariosAColaborar`;

DELIMITER $$
USE `pcicz`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerUsuariosAColaborar`(idResponsable INTEGER)
BEGIN
	
    DECLARE pIdUsuario INTEGER;
    DECLARE pNombre VARCHAR(255);
    DECLARE pApP VARCHAR(255);
    DECLARE pApM VARCHAR(255);
    DECLARE nombreCompleto VARCHAR(255);
    DECLARE noMasRegistros INT DEFAULT 0;
    
    DECLARE cursorUsCol CURSOR FOR
		SELECT id_usuarios, nombre, apellido_paterno, apellido_materno FROM usuarios;
    
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET noMasRegistros = 1;
    
    DROP TEMPORARY TABLE IF EXISTS UsuariosColaborar;
    CREATE TEMPORARY TABLE UsuariosColaborar (idUsuario INTEGER, nomUsuario VARCHAR(255));
 
    OPEN cursorUsCol;

    bucle: LOOP
		
        FETCH cursorUsCol INTO pIdUsuario, pNombre, pApP, pApM;
        IF (NoMasRegistros = 1) THEN
			LEAVE bucle;
		END IF;
        
        IF(pIdUsuario != 0 AND pIdUsuario != idResponsable) THEN 
			SET nombreCompleto = fObtenerUsuario(pIdUsuario);
            INSERT UsuariosColaborar VALUES (pIdUsuario, nombreCompleto);
		END IF;
        
	END LOOP bucle;
    
    SELECT * FROM UsuariosColaborar;
    
    DROP TEMPORARY TABLE IF EXISTS UsuariosColaborar;
    
END$$

DELIMITER ;

