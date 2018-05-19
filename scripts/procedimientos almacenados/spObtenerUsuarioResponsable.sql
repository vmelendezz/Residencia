USE `pcicz`;
DROP procedure IF EXISTS `spObtenerUsuarioResponsable`;

DELIMITER $$
USE `pcicz`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerUsuarioResponsable`(idUsuario INTEGER)
BEGIN
	
    DECLARE codRet INTEGER;

	SELECT CONCAT(nombre, ' ',
		apellidoPaterno, ' ', 
        apellidoMaterno) AS Nombre,
        correo  AS Correo
    FROM usuarios
    WHERE idUsuarios = idUsuario;
    
    IF EXISTS(SELECT * FROM usuarios WHERE idUsuarios = idUsuario) THEN
		SET codRet = 0;
	ELSE
		SET codRet = 1;
	END IF;
    
    SELECT codRet;

END$$

DELIMITER ;

