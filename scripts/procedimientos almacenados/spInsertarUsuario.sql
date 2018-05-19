USE `pcicz`;
DROP procedure IF EXISTS `spInsertarUsuario`;

DELIMITER $$
USE `pcicz`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spInsertarUsuario`(
	pNombre VARCHAR(255),
	pApellidoPaterno VARCHAR(255),
	pApellidoMaterno VARCHAR(255),
	pCorreo VARCHAR(255),
	pPassword VARCHAR(255),
	pCurp VARCHAR(255),
	pTipoUsuario INTEGER,
	pIddocumentos INTEGER
)
BEGIN
	INSERT INTO usuarios (
		correo, 
		password, 
		nombre, 
		apellido_paterno, 
		apellido_materno, 
		curp, 
		tipo_usuario_id_tipo_usuario, 
		documentos_id_documentos)
	VALUES (
		pCorreo,
		pPassword,
		pNombre,
		pApellidoPaterno,
		pApellidoMaterno,
		pCurp,
		pTipoUsuario,
		pIddocumentos);
        
END$$

DELIMITER ;

