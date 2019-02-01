-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-06-2018 a las 10:49:36
-- Versión del servidor: 10.1.29-MariaDB
-- Versión de PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pcicz`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGuardarActividades` (`pNombreResponsable` VARCHAR(45), `pPeriodo` VARCHAR(45), `pResultados` MEDIUMTEXT, `pPartidasSolicitadas` VARCHAR(255), `pMontoSolicitado` DECIMAL(2,0), `pDescripcionBienes` MEDIUMTEXT, `pIdSolicitudApoyo` INTEGER, `pActividad` VARCHAR(45))  BEGIN
	
	DECLARE codRet INTEGER;
	
	DECLARE pId INTEGER;
	DECLARE idAct INTEGER;
	
	SET codRet = 1;
	
	IF EXISTS(SELECT * FROM actividades) THEN
		SET idAct = (SELECT idActividades FROM actividades ORDER BY idActividades DESC LIMIT 1);
		SET pId = idAct + 1;
	ELSE
		SET pId = 1;
	END IF;
	
	IF(pIdSolicitudApoyo != 0)THEN
		INSERT INTO actividades
		VALUES (pId, pNombreResponsable, pPeriodo, pResultados, pPartidasSolicitadas, pMontoSolicitado, pDescripcionBienes, pIdSolicitudApoyo, pActividad);
		
		SET codRet = 0;
	END IF;
    
    SELECT codRet;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spGuardarActividadesDireccionTesis` (`pNombreEstudiante` VARCHAR(255), `pNombreTesis` VARCHAR(255), `pNivelLicenciatura` BOOLEAN, `pNivelMaestria` BOOLEAN, `pFechaTermino` DATE, `pTotalHorasSemana` INTEGER, `pIdPlanTrabajo` INTEGER)  BEGIN
    DECLARE codRet INTEGER;
	
	DECLARE pId INTEGER;
	DECLARE idAct INTEGER;
	
	SET codRet = 1;
	
	IF EXISTS(SELECT * FROM actividadesdirecciontesis) THEN
		SET idAct = (SELECT idActividadesDireccionTesis FROM actividadesdirecciontesis ORDER BY idActividadesDireccionTesis DESC LIMIT 1);
		SET pId = idAct + 1;
	ELSE
		SET pId = 1;
	END IF;
	
	IF(pIdPlanTrabajo != 0)THEN
		INSERT INTO actividadesdirecciontesis
		VALUES (pId, pNombreEstudiante, pNombreTesis, pNivelLicenciatura, pNivelMaestria, pFechaTermino, pTotalHorasSemana, pIdPlanTrabajo);
		
		SET codRet = 0;
	END IF;
    
    SELECT codRet;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spGuardarActividadesDocencia` (`pNombreAsignatura` VARCHAR(255), `pNoEstudiantes` INTEGER, `pNivelLicenciatura` BOOLEAN, `pNivelMaestria` BOOLEAN, `pHorasTeorica` BOOLEAN, `pHorasTeoricaPractica` BOOLEAN, `pHorasPractica` BOOLEAN, `pTotalHorasSemana` INTEGER, `pIdPlanTrabajo` INTEGER)  BEGIN
    DECLARE codRet INTEGER;
	
	DECLARE pId INTEGER;
	DECLARE idAct INTEGER;
	
	SET codRet = 1;
	
	IF EXISTS(SELECT * FROM actividadesdocencia) THEN
		SET idAct = (SELECT idActividadesDocencia FROM actividadesdocencia ORDER BY idActividadesDocencia DESC LIMIT 1);
		SET pId = idAct + 1;
	ELSE
		SET pId = 1;
	END IF;
	
	IF(pIdPlanTrabajo != 0)THEN
		INSERT INTO actividadesdocencia
		VALUES (pId, pNombreAsignatura, pNoEstudiantes, pNivelLicenciatura, pNivelMaestria, pHorasTeorica, pHorasTeoricaPractica, pHorasPractica, pTotalHorasSemana, pIdPlanTrabajo);
		
		SET codRet = 0;
	END IF;
    
    SELECT codRet;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spGuardarActividadesGestionAcademica` (`pFuncion` VARCHAR(255), `pDescripcion` VARCHAR(255), `pProductoEsperado` VARCHAR(255), `pTotalHorasSemana` INTEGER, `pIdPlanTrabajo` INTEGER)  BEGIN
    DECLARE codRet INTEGER;
	
	DECLARE pId INTEGER;
	DECLARE idAct INTEGER;
	
	SET codRet = 1;
	
	IF EXISTS(SELECT * FROM actividadesgestionAcademica) THEN
		SET idAct = (SELECT idActividadesGestionAcademica FROM actividadesgestionAcademica ORDER BY idActividadesGestionAcademica DESC LIMIT 1);
		SET pId = idAct + 1;
	ELSE
		SET pId = 1;
	END IF;
	
	IF(pIdPlanTrabajo != 0)THEN
		INSERT INTO actividadesgestionAcademica
		VALUES (pId, pFuncion, pDescripcion, pProductoEsperado, pTotalHorasSemana, pIdPlanTrabajo);
		
		SET codRet = 0;
	END IF;
    
    SELECT codRet;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spGuardarActividadesInvestigacion` (`pNombreproyecto` VARCHAR(255), `pFuncionEnProyecto` VARCHAR(255), `pProductosEsperados` VARCHAR(255), `pTotalHorasSemana` INTEGER, `pIdPlanTrabajo` INTEGER)  BEGIN
    DECLARE codRet INTEGER;
	
	DECLARE pId INTEGER;
	DECLARE idAct INTEGER;
	
	SET codRet = 1;
	
	IF EXISTS(SELECT * FROM actividadesinvestigacion) THEN
		SET idAct = (SELECT idActividadesInvestigacion FROM actividadesinvestigacion ORDER BY idActividadesInvestigacion DESC LIMIT 1);
		SET pId = idAct + 1;
	ELSE
		SET pId = 1;
	END IF;
	
	IF(pIdPlanTrabajo != 0)THEN
		INSERT INTO actividadesinvestigacion
		VALUES (pId, pNombreproyecto, pFuncionEnProyecto, pProductosEsperados, pTotalHorasSemana, pIdPlanTrabajo);
		
		SET codRet = 0;
	END IF;
    
    SELECT codRet;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spGuardarActividadesTutoria` (`pNombreEstudiante` VARCHAR(255), `pTipoTutoria` VARCHAR(255), `pNivelLicenciatura` BOOLEAN, `pNivelMaestria` BOOLEAN, `pHorasteoria` BOOLEAN, `pHorasteoriaPractica` BOOLEAN, `pHorasPractica` BOOLEAN, `pTotalHorasSemana` INTEGER, `pIdPlanTrabajo` INTEGER)  BEGIN
    DECLARE codRet INTEGER;
	
	DECLARE pId INTEGER;
	DECLARE idAct INTEGER;
	
	SET codRet = 1;
	
	IF EXISTS(SELECT * FROM actividadestutoria) THEN
		SET idAct = (SELECT idActividadesTutoria FROM actividadestutoria ORDER BY idActividadesTutoria DESC LIMIT 1);
		SET pId = idAct + 1;
	ELSE
		SET pId = 1;
	END IF;
	
	IF(pIdPlanTrabajo != 0)THEN
		INSERT INTO actividadestutoria
		VALUES (pId, pNombreEstudiante, pTipoTutoria, pNivelLicenciatura, pNivelMaestria, pHorasteoria, pHorasteoriaPractica, pHorasPractica, pTotalHorasSemana, pIdPlanTrabajo);
		
		SET codRet = 0;
	END IF;
    
    SELECT codRet;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spGuardarAlumnosIncorporados` (`pIdSolicitudApoyo` INTEGER, `pNombre` VARCHAR(255))  BEGIN
	
	DECLARE codRet INTEGER;
	DECLARE idEnt INTEGER;
	DECLARE idCont INTEGER;
	
	DECLARE pId INTEGER;
	DECLARE idAlInc INTEGER;
	
	SET codRet = 1;
	
	IF EXISTS(SELECT * FROM alumnosincorporados) THEN
		SET idAlInc = (SELECT idAlumnosIncorporados FROM alumnosincorporados ORDER BY idAlumnosIncorporados DESC LIMIT 1);
		SET pId = idAlInc + 1;
	ELSE
		SET pId = 1;
	END IF;
	
	IF(pIdSolicitudApoyo != 0)THEN
		SET idEnt = (SELECT idEntregables FROM entregables WHERE idSolicitudApoyo = pIdSolicitudApoyo);
		SET idCont = (SELECT idContribucion FROM contribucion WHERE idEntregables = idEnt);

		INSERT INTO alumnosincorporados
		VALUES (pId, pNombre, idCont);
		
		SET codRet = 0;
	END If;
    
    SELECT codRet;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spGuardarAlumnosResidentes` (`pIdSolicitudApoyo` INTEGER, `pNombre` VARCHAR(255))  BEGIN
	
	DECLARE codRet INTEGER;
	DECLARE idEnt INTEGER;
	DECLARE idCont INTEGER;
	
	DECLARE pId INTEGER;
	DECLARE idAlRes INTEGER;
	
	SET codRet = 1;
	
	IF EXISTS(SELECT * FROM alumnosresidentes) THEN
		SET idAlRes = (SELECT idAlumnosResidentes FROM alumnosresidentes ORDER BY idAlumnosResidentes DESC LIMIT 1);
		SET pId = idAlRes + 1;
	ELSE
		SET pId = 1;
	END IF;
	
	IF(pIdSolicitudApoyo != 0)THEN
		SET idEnt = (SELECT idEntregables FROM entregables WHERE idSolicitudApoyo = pIdSolicitudApoyo);
		SET idCont = (SELECT idContribucion FROM contribucion WHERE idEntregables = idEnt);

		INSERT INTO alumnosresidentes
		VALUES (pId, pNombre, idCont);
		
		SET codRet = 0;
	END IF;
    
    SELECT codRet;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spGuardarColaboradores` (`pIdSolicitudApoyo` INTEGER, `pNombre` VARCHAR(255), `pTiempoCompleto` BOOLEAN, `pCorreo` VARCHAR(45), `pPerfilPromep` BOOLEAN, `pNivelSNI` VARCHAR(45))  BEGIN
	
    DECLARE codRet INTEGER;
	DECLARE pId INTEGER;
	DECLARE idCol INTEGER;
	
	SET codRet = 1;
	
	IF EXISTS(SELECT * FROM colaboradores) THEN
		SET idCol = (SELECT idColaborador FROM colaboradores ORDER BY idColaborador DESC LIMIT 1);
		SET pId = idCol + 1;
	ELSE
		SET pId = 1;
	END IF;
	
	IF(pIdSolicitudApoyo != 0)THEN
		INSERT INTO colaboradores (idColaborador, idSolicitudApoyo, nombre, tiempoCompleto, correo, perfilPromep, nivelSNI)
		VALUES (pId, pIdSolicitudApoyo, pNombre, pTiempoCompleto, pCorreo, pPerfilPromep, pNivelSNI);
		
		SET codRet = 0;
	END IF;
    
    SELECT codRet;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spGuardarDescrpcionProyecto` (`pTitulo` VARCHAR(45), `pResumen` LONGTEXT, `pIntroduccion` LONGTEXT, `pAntecedentes` LONGTEXT, `pMarcoTeorico` LONGTEXT, `pMetas` LONGTEXT, `pImpactoBeneficio` LONGTEXT, `pMetodologia` LONGTEXT, `pProductosEntregables` MEDIUMTEXT, `pIdInvestigador` INTEGER, `pIdProtocoloInvestigacion` INTEGER, `pIdCampus` INTEGER)  BEGIN
	
	DECLARE codRet INTEGER;
    DECLARE pId INTEGER;
	
	SET codRet = 1;
	
	IF(pIdCampus <= 0)THEN
		SET pIdCampus = NULL;
	END IF;
	
	IF(pIdProtocoloInvestigacion = 0)THEN
		SET pId = (SELECT idSolicitudApoyo FROM solicitudapoyo ORDER BY idSolicitudApoyo DESC LIMIT 1) + 1;
		INSERT INTO solicitudapoyo(idSolicitudApoyo, tituloProyecto, idInvestigador) VALUES (pId, pTitulo, pIdInvestigador);
		SET pIdProtocoloInvestigacion = pId;
	END IF;
    
	IF NOT EXISTS(SELECT * FROM descripcionproyecto WHERE idProtocoloInvestigacion = pIdProtocoloInvestigacion) THEN
		INSERT INTO descripcionproyecto(resumen, introduccion, antecedentes, marcoTeorico, metas, impactoBeneficio, metodologia, productosEntregables, idProtocoloInvestigacion, idCampus)
		VALUES (pResumen, pIntroduccion, pAntecedentes, pMarcoTeorico, pMetas, pImpactoBeneficio, pMetodologia, pProductosEntregables, pIdProtocoloInvestigacion, pIdCampus);
		
		SET codRet = 0;
	ELSE
		UPDATE solicitudapoyo
		SET tituloProyecto = pTitulo, idInvestigador = pIdInvestigador
		WHERE idSolicitudApoyo = pIdProtocoloInvestigacion;
	
		UPDATE descripcionproyecto
		SET resumen = pResumen, introduccion = pIntroduccion, antecedentes = pAntecedentes, marcoTeorico = pMarcoTeorico,
			metas = pMetas, impactoBeneficio = pImpactoBeneficio, metodologia = pMetodologia, productosEntregables = pProductosEntregables, idCampus = pIdCampus
		WHERE idProtocoloInvestigacion = pIdProtocoloInvestigacion;
		
		SET codRet = 0;
	END IF;
    
	SET pId = pIdProtocoloInvestigacion;
    SELECT pId AS id, codRet;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spGuardarDocumentosProyecto` (`pIdProtocoloInvestigacion` INTEGER, `pRuta` VARCHAR(255), `pNombre` VARCHAR(255))  BEGIN
	
	DECLARE codRet INTEGER;
	
	DECLARE pId INTEGER;
	DECLARE idDoc INTEGER;
	
	SET codRet = 1;
	
	IF EXISTS(SELECT * FROM documentosproyecto) THEN
		SET idDoc = (SELECT idDocumentosProyecto FROM documentosproyecto ORDER BY idDocumentosProyecto DESC LIMIT 1);
		SET pId = idDoc + 1;
	ELSE
		SET pId = 1;
	END IF;
	
	IF(pIdProtocoloInvestigacion != 0)THEN
		INSERT INTO documentosproyecto
		VALUES (pId, pRuta, pNombre, pIdProtocoloInvestigacion);
		
		SET codRet = 0;
	END If;
    
    SELECT codRet;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spGuardarEntregables` (`pIdSolicitudApoyo` INTEGER, `pLicenciatura` VARCHAR(255), `pMaestria` VARCHAR(255), `pDoctorado` VARCHAR(255), `pArtRevistaIndizadas` VARCHAR(255), `pArtRevistaArbitrada` VARCHAR(255), `pArtDivulgacion` VARCHAR(255), `pMemoriaCongreso` VARCHAR(255), `pCapLibroRevision` VARCHAR(255), `pLibroRevision` VARCHAR(255), `pLibroPublicado` VARCHAR(255), `pPrototipoRegistro` VARCHAR(255), `pPatenteRegistro` VARCHAR(255), `pPaqueteRegistro` VARCHAR(255), `pOtros` VARCHAR(255), `pBeneficios` VARCHAR(255))  BEGIN

	DECLARE codRet INTEGER;
	DECLARE pId INTEGER;
	DECLARE idEnt INTEGER;
	
	SET codRet = 1;
	
	If(pIdSolicitudApoyo != 0)THEN
		IF NOT EXISTS(SELECT * FROM entregables WHERE idSolicitudApoyo = pIdSolicitudApoyo) THEN
			IF EXISTS(SELECT * FROM entregables) THEN
				SET idEnt = (SELECT idEntregables FROM entregables ORDER BY idEntregables DESC LIMIT 1);
				SET pId = idEnt + 1;
			ELSE
				SET pId = 1;
			END IF;
			
			INSERT INTO entregables(idEntregables, idSolicitudApoyo)
			VALUES(pId, pIdSolicitudApoyo);
			
			INSERT INTO contribucion (licenciatura, maestria, doctorado, idEntregables)
			VALUES(pLicenciatura, pMaestria, pDoctorado, pId);
			
			INSERT INTO prodacademica(artRevistaIndizadas, artRevistArbitrada, artDivulgacion, memoriaCongreso, capLibroRevision,
										libroRevision, libroPublicado, prototipoRegistro, patenteRegistro, pqtRegistro, otros, idEntregables, beneficios)
			VALUES(pArtRevistaIndizadas, pArtRevistaArbitrada, pArtDivulgacion, pMemoriaCongreso, pCapLibroRevision,
				pLibroRevision,	pLibroPublicado, pPrototipoRegistro, pPatenteRegistro, pPaqueteRegistro, pOtros,
				pId, pBeneficios);
				
			SET codRet = 0;
		ELSE
			SET pId = (SELECT idEntregables FROM entregables WHERE idSolicitudApoyo = pIdSolicitudApoyo);
			
			UPDATE contribucion
			SET licenciatura = pLicenciatura, maestria = pMaestria, doctorado = pDoctorado
			WHERE idEntregables = pId;
			
			UPDATE prodacademica
			SET artRevistaIndizadas = pArtRevistaIndizadas, artRevistArbitrada = pArtRevistaArbitrada, artDivulgacion = pArtDivulgacion,
				memoriaCongreso = pMemoriaCongreso, capLibroRevision = pCapLibroRevision, libroRevision = pLibroRevision,
				libroPublicado = pLibroPublicado, prototipoRegistro = pPrototipoRegistro, patenteRegistro = pPatenteRegistro,
				pqtRegistro = pPaqueteRegistro, otros = pOtros, beneficios = pBeneficios
			WHERE idEntregables = pId;
			
			SET codRet = 0;
		END IF;
	END IF;
	
	SELECT codRet;
	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spGuardarFinanciamiento` (`pRequiereFinanciamiento` BOOLEAN, `pFuente` VARCHAR(255), `pIdSolicitudApoyo` INTEGER)  BEGIN
	
    DECLARE codRet INTEGER;
	
	SET codRet = 1;
	
	If(pRequiereFinanciamiento = true)THEN
		SET pRequiereFinanciamiento = 1;
	ELSE
		SET pRequiereFinanciamiento = 0;
	END IF;
    
	IF(pIdSolicitudApoyo != 0)THEN
		IF NOT EXISTS(SELECT * FROM financiamiento WHERE idSolicitudApoyo = pIdSolicitudApoyo) THEN		
			INSERT INTO financiamiento(requiereFinanciamiento, fuenteFinanciamiento, idSolicitudApoyo)
			VALUES (pRequiereFinanciamiento, pFuente, pIdSolicitudApoyo);
			
			SET codRet = 0;
		ELSE
			UPDATE financiamiento
			SET requiereFinanciamiento = pRequiereFinanciamiento, fuenteFinanciamiento = pFuente 
			WHERE idSolicitudApoyo = pIdSolicitudApoyo;
			
			SET codRet = 0;
		END IF;
	END IF;
    
    SELECT codret;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spGuardarGestionAcademica` (`pFuncion` VARCHAR(255), `pDescripcion` VARCHAR(255), `pProductoEsperado` VARCHAR(255), `pTotalHorasSemana` INTEGER, `pIdPlanTrabajo` INTEGER)  BEGIN
    DECLARE codRet INTEGER;
	
	SET codRet = 0;
	
	INSERT INTO actividadesdirecciontesis
	VALUES (pFuncion, pDescripcion, pProductoEsperado, pTotalHorasSemana, pIdPlanTrabajo);
	
	SET codRet = 1;
    
    SELECT codRet;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spGuardarInfraestructura` (`pDescripcion` VARCHAR(500), `pIdProtocoloInvestigacion` INTEGER)  BEGIN
	
	DECLARE codRet INTEGER;
	
	SET codRet = 1;
		
	IF(pIdProtocoloInvestigacion != 0)THEN
		IF NOT EXISTS(SELECT * FROM infraestructura WHERE idProtocoloInvestigacion = pIdProtocoloInvestigacion) THEN		
			INSERT INTO infraestructura(descripcion, idProtocoloInvestigacion)
			VALUES (pDescripcion, pIdProtocoloInvestigacion);
			
			SET codRet = 0;
		ELSE
			UPDATE infraestructura
			SET descripcion = pDescripcion
			WHERE idProtocoloInvestigacion = pIdProtocoloInvestigacion;
			
			SET codRet = 0;
		END IF;
	END IF;
    
    SELECT codRet;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spGuardarLugarDesarrollo` (`pIdProtocoloInvestigacion` INTEGER, `pNombreSeccion` VARCHAR(255), `pDireccionExacta` VARCHAR(255), `pRequierePruebasCampo` BOOLEAN, `pEstado` VARCHAR(255), `pRegion` VARCHAR(255), `pZona` VARCHAR(255), `pMunicipio` VARCHAR(255), `pDistanciaKM` DECIMAL(50,2))  BEGIN
	
	DECLARE codRet INTEGER;

	SET codRet = 1;
	
	IF(pIdProtocoloInvestigacion != 0)THEN
		IF NOT EXISTS(SELECT * FROM lugardesarrollo WHERE idProtocoloInstigacion = pIdProtocoloInvestigacion) THEN
			INSERT INTO lugardesarrollo(idProtocoloInstigacion, nombreSeccion, diereccionExacta, requierePruebasCampo, estado, region, zona, municipio, distanciaKM)
			VALUES (pIdProtocoloInvestigacion, pNombreSeccion, pDireccionExacta, pRequierePruebasCampo, pEstado, pRegion, pZona, pMunicipio, pDistanciaKM);
			
			SET codRet = 0;
		ELSE		
			UPDATE lugardesarrollo
			SET nombreSeccion = pNombreSeccion, diereccionExacta = pDireccionExacta, requierePruebasCampo = pRequierePruebasCampo, 
				estado = pEstado, region = pRegion, zona = pZona, municipio = pMunicipio, distanciaKM = pDistanciaKM
			WHERE idProtocoloInstigacion = pIdProtocoloInvestigacion;
			
			SET codRet = 0;
		END IF;
	ELSE
		SET codRet = 1;
	END If;
    
    SELECT codRet;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spGuardarObjetivoEspecifico` (`pObjEsp` TEXT, `pIdSolicitudApoyo` INTEGER)  BEGIN
	
    DECLARE codRet INTEGER;
	
	SET codRet = 1;
    
	IF(pIdSolicitudApoyo != 0)THEN
		IF NOT EXISTS(SELECT * FROM objetivosespecificos WHERE idSolicitudApoyo = pIdSolicitudApoyo) THEN
			INSERT INTO objetivosespecificos(descripcion, idSolicitudApoyo)
			VALUES (pObjEsp, pIdSolicitudApoyo);
				
			SET codRet = 0;
		ELSE
			UPDATE objetivosespecificos
			SET descripcion = pObjEsp
			WHERE idSolicitudApoyo = pIdSolicitudApoyo;
			
			SET codRet = 0;
		END IF;
	END If;
    
    SELECT codRet;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spGuardarObjetivoGeneral` (`pObjGral` TEXT, `pIdSolicitudApoyo` INTEGER)  BEGIN
	DECLARE codRet INTEGER;
    DECLARE pId INTEGER;
    DECLARE idOG INTEGER;
	
	SET codRet = 1;
		
	IF(pIdSolicitudApoyo != 0)THEN
		IF NOT EXISTS(SELECT * FROM objetivogeneral WHERE idSolicituApoyo = pIdSolicitudApoyo) THEN
			INSERT INTO objetivogeneral(descripcion, idSolicituApoyo)
			VALUES (pObjGral, pIdSolicitudApoyo);
			
			SET codRet = 0;
		ELSE
			UPDATE objetivogeneral
			SET descripcion = pObjGral
			WHERE idSolicituApoyo = pIdSolicitudApoyo;
			
			SET codRet = 0;
		END IF;
	END IF;
    
    SELECT codRet;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spGuardarPresupuesto` (`pIdSolicitudApoyo` INTEGER, `pMontoSolicitadoMateriales` DECIMAL(50,2), `pMontoOtorgadoTecMateriales` DECIMAL(50,2), `pMontoOtorgadoInstitucionesMateriales` DECIMAL(50,2), `pTotalMateriales` DECIMAL(50,2), `pMontoSolicitadoServicios` DECIMAL(50,2), `pMontoOtorgadoTecServicios` DECIMAL(50,2), `pMontoOtorgadoInstitucionesServicios` DECIMAL(50,2), `pTotalServicios` DECIMAL(50,2), `pTotalMontoSolicitado` DECIMAL(50,2), `pTotalMontoOtorgadoTec` DECIMAL(50,2), `pTotalMontoOtorgadoInstituciones` DECIMAL(50,2), `pTotal` DECIMAL(50,2))  BEGIN
	
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `spGuardarReferencias` (`pReferencia` VARCHAR(500), `pEstadoCampoArte` VARCHAR(500), `pPlanteamiento` VARCHAR(500), `pDesarrolloProyecto` VARCHAR(500), `pIdProtocoloInvestigacion` INTEGER)  BEGIN
	
	DECLARE codRet INTEGER;

	SET codRet = 1;
	
	IF(pIdProtocoloInvestigacion != 0)THEN
		IF NOT EXISTS(SELECT * FROM referencias WHERE idProtocoloInvestigacion = pIdProtocoloInvestigacion) THEN
			INSERT INTO referencias(referencia, estadoCampoArte, planteamiento, desarrolloProyecto, idProtocoloInvestigacion)
			VALUES (pReferencia, pEstadoCampoArte, pPlanteamiento, pDesarrolloProyecto, pIdProtocoloInvestigacion);
			
			SET codRet = 0;
		ELSE		
			UPDATE referencias
			SET referencia = pReferencia, estadoCampoArte = pEstadoCampoArte, planteamiento = pPlanteamiento, desarrolloProyecto = pDesarrolloProyecto
			WHERE idProtocoloInvestigacion = pIdProtocoloInvestigacion;
			
			SET codRet = 0;
		END IF;
	ELSE
		SET codRet = 1;
	END IF;
    
    SELECT codRet;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spGuardarSolicitudApoyo` (`pIdSolicitudApoyo` INTEGER, `pTitulo` VARCHAR(255), `pDescripcion` VARCHAR(255), `pIdtipoInvestigacion` INTEGER, `pOrientacion` VARCHAR(45), `pIdPrograma` INTEGER, `pIdLinea` INTEGER, `pFechaInicio` DATE, `pDuracion` INTEGER, `pHorasRequeridas` INTEGER, `pResponsable` VARCHAR(45), `pIdProgramaInv` INTEGER, `pIdLineaInv` INTEGER, `pIdProgramaCuerpo` INTEGER, `pIdLineaCuerpo` INTEGER, `pCorreoResponsable` VARCHAR(45), `pSubOrientacion` VARCHAR(45), `pIdInvestigador` INTEGER, `pIdCuerpoAcademico` INTEGER, `pSniInv` INTEGER, `pPromepInv` INTEGER, `pIdInstitucion` INTEGER, `pSNI` BOOLEAN, `pNumeroRegistroSNI` INTEGER, `pVigenciaNombramiento` INTEGER, `pOrientacionCuerpo` INTEGER)  BEGIN

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

CREATE DEFINER=`root`@`localhost` PROCEDURE `spGuardarVinculacion` (`pNombreEmpresa` VARCHAR(45), `pTipoCooperacion` VARCHAR(45), `pResponsabilidad` MEDIUMTEXT, `pUsuariosPotenciales` MEDIUMTEXT, `pIdProtocoloInvestigacion` INTEGER)  BEGIN
	
	DECLARE codRet INTEGER;
	
	SET codRet = 1;
    
	IF(pIdProtocoloInvestigacion != 0)THEN
		IF NOT EXISTS(SELECT * FROM vinculacion WHERE idProtocoloInvestigacion = pIdProtocoloInvestigacion) THEN		
			INSERT INTO vinculacion(nombreEmpresa, tipoCooperacion, responsabilidad, usuariosPotenciables, idProtocoloInvestigacion)
			VALUES (pNombreEmpresa, pTipoCooperacion, pResponsabilidad, pUsuariosPotenciales, pIdProtocoloInvestigacion);
			
			SET codRet = 0;
		ELSE
			UPDATE vinculacion
			SET nombreEmpresa = pNombreEmpresa, tipoCooperacion = pTipoCooperacion, responsabilidad = pResponsabilidad, usuariosPotenciables = pUsuariosPotenciales
			WHERE idProtocoloInvestigacion = pIdProtocoloInvestigacion;
			
			SET codRet = 0;
		END IF;
	END IF;
    
    SELECT codRet;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spInicializarProtocoloInvestigacion` (`pId` BOOLEAN, `pTitulo` VARCHAR(255), `pIdInvestigador` INTEGER)  BEGIN
	
	CALL spGuardarDescrpcionProyecto(pTitulo, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, pIdInvestigador, pId, NULL);
	CALL spGuardarInfraestructura(NULL, pId);
	CALL spGuardarLugarDesarrollo(pId, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
	CALL spGuardarReferencias(NULL, NULL, NULL, NULL, pId);
	CALL spGuardarVinculacion(NULL, NULL, NULL, NULL, pId);
	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spInicializarSolicitudApoyo` (`pId` BOOLEAN, `pTitulo` VARCHAR(255), `pIdInvestigador` INTEGER)  BEGIN
	
	CALL spGuardarSolicitudApoyo(pId, pTitulo, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, pIdInvestigador, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
	CALL spGuardarEntregables(pId, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
	CALL spGuardarFinanciamiento(NULL, NULL, pId);
	CALL spGuardarPresupuesto(pId, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerLineas` (`pIdPrograma` INTEGER)  BEGIN
	
   select l.idLinea as id, l.nombre as nombre, l.descripcion as descripcion from programlineas pl
	inner join lineas l on pl.idLinea = l.idLinea
    where pl.idPrograma = pIdPrograma;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerLineasCuerpoAcademico` (`pIdPrograma` INTEGER)  BEGIN
	
   select l.idLineasCuerpoAcademico as id, l.nombre as nombre, l.descripcion as descripcion from programalineacuerpoacademico pl
	inner join lineascuerpoacademico l on pl.idLineaCuerpoAcademico = l.idLineasCuerpoAcademico
    where pl.idProgramaCuerpoAcademico = pIdPrograma;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerLineasInvConsolidar` (`pIdPrograma` INTEGER)  BEGIN
	
   select l.idLineasInvConsolidar as id, l.nombre as nombre, l.descripcion as descripcion from programalineainvconsolidar pl
	inner join lineasinvconsolidar l on pl.idLineaInvConsolidar = l.idLineasInvConsolidar
    where pl.idProgramaInvConsolidar = pIdPrograma;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerProyectosDeConvocatoria` (`pIdConvocatoria` INTEGER)  BEGIN
	
    SELECT SA.idSolicitudApoyo, SA.tituloProyecto FROM ligaconvocatoriaproyecto LCP
	INNER JOIN solicitudapoyo SA ON LCP.idSolicitudApoyo = SA.idSolicitudApoyo
    WHERE LCP.idConvocatoria = pIdConvocatoria;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerUsuarioResponsable` (`idUsuario` INTEGER)  BEGIN
	
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `idActividades` int(11) NOT NULL,
  `nombreResponsable` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `periodo` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `resultados` mediumtext COLLATE utf8_bin,
  `partidaSolicitadas` float DEFAULT NULL,
  `montoSolicitado` float DEFAULT NULL,
  `descripcionBienes` mediumtext COLLATE utf8_bin,
  `idSolicitudApoyo` int(11) NOT NULL,
  `Actividad` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`idActividades`, `nombreResponsable`, `periodo`, `resultados`, `partidaSolicitadas`, `montoSolicitado`, `descripcionBienes`, `idSolicitudApoyo`, `Actividad`) VALUES
(1, 'fgh', '123', 'sdfg', 0, 99, '1234', 33, 'sdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividadesdirecciontesis`
--

CREATE TABLE `actividadesdirecciontesis` (
  `idActividadesDireccionTesis` int(11) NOT NULL,
  `nombreEstudiante` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `nombreTesis` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `nivelLicenciatura` tinyint(1) DEFAULT NULL,
  `nivelMaestria` tinyint(1) DEFAULT NULL,
  `fechaTermino` date DEFAULT NULL,
  `totalHorasSemana` int(11) DEFAULT NULL,
  `idPlanDeTrabajo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividadesdocencia`
--

CREATE TABLE `actividadesdocencia` (
  `idActividadesDocencia` int(11) NOT NULL,
  `nombreAsigantura` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `noEstudiantes` int(11) DEFAULT NULL,
  `nivelLicenciatura` tinyint(1) DEFAULT NULL,
  `nivelMaestria` tinyint(1) DEFAULT NULL,
  `horasTeorica` tinyint(1) DEFAULT NULL,
  `HorasTeoricaPractica` tinyint(1) DEFAULT NULL,
  `horasPractica` tinyint(1) DEFAULT NULL,
  `totalHorasSemana` int(11) DEFAULT NULL,
  `idPlanDeTrabajo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `actividadesdocencia`
--

INSERT INTO `actividadesdocencia` (`idActividadesDocencia`, `nombreAsigantura`, `noEstudiantes`, `nivelLicenciatura`, `nivelMaestria`, `horasTeorica`, `HorasTeoricaPractica`, `horasPractica`, `totalHorasSemana`, `idPlanDeTrabajo`) VALUES
(1, 'dfghj', 4, 1, 0, 127, 127, 127, 444, 33);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividadesgestionacademica`
--

CREATE TABLE `actividadesgestionacademica` (
  `idActividadesGestionAcademica` int(11) NOT NULL,
  `funcion` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `productoEsperado` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `totalHorasSemana` int(11) DEFAULT NULL,
  `idPlanDeTrabajo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividadesinvestigacion`
--

CREATE TABLE `actividadesinvestigacion` (
  `idActividadesInvestigacion` int(11) NOT NULL,
  `nombreProyecto` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `funcionEnProyecto` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `productosEsperados` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `totalHorasSemana` int(11) DEFAULT NULL,
  `idPlanDeTrabajo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `actividadesinvestigacion`
--

INSERT INTO `actividadesinvestigacion` (`idActividadesInvestigacion`, `nombreProyecto`, `funcionEnProyecto`, `productosEsperados`, `totalHorasSemana`, `idPlanDeTrabajo`) VALUES
(1, 'lkjhgfytr', 'ytruytgf', 'hgfhgf', 76543, 33);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividadestutoria`
--

CREATE TABLE `actividadestutoria` (
  `idActividadesTutoria` int(11) NOT NULL,
  `nombreEstudiante` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `tipoTutoria` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `nivelLicenciatura` tinyint(1) DEFAULT NULL,
  `nivelMaestria` tinyint(1) DEFAULT NULL,
  `horasTeorica` tinyint(1) DEFAULT NULL,
  `HorasTeoricaPractica` tinyint(1) DEFAULT NULL,
  `horasPractica` tinyint(1) DEFAULT NULL,
  `totalHorasSemana` int(11) DEFAULT NULL,
  `idPlanDeTrabajo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actualanterior`
--

CREATE TABLE `actualanterior` (
  `idActualAnterior` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `actualanterior`
--

INSERT INTO `actualanterior` (`idActualAnterior`, `nombre`) VALUES
(1, 'García Zarate Carlos Fernando');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnosincorporados`
--

CREATE TABLE `alumnosincorporados` (
  `idAlumnosIncorporados` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `idContribucion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `alumnosincorporados`
--

INSERT INTO `alumnosincorporados` (`idAlumnosIncorporados`, `nombre`, `idContribucion`) VALUES
(1, 'ghgfhgf', 20),
(2, 'fghgfhg', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnosresidentes`
--

CREATE TABLE `alumnosresidentes` (
  `idAlumnosResidentes` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `idContribucion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `alumnosresidentes`
--

INSERT INTO `alumnosresidentes` (`idAlumnosResidentes`, `nombre`, `idContribucion`) VALUES
(1, 'gfhgfhgf', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE `area` (
  `idArea` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areadiciplinas`
--

CREATE TABLE `areadiciplinas` (
  `idAreaDiciplina` int(11) NOT NULL,
  `idArea` int(11) NOT NULL,
  `idDiciplinaSub` int(11) NOT NULL,
  `idCampus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areadisciplinas`
--

CREATE TABLE `areadisciplinas` (
  `idAreaDisciplina` int(11) NOT NULL,
  `idArea` int(11) NOT NULL,
  `idDisciplinaSub` int(11) NOT NULL,
  `idCampus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asociaciones`
--

CREATE TABLE `asociaciones` (
  `idAsociaciones` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `periodo` date DEFAULT NULL,
  `idTipoMembresia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autorpatente`
--

CREATE TABLE `autorpatente` (
  `idAutorPatente` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autortecnico`
--

CREATE TABLE `autortecnico` (
  `idAutorTecnico` int(11) NOT NULL,
  `idTecnicoAutor` int(10) NOT NULL,
  `idReportesTecnicos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campo`
--

CREATE TABLE `campo` (
  `idCampo` int(11) NOT NULL,
  `nombreCampo` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campus`
--

CREATE TABLE `campus` (
  `idCampus` int(11) NOT NULL,
  `nombreCampus` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `idInstituciones` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `campus`
--

INSERT INTO `campus` (`idCampus`, `nombreCampus`, `idInstituciones`) VALUES
(1, 'Zapopan', 1),
(2, 'Zapotlanejo', 1),
(3, 'Tequila', 1),
(4, 'Tala', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campusdepartamento`
--

CREATE TABLE `campusdepartamento` (
  `idCampusDepartamento` int(11) NOT NULL,
  `idCampus` int(11) NOT NULL,
  `idDepartamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capitulospublicados`
--

CREATE TABLE `capitulospublicados` (
  `idCapitulosPublicados` int(11) NOT NULL,
  `tituloLibro` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `editorial` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `numeroEdicion` int(11) DEFAULT NULL,
  `yearEdicion` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `tituloCapitulo` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `noCapitulo` int(11) DEFAULT NULL,
  `paginaInicio` int(11) DEFAULT NULL,
  `paginaFin` int(11) DEFAULT NULL,
  `resumen` longtext COLLATE utf8_bin,
  `idAreaDisciplina` int(11) NOT NULL,
  `Apoyo` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `fondo` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `claseocde`
--

CREATE TABLE `claseocde` (
  `idClaseOcde` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasescian`
--

CREATE TABLE `clasescian` (
  `idClaseScian` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colaboradores`
--

CREATE TABLE `colaboradores` (
  `idColaborador` int(11) NOT NULL,
  `idSolicitudApoyo` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `tiempoCompleto` tinyint(4) DEFAULT NULL,
  `correo` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `perfilPromep` tinyint(4) DEFAULT NULL,
  `nivelSNI` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `colaboradores`
--

INSERT INTO `colaboradores` (`idColaborador`, `idSolicitudApoyo`, `nombre`, `tiempoCompleto`, `correo`, `perfilPromep`, `nivelSNI`) VALUES
(1, 33, '1231232', 1, 'hf@hgjg.com', 0, '12323'),
(2, 33, 'aaaaa', 0, 'hf@hgjg.com', 1, '9999');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colaboradoresactividades`
--

CREATE TABLE `colaboradoresactividades` (
  `idColaboradoresActividades` int(11) NOT NULL,
  `idActividades` int(11) NOT NULL,
  `idColaboradores` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colaboradorescongreso`
--

CREATE TABLE `colaboradorescongreso` (
  `idColaboradoresCongreso` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `apellidoPaterno` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `apellidoMaterno` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `sexo` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `idNivelEstudio` int(11) NOT NULL,
  `nacionalidad` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `institucion` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `idAreaDisciplina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colaboradoresgrupoinvestigacion`
--

CREATE TABLE `colaboradoresgrupoinvestigacion` (
  `idColaboradoresgrupoinvestigacion` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `apellidoPaterno` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `apellidoMaterno` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `sexo` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `idNivelEstudio` int(11) DEFAULT NULL,
  `nacionalidad` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colaboradoresredes`
--

CREATE TABLE `colaboradoresredes` (
  `idColaboradoresRedes` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colaboratoresinvestigacion`
--

CREATE TABLE `colaboratoresinvestigacion` (
  `idColaboratoresInvestigacion` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `apellidoPaterno` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `apellidoMaterno` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `sexo` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `nacionalidad` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `institucion` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `idNivelEstudio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colaboratoresproyectos`
--

CREATE TABLE `colaboratoresproyectos` (
  `idColaboratoresProyectos` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `apellidoPaterno` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `apellidoMaterno` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `sexo` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `nacionalidad` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `institucion` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `idNivelEstudio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `idContacto` int(11) NOT NULL,
  `datos` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `idTipoContacto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contribucion`
--

CREATE TABLE `contribucion` (
  `idContribucion` int(11) NOT NULL,
  `licenciatura` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `maestria` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `doctorado` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `idEntregables` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `contribucion`
--

INSERT INTO `contribucion` (`idContribucion`, `licenciatura`, `maestria`, `doctorado`, `idEntregables`) VALUES
(20, NULL, NULL, NULL, 7),
(24, NULL, NULL, NULL, 8),
(25, '', '', '', 9),
(27, '', '', '', 10),
(28, '', '', '', 11),
(29, NULL, NULL, NULL, 12),
(30, NULL, NULL, NULL, 13),
(32, NULL, NULL, NULL, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `convocatorias`
--

CREATE TABLE `convocatorias` (
  `idConvocatoria` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` longtext NOT NULL,
  `link` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `convocatorias`
--

INSERT INTO `convocatorias` (`idConvocatoria`, `nombre`, `descripcion`, `link`) VALUES
(1, 'aaa', 'aaa', ''),
(2, 'asd', 'asd', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuerpoacademico`
--

CREATE TABLE `cuerpoacademico` (
  `idcuerpoAcademico` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `clave` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `gradoConsolidacion` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `cuerpoacademico`
--

INSERT INTO `cuerpoacademico` (`idcuerpoAcademico`, `nombre`, `clave`, `gradoConsolidacion`) VALUES
(1, 'cuerpo academico', '001', '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curriculumca`
--

CREATE TABLE `curriculumca` (
  `idCurriculumCa` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursoimpartido`
--

CREATE TABLE `cursoimpartido` (
  `idCursoImpartido` int(11) NOT NULL,
  `institucion` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `nombrePrograma` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `nombreCurso` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `horasTotal` int(11) DEFAULT NULL,
  `fechaInicio` date DEFAULT NULL,
  `fecchaFin` date DEFAULT NULL,
  `idAreaDisciplina` int(11) NOT NULL,
  `idTipoProgramaPnpc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cvu`
--

CREATE TABLE `cvu` (
  `idCvu` int(11) NOT NULL,
  `idCampusDepartamento` int(11) NOT NULL,
  `idUsuarios` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cvuasociones`
--

CREATE TABLE `cvuasociones` (
  `idCvuAsociaciones` int(11) NOT NULL,
  `idAsociaciones` int(11) NOT NULL,
  `idCvu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cvucapitulospublicados`
--

CREATE TABLE `cvucapitulospublicados` (
  `idCvuCapitulosPublicados` int(11) NOT NULL,
  `idCapitulosPublicados` int(11) NOT NULL,
  `idCvu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cvuconacyt`
--

CREATE TABLE `cvuconacyt` (
  `idCvuConacyt` int(11) NOT NULL,
  `idEvaluacionConacyt` int(11) NOT NULL,
  `idCvu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cvucuerpoacademico`
--

CREATE TABLE `cvucuerpoacademico` (
  `idCvuCuerpoAcademico` int(11) NOT NULL,
  `idCuerpoAcademico` int(11) NOT NULL,
  `idCvu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cvucursoimpartido`
--

CREATE TABLE `cvucursoimpartido` (
  `idCvuCursoImpartido` int(11) NOT NULL,
  `idCursoImpartido` int(11) NOT NULL,
  `idCvu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cvudesarrollosoftware`
--

CREATE TABLE `cvudesarrollosoftware` (
  `idCvuDesarrolloSoftware` int(11) NOT NULL,
  `idDesarrolloSoftware` int(11) NOT NULL,
  `idCvu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cvudesarrollostecnologicos`
--

CREATE TABLE `cvudesarrollostecnologicos` (
  `idCvuDesarrollosTecnologicos` int(11) NOT NULL,
  `idCvu` int(11) NOT NULL,
  `idDesarrollosTecnologicos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cvudiplomasimpartidos`
--

CREATE TABLE `cvudiplomasimpartidos` (
  `idCvuDiplomasImpartidos` int(11) NOT NULL,
  `idDiplomasImpartidos` int(11) NOT NULL,
  `idCvu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cvudocenciaactual`
--

CREATE TABLE `cvudocenciaactual` (
  `idCvuDocenciaActual` int(11) NOT NULL,
  `idDocenciaActualMaterias` int(11) NOT NULL,
  `idCvu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cvudocente`
--

CREATE TABLE `cvudocente` (
  `idCvuDocente` int(11) NOT NULL,
  `idExperienciaDocente` int(11) NOT NULL,
  `idCvu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cvudocumentostrabajo`
--

CREATE TABLE `cvudocumentostrabajo` (
  `idCvuDocumentosTrabajo` int(11) NOT NULL,
  `idDocumentosTrabajo` int(11) NOT NULL,
  `idCvu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cvuestudiorealizados`
--

CREATE TABLE `cvuestudiorealizados` (
  `idCvuEstudioRealizados` int(11) NOT NULL,
  `idCvu` int(11) NOT NULL,
  `idEstudioRealizados` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cvuexperiencia`
--

CREATE TABLE `cvuexperiencia` (
  `idCvuExperiencia` int(11) NOT NULL,
  `idExperienciaProfesional` int(11) NOT NULL,
  `idCvu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cvugestionacademica`
--

CREATE TABLE `cvugestionacademica` (
  `idcvuGestion` int(11) NOT NULL,
  `idGestionAcademica` int(11) NOT NULL,
  `idCvu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cvugrupoinvestigacion`
--

CREATE TABLE `cvugrupoinvestigacion` (
  `idCvuInvestigacionGrupo` int(11) NOT NULL,
  `idCvu` int(11) NOT NULL,
  `idGrupoInvestigacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cvuinnovacion`
--

CREATE TABLE `cvuinnovacion` (
  `idCvuInnovacion` int(11) NOT NULL,
  `idInnovacion` int(11) NOT NULL,
  `idCvu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cvuinvestigacion`
--

CREATE TABLE `cvuinvestigacion` (
  `idCvuInvestigacion` int(11) NOT NULL,
  `idRedesInvestigacion` int(11) NOT NULL,
  `idCvu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cvulineas`
--

CREATE TABLE `cvulineas` (
  `idCvuLineas` int(11) NOT NULL,
  `idCvu` int(11) NOT NULL,
  `idLineaGeneracion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cvumemorias`
--

CREATE TABLE `cvumemorias` (
  `idCvuMemorias` int(11) NOT NULL,
  `idMemorias` int(11) NOT NULL,
  `idCvu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cvunoconacyt`
--

CREATE TABLE `cvunoconacyt` (
  `idCvuNoConacyt` int(11) NOT NULL,
  `idEvaluacionNoConacyt` int(11) NOT NULL,
  `idCvu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cvuotrosestudios`
--

CREATE TABLE `cvuotrosestudios` (
  `idCvuOtrosEstudios` int(11) NOT NULL,
  `idCvu` int(11) NOT NULL,
  `idOtrosEstudios` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cvuparticipacionactualizacionprogeducativo`
--

CREATE TABLE `cvuparticipacionactualizacionprogeducativo` (
  `idcvuPartiActProgEduc` int(11) NOT NULL,
  `idPartiActProgEduc` int(11) NOT NULL,
  `idCvu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cvuparticipacioncongreso`
--

CREATE TABLE `cvuparticipacioncongreso` (
  `idcvuPartiCongreso` int(11) NOT NULL,
  `idPartiCongreso` int(11) NOT NULL,
  `idCvu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cvuparticipacioneventos`
--

CREATE TABLE `cvuparticipacioneventos` (
  `idCvuPartiEvento` int(11) NOT NULL,
  `idCvu` int(11) NOT NULL,
  `idParticipacionEventos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cvupatentes`
--

CREATE TABLE `cvupatentes` (
  `idCvuPatentes` int(11) NOT NULL,
  `idPatentes` int(11) NOT NULL,
  `idCvu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cvuproduccionarticulos`
--

CREATE TABLE `cvuproduccionarticulos` (
  `idCvuArticulos` int(11) NOT NULL,
  `idCvu` int(11) NOT NULL,
  `idProduccionArticulos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cvuproyectos`
--

CREATE TABLE `cvuproyectos` (
  `idCvuProyectos` int(11) NOT NULL,
  `idProyectosInvestigacion` int(11) NOT NULL,
  `idCvu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cvupublicaciondivulgacion`
--

CREATE TABLE `cvupublicaciondivulgacion` (
  `idCvuPublicacionDivulgacion` int(11) NOT NULL,
  `idPublicacionDivulgacion` int(11) NOT NULL,
  `idCvu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cvureconocimientos`
--

CREATE TABLE `cvureconocimientos` (
  `idCvuReconocimientos` int(11) NOT NULL,
  `idReconocimientos` int(11) NOT NULL,
  `idCvu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cvutecnico`
--

CREATE TABLE `cvutecnico` (
  `idCvuTecnico` int(11) NOT NULL,
  `idReportesTecnicos` int(11) NOT NULL,
  `idCvu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cvutematicas`
--

CREATE TABLE `cvutematicas` (
  `idTematicasCvu` int(11) NOT NULL,
  `idRedesTematicas` int(11) NOT NULL,
  `idCvu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cvutesis`
--

CREATE TABLE `cvutesis` (
  `idCvuTesis` int(11) NOT NULL,
  `idCvu` int(11) NOT NULL,
  `idTesisDirigidas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cvututorias`
--

CREATE TABLE `cvututorias` (
  `idCvuTutorias` int(11) NOT NULL,
  `idTutorias` int(11) NOT NULL,
  `idCvu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datosgenerales`
--

CREATE TABLE `datosgenerales` (
  `idDatosGenerales` int(11) NOT NULL,
  `idContacto` int(11) NOT NULL,
  `rfc` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `sexo` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `paisNacimineto` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `idDomicinio` int(11) NOT NULL,
  `nacionalidad` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `entidadFederativa` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `numeroConacyt` int(11) DEFAULT NULL,
  `numeroPromep` int(11) DEFAULT NULL,
  `numeroTecmm` int(11) DEFAULT NULL,
  `idCvu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `idDepartamento` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `desarrollologros`
--

CREATE TABLE `desarrollologros` (
  `idDesarrolloLogros` int(11) NOT NULL,
  `idDesarrollosTecnologicos` int(11) NOT NULL,
  `idLogros` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `desarrollosoftware`
--

CREATE TABLE `desarrollosoftware` (
  `idDesarrolloSoftware` int(11) NOT NULL,
  `titulo` varchar(40) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `derechosAutor` varchar(30) NOT NULL,
  `pais` varchar(30) NOT NULL,
  `horas` int(11) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fecchaFin` date NOT NULL,
  `costo` int(11) NOT NULL,
  `beneficiario` int(11) NOT NULL,
  `objetivo` int(11) NOT NULL,
  `resumen` text NOT NULL,
  `logros` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `desarrollostecnologicos`
--

CREATE TABLE `desarrollostecnologicos` (
  `idDesarrollosTecnologicos` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `tipo` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `respaldo` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `objetivos` text COLLATE utf8_bin,
  `resumen` text COLLATE utf8_bin,
  `desarrollosApoyoConacyt` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `idSectorRama` int(11) NOT NULL,
  `idSectorOcde` int(11) NOT NULL,
  `idAreaDisciplina` int(11) NOT NULL,
  `valorImpacto` text COLLATE utf8_bin,
  `FormacionRecursos` text COLLATE utf8_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descripcionproyecto`
--

CREATE TABLE `descripcionproyecto` (
  `idDescripcionProyecto` int(11) NOT NULL,
  `resumen` longtext,
  `introduccion` longtext,
  `antecedentes` longtext,
  `marcoTeorico` longtext,
  `metas` longtext,
  `impactoBeneficio` longtext,
  `metodologia` longtext,
  `productosEntregables` longtext,
  `idProtocoloInvestigacion` int(11) NOT NULL,
  `idCampus` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `descripcionproyecto`
--

INSERT INTO `descripcionproyecto` (`idDescripcionProyecto`, `resumen`, `introduccion`, `antecedentes`, `marcoTeorico`, `metas`, `impactoBeneficio`, `metodologia`, `productosEntregables`, `idProtocoloInvestigacion`, `idCampus`) VALUES
(14, '', '', '', '', NULL, NULL, NULL, NULL, 33, 2),
(18, '', '', '', '', '', '', '', '', 34, 2),
(19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 35, NULL),
(21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 36, NULL),
(22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 37, NULL),
(23, '', '', '', '', '', '', '', '', 38, 2),
(24, '', '', '', '', '', '', '', '', 39, 2),
(26, NULL, NULL, NULL, NULL, '', '', '', '', 41, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diciplina`
--

CREATE TABLE `diciplina` (
  `idDiciplina` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diciplinasubdiciplina`
--

CREATE TABLE `diciplinasubdiciplina` (
  `idDiciplinaSub` int(11) NOT NULL,
  `idSubDiciplina` int(11) NOT NULL,
  `idDiciplina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diciplinasubdisciplina`
--

CREATE TABLE `diciplinasubdisciplina` (
  `idDisciplinaSub` int(11) NOT NULL,
  `idSubDisciplina` int(11) NOT NULL,
  `idDisciplina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dictamenconacyt`
--

CREATE TABLE `dictamenconacyt` (
  `idDictamenConacyt` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diplomasimpartidos`
--

CREATE TABLE `diplomasimpartidos` (
  `idDiplomasImpartidos` int(11) NOT NULL,
  `institucion` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `nombreCurso` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `horasTotal` int(11) DEFAULT NULL,
  `idAreaDisciplina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distincionesconacyt`
--

CREATE TABLE `distincionesconacyt` (
  `idDistincionesConacyt` int(11) NOT NULL,
  `NombreDistincion` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `year` varchar(20) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distincionesnoconacyt`
--

CREATE TABLE `distincionesnoconacyt` (
  `idDistincionesNoConacyt` int(11) NOT NULL,
  `NombreDistincion` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `institucion` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `year` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `pais` varchar(20) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `divicionocde`
--

CREATE TABLE `divicionocde` (
  `idDivicionOcde` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `divulgacionproductosobtenidos`
--

CREATE TABLE `divulgacionproductosobtenidos` (
  `idDivulgacionProductosObte` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `idPublicacionDivulgacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docenciaactualmaterias`
--

CREATE TABLE `docenciaactualmaterias` (
  `idDocenciaActualMaterias` int(11) NOT NULL,
  `materiasNombre` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `materiasInstituto` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `materiasProEducativo` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `fechaInicio` date DEFAULT NULL,
  `noAlumnos` int(11) DEFAULT NULL,
  `duracionSemanas` int(11) DEFAULT NULL,
  `horasMes` int(11) DEFAULT NULL,
  `horaSemana` int(11) DEFAULT NULL,
  `idNivelEstudio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `idDocumentos` int(11) NOT NULL,
  `idUsuarios` int(11) NOT NULL,
  `curpDocumentos` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `contratoVigente` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `certificado` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `maestria` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `licenciatura` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `cedula` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentosadjuntos`
--

CREATE TABLE `documentosadjuntos` (
  `idDocumentosAdjuntos` int(11) NOT NULL,
  `ruta` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentosproyecto`
--

CREATE TABLE `documentosproyecto` (
  `idDocumentosProyecto` int(11) NOT NULL,
  `ruta` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `idProtocoloInvestigacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `documentosproyecto`
--

INSERT INTO `documentosproyecto` (`idDocumentosProyecto`, `ruta`, `nombre`, `idProtocoloInvestigacion`) VALUES
(1, 'r4nh67kjXjbc2ZIfwtmSxfhN2RJGtV', 'Coetcyjal-Convocatoria Singularity Mexico Summit 2018 VF.pdf', 33),
(2, 'uL95wocoUpKNcTRgQJUkC0M35z4I6F', 'conacyt-Convocatoria para Jovenes Investigadores 2018.pdf', 33),
(3, 'aDDk8udnjPjLSd8wd1XO6zjaUVOnGo', 'tecnm-CONVOCATORIAINVESTIGACION.pdf', 33),
(4, 'd693LuPiuDyK1V5XjbrglkILaCmKxO', 'Guia TecNM-PRODEP 2017 (1).pdf', 34);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentostrabajo`
--

CREATE TABLE `documentostrabajo` (
  `idDocumentosTrabajo` int(11) NOT NULL,
  `titulo` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `PrimerApellido` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `segundoApellido` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `tituloPublicacion` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `pgInicio` int(11) DEFAULT NULL,
  `pgFin` int(11) DEFAULT NULL,
  `yearPublicacion` year(4) DEFAULT NULL,
  `pais` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `palabraClave1` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `palabraClave2` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `palabraClave3` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `domicinio`
--

CREATE TABLE `domicinio` (
  `idDomicinio` int(11) NOT NULL,
  `idPais` int(11) NOT NULL,
  `codigoPostal` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `estado` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `municiopODelegacion` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `localidad` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `tipoAsentamiento` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `nombreAsentamiento` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `carretera` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `nombreVialidad` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `idNumeroTipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entregables`
--

CREATE TABLE `entregables` (
  `idEntregables` int(11) NOT NULL,
  `idSolicitudApoyo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `entregables`
--

INSERT INTO `entregables` (`idEntregables`, `idSolicitudApoyo`) VALUES
(7, 33),
(8, 34),
(9, 35),
(10, 36),
(11, 37),
(12, 38),
(13, 39),
(15, 41);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadocivil`
--

CREATE TABLE `estadocivil` (
  `idEstadoCivil` int(11) NOT NULL,
  `nombre` varchar(20) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadotutorias`
--

CREATE TABLE `estadotutorias` (
  `idEstadoTutorias` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estanciasprofesionale`
--

CREATE TABLE `estanciasprofesionale` (
  `idEstanciasProfesionale` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `fechaInicio` date DEFAULT NULL,
  `FechaFin` date DEFAULT NULL,
  `logro` date DEFAULT NULL,
  `idAreaDisciplina` int(11) NOT NULL,
  `idTipoInstancia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiorealizados`
--

CREATE TABLE `estudiorealizados` (
  `idEstudioRealizados` int(11) NOT NULL,
  `idNivelEstudio` int(11) NOT NULL,
  `idTipoInstituto` int(11) NOT NULL,
  `instituto` varchar(45) COLLATE utf8_bin NOT NULL,
  `noCedula` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `siglasEstudios` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `fechaInicio` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  `fechaObtencion` date DEFAULT NULL,
  `periodo` date DEFAULT NULL,
  `idAreaDisciplina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etapadesarrollo`
--

CREATE TABLE `etapadesarrollo` (
  `idEtapaDesarrollo` int(11) NOT NULL,
  `idOpcionesEtapa` int(11) NOT NULL,
  `hora` int(11) NOT NULL,
  `fechaInicio` date NOT NULL,
  `FechaFin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etapadesarrollotecnologicos`
--

CREATE TABLE `etapadesarrollotecnologicos` (
  `idEtapaDesaTecnologico` int(11) NOT NULL,
  `idEtapaDesarrollo` int(11) NOT NULL,
  `idDesarrollosTecnologicos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacionconacyt`
--

CREATE TABLE `evaluacionconacyt` (
  `idEvaluacionConacyt` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `fechaAsignacion` date DEFAULT NULL,
  `fechaAceptacion` date DEFAULT NULL,
  `fechaEvaluacion` date DEFAULT NULL,
  `Descripcion` text COLLATE utf8_bin,
  `idDictamenConacyt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacionnoconacyt`
--

CREATE TABLE `evaluacionnoconacyt` (
  `idEvaluacionnoConacyt` int(11) NOT NULL,
  `institucion` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `fechaInicio` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  `cargo` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `idTipoEvaluacion` int(11) NOT NULL,
  `idProductoEvaluado` int(11) NOT NULL,
  `idDictamenConacyt` int(11) NOT NULL,
  `descripcion` text COLLATE utf8_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `experienciadocente`
--

CREATE TABLE `experienciadocente` (
  `idExperienciaDocente` int(11) NOT NULL,
  `periodo` date DEFAULT NULL,
  `nombreCurso.` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `idTipoNivel` int(11) NOT NULL,
  `duracionSemanas` int(11) DEFAULT NULL,
  `dependenciaEducacion` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `fechaInicio` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  `horasAsesoriasMes` int(11) DEFAULT NULL,
  `programaEducativo` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `numeroAlumnos` int(11) DEFAULT NULL,
  `horasSemanalesDedicadas` int(11) DEFAULT NULL,
  `experienciaInstitucion` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `experienciaprofesional`
--

CREATE TABLE `experienciaprofesional` (
  `idExperienciaProfesional` int(11) NOT NULL,
  `funcion` varchar(45) COLLATE utf8_bin NOT NULL,
  `periodo` date NOT NULL,
  `idActualAnterior` int(11) NOT NULL,
  `idEstanciasProfesionale` int(11) NOT NULL,
  `idPuesto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `feddes`
--

CREATE TABLE `feddes` (
  `idFedDes` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `descripcion` longtext COLLATE utf8_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `feddes`
--

INSERT INTO `feddes` (`idFedDes`, `nombre`, `descripcion`) VALUES
(1, 'Federal', 'Incorporada a federal'),
(2, 'Descentralizada', 'Incorporada a descentralizada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `financiamiento`
--

CREATE TABLE `financiamiento` (
  `idFinanciamiento` int(11) NOT NULL,
  `requiereFinanciamiento` tinyint(4) NOT NULL,
  `fuenteFinanciamiento` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `idSolicitudApoyo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `financiamiento`
--

INSERT INTO `financiamiento` (`idFinanciamiento`, `requiereFinanciamiento`, `fuenteFinanciamiento`, `idSolicitudApoyo`) VALUES
(18, 0, NULL, 33),
(22, 0, NULL, 34),
(23, 0, '', 35),
(25, 0, '', 36),
(26, 0, '', 37),
(27, 0, NULL, 38),
(28, 0, NULL, 39),
(30, 0, NULL, 41);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formacioncontinua`
--

CREATE TABLE `formacioncontinua` (
  `idFormacion` int(11) NOT NULL,
  `nombreFormacion` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fuentefinanciamiento`
--

CREATE TABLE `fuentefinanciamiento` (
  `idFuenteFinciamineto` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gestionacademica`
--

CREATE TABLE `gestionacademica` (
  `idGestionAcademica` int(11) NOT NULL,
  `fechaInicio` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  `idTipoGestion` int(11) NOT NULL,
  `funcionEncomentada` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `fechaUltimoReporte` date DEFAULT NULL,
  `horasSemana` int(11) DEFAULT NULL,
  `gestionAcademicaIes` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `idGestionEstados` int(11) NOT NULL,
  `idGestionResultadosObte` int(11) NOT NULL,
  `organoPresentado` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `idGestionAprobado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gestionaprobado`
--

CREATE TABLE `gestionaprobado` (
  `idGestionAprobado` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gestionestados`
--

CREATE TABLE `gestionestados` (
  `idGestionEstados` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gestionresultadosobtenidos`
--

CREATE TABLE `gestionresultadosobtenidos` (
  `idGestionResultadosObte` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gradotesis`
--

CREATE TABLE `gradotesis` (
  `idGradoTesis` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupoinvestigacion`
--

CREATE TABLE `grupoinvestigacion` (
  `idGrupoInvestigacion` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `fechaInicio` date DEFAULT NULL,
  `fechaIngreso` date DEFAULT NULL,
  `totaInves` int(11) DEFAULT NULL,
  `impacto` text COLLATE utf8_bin,
  `colaboracion` text COLLATE utf8_bin,
  `institucion` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `idAreaDisciplina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupoinvestigacioncolaboradores`
--

CREATE TABLE `grupoinvestigacioncolaboradores` (
  `idgrupoinvestigacionColaboradores` int(11) NOT NULL,
  `idGrupoInvestigacion` int(11) NOT NULL,
  `idColaboradoresgrupoinvestigacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupoocde`
--

CREATE TABLE `grupoocde` (
  `idGrupoOcde` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `idiomas`
--

CREATE TABLE `idiomas` (
  `idIdiomas` int(11) NOT NULL,
  `institucion` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `idioma` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `GradoDominio` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `nivelConversacion` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `nivelLectura` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `nivelEscritura` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `Certificacion` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `fechaEvaluacion` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `documento` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `VigenciaInicio` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `VigenciaFin` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `Puntos` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `nivelConferido` varchar(20) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `infraestructura`
--

CREATE TABLE `infraestructura` (
  `idInfraestructura` int(11) NOT NULL,
  `descripcion` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `idProtocoloInvestigacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `infraestructura`
--

INSERT INTO `infraestructura` (`idInfraestructura`, `descripcion`, `idProtocoloInvestigacion`) VALUES
(15, '', 33),
(19, '', 34),
(20, NULL, 35),
(22, NULL, 36),
(23, NULL, 37),
(24, '', 38),
(25, '', 39),
(27, '', 41);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `innovacion`
--

CREATE TABLE `innovacion` (
  `idInnovacion` int(11) NOT NULL,
  `tipoOslo` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `InnovacionTipo` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `aplocacion` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `potencial` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `mecanismo` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `apoyoConacyt` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `fondoPrograma` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `idSectorOcde` int(11) NOT NULL,
  `idSectorRama` int(11) NOT NULL,
  `idAreaDisciplina` int(11) NOT NULL,
  `montoVentas` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `volumenProduccion` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `noEmpleados` int(11) DEFAULT NULL,
  `noEmpleadosIndirectos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instituciones`
--

CREATE TABLE `instituciones` (
  `idInstitucion` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin NOT NULL,
  `descripcion` longtext COLLATE utf8_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `instituciones`
--

INSERT INTO `instituciones` (`idInstitucion`, `nombre`, `descripcion`) VALUES
(1, 'TecMM', 'Tecnológico Mario Molina Pasquel y Henríquez');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `institucionesfeddes`
--

CREATE TABLE `institucionesfeddes` (
  `idInstitucionFedDes` int(11) NOT NULL,
  `idInstirucion` int(11) NOT NULL,
  `idFedDes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `institucionesprogramas`
--

CREATE TABLE `institucionesprogramas` (
  `idInstitucionPrograma` int(11) NOT NULL,
  `idInstitucion` int(11) NOT NULL,
  `idPrograma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `institucionesprogramas`
--

INSERT INTO `institucionesprogramas` (`idInstitucionPrograma`, `idInstitucion`, `idPrograma`) VALUES
(1, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `investigacioncolaboratores`
--

CREATE TABLE `investigacioncolaboratores` (
  `idInvestigacionColaboratores` int(11) NOT NULL,
  `idRedesInvestigacion` int(11) NOT NULL,
  `idColaboratoresInvestigacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lenguasindigenas`
--

CREATE TABLE `lenguasindigenas` (
  `idLenguasIndigenas` int(11) NOT NULL,
  `lengua` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `GradoDominio` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `nivelConversacion` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `nivelLectura` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `nivelEscritura` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `Certificacion` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `fechaEvaluacion` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `documento` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `VigenciaInicio` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `VigenciaFin` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `Puntos` varchar(20) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ligaconvocatoriaproyecto`
--

CREATE TABLE `ligaconvocatoriaproyecto` (
  `idLigaConvocatoriaProyecto` int(11) NOT NULL,
  `idConvocatoria` int(11) NOT NULL,
  `idSolicitudApoyo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineageneracion`
--

CREATE TABLE `lineageneracion` (
  `idLineaGeneracion` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `horas` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `actividades` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineainvestigacion`
--

CREATE TABLE `lineainvestigacion` (
  `idLineaInvestigacion` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `lineainvestigacion`
--

INSERT INTO `lineainvestigacion` (`idLineaInvestigacion`, `nombre`) VALUES
(1, 'Tecnologías emergentes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas`
--

CREATE TABLE `lineas` (
  `idLinea` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin NOT NULL,
  `descripcion` longtext COLLATE utf8_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `lineas`
--

INSERT INTO `lineas` (`idLinea`, `nombre`, `descripcion`) VALUES
(1, 'Arquitectura, Bioclimática y Medio Ambiente', 'Arquitectura, bioclimática y medio ambiente'),
(2, 'Ciudad, Región y Planicificación Urbana Suste', 'Ciudad, región y planicificación urbana sustentable'),
(3, 'Materiales y Tecnologías alternativas para la', 'Materiales y tecnologías alternativas para la construccion'),
(4, 'Automatización, Instrumentación y Control', 'Automatización, instrumentación y control'),
(5, 'Fuentes alternas de Energía', 'Fuentes alternas de energía'),
(6, 'Diseño de máquinas, mecanismos, dispositivos ', 'Diseño de máquinas, mecanismos, dispositivos y sistemas de ingeniería mecánica y energética'),
(7, 'Desarrollo e innovación en Sistemas Electróni', 'Desarrollo e innovación en sistemas electrónicos'),
(8, 'Diseño de Apicaciones en Electrónica', 'Diseño de apicaciones en electrónica'),
(9, 'Radiometría, Fotometría Y procesamiento De Im', 'Radiometría, fotometría Y procesamiento De imagenes'),
(10, 'Gestión e innovación de los procesos', 'Gestión e innovación de los procesos'),
(11, 'Innovación y desarrollo tecnologíco sustentab', 'Innovación y desarrollo tecnologíco sustentable'),
(12, 'Planeación empresarial, calidad y competitivi', 'Planeación empresarial, calidad y competitividad'),
(13, 'Agricultura e innovación sustentable', 'Agricultura e innovación sustentable'),
(14, 'Agricultura protegida', 'Agricultura protegida'),
(15, 'Biotecnología vegetal aplicada', 'Biotecnología vegetal aplicada'),
(16, 'Sistemas, bases de datos y plataformas comput', 'Sistemas, bases de datos y plataformas computacionales'),
(17, 'Procesamiento digital de imágenes y visión', 'Procesamiento digital de imágenes y visión'),
(18, 'Tecnologías emergentes de la información y co', 'Tecnologías emergentes de la información y comunicación'),
(19, 'Calidad y productividad de procesos industral', 'Calidad y productividad de procesos industrales'),
(20, 'Sistemas de producción y manufactura avanzada', 'Sistemas de producción y manufactura avanzada'),
(21, 'Innovación, productividad y tecnología para l', 'Innovación, productividad y tecnología para la competitividad internacional'),
(22, 'Contabilidad integral para el sector empresar', 'Contabilidad integral para el sector empresarial y gubernamental'),
(23, 'Gestión e innovación de procesos contables', 'Gestión e innovación de procesos contables'),
(24, 'Integración 3D para cortometrajes', 'Integración 3D para cortometrajes'),
(25, 'Ingeniería ecologíca, ambiental y ciencias', 'Ingeniería ecologíca, ambiental y ciencias'),
(26, 'Materiales alternativos en la construccion', 'Materiales alternativos en la construccion'),
(27, 'Tecnologías sustentables para la construccion', 'Tecnologías sustentables para la construccion'),
(28, 'Tecnología del ambiente y sustentabilidad', 'Tecnología del ambiente y sustentabilidad'),
(29, 'Estudios y aplicaciones del comportamiento or', 'Estudios y aplicaciones del comportamiento organizacional y talento humano'),
(30, 'Gestión e innovación de las organizaciones', 'Gestión e innovación de las organizaciones'),
(31, 'Sistemas de innovación e investigación tecnol', 'Sistemas de innovación e investigación tecnológica empresarial'),
(32, 'Reciclaje de residuos industrales', 'Reciclaje de residuos industrales'),
(33, 'Realidad virtual', 'Realidad virtual'),
(34, 'Tecnologías de información y comunicación', 'Tecnologías de información y comunicación'),
(35, 'Desarrollo y experimentación en sistemas meca', 'Desarrollo y experimentación en sistemas mecatrónicos'),
(36, 'Diseño e implementación para sistemas de cont', 'Diseño e implementación para sistemas de control y adquisición de datos'),
(37, 'Biotecnología y bioquímica', 'Biotecnología y bioquímica'),
(38, 'Ingeniería e inocuidad alimentaria', 'Ingeniería e inocuidad alimentaria'),
(39, 'Tecnología de alimentos', 'Tecnología de alimentos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineascuerpoacademico`
--

CREATE TABLE `lineascuerpoacademico` (
  `idlineasCuerpoAcademico` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `lineascuerpoacademico`
--

INSERT INTO `lineascuerpoacademico` (`idlineasCuerpoAcademico`, `nombre`, `descripcion`) VALUES
(1, 'linea cuerpo prueba', 'prueba'),
(2, 'Tecnologías emergentes', ''),
(5, 'lineaprueba2', 'lineaprueba2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineasinvconsolidar`
--

CREATE TABLE `lineasinvconsolidar` (
  `idLineasInvConsolidar` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `lineasinvconsolidar`
--

INSERT INTO `lineasinvconsolidar` (`idLineasInvConsolidar`, `nombre`, `descripcion`) VALUES
(1, 'linea prueba', 'prueba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logros`
--

CREATE TABLE `logros` (
  `idlogros` int(11) NOT NULL,
  `descripcion` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugardesarrollo`
--

CREATE TABLE `lugardesarrollo` (
  `idLugarDesarrollo` int(11) NOT NULL,
  `idProtocoloInstigacion` int(11) NOT NULL,
  `nombreSeccion` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `diereccionExacta` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `requierePruebasCampo` tinyint(4) DEFAULT NULL,
  `estado` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `region` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `zona` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `municipio` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `distanciaKM` decimal(50,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `lugardesarrollo`
--

INSERT INTO `lugardesarrollo` (`idLugarDesarrollo`, `idProtocoloInstigacion`, `nombreSeccion`, `diereccionExacta`, `requierePruebasCampo`, `estado`, `region`, `zona`, `municipio`, `distanciaKM`) VALUES
(15, 33, '', '', NULL, '', '', '', '', '0.00'),
(19, 34, '', '', 0, '', '', '', '', '0.00'),
(20, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 38, '', '', NULL, '', '', '', '', '0.00'),
(25, 39, '', '', NULL, '', '', '', '', '0.00'),
(27, 41, '', '', NULL, '', '', '', '', '0.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mecanismodesarrollostecnologicos`
--

CREATE TABLE `mecanismodesarrollostecnologicos` (
  `idmecaDesaTecnologico` int(11) NOT NULL,
  `idDesarrollosTecnologicos` int(11) NOT NULL,
  `idMecanismoTranferencia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mecanismotransferencia`
--

CREATE TABLE `mecanismotransferencia` (
  `idMecanismoTranferencia` int(11) NOT NULL,
  `descripcion` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `memorias`
--

CREATE TABLE `memorias` (
  `idMemorias` int(11) NOT NULL,
  `titulo` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `apellidoPaterno` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `apellidoMaterno` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `tituloPublicacion` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `paginaInicio` int(11) DEFAULT NULL,
  `paginaFin` int(11) DEFAULT NULL,
  `publicacionYear` year(4) DEFAULT NULL,
  `pais` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `palabraClave1` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `palabraClave2` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `palabraClave3` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `apoyoConacyt` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `fondoPrograma` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niveldeestudio`
--

CREATE TABLE `niveldeestudio` (
  `idNivelEstudio` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niveltutorias`
--

CREATE TABLE `niveltutorias` (
  `idNivelTutorias` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nombredistincionconacyt`
--

CREATE TABLE `nombredistincionconacyt` (
  `idNombreDistincionConacyt` int(11) NOT NULL,
  `NombreDistincion` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `idReconocimientos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `titulo` text NOT NULL,
  `descripcion` text NOT NULL,
  `leido` tinytext NOT NULL,
  `fechaInicio` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaFin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `notifications`
--

INSERT INTO `notifications` (`id`, `titulo`, `descripcion`, `leido`, `fechaInicio`, `fechaFin`) VALUES
(1, 'hola base de datos', 'prueba a la base', '1', '2018-05-08 01:02:40', '0000-00-00 00:00:00'),
(2, '08/05/2018', 'Una descripciÃ³n del dia', '1', '2018-05-08 17:08:05', '0000-00-00 00:00:00'),
(3, 'Entrega de avance', 'Una prueba mas', '1', '2018-05-08 17:08:52', '0000-00-00 00:00:00'),
(4, 'Sistema', 'GeneraciÃ³n de modulo', '1', '2018-05-08 17:09:40', '0000-00-00 00:00:00'),
(5, 'Modulo tickets', 'Modulo encargado de realizar', '1', '2018-05-08 17:10:27', '0000-00-00 00:00:00'),
(6, 'TECNM', 'Muestra de notificacion', '1', '2018-05-08 17:12:13', '0000-00-00 00:00:00'),
(7, 'sdfds|', 'sdfsdf', '1', '2018-05-23 19:19:13', '0000-00-00 00:00:00'),
(8, 'aaaa', 'aaa', '1', '2018-05-23 21:53:02', '0000-00-00 00:00:00'),
(9, 'oración', 'sddfsdfsdf', '1', '2018-05-23 21:53:49', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `numerotipo`
--

CREATE TABLE `numerotipo` (
  `idNumeroTipo` int(11) NOT NULL,
  `numero` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `objetivogeneral`
--

CREATE TABLE `objetivogeneral` (
  `idObjetivoGeneral` int(11) NOT NULL,
  `descripcion` longtext COLLATE utf8_bin,
  `idSolicituApoyo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `objetivogeneral`
--

INSERT INTO `objetivogeneral` (`idObjetivoGeneral`, `descripcion`, `idSolicituApoyo`) VALUES
(30, 'sfdghj', 33),
(34, '', 34),
(35, '', 35),
(37, '', 36),
(38, '', 37),
(39, '', 38),
(40, '', 39),
(42, 'aaaa', 41);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `objetivosespecificos`
--

CREATE TABLE `objetivosespecificos` (
  `idObjetivosEspecificos` int(11) NOT NULL,
  `descripcion` longtext COLLATE utf8_bin,
  `idSolicitudApoyo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `objetivosespecificos`
--

INSERT INTO `objetivosespecificos` (`idObjetivosEspecificos`, `descripcion`, `idSolicitudApoyo`) VALUES
(27, 'sdfght', 33),
(31, '', 34),
(32, '', 35),
(34, '', 36),
(35, '', 37),
(36, '', 38),
(37, '', 39),
(39, 'aaaaa', 41);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opcionesetapa`
--

CREATE TABLE `opcionesetapa` (
  `idOpcionesEtapa` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orientacion`
--

CREATE TABLE `orientacion` (
  `idOrientacion` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin NOT NULL,
  `descripcion` longtext COLLATE utf8_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `orientacion`
--

INSERT INTO `orientacion` (`idOrientacion`, `nombre`, `descripcion`) VALUES
(1, 'Licenciatura', 'Licenciatura'),
(2, 'Maestria', 'Maestria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `origenreportetecnico`
--

CREATE TABLE `origenreportetecnico` (
  `idOrigenReporteTecnico` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `otroestudios`
--

CREATE TABLE `otroestudios` (
  `idOtrosEstudios` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `instituto` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `idFormacion` int(11) NOT NULL,
  `idAreaDisciplina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participacionactualizacionprogeducativo`
--

CREATE TABLE `participacionactualizacionprogeducativo` (
  `idParticipacionActualizacionEducativo` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `gradoIntervencion` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `fechaImplementacion` date DEFAULT NULL,
  `resumenProyectoPdf` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participacioncongreso`
--

CREATE TABLE `participacioncongreso` (
  `idParticipacionCongreso` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `idTipoParticipacionCongreso` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `palabraClave1` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `palabraClave2` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `palabraClave3` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participacioncongresocolaboradores`
--

CREATE TABLE `participacioncongresocolaboradores` (
  `idParticipacionCongresoColabora` int(11) NOT NULL,
  `idParticipacionCongreso` int(11) NOT NULL,
  `idColaboradoresCongreso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participacioneventos`
--

CREATE TABLE `participacioneventos` (
  `idParticipacionEventos` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `tipoParticipacion` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participantestesis`
--

CREATE TABLE `participantestesis` (
  `idParticipantesTesis` int(11) NOT NULL,
  `idTesisParticipantes` int(11) NOT NULL,
  `idTesisDirigidas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `patenteautor`
--

CREATE TABLE `patenteautor` (
  `idPatenteAutor` int(11) NOT NULL,
  `idAutorPatente` int(11) NOT NULL,
  `idPatentes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `patentes`
--

CREATE TABLE `patentes` (
  `idPatentes` int(11) NOT NULL,
  `titulo` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `PatentesTipo` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `PatentesEstado` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `numeroTramite` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `fechaSolicitud` date DEFAULT NULL,
  `fechaRegistro` date DEFAULT NULL,
  `expediente` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `clasificacionPatente` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `resumen` text COLLATE utf8_bin,
  `explotacionIndustrial` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `yearPublicacion` year(4) DEFAULT NULL,
  `pais` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plandetrabajo`
--

CREATE TABLE `plandetrabajo` (
  `idPlanDeTrabajo` int(11) NOT NULL,
  `idSolicitudApoyo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `plandetrabajo`
--

INSERT INTO `plandetrabajo` (`idPlanDeTrabajo`, `idSolicitudApoyo`) VALUES
(33, 33),
(34, 34),
(35, 35),
(36, 36),
(37, 37),
(38, 38),
(39, 39),
(41, 41);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuesto`
--

CREATE TABLE `presupuesto` (
  `idPresupuesto` int(11) NOT NULL,
  `montoSolicitadoMateriales` decimal(50,2) DEFAULT NULL,
  `montoOtorgadoTecMateriales` decimal(50,2) DEFAULT NULL,
  `montoOtorgadoInstitucionesMateriales` decimal(50,2) DEFAULT NULL,
  `totalMateriales` decimal(50,2) DEFAULT NULL,
  `montoSolicitadoServicios` decimal(50,2) DEFAULT NULL,
  `montoOtorgadoTecServicios` decimal(50,2) DEFAULT NULL,
  `montoOtorgadoInstitucionesServicios` decimal(50,2) DEFAULT NULL,
  `totalServicios` decimal(50,2) DEFAULT NULL,
  `totalMontoSolicitado` decimal(50,2) DEFAULT NULL,
  `totalMontoOtorgadoTec` decimal(50,2) DEFAULT NULL,
  `totalMontoOtorgadoInstituciones` decimal(50,2) DEFAULT NULL,
  `total` decimal(50,2) DEFAULT NULL,
  `idSolicitudApoyo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `presupuesto`
--

INSERT INTO `presupuesto` (`idPresupuesto`, `montoSolicitadoMateriales`, `montoOtorgadoTecMateriales`, `montoOtorgadoInstitucionesMateriales`, `totalMateriales`, `montoSolicitadoServicios`, `montoOtorgadoTecServicios`, `montoOtorgadoInstitucionesServicios`, `totalServicios`, `totalMontoSolicitado`, `totalMontoOtorgadoTec`, `totalMontoOtorgadoInstituciones`, `total`, `idSolicitudApoyo`) VALUES
(19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33),
(23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 34),
(24, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 35),
(26, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 36),
(27, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 37),
(28, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 38),
(29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 39),
(31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 41);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prodacademica`
--

CREATE TABLE `prodacademica` (
  `idProdAcademica` int(11) NOT NULL,
  `artRevistaIndizadas` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `artRevistArbitrada` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `artDivulgacion` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `memoriaCongreso` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `capLibroRevision` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `libroRevision` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `libroPublicado` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `prototipoRegistro` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `patenteRegistro` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `pqtRegistro` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `otros` mediumtext COLLATE utf8_bin,
  `idEntregables` int(11) NOT NULL,
  `beneficios` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `prodacademica`
--

INSERT INTO `prodacademica` (`idProdAcademica`, `artRevistaIndizadas`, `artRevistArbitrada`, `artDivulgacion`, `memoriaCongreso`, `capLibroRevision`, `libroRevision`, `libroPublicado`, `prototipoRegistro`, `patenteRegistro`, `pqtRegistro`, `otros`, `idEntregables`, `beneficios`) VALUES
(17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, NULL),
(21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL),
(22, '', '', '', '', '', '', '', '', '', '', '', 9, 0),
(24, '', '', '', '', '', '', '', '', '', '', '', 10, 0),
(25, '', '', '', '', '', '', '', '', '', '', '', 11, 0),
(26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, NULL),
(27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, NULL),
(29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `produccionarticulos`
--

CREATE TABLE `produccionarticulos` (
  `idProduccionArticulos` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `pais` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `titulo` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `numeroRevista` int(11) DEFAULT NULL,
  `yearPublicacion` int(11) DEFAULT NULL,
  `yearEdicion` int(11) DEFAULT NULL,
  `paginasInicio` int(11) DEFAULT NULL,
  `paginaFin` int(11) DEFAULT NULL,
  `articuloIssn` int(11) DEFAULT NULL,
  `volumen` int(11) DEFAULT NULL,
  `palabraClave1` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `palabraClave2` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `palabraClave3` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `idAreaDisciplina` int(11) NOT NULL,
  `Apoyo` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `fondo` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productoevaluado`
--

CREATE TABLE `productoevaluado` (
  `idProductoEvaluado` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programainvconsolidar`
--

CREATE TABLE `programainvconsolidar` (
  `idProgramaInvConsolidar` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `programainvconsolidar`
--

INSERT INTO `programainvconsolidar` (`idProgramaInvConsolidar`, `nombre`, `descripcion`) VALUES
(1, 'prueba111', 'prueba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programalineacuerpoacademico`
--

CREATE TABLE `programalineacuerpoacademico` (
  `idProgramaLineaCuerpoAcademico` int(11) NOT NULL,
  `idProgramaCuerpoAcademico` int(11) NOT NULL,
  `idLineaCuerpoAcademico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `programalineacuerpoacademico`
--

INSERT INTO `programalineacuerpoacademico` (`idProgramaLineaCuerpoAcademico`, `idProgramaCuerpoAcademico`, `idLineaCuerpoAcademico`) VALUES
(1, 1, 1),
(4, 3, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programalineainvconsolidar`
--

CREATE TABLE `programalineainvconsolidar` (
  `idProgramaLineaInvConsolidar` int(11) NOT NULL,
  `idProgramaInvConsolidar` int(11) NOT NULL,
  `idLineaInvConsolidar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `programalineainvconsolidar`
--

INSERT INTO `programalineainvconsolidar` (`idProgramaLineaInvConsolidar`, `idProgramaInvConsolidar`, `idLineaInvConsolidar`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programaorientacion`
--

CREATE TABLE `programaorientacion` (
  `idProgramaOrientacion` int(11) NOT NULL,
  `idOrientacion` int(11) NOT NULL,
  `idPrograma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `programaorientacion`
--

INSERT INTO `programaorientacion` (`idProgramaOrientacion`, `idOrientacion`, `idPrograma`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10),
(11, 1, 11),
(12, 1, 12),
(13, 1, 13),
(14, 1, 14),
(15, 1, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programas`
--

CREATE TABLE `programas` (
  `idPrograma` int(11) NOT NULL,
  `nomPrograma` varchar(45) COLLATE utf8_bin NOT NULL,
  `descripcion` longtext COLLATE utf8_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `programas`
--

INSERT INTO `programas` (`idPrograma`, `nomPrograma`, `descripcion`) VALUES
(1, 'Ingenieria Ambiental', 'Arquitectura'),
(2, 'Ingeniería electromecanica', 'Ingeniería electromecanica'),
(3, 'Ingeniería en electrónica', 'Ingeniería en electrónica'),
(4, 'Ingeniería en gestión empresarial', 'Ingeniería en gestión empresarial'),
(5, 'Ingeniería en innovación agricola sustentable', 'Ingeniería en innovación agricola sustentable'),
(6, 'Ingeniería en sistemas computacionales', 'Ingeniería en sistemas computacionales'),
(7, 'Ingeniería industrial', 'Ingeniería industrial'),
(8, 'Contador publico', 'Contador publico'),
(9, 'Ingeniería en animación digital y efectos vis', 'Ingeniería en animación digital y efectos visuales'),
(10, 'Ingeniería ambiental', 'Ingeniería ambiental'),
(11, 'Ingeniería civil', 'Ingeniería civil'),
(12, 'Ingeniería en administración', 'Ingeniería en administración'),
(13, 'Ingeniería en energias renovables', 'Ingeniería en energias renovables'),
(14, 'Ingeniería informática', 'Ingeniería informática'),
(15, 'Ingeniería mecatrónica', 'Ingeniería mecatrónica'),
(16, 'Ingeniería en industrias alimentarias', 'Ingeniería en industrias alimentarias	Lineas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programascuerpoacademico`
--

CREATE TABLE `programascuerpoacademico` (
  `idProgramasCuerpoAcademico` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `programascuerpoacademico`
--

INSERT INTO `programascuerpoacademico` (`idProgramasCuerpoAcademico`, `nombre`, `descripcion`) VALUES
(1, 'prueba', 'prueba'),
(3, 'prueba2', 'prueba2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programlineas`
--

CREATE TABLE `programlineas` (
  `idProgramLinea` int(11) NOT NULL,
  `idPrograma` int(11) NOT NULL,
  `idLinea` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `programlineas`
--

INSERT INTO `programlineas` (`idProgramLinea`, `idPrograma`, `idLinea`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 4),
(5, 2, 5),
(6, 2, 6),
(7, 3, 7),
(8, 3, 8),
(9, 3, 9),
(10, 4, 10),
(11, 4, 11),
(12, 4, 12),
(13, 5, 13),
(14, 5, 14),
(15, 5, 15),
(16, 6, 16),
(17, 6, 17),
(18, 6, 18),
(19, 7, 19),
(20, 7, 20),
(21, 7, 21),
(22, 8, 22),
(23, 8, 23),
(24, 9, 24),
(25, 10, 25),
(26, 11, 26),
(27, 11, 27),
(28, 11, 28),
(29, 12, 29),
(30, 12, 30),
(31, 12, 31),
(32, 13, 32),
(33, 14, 33),
(34, 14, 34),
(35, 14, 16),
(36, 15, 35),
(37, 15, 36);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `protocolodocs`
--

CREATE TABLE `protocolodocs` (
  `idProtocoloDocs` int(11) NOT NULL,
  `idProtocoloInvestigacion` int(11) NOT NULL,
  `idDocumentosAdjuntos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `protocoloinvestigacion`
--

CREATE TABLE `protocoloinvestigacion` (
  `idProtocoloInvestigacion` int(11) NOT NULL,
  `idSolicitudApoyo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `protocoloinvestigacion`
--

INSERT INTO `protocoloinvestigacion` (`idProtocoloInvestigacion`, `idSolicitudApoyo`) VALUES
(33, 33),
(34, 34),
(35, 35),
(36, 36),
(37, 37),
(38, 38),
(39, 39),
(41, 41);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectoscolaboradores`
--

CREATE TABLE `proyectoscolaboradores` (
  `idProyectosColaboratores` int(11) NOT NULL,
  `idColaboratoresProyectos` int(11) NOT NULL,
  `idProyectosInvestigacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectosinvestigacion`
--

CREATE TABLE `proyectosinvestigacion` (
  `idProyectosInvestigacion` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `fechaInicio` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  `actRealizada` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `idLineaInvestigacion` int(11) NOT NULL,
  `idResultadosInvestigacion` int(11) NOT NULL,
  `idTipoProyecto` int(11) NOT NULL,
  `investigacionPdf` text COLLATE utf8_bin,
  `idTipoPatrocinador` int(11) NOT NULL,
  `nombrePatricinador` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `institucion` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `idCurriculumCa` int(11) NOT NULL,
  `monto` decimal(10,0) DEFAULT NULL,
  `idFuenteFinciamineto` int(11) NOT NULL,
  `idAreaDisciplina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectostrabajados`
--

CREATE TABLE `proyectostrabajados` (
  `idProyectosTrabajados` int(11) NOT NULL,
  `investigaciónTrabajo` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `resultados` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `idFuenteFinanciacion` int(11) NOT NULL,
  `montoProyecto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicaciondivulgacion`
--

CREATE TABLE `publicaciondivulgacion` (
  `idPublicacionDivulgacion` int(11) NOT NULL,
  `tituloTrabajo` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `idTipoParticipacion` int(11) NOT NULL,
  `idTipoEvento` int(11) NOT NULL,
  `institucion` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `dirigidoA` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `idTipoDivulgacionDifusion` int(11) NOT NULL,
  `palabraClave1` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `palabraClave2` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `palabraClave3` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `notaPeriodistica` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ramascian`
--

CREATE TABLE `ramascian` (
  `idRamaScian` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ramasubramascian`
--

CREATE TABLE `ramasubramascian` (
  `idRamasubramaScian` int(11) NOT NULL,
  `idRamaScian` int(11) NOT NULL,
  `idSubramaScian` int(11) NOT NULL,
  `idClaseScian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reconocimientos`
--

CREATE TABLE `reconocimientos` (
  `idReconocimientos` int(11) NOT NULL,
  `idTipoReconocimiento` int(11) NOT NULL,
  `OtorgadoReconocimientos` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `fechaReconocimientos` date DEFAULT NULL,
  `motivo` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `nombreReconocimiento` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `idRelacionConacyt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `redescolaboradores`
--

CREATE TABLE `redescolaboradores` (
  `idRedesColaboratores` int(11) NOT NULL,
  `idRedesTematicas` int(11) NOT NULL,
  `idColaboradoresRedes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `redesinvestigacion`
--

CREATE TABLE `redesinvestigacion` (
  `idRedesInvestigacion` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `FechaCreacion` date DEFAULT NULL,
  `fecheInicio` date DEFAULT NULL,
  `institucion` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `totalIntegrantes` int(11) DEFAULT NULL,
  `idAreaDisciplina` int(11) NOT NULL,
  `nombreResponsable` varchar(30) COLLATE utf8_bin NOT NULL,
  `aperllidoPaterno` varchar(30) COLLATE utf8_bin NOT NULL,
  `apellidoMaterno` varchar(30) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `redestematicas`
--

CREATE TABLE `redestematicas` (
  `idRedesTematicas` int(11) NOT NULL,
  `fechaIngreso` date DEFAULT NULL,
  `idTipoTedesTematicas` int(11) NOT NULL,
  `nombreResponsable` varchar(30) COLLATE utf8_bin NOT NULL,
  `aperllidoPaterno` varchar(30) COLLATE utf8_bin NOT NULL,
  `apellidoMaterno` varchar(30) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `referencias`
--

CREATE TABLE `referencias` (
  `idReferencias` int(11) NOT NULL,
  `referencia` varchar(500) DEFAULT NULL,
  `estadoCampoArte` varchar(500) DEFAULT NULL,
  `planteamiento` varchar(500) DEFAULT NULL,
  `desarrolloProyecto` varchar(500) DEFAULT NULL,
  `idProtocoloInvestigacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `referencias`
--

INSERT INTO `referencias` (`idReferencias`, `referencia`, `estadoCampoArte`, `planteamiento`, `desarrolloProyecto`, `idProtocoloInvestigacion`) VALUES
(15, NULL, NULL, NULL, NULL, 33),
(19, '', '', '', '', 34),
(20, NULL, NULL, NULL, NULL, 35),
(22, NULL, NULL, NULL, NULL, 36),
(23, NULL, NULL, NULL, NULL, 37),
(24, '', '', '', '', 38),
(25, '', '', '', '', 39),
(27, NULL, NULL, NULL, NULL, 41);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relacionconacyt`
--

CREATE TABLE `relacionconacyt` (
  `idRelacionConacyt` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportestecnicos`
--

CREATE TABLE `reportestecnicos` (
  `idReportesTecnicos` int(11) NOT NULL,
  `institucion` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `fechaEntrega` date DEFAULT NULL,
  `fechaPublicacion` date DEFAULT NULL,
  `numeroPaginas` int(11) DEFAULT NULL,
  `descripcion` text COLLATE utf8_bin,
  `objetivos` text COLLATE utf8_bin,
  `palabracleve1` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `palabracleve2` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `palabracleve3` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `idOrigenReporteTecnico` int(11) NOT NULL,
  `apoyoConacyt` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `fondo` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportestecnicosautor`
--

CREATE TABLE `reportestecnicosautor` (
  `idReportesTecnicosAutor` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `apellidoPaterno` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `apellidoMaterno` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `idReportesTecnicos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultadosinvestigacion`
--

CREATE TABLE `resultadosinvestigacion` (
  `idResultadosInvestigacion` int(11) NOT NULL,
  `estadoNombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sectorocde`
--

CREATE TABLE `sectorocde` (
  `idSectorOcde` int(11) NOT NULL,
  `idDivicionOcde` int(11) NOT NULL,
  `idGrupoOcde` int(11) NOT NULL,
  `idClaseOcde` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sectorrama`
--

CREATE TABLE `sectorrama` (
  `idSectorRama` int(11) NOT NULL,
  `idSectorSubsectorScian` int(11) NOT NULL,
  `idRamaSubramaScian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sectorscian`
--

CREATE TABLE `sectorscian` (
  `idSectorScian` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sectorsubsectorscian`
--

CREATE TABLE `sectorsubsectorscian` (
  `idSectorSubsectorScian` int(11) NOT NULL,
  `idSectorScian` int(11) NOT NULL,
  `idSubsectorScian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudapoyo`
--

CREATE TABLE `solicitudapoyo` (
  `idSolicitudApoyo` int(11) NOT NULL,
  `tituloProyecto` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `descripcion` longtext COLLATE utf8_bin,
  `idTipoInvestigacion` int(11) DEFAULT NULL,
  `orientacion` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `idPrograma` int(11) DEFAULT '1',
  `idLinea` int(11) DEFAULT NULL,
  `fechaInicio` date DEFAULT NULL,
  `duracion` int(11) DEFAULT NULL,
  `horasRequeridas` int(11) DEFAULT NULL,
  `responsable` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `idProgramaInv` int(11) DEFAULT NULL,
  `idLineaInv` int(11) DEFAULT NULL,
  `idProgramaCuerpo` int(11) DEFAULT NULL,
  `idLineaCuerpo` int(11) DEFAULT NULL,
  `correoResponsable` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `subOrientacion` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `idInvestigador` int(11) NOT NULL,
  `idCuerpoAcademico` int(11) DEFAULT NULL,
  `sniInv` int(11) DEFAULT NULL,
  `promepInv` int(11) DEFAULT NULL,
  `idInstitucion` int(11) DEFAULT NULL,
  `SNI` tinyint(4) DEFAULT NULL,
  `numeroRegistroSNI` int(11) DEFAULT NULL,
  `vigencia` int(4) DEFAULT NULL,
  `orientacionCuerpo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `solicitudapoyo`
--

INSERT INTO `solicitudapoyo` (`idSolicitudApoyo`, `tituloProyecto`, `descripcion`, `idTipoInvestigacion`, `orientacion`, `idPrograma`, `idLinea`, `fechaInicio`, `duracion`, `horasRequeridas`, `responsable`, `idProgramaInv`, `idLineaInv`, `idProgramaCuerpo`, `idLineaCuerpo`, `correoResponsable`, `subOrientacion`, `idInvestigador`, `idCuerpoAcademico`, `sniInv`, `promepInv`, `idInstitucion`, `SNI`, `numeroRegistroSNI`, `vigencia`, `orientacionCuerpo`) VALUES
(33, 'drones', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 'qqqqq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 'Casas', NULL, NULL, NULL, NULL, NULL, '0000-00-00', 0, 0, 'valeria melendez', NULL, NULL, NULL, NULL, 'GFDS@JHGFD.GFD', NULL, 2, NULL, 0, 0, NULL, NULL, 0, 0, NULL),
(36, 'siiiiii', NULL, NULL, NULL, NULL, NULL, '0000-00-00', 0, 0, 'dsaDSA', NULL, NULL, NULL, NULL, 'GFDS@JHGFD.GFD', NULL, 1, NULL, 0, 0, 1, NULL, 0, 0, NULL),
(37, 'siiiiii', NULL, NULL, NULL, NULL, NULL, '0000-00-00', 0, 0, 'dsaDSA', NULL, NULL, NULL, NULL, 'GFDS@JHGFD.GFD', NULL, 1, NULL, 0, 0, 1, NULL, 0, 0, NULL),
(38, 'ttttt', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 'ttttt', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 'drones', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Disparadores `solicitudapoyo`
--
DELIMITER $$
CREATE TRIGGER `insertarProtocolo` AFTER INSERT ON `solicitudapoyo` FOR EACH ROW BEGIN
	INSERT INTO protocoloinvestigacion VALUES (NEW.idSolicitudApoyo, NEW.idSolicitudApoyo);
    INSERT INTO plandetrabajo VALUES (NEW.idSolicitudApoyo, NEW.idSolicitudApoyo);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subdiciplina`
--

CREATE TABLE `subdiciplina` (
  `idSubDiciplina` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subdisciplina`
--

CREATE TABLE `subdisciplina` (
  `idSubDisciplina` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subramascian`
--

CREATE TABLE `subramascian` (
  `idSubramaScian` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subsectorscian`
--

CREATE TABLE `subsectorscian` (
  `idSubsectorScian` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tecnicoautor`
--

CREATE TABLE `tecnicoautor` (
  `idTecnicoAutor` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `idReportesTecnicos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tesisdirigidas`
--

CREATE TABLE `tesisdirigidas` (
  `idTesisDirigidas` int(11) NOT NULL,
  `nombreTesis` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `fechaInicio` date DEFAULT NULL,
  `idTipoProgramaPnpc` int(11) NOT NULL,
  `nombreAlumno` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `idAreaDisciplina` int(11) NOT NULL,
  `fechaFin` date DEFAULT NULL,
  `idgradoTesis` int(11) NOT NULL,
  `institucion` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `CuerpoAcademico` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `estadoDireccion` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `numeroAlumnos` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tesisparticipantes`
--

CREATE TABLE `tesisparticipantes` (
  `idTesisParticipantes` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipocontacto`
--

CREATE TABLE `tipocontacto` (
  `idTipoContacto` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodivulgaciondifusion`
--

CREATE TABLE `tipodivulgaciondifusion` (
  `idTipoDivulgacionDifusion` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoevaluacion`
--

CREATE TABLE `tipoevaluacion` (
  `idTipoEvaluacion` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoevento`
--

CREATE TABLE `tipoevento` (
  `idTipoEvento` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipogestion`
--

CREATE TABLE `tipogestion` (
  `idTipoGestion` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoinstancia`
--

CREATE TABLE `tipoinstancia` (
  `idTipoInstancia` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoinstituto`
--

CREATE TABLE `tipoinstituto` (
  `idTipoInstituto` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoinvestigacion`
--

CREATE TABLE `tipoinvestigacion` (
  `idTipoInvestigacion` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin NOT NULL,
  `descripcion` longtext COLLATE utf8_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tipoinvestigacion`
--

INSERT INTO `tipoinvestigacion` (`idTipoInvestigacion`, `nombre`, `descripcion`) VALUES
(1, 'Basica', 'Basica'),
(2, 'Aplicada', 'Aplicada'),
(3, 'Desarrollo Tecnológico', 'Desarrollo Tecnológico'),
(4, 'Educativa', 'Educativa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipomembresia`
--

CREATE TABLE `tipomembresia` (
  `idTipoMenbresia` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiponivel`
--

CREATE TABLE `tiponivel` (
  `idTipoNivel` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiponumero`
--

CREATE TABLE `tiponumero` (
  `idTipoNumero` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoparticipacion`
--

CREATE TABLE `tipoparticipacion` (
  `idTipoParticipacion` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoparticipacioncongreso`
--

CREATE TABLE `tipoparticipacioncongreso` (
  `idTipoParticipacionCongreso` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipopatrocinador`
--

CREATE TABLE `tipopatrocinador` (
  `idTipoPatrocinador` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoprogramapnpc`
--

CREATE TABLE `tipoprogramapnpc` (
  `idTipoProgramaPnpc` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoproyecto`
--

CREATE TABLE `tipoproyecto` (
  `idTipoProyecto` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipopuesto`
--

CREATE TABLE `tipopuesto` (
  `idTipoPuesto` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiporeconocimiento`
--

CREATE TABLE `tiporeconocimiento` (
  `idTipoReconocimiento` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiporedestematicas`
--

CREATE TABLE `tiporedestematicas` (
  `idTipoRedesTematicas` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipotutorias`
--

CREATE TABLE `tipotutorias` (
  `idTipoTutorias` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuario`
--

CREATE TABLE `tipousuario` (
  `idTipoUsuario` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tipousuario`
--

INSERT INTO `tipousuario` (`idTipoUsuario`, `nombre`) VALUES
(1, 'usuario'),
(2, 'Admi');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutorias`
--

CREATE TABLE `tutorias` (
  `idTutorias` int(11) NOT NULL,
  `idTipoTutorias` int(11) NOT NULL,
  `idNivelTutorias` int(11) NOT NULL,
  `fechaInicio` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  `idEstadoTutorias` int(11) NOT NULL,
  `numeroEstudiantes` int(11) DEFAULT NULL,
  `nombreestudiante` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `programaEducativo` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `idTutoriasGrupanIndi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutoriasgrupanindi`
--

CREATE TABLE `tutoriasgrupanindi` (
  `idTutoriasGrupanIndi` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuarios` int(11) NOT NULL,
  `correo` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `apellidoPaterno` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `apellidoMaterno` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `curp` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `estatusUsuario` int(11) DEFAULT NULL,
  `idTipoUsuario` int(11) NOT NULL,
  `idEstadoCivil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuarios`, `correo`, `password`, `nombre`, `apellidoPaterno`, `apellidoMaterno`, `curp`, `estatusUsuario`, `idTipoUsuario`, `idEstadoCivil`) VALUES
(1, 'raulzp39@gmail.com', 'zepara', 'Raul', 'Zepeda', 'Parra', 'zepdhsfs6789', 1, 2, 0),
(2, 'vmelendez@gmail.com', '123', 'Valeria', 'Melendez', 'Flores', 'zepdhsfs6789', 1, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vinculacion`
--

CREATE TABLE `vinculacion` (
  `idVinculacion` int(11) NOT NULL,
  `nombreEmpresa` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `tipoCooperacion` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `responsabilidad` mediumtext COLLATE utf8_bin,
  `usuariosPotenciables` mediumtext COLLATE utf8_bin,
  `idProtocoloInvestigacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `vinculacion`
--

INSERT INTO `vinculacion` (`idVinculacion`, `nombreEmpresa`, `tipoCooperacion`, `responsabilidad`, `usuariosPotenciables`, `idProtocoloInvestigacion`) VALUES
(1, 'Jabil', 'Desarrollo de software', 'Desarrollo de software\r\nDesarrollo de software\r\nDesarrollo de software\r\nDesarrollo de software', 'líder de proyecto\r\nlíder de proyecto\r\nlíder de proyecto\r\nlíder de proyecto', 20),
(3, 'as', 'as', 'as', 'as', 27),
(5, '', '', '', '', 25),
(6, '', '', '', '', 28),
(7, '', '', '', '', 29),
(8, NULL, NULL, NULL, NULL, 35),
(9, NULL, NULL, NULL, NULL, 37),
(10, '', '', '', '', 39),
(11, NULL, NULL, NULL, NULL, 41),
(12, NULL, NULL, NULL, NULL, 43),
(13, NULL, NULL, NULL, NULL, 45),
(14, NULL, NULL, NULL, NULL, 31),
(15, NULL, NULL, NULL, NULL, 32),
(16, NULL, NULL, NULL, NULL, 33),
(17, NULL, NULL, NULL, NULL, 36),
(18, '', '', '', '', 34),
(19, '', '', '', '', 38),
(20, '', '', '', '', 40);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`idActividades`),
  ADD KEY `idSolicitudApoyo` (`idSolicitudApoyo`);

--
-- Indices de la tabla `actividadesdirecciontesis`
--
ALTER TABLE `actividadesdirecciontesis`
  ADD PRIMARY KEY (`idActividadesDireccionTesis`),
  ADD KEY `idPlanDeTrabajoDT_idx` (`idPlanDeTrabajo`);

--
-- Indices de la tabla `actividadesdocencia`
--
ALTER TABLE `actividadesdocencia`
  ADD PRIMARY KEY (`idActividadesDocencia`),
  ADD KEY `idPlanDeTrabajoD_idx` (`idPlanDeTrabajo`);

--
-- Indices de la tabla `actividadesgestionacademica`
--
ALTER TABLE `actividadesgestionacademica`
  ADD PRIMARY KEY (`idActividadesGestionAcademica`),
  ADD KEY `idPlanDeTrabajoGA_idx` (`idPlanDeTrabajo`);

--
-- Indices de la tabla `actividadesinvestigacion`
--
ALTER TABLE `actividadesinvestigacion`
  ADD PRIMARY KEY (`idActividadesInvestigacion`),
  ADD KEY `idPlanDeTrabajoI_idx` (`idPlanDeTrabajo`);

--
-- Indices de la tabla `actividadestutoria`
--
ALTER TABLE `actividadestutoria`
  ADD PRIMARY KEY (`idActividadesTutoria`),
  ADD KEY `idPlanDeTrabajoT_idx` (`idPlanDeTrabajo`);

--
-- Indices de la tabla `actualanterior`
--
ALTER TABLE `actualanterior`
  ADD PRIMARY KEY (`idActualAnterior`);

--
-- Indices de la tabla `alumnosincorporados`
--
ALTER TABLE `alumnosincorporados`
  ADD PRIMARY KEY (`idAlumnosIncorporados`),
  ADD KEY `idContribucionAI_idx` (`idContribucion`);

--
-- Indices de la tabla `alumnosresidentes`
--
ALTER TABLE `alumnosresidentes`
  ADD PRIMARY KEY (`idAlumnosResidentes`),
  ADD KEY `idContribucionAR_idx` (`idContribucion`);

--
-- Indices de la tabla `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`idArea`);

--
-- Indices de la tabla `areadiciplinas`
--
ALTER TABLE `areadiciplinas`
  ADD PRIMARY KEY (`idAreaDiciplina`),
  ADD KEY `idArea` (`idArea`) USING BTREE,
  ADD KEY `idDiciplinaSub` (`idDiciplinaSub`) USING BTREE,
  ADD KEY `idCampus` (`idCampus`);

--
-- Indices de la tabla `areadisciplinas`
--
ALTER TABLE `areadisciplinas`
  ADD PRIMARY KEY (`idAreaDisciplina`),
  ADD KEY `idArea` (`idArea`) USING BTREE,
  ADD KEY `idDisciplinaSub` (`idDisciplinaSub`) USING BTREE,
  ADD KEY `idCampus` (`idCampus`);

--
-- Indices de la tabla `asociaciones`
--
ALTER TABLE `asociaciones`
  ADD PRIMARY KEY (`idAsociaciones`),
  ADD KEY `idTipoMembresia` (`idTipoMembresia`);

--
-- Indices de la tabla `autorpatente`
--
ALTER TABLE `autorpatente`
  ADD PRIMARY KEY (`idAutorPatente`);

--
-- Indices de la tabla `autortecnico`
--
ALTER TABLE `autortecnico`
  ADD PRIMARY KEY (`idAutorTecnico`),
  ADD KEY `idReportesTecnicos` (`idReportesTecnicos`),
  ADD KEY `idTecnicoAutor` (`idTecnicoAutor`);

--
-- Indices de la tabla `campo`
--
ALTER TABLE `campo`
  ADD PRIMARY KEY (`idCampo`);

--
-- Indices de la tabla `campus`
--
ALTER TABLE `campus`
  ADD PRIMARY KEY (`idCampus`),
  ADD KEY `idInstituciones_idx` (`idInstituciones`);

--
-- Indices de la tabla `campusdepartamento`
--
ALTER TABLE `campusdepartamento`
  ADD PRIMARY KEY (`idCampusDepartamento`),
  ADD KEY `idDepartamento` (`idDepartamento`),
  ADD KEY `idCampus` (`idCampus`);

--
-- Indices de la tabla `capitulospublicados`
--
ALTER TABLE `capitulospublicados`
  ADD PRIMARY KEY (`idCapitulosPublicados`),
  ADD KEY `idAreaDisciplina` (`idAreaDisciplina`);

--
-- Indices de la tabla `claseocde`
--
ALTER TABLE `claseocde`
  ADD PRIMARY KEY (`idClaseOcde`);

--
-- Indices de la tabla `clasescian`
--
ALTER TABLE `clasescian`
  ADD PRIMARY KEY (`idClaseScian`);

--
-- Indices de la tabla `colaboradores`
--
ALTER TABLE `colaboradores`
  ADD PRIMARY KEY (`idColaborador`),
  ADD KEY `idSolicitudApoyo` (`idSolicitudApoyo`);

--
-- Indices de la tabla `colaboradoresactividades`
--
ALTER TABLE `colaboradoresactividades`
  ADD PRIMARY KEY (`idColaboradoresActividades`),
  ADD KEY `idActividades` (`idActividades`),
  ADD KEY `idColaboradores` (`idColaboradores`);

--
-- Indices de la tabla `colaboradorescongreso`
--
ALTER TABLE `colaboradorescongreso`
  ADD PRIMARY KEY (`idColaboradoresCongreso`),
  ADD KEY `idAreaDisciplina` (`idAreaDisciplina`),
  ADD KEY `idNivelEstudio` (`idNivelEstudio`);

--
-- Indices de la tabla `colaboradoresgrupoinvestigacion`
--
ALTER TABLE `colaboradoresgrupoinvestigacion`
  ADD PRIMARY KEY (`idColaboradoresgrupoinvestigacion`),
  ADD KEY `idNivelEstudio` (`idNivelEstudio`);

--
-- Indices de la tabla `colaboradoresredes`
--
ALTER TABLE `colaboradoresredes`
  ADD PRIMARY KEY (`idColaboradoresRedes`);

--
-- Indices de la tabla `colaboratoresinvestigacion`
--
ALTER TABLE `colaboratoresinvestigacion`
  ADD PRIMARY KEY (`idColaboratoresInvestigacion`),
  ADD KEY `idNivelEstudio` (`idNivelEstudio`);

--
-- Indices de la tabla `colaboratoresproyectos`
--
ALTER TABLE `colaboratoresproyectos`
  ADD PRIMARY KEY (`idColaboratoresProyectos`),
  ADD KEY `idNivelEstudio` (`idNivelEstudio`);

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`idContacto`),
  ADD KEY `idTipoContacto` (`idTipoContacto`);

--
-- Indices de la tabla `contribucion`
--
ALTER TABLE `contribucion`
  ADD PRIMARY KEY (`idContribucion`),
  ADD KEY `idEntregables` (`idEntregables`);

--
-- Indices de la tabla `convocatorias`
--
ALTER TABLE `convocatorias`
  ADD PRIMARY KEY (`idConvocatoria`);

--
-- Indices de la tabla `cuerpoacademico`
--
ALTER TABLE `cuerpoacademico`
  ADD PRIMARY KEY (`idcuerpoAcademico`);

--
-- Indices de la tabla `curriculumca`
--
ALTER TABLE `curriculumca`
  ADD PRIMARY KEY (`idCurriculumCa`);

--
-- Indices de la tabla `cursoimpartido`
--
ALTER TABLE `cursoimpartido`
  ADD PRIMARY KEY (`idCursoImpartido`),
  ADD KEY `idAreaDisciplina` (`idAreaDisciplina`),
  ADD KEY `idProgramaPnpc` (`idTipoProgramaPnpc`);

--
-- Indices de la tabla `cvu`
--
ALTER TABLE `cvu`
  ADD PRIMARY KEY (`idCvu`),
  ADD KEY `idCampusDepartamento` (`idCampusDepartamento`),
  ADD KEY `idUsuarios` (`idUsuarios`);

--
-- Indices de la tabla `cvuasociones`
--
ALTER TABLE `cvuasociones`
  ADD PRIMARY KEY (`idCvuAsociaciones`),
  ADD KEY `idCvu` (`idCvu`),
  ADD KEY `idAsociaciones` (`idAsociaciones`);

--
-- Indices de la tabla `cvucapitulospublicados`
--
ALTER TABLE `cvucapitulospublicados`
  ADD PRIMARY KEY (`idCvuCapitulosPublicados`),
  ADD KEY `idCvu` (`idCvu`),
  ADD KEY `idCapitulosPublicados` (`idCapitulosPublicados`);

--
-- Indices de la tabla `cvuconacyt`
--
ALTER TABLE `cvuconacyt`
  ADD PRIMARY KEY (`idCvuConacyt`),
  ADD KEY `idCvu` (`idCvu`),
  ADD KEY `idEvaluacionConacyt` (`idEvaluacionConacyt`);

--
-- Indices de la tabla `cvucuerpoacademico`
--
ALTER TABLE `cvucuerpoacademico`
  ADD PRIMARY KEY (`idCvuCuerpoAcademico`),
  ADD KEY `idCvu` (`idCvu`),
  ADD KEY `idCuerpoAcademico` (`idCuerpoAcademico`);

--
-- Indices de la tabla `cvucursoimpartido`
--
ALTER TABLE `cvucursoimpartido`
  ADD PRIMARY KEY (`idCvuCursoImpartido`),
  ADD KEY `idCvu` (`idCvu`),
  ADD KEY `idCursoImpartido` (`idCursoImpartido`);

--
-- Indices de la tabla `cvudesarrollosoftware`
--
ALTER TABLE `cvudesarrollosoftware`
  ADD PRIMARY KEY (`idCvuDesarrolloSoftware`),
  ADD KEY `idCvu` (`idCvu`),
  ADD KEY `idDesarrolloSoftware` (`idDesarrolloSoftware`);

--
-- Indices de la tabla `cvudesarrollostecnologicos`
--
ALTER TABLE `cvudesarrollostecnologicos`
  ADD PRIMARY KEY (`idCvuDesarrollosTecnologicos`),
  ADD KEY `idCvu` (`idCvu`),
  ADD KEY `idDesarrollosTecnologicos` (`idDesarrollosTecnologicos`);

--
-- Indices de la tabla `cvudiplomasimpartidos`
--
ALTER TABLE `cvudiplomasimpartidos`
  ADD PRIMARY KEY (`idCvuDiplomasImpartidos`),
  ADD KEY `idCvu` (`idCvu`),
  ADD KEY `idDiplomasImpartidos` (`idDiplomasImpartidos`);

--
-- Indices de la tabla `cvudocenciaactual`
--
ALTER TABLE `cvudocenciaactual`
  ADD PRIMARY KEY (`idCvuDocenciaActual`),
  ADD KEY `idCvu` (`idCvu`);

--
-- Indices de la tabla `cvudocente`
--
ALTER TABLE `cvudocente`
  ADD PRIMARY KEY (`idCvuDocente`),
  ADD KEY `idCvu` (`idCvu`),
  ADD KEY `idExperienciaDocente` (`idExperienciaDocente`);

--
-- Indices de la tabla `cvudocumentostrabajo`
--
ALTER TABLE `cvudocumentostrabajo`
  ADD PRIMARY KEY (`idCvuDocumentosTrabajo`),
  ADD KEY `idCvu` (`idCvu`),
  ADD KEY `idDocumentosTrabajo` (`idDocumentosTrabajo`);

--
-- Indices de la tabla `cvuestudiorealizados`
--
ALTER TABLE `cvuestudiorealizados`
  ADD PRIMARY KEY (`idCvuEstudioRealizados`),
  ADD KEY `idCvu` (`idCvu`),
  ADD KEY `idEstudioRealizados` (`idEstudioRealizados`);

--
-- Indices de la tabla `cvuexperiencia`
--
ALTER TABLE `cvuexperiencia`
  ADD PRIMARY KEY (`idCvuExperiencia`),
  ADD KEY `idCvu` (`idCvu`),
  ADD KEY `idExperienciaProfesional` (`idExperienciaProfesional`);

--
-- Indices de la tabla `cvugestionacademica`
--
ALTER TABLE `cvugestionacademica`
  ADD PRIMARY KEY (`idcvuGestion`),
  ADD KEY `idCvu` (`idCvu`),
  ADD KEY `idGestionAcademica` (`idGestionAcademica`);

--
-- Indices de la tabla `cvugrupoinvestigacion`
--
ALTER TABLE `cvugrupoinvestigacion`
  ADD PRIMARY KEY (`idCvuInvestigacionGrupo`),
  ADD KEY `idCvu` (`idCvu`),
  ADD KEY `idGrupoInvestigacion` (`idGrupoInvestigacion`);

--
-- Indices de la tabla `cvuinnovacion`
--
ALTER TABLE `cvuinnovacion`
  ADD PRIMARY KEY (`idCvuInnovacion`),
  ADD KEY `idCvu` (`idCvu`),
  ADD KEY `idInnovacion` (`idInnovacion`);

--
-- Indices de la tabla `cvuinvestigacion`
--
ALTER TABLE `cvuinvestigacion`
  ADD PRIMARY KEY (`idCvuInvestigacion`),
  ADD KEY `idCvu` (`idCvu`),
  ADD KEY `idRedesInvestigacion` (`idRedesInvestigacion`);

--
-- Indices de la tabla `cvulineas`
--
ALTER TABLE `cvulineas`
  ADD PRIMARY KEY (`idCvuLineas`),
  ADD KEY `idCvu` (`idCvu`),
  ADD KEY `idLineaGeneracion` (`idLineaGeneracion`);

--
-- Indices de la tabla `cvumemorias`
--
ALTER TABLE `cvumemorias`
  ADD PRIMARY KEY (`idCvuMemorias`),
  ADD KEY `idCvu` (`idCvu`),
  ADD KEY `idMemorias` (`idMemorias`);

--
-- Indices de la tabla `cvunoconacyt`
--
ALTER TABLE `cvunoconacyt`
  ADD PRIMARY KEY (`idCvuNoConacyt`),
  ADD KEY `idCvu` (`idCvu`),
  ADD KEY `idEvaluacionNoConacyt` (`idEvaluacionNoConacyt`);

--
-- Indices de la tabla `cvuotrosestudios`
--
ALTER TABLE `cvuotrosestudios`
  ADD PRIMARY KEY (`idCvuOtrosEstudios`),
  ADD KEY `idCvu` (`idCvu`),
  ADD KEY `idOtrosEstudios` (`idOtrosEstudios`);

--
-- Indices de la tabla `cvuparticipacionactualizacionprogeducativo`
--
ALTER TABLE `cvuparticipacionactualizacionprogeducativo`
  ADD PRIMARY KEY (`idcvuPartiActProgEduc`),
  ADD KEY `idCvu` (`idCvu`),
  ADD KEY `idPartiActProgEduc` (`idPartiActProgEduc`);

--
-- Indices de la tabla `cvuparticipacioncongreso`
--
ALTER TABLE `cvuparticipacioncongreso`
  ADD PRIMARY KEY (`idcvuPartiCongreso`),
  ADD KEY `idCvu` (`idCvu`),
  ADD KEY `idPartiCongreso` (`idPartiCongreso`);

--
-- Indices de la tabla `cvuparticipacioneventos`
--
ALTER TABLE `cvuparticipacioneventos`
  ADD PRIMARY KEY (`idCvuPartiEvento`),
  ADD KEY `idCvu` (`idCvu`),
  ADD KEY `idParticipacionEventos` (`idParticipacionEventos`);

--
-- Indices de la tabla `cvupatentes`
--
ALTER TABLE `cvupatentes`
  ADD PRIMARY KEY (`idCvuPatentes`),
  ADD KEY `idCvu` (`idCvu`),
  ADD KEY `idPatentes` (`idPatentes`);

--
-- Indices de la tabla `cvuproduccionarticulos`
--
ALTER TABLE `cvuproduccionarticulos`
  ADD PRIMARY KEY (`idCvuArticulos`),
  ADD KEY `idCvu` (`idCvu`),
  ADD KEY `idProduccionArticulos` (`idProduccionArticulos`);

--
-- Indices de la tabla `cvuproyectos`
--
ALTER TABLE `cvuproyectos`
  ADD PRIMARY KEY (`idCvuProyectos`),
  ADD KEY `idCvu` (`idCvu`),
  ADD KEY `idProyectosInvestigacion` (`idProyectosInvestigacion`);

--
-- Indices de la tabla `cvupublicaciondivulgacion`
--
ALTER TABLE `cvupublicaciondivulgacion`
  ADD PRIMARY KEY (`idCvuPublicacionDivulgacion`),
  ADD KEY `idCvu` (`idCvu`),
  ADD KEY `idPublicacionDivulgacion` (`idPublicacionDivulgacion`);

--
-- Indices de la tabla `cvureconocimientos`
--
ALTER TABLE `cvureconocimientos`
  ADD PRIMARY KEY (`idCvuReconocimientos`),
  ADD KEY `idCvu` (`idCvu`),
  ADD KEY `idReconocimientos` (`idReconocimientos`);

--
-- Indices de la tabla `cvutecnico`
--
ALTER TABLE `cvutecnico`
  ADD PRIMARY KEY (`idCvuTecnico`),
  ADD KEY `idCvu` (`idCvu`),
  ADD KEY `idReportesTecnicos` (`idReportesTecnicos`);

--
-- Indices de la tabla `cvutematicas`
--
ALTER TABLE `cvutematicas`
  ADD PRIMARY KEY (`idTematicasCvu`),
  ADD KEY `idCvu` (`idCvu`),
  ADD KEY `idRedesTematicas` (`idRedesTematicas`);

--
-- Indices de la tabla `cvutesis`
--
ALTER TABLE `cvutesis`
  ADD PRIMARY KEY (`idCvuTesis`),
  ADD KEY `idCvu` (`idCvu`),
  ADD KEY `idTesisRealizadas` (`idTesisDirigidas`);

--
-- Indices de la tabla `cvututorias`
--
ALTER TABLE `cvututorias`
  ADD PRIMARY KEY (`idCvuTutorias`),
  ADD KEY `idCvu` (`idCvu`),
  ADD KEY `idTutorias` (`idTutorias`);

--
-- Indices de la tabla `datosgenerales`
--
ALTER TABLE `datosgenerales`
  ADD PRIMARY KEY (`idDatosGenerales`),
  ADD KEY `idCvu` (`idCvu`),
  ADD KEY `idDomicinio` (`idDomicinio`),
  ADD KEY `idContacto` (`idContacto`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`idDepartamento`);

--
-- Indices de la tabla `desarrollologros`
--
ALTER TABLE `desarrollologros`
  ADD PRIMARY KEY (`idDesarrolloLogros`),
  ADD KEY `idDesarrollosTecnologicos` (`idDesarrollosTecnologicos`),
  ADD KEY `idLogros` (`idLogros`);

--
-- Indices de la tabla `desarrollosoftware`
--
ALTER TABLE `desarrollosoftware`
  ADD PRIMARY KEY (`idDesarrolloSoftware`);

--
-- Indices de la tabla `desarrollostecnologicos`
--
ALTER TABLE `desarrollostecnologicos`
  ADD PRIMARY KEY (`idDesarrollosTecnologicos`),
  ADD KEY `idAreaDisciplina` (`idAreaDisciplina`),
  ADD KEY `idSectorOcde` (`idSectorOcde`),
  ADD KEY `idSectorRama` (`idSectorRama`);

--
-- Indices de la tabla `descripcionproyecto`
--
ALTER TABLE `descripcionproyecto`
  ADD PRIMARY KEY (`idDescripcionProyecto`),
  ADD KEY `idProtocoloDescFK_idx` (`idProtocoloInvestigacion`),
  ADD KEY `idCampusFK_idx` (`idCampus`);

--
-- Indices de la tabla `diciplina`
--
ALTER TABLE `diciplina`
  ADD PRIMARY KEY (`idDiciplina`);

--
-- Indices de la tabla `diciplinasubdiciplina`
--
ALTER TABLE `diciplinasubdiciplina`
  ADD PRIMARY KEY (`idDiciplinaSub`);

--
-- Indices de la tabla `diciplinasubdisciplina`
--
ALTER TABLE `diciplinasubdisciplina`
  ADD PRIMARY KEY (`idDisciplinaSub`);

--
-- Indices de la tabla `dictamenconacyt`
--
ALTER TABLE `dictamenconacyt`
  ADD PRIMARY KEY (`idDictamenConacyt`);

--
-- Indices de la tabla `diplomasimpartidos`
--
ALTER TABLE `diplomasimpartidos`
  ADD PRIMARY KEY (`idDiplomasImpartidos`),
  ADD KEY `idAreaDisciplina` (`idAreaDisciplina`);

--
-- Indices de la tabla `distincionesconacyt`
--
ALTER TABLE `distincionesconacyt`
  ADD PRIMARY KEY (`idDistincionesConacyt`);

--
-- Indices de la tabla `distincionesnoconacyt`
--
ALTER TABLE `distincionesnoconacyt`
  ADD PRIMARY KEY (`idDistincionesNoConacyt`);

--
-- Indices de la tabla `divicionocde`
--
ALTER TABLE `divicionocde`
  ADD PRIMARY KEY (`idDivicionOcde`);

--
-- Indices de la tabla `divulgacionproductosobtenidos`
--
ALTER TABLE `divulgacionproductosobtenidos`
  ADD PRIMARY KEY (`idDivulgacionProductosObte`),
  ADD KEY `idPublicacionDivulgacion` (`idPublicacionDivulgacion`);

--
-- Indices de la tabla `docenciaactualmaterias`
--
ALTER TABLE `docenciaactualmaterias`
  ADD PRIMARY KEY (`idDocenciaActualMaterias`),
  ADD KEY `idNivelEstudio` (`idNivelEstudio`);

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`idDocumentos`),
  ADD KEY `idUsuarios` (`idUsuarios`);

--
-- Indices de la tabla `documentosadjuntos`
--
ALTER TABLE `documentosadjuntos`
  ADD PRIMARY KEY (`idDocumentosAdjuntos`);

--
-- Indices de la tabla `documentosproyecto`
--
ALTER TABLE `documentosproyecto`
  ADD PRIMARY KEY (`idDocumentosProyecto`),
  ADD KEY `idProtocoloFKDP_idx` (`idProtocoloInvestigacion`);

--
-- Indices de la tabla `documentostrabajo`
--
ALTER TABLE `documentostrabajo`
  ADD PRIMARY KEY (`idDocumentosTrabajo`);

--
-- Indices de la tabla `domicinio`
--
ALTER TABLE `domicinio`
  ADD PRIMARY KEY (`idDomicinio`),
  ADD KEY `idNumeroTipo` (`idNumeroTipo`);

--
-- Indices de la tabla `entregables`
--
ALTER TABLE `entregables`
  ADD PRIMARY KEY (`idEntregables`),
  ADD KEY `idSolicitudApoyo` (`idSolicitudApoyo`);

--
-- Indices de la tabla `estadocivil`
--
ALTER TABLE `estadocivil`
  ADD PRIMARY KEY (`idEstadoCivil`);

--
-- Indices de la tabla `estadotutorias`
--
ALTER TABLE `estadotutorias`
  ADD PRIMARY KEY (`idEstadoTutorias`);

--
-- Indices de la tabla `estanciasprofesionale`
--
ALTER TABLE `estanciasprofesionale`
  ADD PRIMARY KEY (`idEstanciasProfesionale`),
  ADD KEY `idAreaDisciplina` (`idAreaDisciplina`),
  ADD KEY `idTipoInstancia` (`idTipoInstancia`);

--
-- Indices de la tabla `estudiorealizados`
--
ALTER TABLE `estudiorealizados`
  ADD PRIMARY KEY (`idEstudioRealizados`),
  ADD KEY `idAreaDisciplina` (`idAreaDisciplina`),
  ADD KEY `idNivelEstudio` (`idNivelEstudio`),
  ADD KEY `idTipoInstituto` (`idTipoInstituto`);

--
-- Indices de la tabla `etapadesarrollo`
--
ALTER TABLE `etapadesarrollo`
  ADD PRIMARY KEY (`idEtapaDesarrollo`),
  ADD KEY `idOpcionesEtapa` (`idOpcionesEtapa`);

--
-- Indices de la tabla `etapadesarrollotecnologicos`
--
ALTER TABLE `etapadesarrollotecnologicos`
  ADD PRIMARY KEY (`idEtapaDesaTecnologico`),
  ADD KEY `idEtapaDesarrollo` (`idEtapaDesarrollo`),
  ADD KEY `idDesarrollosTecnologicos` (`idDesarrollosTecnologicos`);

--
-- Indices de la tabla `evaluacionconacyt`
--
ALTER TABLE `evaluacionconacyt`
  ADD PRIMARY KEY (`idEvaluacionConacyt`),
  ADD KEY `idDictamenConacyt` (`idDictamenConacyt`);

--
-- Indices de la tabla `evaluacionnoconacyt`
--
ALTER TABLE `evaluacionnoconacyt`
  ADD PRIMARY KEY (`idEvaluacionnoConacyt`),
  ADD KEY `idDictamenConacyt` (`idDictamenConacyt`),
  ADD KEY `idProductoEvaluado` (`idProductoEvaluado`),
  ADD KEY `idTipoEvaluacion` (`idTipoEvaluacion`);

--
-- Indices de la tabla `experienciadocente`
--
ALTER TABLE `experienciadocente`
  ADD PRIMARY KEY (`idExperienciaDocente`),
  ADD KEY `idTipoNivel` (`idTipoNivel`);

--
-- Indices de la tabla `experienciaprofesional`
--
ALTER TABLE `experienciaprofesional`
  ADD PRIMARY KEY (`idExperienciaProfesional`),
  ADD KEY `idActualAnterior` (`idActualAnterior`),
  ADD KEY `idEstanciasPprofesionale` (`idEstanciasProfesionale`),
  ADD KEY `idPuesto` (`idPuesto`);

--
-- Indices de la tabla `feddes`
--
ALTER TABLE `feddes`
  ADD PRIMARY KEY (`idFedDes`);

--
-- Indices de la tabla `financiamiento`
--
ALTER TABLE `financiamiento`
  ADD PRIMARY KEY (`idFinanciamiento`),
  ADD KEY `idSolicitudApoyo` (`idSolicitudApoyo`);

--
-- Indices de la tabla `formacioncontinua`
--
ALTER TABLE `formacioncontinua`
  ADD PRIMARY KEY (`idFormacion`);

--
-- Indices de la tabla `fuentefinanciamiento`
--
ALTER TABLE `fuentefinanciamiento`
  ADD PRIMARY KEY (`idFuenteFinciamineto`);

--
-- Indices de la tabla `gestionacademica`
--
ALTER TABLE `gestionacademica`
  ADD PRIMARY KEY (`idGestionAcademica`),
  ADD KEY `idGestionAprobado` (`idGestionAprobado`),
  ADD KEY `idGestionEstados` (`idGestionEstados`),
  ADD KEY `idGestionResultadosObte` (`idGestionResultadosObte`),
  ADD KEY `idTipoGestion` (`idTipoGestion`);

--
-- Indices de la tabla `gestionaprobado`
--
ALTER TABLE `gestionaprobado`
  ADD PRIMARY KEY (`idGestionAprobado`);

--
-- Indices de la tabla `gestionestados`
--
ALTER TABLE `gestionestados`
  ADD PRIMARY KEY (`idGestionEstados`);

--
-- Indices de la tabla `gestionresultadosobtenidos`
--
ALTER TABLE `gestionresultadosobtenidos`
  ADD PRIMARY KEY (`idGestionResultadosObte`);

--
-- Indices de la tabla `gradotesis`
--
ALTER TABLE `gradotesis`
  ADD PRIMARY KEY (`idGradoTesis`);

--
-- Indices de la tabla `grupoinvestigacion`
--
ALTER TABLE `grupoinvestigacion`
  ADD PRIMARY KEY (`idGrupoInvestigacion`),
  ADD KEY `idAreaDisciplina` (`idAreaDisciplina`);

--
-- Indices de la tabla `grupoinvestigacioncolaboradores`
--
ALTER TABLE `grupoinvestigacioncolaboradores`
  ADD PRIMARY KEY (`idgrupoinvestigacionColaboradores`),
  ADD KEY `idGrupoInvestigacion` (`idGrupoInvestigacion`),
  ADD KEY `idColaboradoresgrupoinvestigacion` (`idColaboradoresgrupoinvestigacion`);

--
-- Indices de la tabla `grupoocde`
--
ALTER TABLE `grupoocde`
  ADD PRIMARY KEY (`idGrupoOcde`);

--
-- Indices de la tabla `idiomas`
--
ALTER TABLE `idiomas`
  ADD PRIMARY KEY (`idIdiomas`);

--
-- Indices de la tabla `infraestructura`
--
ALTER TABLE `infraestructura`
  ADD PRIMARY KEY (`idInfraestructura`),
  ADD KEY `idProtocoloInvestigacion` (`idProtocoloInvestigacion`);

--
-- Indices de la tabla `innovacion`
--
ALTER TABLE `innovacion`
  ADD PRIMARY KEY (`idInnovacion`),
  ADD KEY `idAreaDisciplina` (`idAreaDisciplina`),
  ADD KEY `idSectorOcde` (`idSectorOcde`),
  ADD KEY `idSectorRama` (`idSectorRama`);

--
-- Indices de la tabla `instituciones`
--
ALTER TABLE `instituciones`
  ADD PRIMARY KEY (`idInstitucion`);

--
-- Indices de la tabla `institucionesfeddes`
--
ALTER TABLE `institucionesfeddes`
  ADD PRIMARY KEY (`idInstitucionFedDes`),
  ADD KEY `idInstirucion` (`idInstirucion`),
  ADD KEY `idFedDes` (`idFedDes`);

--
-- Indices de la tabla `institucionesprogramas`
--
ALTER TABLE `institucionesprogramas`
  ADD PRIMARY KEY (`idInstitucionPrograma`),
  ADD KEY `idPrograma` (`idPrograma`),
  ADD KEY `idInstitucion` (`idInstitucion`);

--
-- Indices de la tabla `investigacioncolaboratores`
--
ALTER TABLE `investigacioncolaboratores`
  ADD PRIMARY KEY (`idInvestigacionColaboratores`),
  ADD KEY `idRedesInvestigacion` (`idRedesInvestigacion`),
  ADD KEY `idColaboratoresInvestigacion` (`idColaboratoresInvestigacion`);

--
-- Indices de la tabla `lenguasindigenas`
--
ALTER TABLE `lenguasindigenas`
  ADD PRIMARY KEY (`idLenguasIndigenas`);

--
-- Indices de la tabla `ligaconvocatoriaproyecto`
--
ALTER TABLE `ligaconvocatoriaproyecto`
  ADD PRIMARY KEY (`idLigaConvocatoriaProyecto`),
  ADD KEY `idConvocatoriaFK_idx` (`idConvocatoria`),
  ADD KEY `idSolicitudApoyoFKLiga_idx` (`idSolicitudApoyo`);

--
-- Indices de la tabla `lineageneracion`
--
ALTER TABLE `lineageneracion`
  ADD PRIMARY KEY (`idLineaGeneracion`);

--
-- Indices de la tabla `lineainvestigacion`
--
ALTER TABLE `lineainvestigacion`
  ADD PRIMARY KEY (`idLineaInvestigacion`);

--
-- Indices de la tabla `lineas`
--
ALTER TABLE `lineas`
  ADD PRIMARY KEY (`idLinea`);

--
-- Indices de la tabla `lineascuerpoacademico`
--
ALTER TABLE `lineascuerpoacademico`
  ADD PRIMARY KEY (`idlineasCuerpoAcademico`);

--
-- Indices de la tabla `lineasinvconsolidar`
--
ALTER TABLE `lineasinvconsolidar`
  ADD PRIMARY KEY (`idLineasInvConsolidar`);

--
-- Indices de la tabla `logros`
--
ALTER TABLE `logros`
  ADD PRIMARY KEY (`idlogros`);

--
-- Indices de la tabla `lugardesarrollo`
--
ALTER TABLE `lugardesarrollo`
  ADD PRIMARY KEY (`idLugarDesarrollo`),
  ADD KEY `idProtocoloInvestigacion_idx` (`idProtocoloInstigacion`);

--
-- Indices de la tabla `mecanismodesarrollostecnologicos`
--
ALTER TABLE `mecanismodesarrollostecnologicos`
  ADD PRIMARY KEY (`idmecaDesaTecnologico`),
  ADD KEY `idDesarrollosTecnologicos` (`idDesarrollosTecnologicos`),
  ADD KEY `idMecanismoTranferencia` (`idMecanismoTranferencia`);

--
-- Indices de la tabla `mecanismotransferencia`
--
ALTER TABLE `mecanismotransferencia`
  ADD PRIMARY KEY (`idMecanismoTranferencia`);

--
-- Indices de la tabla `memorias`
--
ALTER TABLE `memorias`
  ADD PRIMARY KEY (`idMemorias`);

--
-- Indices de la tabla `niveldeestudio`
--
ALTER TABLE `niveldeestudio`
  ADD PRIMARY KEY (`idNivelEstudio`);

--
-- Indices de la tabla `niveltutorias`
--
ALTER TABLE `niveltutorias`
  ADD PRIMARY KEY (`idNivelTutorias`);

--
-- Indices de la tabla `nombredistincionconacyt`
--
ALTER TABLE `nombredistincionconacyt`
  ADD PRIMARY KEY (`idNombreDistincionConacyt`),
  ADD KEY `idReconocimientos` (`idReconocimientos`);

--
-- Indices de la tabla `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `numerotipo`
--
ALTER TABLE `numerotipo`
  ADD PRIMARY KEY (`idNumeroTipo`);

--
-- Indices de la tabla `objetivogeneral`
--
ALTER TABLE `objetivogeneral`
  ADD PRIMARY KEY (`idObjetivoGeneral`),
  ADD KEY `idSolicituApoyo` (`idSolicituApoyo`);

--
-- Indices de la tabla `objetivosespecificos`
--
ALTER TABLE `objetivosespecificos`
  ADD PRIMARY KEY (`idObjetivosEspecificos`),
  ADD UNIQUE KEY `idSolicitudApoyo_UNIQUE` (`idSolicitudApoyo`),
  ADD KEY `idSolicitudApoyo` (`idSolicitudApoyo`);

--
-- Indices de la tabla `opcionesetapa`
--
ALTER TABLE `opcionesetapa`
  ADD PRIMARY KEY (`idOpcionesEtapa`);

--
-- Indices de la tabla `orientacion`
--
ALTER TABLE `orientacion`
  ADD PRIMARY KEY (`idOrientacion`);

--
-- Indices de la tabla `origenreportetecnico`
--
ALTER TABLE `origenreportetecnico`
  ADD PRIMARY KEY (`idOrigenReporteTecnico`);

--
-- Indices de la tabla `otroestudios`
--
ALTER TABLE `otroestudios`
  ADD PRIMARY KEY (`idOtrosEstudios`),
  ADD KEY `idAreaDisciplina` (`idAreaDisciplina`),
  ADD KEY `idFormacion` (`idFormacion`);

--
-- Indices de la tabla `participacionactualizacionprogeducativo`
--
ALTER TABLE `participacionactualizacionprogeducativo`
  ADD PRIMARY KEY (`idParticipacionActualizacionEducativo`);

--
-- Indices de la tabla `participacioncongreso`
--
ALTER TABLE `participacioncongreso`
  ADD PRIMARY KEY (`idParticipacionCongreso`);

--
-- Indices de la tabla `participacioncongresocolaboradores`
--
ALTER TABLE `participacioncongresocolaboradores`
  ADD PRIMARY KEY (`idParticipacionCongresoColabora`),
  ADD KEY `idColaboradoresCongreso` (`idColaboradoresCongreso`),
  ADD KEY `idParticipacionCongreso` (`idParticipacionCongreso`);

--
-- Indices de la tabla `participacioneventos`
--
ALTER TABLE `participacioneventos`
  ADD PRIMARY KEY (`idParticipacionEventos`);

--
-- Indices de la tabla `participantestesis`
--
ALTER TABLE `participantestesis`
  ADD PRIMARY KEY (`idParticipantesTesis`),
  ADD KEY `idTesisDirigidas` (`idTesisDirigidas`),
  ADD KEY `idTesisParticipantes` (`idTesisParticipantes`);

--
-- Indices de la tabla `patenteautor`
--
ALTER TABLE `patenteautor`
  ADD PRIMARY KEY (`idPatenteAutor`),
  ADD KEY `idPatentes` (`idPatentes`),
  ADD KEY `idAutorPatente` (`idAutorPatente`);

--
-- Indices de la tabla `patentes`
--
ALTER TABLE `patentes`
  ADD PRIMARY KEY (`idPatentes`);

--
-- Indices de la tabla `plandetrabajo`
--
ALTER TABLE `plandetrabajo`
  ADD PRIMARY KEY (`idPlanDeTrabajo`),
  ADD KEY `idSolicitudApoyo_idx` (`idSolicitudApoyo`);

--
-- Indices de la tabla `presupuesto`
--
ALTER TABLE `presupuesto`
  ADD PRIMARY KEY (`idPresupuesto`),
  ADD KEY `idSolicitudApoyo` (`idSolicitudApoyo`);

--
-- Indices de la tabla `prodacademica`
--
ALTER TABLE `prodacademica`
  ADD PRIMARY KEY (`idProdAcademica`),
  ADD KEY `idEntregables` (`idEntregables`);

--
-- Indices de la tabla `produccionarticulos`
--
ALTER TABLE `produccionarticulos`
  ADD PRIMARY KEY (`idProduccionArticulos`),
  ADD KEY `idAreaDisciplina` (`idAreaDisciplina`);

--
-- Indices de la tabla `productoevaluado`
--
ALTER TABLE `productoevaluado`
  ADD PRIMARY KEY (`idProductoEvaluado`);

--
-- Indices de la tabla `programainvconsolidar`
--
ALTER TABLE `programainvconsolidar`
  ADD PRIMARY KEY (`idProgramaInvConsolidar`);

--
-- Indices de la tabla `programalineacuerpoacademico`
--
ALTER TABLE `programalineacuerpoacademico`
  ADD PRIMARY KEY (`idProgramaLineaCuerpoAcademico`),
  ADD KEY `idProgramaCuerpo_idx` (`idProgramaCuerpoAcademico`),
  ADD KEY `idLineaCuerpo_idx` (`idLineaCuerpoAcademico`);

--
-- Indices de la tabla `programalineainvconsolidar`
--
ALTER TABLE `programalineainvconsolidar`
  ADD PRIMARY KEY (`idProgramaLineaInvConsolidar`),
  ADD KEY `idProgramaInv_idx` (`idProgramaInvConsolidar`),
  ADD KEY `idLineaInv_idx` (`idLineaInvConsolidar`);

--
-- Indices de la tabla `programaorientacion`
--
ALTER TABLE `programaorientacion`
  ADD PRIMARY KEY (`idProgramaOrientacion`),
  ADD KEY `idPrograma` (`idPrograma`),
  ADD KEY `idOrientacion` (`idOrientacion`);

--
-- Indices de la tabla `programas`
--
ALTER TABLE `programas`
  ADD PRIMARY KEY (`idPrograma`);

--
-- Indices de la tabla `programascuerpoacademico`
--
ALTER TABLE `programascuerpoacademico`
  ADD PRIMARY KEY (`idProgramasCuerpoAcademico`);

--
-- Indices de la tabla `programlineas`
--
ALTER TABLE `programlineas`
  ADD PRIMARY KEY (`idProgramLinea`),
  ADD KEY `idPrograma` (`idPrograma`),
  ADD KEY `idLinea` (`idLinea`);

--
-- Indices de la tabla `protocolodocs`
--
ALTER TABLE `protocolodocs`
  ADD PRIMARY KEY (`idProtocoloDocs`),
  ADD KEY `idDocumentosAdjuntos` (`idDocumentosAdjuntos`),
  ADD KEY `idProtocoloInvestigacion` (`idProtocoloInvestigacion`);

--
-- Indices de la tabla `protocoloinvestigacion`
--
ALTER TABLE `protocoloinvestigacion`
  ADD PRIMARY KEY (`idProtocoloInvestigacion`),
  ADD KEY `idSolicitudApoyo_idx` (`idSolicitudApoyo`);

--
-- Indices de la tabla `proyectoscolaboradores`
--
ALTER TABLE `proyectoscolaboradores`
  ADD PRIMARY KEY (`idProyectosColaboratores`),
  ADD KEY `idColaboratoresProyectos` (`idColaboratoresProyectos`),
  ADD KEY `idProyectosInvestigacion` (`idProyectosInvestigacion`);

--
-- Indices de la tabla `proyectosinvestigacion`
--
ALTER TABLE `proyectosinvestigacion`
  ADD PRIMARY KEY (`idProyectosInvestigacion`),
  ADD KEY `idAreaDisciplina` (`idAreaDisciplina`),
  ADD KEY `idCurriculumCa` (`idCurriculumCa`),
  ADD KEY `idFuenteFinciamineto` (`idFuenteFinciamineto`),
  ADD KEY `idLineaInvestigacion` (`idLineaInvestigacion`),
  ADD KEY `idResultadosInvestigacion` (`idResultadosInvestigacion`),
  ADD KEY `idTipoPatrocinador` (`idTipoPatrocinador`),
  ADD KEY `idTipoProyecto` (`idTipoProyecto`);

--
-- Indices de la tabla `proyectostrabajados`
--
ALTER TABLE `proyectostrabajados`
  ADD PRIMARY KEY (`idProyectosTrabajados`),
  ADD KEY `idFuenteFinanciacion` (`idFuenteFinanciacion`);

--
-- Indices de la tabla `publicaciondivulgacion`
--
ALTER TABLE `publicaciondivulgacion`
  ADD PRIMARY KEY (`idPublicacionDivulgacion`),
  ADD KEY `idTipoDivulgacionDifusion` (`idTipoDivulgacionDifusion`),
  ADD KEY `idTipoEvento` (`idTipoEvento`),
  ADD KEY `idTipoParticipacion` (`idTipoParticipacion`);

--
-- Indices de la tabla `ramascian`
--
ALTER TABLE `ramascian`
  ADD PRIMARY KEY (`idRamaScian`);

--
-- Indices de la tabla `ramasubramascian`
--
ALTER TABLE `ramasubramascian`
  ADD PRIMARY KEY (`idRamasubramaScian`),
  ADD KEY `idClaseScian` (`idClaseScian`),
  ADD KEY `idRamaScian` (`idRamaScian`),
  ADD KEY `idSubramaScian` (`idSubramaScian`);

--
-- Indices de la tabla `reconocimientos`
--
ALTER TABLE `reconocimientos`
  ADD PRIMARY KEY (`idReconocimientos`),
  ADD KEY `idTipoReconocimiento` (`idTipoReconocimiento`),
  ADD KEY `idRelacionConacyt` (`idRelacionConacyt`);

--
-- Indices de la tabla `redescolaboradores`
--
ALTER TABLE `redescolaboradores`
  ADD PRIMARY KEY (`idRedesColaboratores`),
  ADD KEY `idColaboradoresRedes` (`idColaboradoresRedes`),
  ADD KEY `idRedesTematicas` (`idRedesTematicas`);

--
-- Indices de la tabla `redesinvestigacion`
--
ALTER TABLE `redesinvestigacion`
  ADD PRIMARY KEY (`idRedesInvestigacion`),
  ADD KEY `idAreaDisciplina` (`idAreaDisciplina`);

--
-- Indices de la tabla `redestematicas`
--
ALTER TABLE `redestematicas`
  ADD PRIMARY KEY (`idRedesTematicas`),
  ADD KEY `idTipoTedesTematicas` (`idTipoTedesTematicas`);

--
-- Indices de la tabla `referencias`
--
ALTER TABLE `referencias`
  ADD PRIMARY KEY (`idReferencias`),
  ADD KEY `idprotocoloInvestigacionRef_idx` (`idProtocoloInvestigacion`);

--
-- Indices de la tabla `relacionconacyt`
--
ALTER TABLE `relacionconacyt`
  ADD PRIMARY KEY (`idRelacionConacyt`);

--
-- Indices de la tabla `reportestecnicos`
--
ALTER TABLE `reportestecnicos`
  ADD PRIMARY KEY (`idReportesTecnicos`),
  ADD KEY `idOrigenReporteTecnico` (`idOrigenReporteTecnico`);

--
-- Indices de la tabla `reportestecnicosautor`
--
ALTER TABLE `reportestecnicosautor`
  ADD PRIMARY KEY (`idReportesTecnicosAutor`),
  ADD KEY `idReportesTecnicos` (`idReportesTecnicos`);

--
-- Indices de la tabla `resultadosinvestigacion`
--
ALTER TABLE `resultadosinvestigacion`
  ADD PRIMARY KEY (`idResultadosInvestigacion`);

--
-- Indices de la tabla `sectorocde`
--
ALTER TABLE `sectorocde`
  ADD PRIMARY KEY (`idSectorOcde`),
  ADD KEY `idClaseOcde` (`idClaseOcde`),
  ADD KEY `idGrupoOcde` (`idGrupoOcde`),
  ADD KEY `idDivicionOcde` (`idDivicionOcde`);

--
-- Indices de la tabla `sectorrama`
--
ALTER TABLE `sectorrama`
  ADD PRIMARY KEY (`idSectorRama`),
  ADD KEY `idRamaSubramaScian` (`idRamaSubramaScian`),
  ADD KEY `idSectorSubsectorScian` (`idSectorSubsectorScian`);

--
-- Indices de la tabla `sectorscian`
--
ALTER TABLE `sectorscian`
  ADD PRIMARY KEY (`idSectorScian`);

--
-- Indices de la tabla `sectorsubsectorscian`
--
ALTER TABLE `sectorsubsectorscian`
  ADD PRIMARY KEY (`idSectorSubsectorScian`),
  ADD KEY `idSectorScian` (`idSectorScian`),
  ADD KEY `idSubsectorScian` (`idSubsectorScian`);

--
-- Indices de la tabla `solicitudapoyo`
--
ALTER TABLE `solicitudapoyo`
  ADD PRIMARY KEY (`idSolicitudApoyo`),
  ADD KEY `idLinea` (`idLinea`),
  ADD KEY `idPrograma` (`idPrograma`),
  ADD KEY `idTipoInvestigacion` (`idTipoInvestigacion`),
  ADD KEY `solicitudapoyo_ibfk_6_idx` (`idProgramaInv`),
  ADD KEY `solicitudapoyo_ibfk_7_idx` (`idLineaInv`),
  ADD KEY `solicitudapoyo_ibfk_8_idx` (`idProgramaCuerpo`),
  ADD KEY `solicitudapoyo_ibfk_9_idx` (`idLineaCuerpo`),
  ADD KEY `idInvestigadorFK_idx` (`idInvestigador`),
  ADD KEY `idCuerpoAcademicoFK_idx` (`idCuerpoAcademico`),
  ADD KEY `idInstitucionFK_idx` (`idInstitucion`);

--
-- Indices de la tabla `subdiciplina`
--
ALTER TABLE `subdiciplina`
  ADD PRIMARY KEY (`idSubDiciplina`);

--
-- Indices de la tabla `subdisciplina`
--
ALTER TABLE `subdisciplina`
  ADD PRIMARY KEY (`idSubDisciplina`);

--
-- Indices de la tabla `subramascian`
--
ALTER TABLE `subramascian`
  ADD PRIMARY KEY (`idSubramaScian`);

--
-- Indices de la tabla `subsectorscian`
--
ALTER TABLE `subsectorscian`
  ADD PRIMARY KEY (`idSubsectorScian`);

--
-- Indices de la tabla `tecnicoautor`
--
ALTER TABLE `tecnicoautor`
  ADD PRIMARY KEY (`idTecnicoAutor`),
  ADD KEY `idReportesTecnicos` (`idReportesTecnicos`);

--
-- Indices de la tabla `tesisdirigidas`
--
ALTER TABLE `tesisdirigidas`
  ADD PRIMARY KEY (`idTesisDirigidas`),
  ADD KEY `idAreaDisciplina` (`idAreaDisciplina`),
  ADD KEY `idgradoTesis` (`idgradoTesis`),
  ADD KEY `idTipoProgramaPnpc` (`idTipoProgramaPnpc`);

--
-- Indices de la tabla `tesisparticipantes`
--
ALTER TABLE `tesisparticipantes`
  ADD PRIMARY KEY (`idTesisParticipantes`);

--
-- Indices de la tabla `tipocontacto`
--
ALTER TABLE `tipocontacto`
  ADD PRIMARY KEY (`idTipoContacto`);

--
-- Indices de la tabla `tipodivulgaciondifusion`
--
ALTER TABLE `tipodivulgaciondifusion`
  ADD PRIMARY KEY (`idTipoDivulgacionDifusion`);

--
-- Indices de la tabla `tipoevaluacion`
--
ALTER TABLE `tipoevaluacion`
  ADD PRIMARY KEY (`idTipoEvaluacion`);

--
-- Indices de la tabla `tipoevento`
--
ALTER TABLE `tipoevento`
  ADD PRIMARY KEY (`idTipoEvento`);

--
-- Indices de la tabla `tipogestion`
--
ALTER TABLE `tipogestion`
  ADD PRIMARY KEY (`idTipoGestion`);

--
-- Indices de la tabla `tipoinstancia`
--
ALTER TABLE `tipoinstancia`
  ADD PRIMARY KEY (`idTipoInstancia`);

--
-- Indices de la tabla `tipoinstituto`
--
ALTER TABLE `tipoinstituto`
  ADD PRIMARY KEY (`idTipoInstituto`);

--
-- Indices de la tabla `tipoinvestigacion`
--
ALTER TABLE `tipoinvestigacion`
  ADD PRIMARY KEY (`idTipoInvestigacion`);

--
-- Indices de la tabla `tipomembresia`
--
ALTER TABLE `tipomembresia`
  ADD PRIMARY KEY (`idTipoMenbresia`);

--
-- Indices de la tabla `tiponivel`
--
ALTER TABLE `tiponivel`
  ADD PRIMARY KEY (`idTipoNivel`);

--
-- Indices de la tabla `tiponumero`
--
ALTER TABLE `tiponumero`
  ADD PRIMARY KEY (`idTipoNumero`);

--
-- Indices de la tabla `tipoparticipacion`
--
ALTER TABLE `tipoparticipacion`
  ADD PRIMARY KEY (`idTipoParticipacion`);

--
-- Indices de la tabla `tipoparticipacioncongreso`
--
ALTER TABLE `tipoparticipacioncongreso`
  ADD PRIMARY KEY (`idTipoParticipacionCongreso`);

--
-- Indices de la tabla `tipopatrocinador`
--
ALTER TABLE `tipopatrocinador`
  ADD PRIMARY KEY (`idTipoPatrocinador`);

--
-- Indices de la tabla `tipoprogramapnpc`
--
ALTER TABLE `tipoprogramapnpc`
  ADD PRIMARY KEY (`idTipoProgramaPnpc`);

--
-- Indices de la tabla `tipoproyecto`
--
ALTER TABLE `tipoproyecto`
  ADD PRIMARY KEY (`idTipoProyecto`);

--
-- Indices de la tabla `tipopuesto`
--
ALTER TABLE `tipopuesto`
  ADD PRIMARY KEY (`idTipoPuesto`);

--
-- Indices de la tabla `tiporeconocimiento`
--
ALTER TABLE `tiporeconocimiento`
  ADD PRIMARY KEY (`idTipoReconocimiento`);

--
-- Indices de la tabla `tiporedestematicas`
--
ALTER TABLE `tiporedestematicas`
  ADD PRIMARY KEY (`idTipoRedesTematicas`);

--
-- Indices de la tabla `tipotutorias`
--
ALTER TABLE `tipotutorias`
  ADD PRIMARY KEY (`idTipoTutorias`);

--
-- Indices de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  ADD PRIMARY KEY (`idTipoUsuario`);

--
-- Indices de la tabla `tutorias`
--
ALTER TABLE `tutorias`
  ADD PRIMARY KEY (`idTutorias`),
  ADD KEY `idEstadoTutorias` (`idEstadoTutorias`),
  ADD KEY `idNivelTutorias` (`idNivelTutorias`),
  ADD KEY `idTipoTutorias` (`idTipoTutorias`),
  ADD KEY `idTutoriasGrupanIndi` (`idTutoriasGrupanIndi`);

--
-- Indices de la tabla `tutoriasgrupanindi`
--
ALTER TABLE `tutoriasgrupanindi`
  ADD PRIMARY KEY (`idTutoriasGrupanIndi`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuarios`),
  ADD KEY `idTipoUsuario` (`idTipoUsuario`),
  ADD KEY `idEstadoCivil` (`idEstadoCivil`);

--
-- Indices de la tabla `vinculacion`
--
ALTER TABLE `vinculacion`
  ADD PRIMARY KEY (`idVinculacion`),
  ADD KEY `vinculacion_ibfk_1_idx` (`idProtocoloInvestigacion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
  MODIFY `idActividades` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `actividadesdirecciontesis`
--
ALTER TABLE `actividadesdirecciontesis`
  MODIFY `idActividadesDireccionTesis` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `actividadesdocencia`
--
ALTER TABLE `actividadesdocencia`
  MODIFY `idActividadesDocencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `actividadesgestionacademica`
--
ALTER TABLE `actividadesgestionacademica`
  MODIFY `idActividadesGestionAcademica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `actividadesinvestigacion`
--
ALTER TABLE `actividadesinvestigacion`
  MODIFY `idActividadesInvestigacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `actividadestutoria`
--
ALTER TABLE `actividadestutoria`
  MODIFY `idActividadesTutoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `actualanterior`
--
ALTER TABLE `actualanterior`
  MODIFY `idActualAnterior` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `alumnosincorporados`
--
ALTER TABLE `alumnosincorporados`
  MODIFY `idAlumnosIncorporados` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `alumnosresidentes`
--
ALTER TABLE `alumnosresidentes`
  MODIFY `idAlumnosResidentes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `area`
--
ALTER TABLE `area`
  MODIFY `idArea` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `areadiciplinas`
--
ALTER TABLE `areadiciplinas`
  MODIFY `idAreaDiciplina` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `areadisciplinas`
--
ALTER TABLE `areadisciplinas`
  MODIFY `idAreaDisciplina` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `asociaciones`
--
ALTER TABLE `asociaciones`
  MODIFY `idAsociaciones` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `autorpatente`
--
ALTER TABLE `autorpatente`
  MODIFY `idAutorPatente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `autortecnico`
--
ALTER TABLE `autortecnico`
  MODIFY `idAutorTecnico` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `campo`
--
ALTER TABLE `campo`
  MODIFY `idCampo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `campus`
--
ALTER TABLE `campus`
  MODIFY `idCampus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `campusdepartamento`
--
ALTER TABLE `campusdepartamento`
  MODIFY `idCampusDepartamento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `capitulospublicados`
--
ALTER TABLE `capitulospublicados`
  MODIFY `idCapitulosPublicados` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `claseocde`
--
ALTER TABLE `claseocde`
  MODIFY `idClaseOcde` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clasescian`
--
ALTER TABLE `clasescian`
  MODIFY `idClaseScian` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `colaboradores`
--
ALTER TABLE `colaboradores`
  MODIFY `idColaborador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `colaboradoresactividades`
--
ALTER TABLE `colaboradoresactividades`
  MODIFY `idColaboradoresActividades` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `colaboradorescongreso`
--
ALTER TABLE `colaboradorescongreso`
  MODIFY `idColaboradoresCongreso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `colaboradoresgrupoinvestigacion`
--
ALTER TABLE `colaboradoresgrupoinvestigacion`
  MODIFY `idColaboradoresgrupoinvestigacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `colaboradoresredes`
--
ALTER TABLE `colaboradoresredes`
  MODIFY `idColaboradoresRedes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `colaboratoresinvestigacion`
--
ALTER TABLE `colaboratoresinvestigacion`
  MODIFY `idColaboratoresInvestigacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `colaboratoresproyectos`
--
ALTER TABLE `colaboratoresproyectos`
  MODIFY `idColaboratoresProyectos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `idContacto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contribucion`
--
ALTER TABLE `contribucion`
  MODIFY `idContribucion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `convocatorias`
--
ALTER TABLE `convocatorias`
  MODIFY `idConvocatoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cuerpoacademico`
--
ALTER TABLE `cuerpoacademico`
  MODIFY `idcuerpoAcademico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `curriculumca`
--
ALTER TABLE `curriculumca`
  MODIFY `idCurriculumCa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cursoimpartido`
--
ALTER TABLE `cursoimpartido`
  MODIFY `idCursoImpartido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cvu`
--
ALTER TABLE `cvu`
  MODIFY `idCvu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cvuasociones`
--
ALTER TABLE `cvuasociones`
  MODIFY `idCvuAsociaciones` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cvucapitulospublicados`
--
ALTER TABLE `cvucapitulospublicados`
  MODIFY `idCvuCapitulosPublicados` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cvuconacyt`
--
ALTER TABLE `cvuconacyt`
  MODIFY `idCvuConacyt` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cvucuerpoacademico`
--
ALTER TABLE `cvucuerpoacademico`
  MODIFY `idCvuCuerpoAcademico` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cvucursoimpartido`
--
ALTER TABLE `cvucursoimpartido`
  MODIFY `idCvuCursoImpartido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cvudesarrollosoftware`
--
ALTER TABLE `cvudesarrollosoftware`
  MODIFY `idCvuDesarrolloSoftware` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cvudesarrollostecnologicos`
--
ALTER TABLE `cvudesarrollostecnologicos`
  MODIFY `idCvuDesarrollosTecnologicos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cvudiplomasimpartidos`
--
ALTER TABLE `cvudiplomasimpartidos`
  MODIFY `idCvuDiplomasImpartidos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cvudocenciaactual`
--
ALTER TABLE `cvudocenciaactual`
  MODIFY `idCvuDocenciaActual` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cvudocente`
--
ALTER TABLE `cvudocente`
  MODIFY `idCvuDocente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cvudocumentostrabajo`
--
ALTER TABLE `cvudocumentostrabajo`
  MODIFY `idCvuDocumentosTrabajo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cvuestudiorealizados`
--
ALTER TABLE `cvuestudiorealizados`
  MODIFY `idCvuEstudioRealizados` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cvuexperiencia`
--
ALTER TABLE `cvuexperiencia`
  MODIFY `idCvuExperiencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cvugestionacademica`
--
ALTER TABLE `cvugestionacademica`
  MODIFY `idcvuGestion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cvugrupoinvestigacion`
--
ALTER TABLE `cvugrupoinvestigacion`
  MODIFY `idCvuInvestigacionGrupo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cvuinnovacion`
--
ALTER TABLE `cvuinnovacion`
  MODIFY `idCvuInnovacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cvuinvestigacion`
--
ALTER TABLE `cvuinvestigacion`
  MODIFY `idCvuInvestigacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cvulineas`
--
ALTER TABLE `cvulineas`
  MODIFY `idCvuLineas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cvumemorias`
--
ALTER TABLE `cvumemorias`
  MODIFY `idCvuMemorias` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cvunoconacyt`
--
ALTER TABLE `cvunoconacyt`
  MODIFY `idCvuNoConacyt` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cvuotrosestudios`
--
ALTER TABLE `cvuotrosestudios`
  MODIFY `idCvuOtrosEstudios` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cvuparticipacionactualizacionprogeducativo`
--
ALTER TABLE `cvuparticipacionactualizacionprogeducativo`
  MODIFY `idcvuPartiActProgEduc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cvuparticipacioncongreso`
--
ALTER TABLE `cvuparticipacioncongreso`
  MODIFY `idcvuPartiCongreso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cvuparticipacioneventos`
--
ALTER TABLE `cvuparticipacioneventos`
  MODIFY `idCvuPartiEvento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cvupatentes`
--
ALTER TABLE `cvupatentes`
  MODIFY `idCvuPatentes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cvuproduccionarticulos`
--
ALTER TABLE `cvuproduccionarticulos`
  MODIFY `idCvuArticulos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cvuproyectos`
--
ALTER TABLE `cvuproyectos`
  MODIFY `idCvuProyectos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cvupublicaciondivulgacion`
--
ALTER TABLE `cvupublicaciondivulgacion`
  MODIFY `idCvuPublicacionDivulgacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cvureconocimientos`
--
ALTER TABLE `cvureconocimientos`
  MODIFY `idCvuReconocimientos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cvutecnico`
--
ALTER TABLE `cvutecnico`
  MODIFY `idCvuTecnico` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cvutematicas`
--
ALTER TABLE `cvutematicas`
  MODIFY `idTematicasCvu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cvutesis`
--
ALTER TABLE `cvutesis`
  MODIFY `idCvuTesis` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cvututorias`
--
ALTER TABLE `cvututorias`
  MODIFY `idCvuTutorias` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `datosgenerales`
--
ALTER TABLE `datosgenerales`
  MODIFY `idDatosGenerales` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `idDepartamento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `desarrollologros`
--
ALTER TABLE `desarrollologros`
  MODIFY `idDesarrolloLogros` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `desarrollosoftware`
--
ALTER TABLE `desarrollosoftware`
  MODIFY `idDesarrolloSoftware` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `desarrollostecnologicos`
--
ALTER TABLE `desarrollostecnologicos`
  MODIFY `idDesarrollosTecnologicos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `descripcionproyecto`
--
ALTER TABLE `descripcionproyecto`
  MODIFY `idDescripcionProyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `diciplina`
--
ALTER TABLE `diciplina`
  MODIFY `idDiciplina` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `diciplinasubdiciplina`
--
ALTER TABLE `diciplinasubdiciplina`
  MODIFY `idDiciplinaSub` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `diciplinasubdisciplina`
--
ALTER TABLE `diciplinasubdisciplina`
  MODIFY `idDisciplinaSub` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dictamenconacyt`
--
ALTER TABLE `dictamenconacyt`
  MODIFY `idDictamenConacyt` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `diplomasimpartidos`
--
ALTER TABLE `diplomasimpartidos`
  MODIFY `idDiplomasImpartidos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `distincionesconacyt`
--
ALTER TABLE `distincionesconacyt`
  MODIFY `idDistincionesConacyt` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `distincionesnoconacyt`
--
ALTER TABLE `distincionesnoconacyt`
  MODIFY `idDistincionesNoConacyt` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `divicionocde`
--
ALTER TABLE `divicionocde`
  MODIFY `idDivicionOcde` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `divulgacionproductosobtenidos`
--
ALTER TABLE `divulgacionproductosobtenidos`
  MODIFY `idDivulgacionProductosObte` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `docenciaactualmaterias`
--
ALTER TABLE `docenciaactualmaterias`
  MODIFY `idDocenciaActualMaterias` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `documentos`
--
ALTER TABLE `documentos`
  MODIFY `idDocumentos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `documentosadjuntos`
--
ALTER TABLE `documentosadjuntos`
  MODIFY `idDocumentosAdjuntos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `documentosproyecto`
--
ALTER TABLE `documentosproyecto`
  MODIFY `idDocumentosProyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `documentostrabajo`
--
ALTER TABLE `documentostrabajo`
  MODIFY `idDocumentosTrabajo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `domicinio`
--
ALTER TABLE `domicinio`
  MODIFY `idDomicinio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `entregables`
--
ALTER TABLE `entregables`
  MODIFY `idEntregables` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `estadocivil`
--
ALTER TABLE `estadocivil`
  MODIFY `idEstadoCivil` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estadotutorias`
--
ALTER TABLE `estadotutorias`
  MODIFY `idEstadoTutorias` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estanciasprofesionale`
--
ALTER TABLE `estanciasprofesionale`
  MODIFY `idEstanciasProfesionale` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estudiorealizados`
--
ALTER TABLE `estudiorealizados`
  MODIFY `idEstudioRealizados` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `etapadesarrollo`
--
ALTER TABLE `etapadesarrollo`
  MODIFY `idEtapaDesarrollo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `etapadesarrollotecnologicos`
--
ALTER TABLE `etapadesarrollotecnologicos`
  MODIFY `idEtapaDesaTecnologico` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `evaluacionconacyt`
--
ALTER TABLE `evaluacionconacyt`
  MODIFY `idEvaluacionConacyt` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `evaluacionnoconacyt`
--
ALTER TABLE `evaluacionnoconacyt`
  MODIFY `idEvaluacionnoConacyt` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `experienciadocente`
--
ALTER TABLE `experienciadocente`
  MODIFY `idExperienciaDocente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `experienciaprofesional`
--
ALTER TABLE `experienciaprofesional`
  MODIFY `idExperienciaProfesional` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `feddes`
--
ALTER TABLE `feddes`
  MODIFY `idFedDes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `financiamiento`
--
ALTER TABLE `financiamiento`
  MODIFY `idFinanciamiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `formacioncontinua`
--
ALTER TABLE `formacioncontinua`
  MODIFY `idFormacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `fuentefinanciamiento`
--
ALTER TABLE `fuentefinanciamiento`
  MODIFY `idFuenteFinciamineto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gestionacademica`
--
ALTER TABLE `gestionacademica`
  MODIFY `idGestionAcademica` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gestionaprobado`
--
ALTER TABLE `gestionaprobado`
  MODIFY `idGestionAprobado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gestionestados`
--
ALTER TABLE `gestionestados`
  MODIFY `idGestionEstados` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gestionresultadosobtenidos`
--
ALTER TABLE `gestionresultadosobtenidos`
  MODIFY `idGestionResultadosObte` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gradotesis`
--
ALTER TABLE `gradotesis`
  MODIFY `idGradoTesis` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `grupoinvestigacion`
--
ALTER TABLE `grupoinvestigacion`
  MODIFY `idGrupoInvestigacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `grupoinvestigacioncolaboradores`
--
ALTER TABLE `grupoinvestigacioncolaboradores`
  MODIFY `idgrupoinvestigacionColaboradores` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `grupoocde`
--
ALTER TABLE `grupoocde`
  MODIFY `idGrupoOcde` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `idiomas`
--
ALTER TABLE `idiomas`
  MODIFY `idIdiomas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `infraestructura`
--
ALTER TABLE `infraestructura`
  MODIFY `idInfraestructura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `innovacion`
--
ALTER TABLE `innovacion`
  MODIFY `idInnovacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `instituciones`
--
ALTER TABLE `instituciones`
  MODIFY `idInstitucion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `institucionesfeddes`
--
ALTER TABLE `institucionesfeddes`
  MODIFY `idInstitucionFedDes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `institucionesprogramas`
--
ALTER TABLE `institucionesprogramas`
  MODIFY `idInstitucionPrograma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `investigacioncolaboratores`
--
ALTER TABLE `investigacioncolaboratores`
  MODIFY `idInvestigacionColaboratores` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lenguasindigenas`
--
ALTER TABLE `lenguasindigenas`
  MODIFY `idLenguasIndigenas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ligaconvocatoriaproyecto`
--
ALTER TABLE `ligaconvocatoriaproyecto`
  MODIFY `idLigaConvocatoriaProyecto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lineageneracion`
--
ALTER TABLE `lineageneracion`
  MODIFY `idLineaGeneracion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lineainvestigacion`
--
ALTER TABLE `lineainvestigacion`
  MODIFY `idLineaInvestigacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `lineas`
--
ALTER TABLE `lineas`
  MODIFY `idLinea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `lineascuerpoacademico`
--
ALTER TABLE `lineascuerpoacademico`
  MODIFY `idlineasCuerpoAcademico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `lineasinvconsolidar`
--
ALTER TABLE `lineasinvconsolidar`
  MODIFY `idLineasInvConsolidar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `logros`
--
ALTER TABLE `logros`
  MODIFY `idlogros` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lugardesarrollo`
--
ALTER TABLE `lugardesarrollo`
  MODIFY `idLugarDesarrollo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `mecanismodesarrollostecnologicos`
--
ALTER TABLE `mecanismodesarrollostecnologicos`
  MODIFY `idmecaDesaTecnologico` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mecanismotransferencia`
--
ALTER TABLE `mecanismotransferencia`
  MODIFY `idMecanismoTranferencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `memorias`
--
ALTER TABLE `memorias`
  MODIFY `idMemorias` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `niveldeestudio`
--
ALTER TABLE `niveldeestudio`
  MODIFY `idNivelEstudio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `niveltutorias`
--
ALTER TABLE `niveltutorias`
  MODIFY `idNivelTutorias` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `nombredistincionconacyt`
--
ALTER TABLE `nombredistincionconacyt`
  MODIFY `idNombreDistincionConacyt` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `numerotipo`
--
ALTER TABLE `numerotipo`
  MODIFY `idNumeroTipo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `objetivogeneral`
--
ALTER TABLE `objetivogeneral`
  MODIFY `idObjetivoGeneral` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `objetivosespecificos`
--
ALTER TABLE `objetivosespecificos`
  MODIFY `idObjetivosEspecificos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `opcionesetapa`
--
ALTER TABLE `opcionesetapa`
  MODIFY `idOpcionesEtapa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `orientacion`
--
ALTER TABLE `orientacion`
  MODIFY `idOrientacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `origenreportetecnico`
--
ALTER TABLE `origenreportetecnico`
  MODIFY `idOrigenReporteTecnico` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `otroestudios`
--
ALTER TABLE `otroestudios`
  MODIFY `idOtrosEstudios` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `participacionactualizacionprogeducativo`
--
ALTER TABLE `participacionactualizacionprogeducativo`
  MODIFY `idParticipacionActualizacionEducativo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `participacioncongreso`
--
ALTER TABLE `participacioncongreso`
  MODIFY `idParticipacionCongreso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `participacioncongresocolaboradores`
--
ALTER TABLE `participacioncongresocolaboradores`
  MODIFY `idParticipacionCongresoColabora` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `participacioneventos`
--
ALTER TABLE `participacioneventos`
  MODIFY `idParticipacionEventos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `participantestesis`
--
ALTER TABLE `participantestesis`
  MODIFY `idParticipantesTesis` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `patenteautor`
--
ALTER TABLE `patenteautor`
  MODIFY `idPatenteAutor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `patentes`
--
ALTER TABLE `patentes`
  MODIFY `idPatentes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `plandetrabajo`
--
ALTER TABLE `plandetrabajo`
  MODIFY `idPlanDeTrabajo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `presupuesto`
--
ALTER TABLE `presupuesto`
  MODIFY `idPresupuesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `prodacademica`
--
ALTER TABLE `prodacademica`
  MODIFY `idProdAcademica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `produccionarticulos`
--
ALTER TABLE `produccionarticulos`
  MODIFY `idProduccionArticulos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productoevaluado`
--
ALTER TABLE `productoevaluado`
  MODIFY `idProductoEvaluado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `programainvconsolidar`
--
ALTER TABLE `programainvconsolidar`
  MODIFY `idProgramaInvConsolidar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `programalineacuerpoacademico`
--
ALTER TABLE `programalineacuerpoacademico`
  MODIFY `idProgramaLineaCuerpoAcademico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `programalineainvconsolidar`
--
ALTER TABLE `programalineainvconsolidar`
  MODIFY `idProgramaLineaInvConsolidar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `programaorientacion`
--
ALTER TABLE `programaorientacion`
  MODIFY `idProgramaOrientacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `programas`
--
ALTER TABLE `programas`
  MODIFY `idPrograma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `programascuerpoacademico`
--
ALTER TABLE `programascuerpoacademico`
  MODIFY `idProgramasCuerpoAcademico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `programlineas`
--
ALTER TABLE `programlineas`
  MODIFY `idProgramLinea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `protocolodocs`
--
ALTER TABLE `protocolodocs`
  MODIFY `idProtocoloDocs` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `protocoloinvestigacion`
--
ALTER TABLE `protocoloinvestigacion`
  MODIFY `idProtocoloInvestigacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `proyectoscolaboradores`
--
ALTER TABLE `proyectoscolaboradores`
  MODIFY `idProyectosColaboratores` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proyectosinvestigacion`
--
ALTER TABLE `proyectosinvestigacion`
  MODIFY `idProyectosInvestigacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proyectostrabajados`
--
ALTER TABLE `proyectostrabajados`
  MODIFY `idProyectosTrabajados` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `publicaciondivulgacion`
--
ALTER TABLE `publicaciondivulgacion`
  MODIFY `idPublicacionDivulgacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ramascian`
--
ALTER TABLE `ramascian`
  MODIFY `idRamaScian` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ramasubramascian`
--
ALTER TABLE `ramasubramascian`
  MODIFY `idRamasubramaScian` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reconocimientos`
--
ALTER TABLE `reconocimientos`
  MODIFY `idReconocimientos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `redescolaboradores`
--
ALTER TABLE `redescolaboradores`
  MODIFY `idRedesColaboratores` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `redesinvestigacion`
--
ALTER TABLE `redesinvestigacion`
  MODIFY `idRedesInvestigacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `redestematicas`
--
ALTER TABLE `redestematicas`
  MODIFY `idRedesTematicas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `referencias`
--
ALTER TABLE `referencias`
  MODIFY `idReferencias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `relacionconacyt`
--
ALTER TABLE `relacionconacyt`
  MODIFY `idRelacionConacyt` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reportestecnicos`
--
ALTER TABLE `reportestecnicos`
  MODIFY `idReportesTecnicos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reportestecnicosautor`
--
ALTER TABLE `reportestecnicosautor`
  MODIFY `idReportesTecnicosAutor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `resultadosinvestigacion`
--
ALTER TABLE `resultadosinvestigacion`
  MODIFY `idResultadosInvestigacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sectorocde`
--
ALTER TABLE `sectorocde`
  MODIFY `idSectorOcde` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sectorrama`
--
ALTER TABLE `sectorrama`
  MODIFY `idSectorRama` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sectorscian`
--
ALTER TABLE `sectorscian`
  MODIFY `idSectorScian` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sectorsubsectorscian`
--
ALTER TABLE `sectorsubsectorscian`
  MODIFY `idSectorSubsectorScian` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitudapoyo`
--
ALTER TABLE `solicitudapoyo`
  MODIFY `idSolicitudApoyo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `subdiciplina`
--
ALTER TABLE `subdiciplina`
  MODIFY `idSubDiciplina` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `subdisciplina`
--
ALTER TABLE `subdisciplina`
  MODIFY `idSubDisciplina` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `subramascian`
--
ALTER TABLE `subramascian`
  MODIFY `idSubramaScian` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `subsectorscian`
--
ALTER TABLE `subsectorscian`
  MODIFY `idSubsectorScian` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tecnicoautor`
--
ALTER TABLE `tecnicoautor`
  MODIFY `idTecnicoAutor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tesisdirigidas`
--
ALTER TABLE `tesisdirigidas`
  MODIFY `idTesisDirigidas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tesisparticipantes`
--
ALTER TABLE `tesisparticipantes`
  MODIFY `idTesisParticipantes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipocontacto`
--
ALTER TABLE `tipocontacto`
  MODIFY `idTipoContacto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipodivulgaciondifusion`
--
ALTER TABLE `tipodivulgaciondifusion`
  MODIFY `idTipoDivulgacionDifusion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipoevaluacion`
--
ALTER TABLE `tipoevaluacion`
  MODIFY `idTipoEvaluacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipoevento`
--
ALTER TABLE `tipoevento`
  MODIFY `idTipoEvento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipogestion`
--
ALTER TABLE `tipogestion`
  MODIFY `idTipoGestion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipoinstancia`
--
ALTER TABLE `tipoinstancia`
  MODIFY `idTipoInstancia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipoinstituto`
--
ALTER TABLE `tipoinstituto`
  MODIFY `idTipoInstituto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipoinvestigacion`
--
ALTER TABLE `tipoinvestigacion`
  MODIFY `idTipoInvestigacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipomembresia`
--
ALTER TABLE `tipomembresia`
  MODIFY `idTipoMenbresia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tiponivel`
--
ALTER TABLE `tiponivel`
  MODIFY `idTipoNivel` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tiponumero`
--
ALTER TABLE `tiponumero`
  MODIFY `idTipoNumero` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipoparticipacion`
--
ALTER TABLE `tipoparticipacion`
  MODIFY `idTipoParticipacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipoparticipacioncongreso`
--
ALTER TABLE `tipoparticipacioncongreso`
  MODIFY `idTipoParticipacionCongreso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipopatrocinador`
--
ALTER TABLE `tipopatrocinador`
  MODIFY `idTipoPatrocinador` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipoprogramapnpc`
--
ALTER TABLE `tipoprogramapnpc`
  MODIFY `idTipoProgramaPnpc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipoproyecto`
--
ALTER TABLE `tipoproyecto`
  MODIFY `idTipoProyecto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipopuesto`
--
ALTER TABLE `tipopuesto`
  MODIFY `idTipoPuesto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tiporeconocimiento`
--
ALTER TABLE `tiporeconocimiento`
  MODIFY `idTipoReconocimiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tiporedestematicas`
--
ALTER TABLE `tiporedestematicas`
  MODIFY `idTipoRedesTematicas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipotutorias`
--
ALTER TABLE `tipotutorias`
  MODIFY `idTipoTutorias` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  MODIFY `idTipoUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tutorias`
--
ALTER TABLE `tutorias`
  MODIFY `idTutorias` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tutoriasgrupanindi`
--
ALTER TABLE `tutoriasgrupanindi`
  MODIFY `idTutoriasGrupanIndi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `vinculacion`
--
ALTER TABLE `vinculacion`
  MODIFY `idVinculacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD CONSTRAINT `actividades_ibfk_1` FOREIGN KEY (`idSolicitudApoyo`) REFERENCES `solicitudapoyo` (`idSolicitudApoyo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `actividadesdirecciontesis`
--
ALTER TABLE `actividadesdirecciontesis`
  ADD CONSTRAINT `idPlanDeTrabajoDT` FOREIGN KEY (`idPlanDeTrabajo`) REFERENCES `plandetrabajo` (`idPlanDeTrabajo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `actividadesdocencia`
--
ALTER TABLE `actividadesdocencia`
  ADD CONSTRAINT `idPlanDeTrabajoD` FOREIGN KEY (`idPlanDeTrabajo`) REFERENCES `plandetrabajo` (`idPlanDeTrabajo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `actividadesgestionacademica`
--
ALTER TABLE `actividadesgestionacademica`
  ADD CONSTRAINT `idPlanDeTrabajoGA` FOREIGN KEY (`idPlanDeTrabajo`) REFERENCES `plandetrabajo` (`idPlanDeTrabajo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `actividadesinvestigacion`
--
ALTER TABLE `actividadesinvestigacion`
  ADD CONSTRAINT `idPlanDeTrabajoI` FOREIGN KEY (`idPlanDeTrabajo`) REFERENCES `plandetrabajo` (`idPlanDeTrabajo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `actividadestutoria`
--
ALTER TABLE `actividadestutoria`
  ADD CONSTRAINT `idPlanDeTrabajoT` FOREIGN KEY (`idPlanDeTrabajo`) REFERENCES `plandetrabajo` (`idPlanDeTrabajo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `alumnosincorporados`
--
ALTER TABLE `alumnosincorporados`
  ADD CONSTRAINT `idContribucionAI` FOREIGN KEY (`idContribucion`) REFERENCES `contribucion` (`idContribucion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `alumnosresidentes`
--
ALTER TABLE `alumnosresidentes`
  ADD CONSTRAINT `idContribucionAR` FOREIGN KEY (`idContribucion`) REFERENCES `contribucion` (`idContribucion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `areadiciplinas`
--
ALTER TABLE `areadiciplinas`
  ADD CONSTRAINT `areadiciplinas_ibfk_1` FOREIGN KEY (`idArea`) REFERENCES `area` (`idArea`),
  ADD CONSTRAINT `areadiciplinas_ibfk_2` FOREIGN KEY (`idDiciplinaSub`) REFERENCES `diciplinasubdiciplina` (`idDiciplinaSub`),
  ADD CONSTRAINT `areadiciplinas_ibfk_3` FOREIGN KEY (`idCampus`) REFERENCES `campus` (`idCampus`);

--
-- Filtros para la tabla `areadisciplinas`
--
ALTER TABLE `areadisciplinas`
  ADD CONSTRAINT `areadisciplinas_ibfk_1` FOREIGN KEY (`idArea`) REFERENCES `area` (`idArea`),
  ADD CONSTRAINT `areadisciplinas_ibfk_2` FOREIGN KEY (`idDisciplinaSub`) REFERENCES `diciplinasubdisciplina` (`idDisciplinaSub`),
  ADD CONSTRAINT `areadisciplinas_ibfk_3` FOREIGN KEY (`idCampus`) REFERENCES `campus` (`idCampus`);

--
-- Filtros para la tabla `asociaciones`
--
ALTER TABLE `asociaciones`
  ADD CONSTRAINT `asociaciones_ibfk_1` FOREIGN KEY (`idTipoMembresia`) REFERENCES `tipomembresia` (`idTipoMenbresia`);

--
-- Filtros para la tabla `autortecnico`
--
ALTER TABLE `autortecnico`
  ADD CONSTRAINT `autortecnico_ibfk_1` FOREIGN KEY (`idReportesTecnicos`) REFERENCES `reportestecnicos` (`idReportesTecnicos`),
  ADD CONSTRAINT `autortecnico_ibfk_2` FOREIGN KEY (`idTecnicoAutor`) REFERENCES `tecnicoautor` (`idTecnicoAutor`);

--
-- Filtros para la tabla `campus`
--
ALTER TABLE `campus`
  ADD CONSTRAINT `idInstituciones` FOREIGN KEY (`idInstituciones`) REFERENCES `instituciones` (`idInstitucion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `campusdepartamento`
--
ALTER TABLE `campusdepartamento`
  ADD CONSTRAINT `campusdepartamento_ibfk_2` FOREIGN KEY (`idDepartamento`) REFERENCES `departamento` (`idDepartamento`),
  ADD CONSTRAINT `campusdepartamento_ibfk_3` FOREIGN KEY (`idCampus`) REFERENCES `campus` (`idCampus`);

--
-- Filtros para la tabla `capitulospublicados`
--
ALTER TABLE `capitulospublicados`
  ADD CONSTRAINT `capitulospublicados_ibfk_1` FOREIGN KEY (`idAreaDisciplina`) REFERENCES `areadisciplinas` (`idAreaDisciplina`);

--
-- Filtros para la tabla `colaboradores`
--
ALTER TABLE `colaboradores`
  ADD CONSTRAINT `colaboradores_ibfk_1` FOREIGN KEY (`idSolicitudApoyo`) REFERENCES `solicitudapoyo` (`idSolicitudApoyo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `colaboradoresactividades`
--
ALTER TABLE `colaboradoresactividades`
  ADD CONSTRAINT `colaboradoresactividades_ibfk_1` FOREIGN KEY (`idActividades`) REFERENCES `actividades` (`idActividades`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `colaboradoresactividades_ibfk_2` FOREIGN KEY (`idColaboradores`) REFERENCES `colaboradores` (`idColaborador`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `colaboradorescongreso`
--
ALTER TABLE `colaboradorescongreso`
  ADD CONSTRAINT `colaboradorescongreso_ibfk_1` FOREIGN KEY (`idAreaDisciplina`) REFERENCES `areadisciplinas` (`idAreaDisciplina`) ON DELETE CASCADE,
  ADD CONSTRAINT `colaboradorescongreso_ibfk_2` FOREIGN KEY (`idNivelEstudio`) REFERENCES `niveldeestudio` (`idNivelEstudio`);

--
-- Filtros para la tabla `colaboradoresgrupoinvestigacion`
--
ALTER TABLE `colaboradoresgrupoinvestigacion`
  ADD CONSTRAINT `colaboradoresgrupoinvestigacion1` FOREIGN KEY (`idNivelEstudio`) REFERENCES `niveldeestudio` (`idNivelEstudio`);

--
-- Filtros para la tabla `colaboratoresinvestigacion`
--
ALTER TABLE `colaboratoresinvestigacion`
  ADD CONSTRAINT `colaboratoresinvestigacion_ibfk_1` FOREIGN KEY (`idNivelEstudio`) REFERENCES `niveldeestudio` (`idNivelEstudio`);

--
-- Filtros para la tabla `colaboratoresproyectos`
--
ALTER TABLE `colaboratoresproyectos`
  ADD CONSTRAINT `colaboratoresproyectos_ibfk_1` FOREIGN KEY (`idNivelEstudio`) REFERENCES `niveldeestudio` (`idNivelEstudio`);

--
-- Filtros para la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD CONSTRAINT `contacto_ibfk_1` FOREIGN KEY (`idTipoContacto`) REFERENCES `tipocontacto` (`idTipoContacto`);

--
-- Filtros para la tabla `contribucion`
--
ALTER TABLE `contribucion`
  ADD CONSTRAINT `contribucion_ibfk_1` FOREIGN KEY (`idEntregables`) REFERENCES `entregables` (`idEntregables`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cursoimpartido`
--
ALTER TABLE `cursoimpartido`
  ADD CONSTRAINT `cursoimpartido_ibfk_1` FOREIGN KEY (`idAreaDisciplina`) REFERENCES `areadisciplinas` (`idAreaDisciplina`),
  ADD CONSTRAINT `cursoimpartido_ibfk_2` FOREIGN KEY (`idTipoProgramaPnpc`) REFERENCES `tipoprogramapnpc` (`idTipoProgramaPnpc`);

--
-- Filtros para la tabla `cvu`
--
ALTER TABLE `cvu`
  ADD CONSTRAINT `cvu_ibfk_1` FOREIGN KEY (`idCampusDepartamento`) REFERENCES `campusdepartamento` (`idCampusDepartamento`),
  ADD CONSTRAINT `cvu_ibfk_2` FOREIGN KEY (`idUsuarios`) REFERENCES `usuarios` (`idUsuarios`);

--
-- Filtros para la tabla `cvuasociones`
--
ALTER TABLE `cvuasociones`
  ADD CONSTRAINT `cvuasociones_ibfk_1` FOREIGN KEY (`idCvu`) REFERENCES `cvu` (`idCvu`),
  ADD CONSTRAINT `cvuasociones_ibfk_2` FOREIGN KEY (`idAsociaciones`) REFERENCES `asociaciones` (`idAsociaciones`);

--
-- Filtros para la tabla `cvucapitulospublicados`
--
ALTER TABLE `cvucapitulospublicados`
  ADD CONSTRAINT `cvucapitulospublicados_ibfk_1` FOREIGN KEY (`idCvu`) REFERENCES `cvu` (`idCvu`),
  ADD CONSTRAINT `cvucapitulospublicados_ibfk_2` FOREIGN KEY (`idCapitulosPublicados`) REFERENCES `capitulospublicados` (`idCapitulosPublicados`);

--
-- Filtros para la tabla `cvuconacyt`
--
ALTER TABLE `cvuconacyt`
  ADD CONSTRAINT `cvuconacyt_ibfk_1` FOREIGN KEY (`idCvu`) REFERENCES `cvu` (`idCvu`),
  ADD CONSTRAINT `cvuconacyt_ibfk_2` FOREIGN KEY (`idEvaluacionConacyt`) REFERENCES `evaluacionconacyt` (`idEvaluacionConacyt`);

--
-- Filtros para la tabla `cvucuerpoacademico`
--
ALTER TABLE `cvucuerpoacademico`
  ADD CONSTRAINT `cvucuerpoacademico_ibfk_1` FOREIGN KEY (`idCvu`) REFERENCES `cvu` (`idCvu`),
  ADD CONSTRAINT `cvucuerpoacademico_ibfk_2` FOREIGN KEY (`idCuerpoAcademico`) REFERENCES `cuerpoacademico` (`idcuerpoAcademico`);

--
-- Filtros para la tabla `cvucursoimpartido`
--
ALTER TABLE `cvucursoimpartido`
  ADD CONSTRAINT `cvucursoimpartido_ibfk_1` FOREIGN KEY (`idCvu`) REFERENCES `cvu` (`idCvu`),
  ADD CONSTRAINT `cvucursoimpartido_ibfk_2` FOREIGN KEY (`idCursoImpartido`) REFERENCES `cursoimpartido` (`idCursoImpartido`);

--
-- Filtros para la tabla `cvudesarrollosoftware`
--
ALTER TABLE `cvudesarrollosoftware`
  ADD CONSTRAINT `cvudesarrollosoftware_ibfk_1` FOREIGN KEY (`idCvu`) REFERENCES `cvu` (`idCvu`),
  ADD CONSTRAINT `cvudesarrollosoftware_ibfk_2` FOREIGN KEY (`idDesarrolloSoftware`) REFERENCES `desarrollosoftware` (`idDesarrolloSoftware`);

--
-- Filtros para la tabla `cvudesarrollostecnologicos`
--
ALTER TABLE `cvudesarrollostecnologicos`
  ADD CONSTRAINT `cvudesarrollostecnologicos_ibfk_1` FOREIGN KEY (`idCvu`) REFERENCES `cvu` (`idCvu`),
  ADD CONSTRAINT `cvudesarrollostecnologicos_ibfk_2` FOREIGN KEY (`idDesarrollosTecnologicos`) REFERENCES `desarrollostecnologicos` (`idDesarrollosTecnologicos`);

--
-- Filtros para la tabla `cvudiplomasimpartidos`
--
ALTER TABLE `cvudiplomasimpartidos`
  ADD CONSTRAINT `cvudiplomasimpartidos_ibfk_1` FOREIGN KEY (`idCvu`) REFERENCES `cvu` (`idCvu`),
  ADD CONSTRAINT `cvudiplomasimpartidos_ibfk_2` FOREIGN KEY (`idDiplomasImpartidos`) REFERENCES `diplomasimpartidos` (`idDiplomasImpartidos`);

--
-- Filtros para la tabla `cvudocenciaactual`
--
ALTER TABLE `cvudocenciaactual`
  ADD CONSTRAINT `cvudocenciaactual_ibfk_1` FOREIGN KEY (`idCvu`) REFERENCES `cvu` (`idCvu`),
  ADD CONSTRAINT `cvudocenciaactual_ibfk_2` FOREIGN KEY (`idCvuDocenciaActual`) REFERENCES `docenciaactualmaterias` (`idDocenciaActualMaterias`);

--
-- Filtros para la tabla `cvudocente`
--
ALTER TABLE `cvudocente`
  ADD CONSTRAINT `cvudocente_ibfk_1` FOREIGN KEY (`idCvu`) REFERENCES `cvu` (`idCvu`),
  ADD CONSTRAINT `cvudocente_ibfk_2` FOREIGN KEY (`idExperienciaDocente`) REFERENCES `experienciadocente` (`idExperienciaDocente`);

--
-- Filtros para la tabla `cvudocumentostrabajo`
--
ALTER TABLE `cvudocumentostrabajo`
  ADD CONSTRAINT `cvudocumentostrabajo_ibfk_1` FOREIGN KEY (`idCvu`) REFERENCES `cvu` (`idCvu`),
  ADD CONSTRAINT `cvudocumentostrabajo_ibfk_2` FOREIGN KEY (`idDocumentosTrabajo`) REFERENCES `documentostrabajo` (`idDocumentosTrabajo`);

--
-- Filtros para la tabla `cvuestudiorealizados`
--
ALTER TABLE `cvuestudiorealizados`
  ADD CONSTRAINT `cvuestudiorealizados_ibfk_1` FOREIGN KEY (`idCvu`) REFERENCES `cvu` (`idCvu`),
  ADD CONSTRAINT `cvuestudiorealizados_ibfk_2` FOREIGN KEY (`idEstudioRealizados`) REFERENCES `estudiorealizados` (`idEstudioRealizados`);

--
-- Filtros para la tabla `cvuexperiencia`
--
ALTER TABLE `cvuexperiencia`
  ADD CONSTRAINT `cvuexperiencia_ibfk_1` FOREIGN KEY (`idCvu`) REFERENCES `cvu` (`idCvu`),
  ADD CONSTRAINT `cvuexperiencia_ibfk_2` FOREIGN KEY (`idExperienciaProfesional`) REFERENCES `experienciaprofesional` (`idExperienciaProfesional`);

--
-- Filtros para la tabla `cvugestionacademica`
--
ALTER TABLE `cvugestionacademica`
  ADD CONSTRAINT `cvugestionacademica_ibfk_1` FOREIGN KEY (`idCvu`) REFERENCES `cvu` (`idCvu`),
  ADD CONSTRAINT `cvugestionacademica_ibfk_2` FOREIGN KEY (`idGestionAcademica`) REFERENCES `gestionacademica` (`idGestionAcademica`);

--
-- Filtros para la tabla `cvugrupoinvestigacion`
--
ALTER TABLE `cvugrupoinvestigacion`
  ADD CONSTRAINT `cvugrupoinvestigacion_ibfk_1` FOREIGN KEY (`idCvu`) REFERENCES `cvu` (`idCvu`),
  ADD CONSTRAINT `cvugrupoinvestigacion_ibfk_2` FOREIGN KEY (`idGrupoInvestigacion`) REFERENCES `grupoinvestigacion` (`idGrupoInvestigacion`);

--
-- Filtros para la tabla `cvuinnovacion`
--
ALTER TABLE `cvuinnovacion`
  ADD CONSTRAINT `cvuinnovacion_ibfk_1` FOREIGN KEY (`idCvu`) REFERENCES `cvu` (`idCvu`),
  ADD CONSTRAINT `cvuinnovacion_ibfk_2` FOREIGN KEY (`idInnovacion`) REFERENCES `innovacion` (`idInnovacion`);

--
-- Filtros para la tabla `cvuinvestigacion`
--
ALTER TABLE `cvuinvestigacion`
  ADD CONSTRAINT `cvuinvestigacion_ibfk_1` FOREIGN KEY (`idCvu`) REFERENCES `cvu` (`idCvu`),
  ADD CONSTRAINT `cvuinvestigacion_ibfk_2` FOREIGN KEY (`idRedesInvestigacion`) REFERENCES `redesinvestigacion` (`idRedesInvestigacion`);

--
-- Filtros para la tabla `cvulineas`
--
ALTER TABLE `cvulineas`
  ADD CONSTRAINT `cvulineas_ibfk_1` FOREIGN KEY (`idCvu`) REFERENCES `cvu` (`idCvu`),
  ADD CONSTRAINT `cvulineas_ibfk_2` FOREIGN KEY (`idLineaGeneracion`) REFERENCES `lineageneracion` (`idLineaGeneracion`);

--
-- Filtros para la tabla `cvumemorias`
--
ALTER TABLE `cvumemorias`
  ADD CONSTRAINT `cvumemorias_ibfk_1` FOREIGN KEY (`idCvu`) REFERENCES `cvu` (`idCvu`),
  ADD CONSTRAINT `cvumemorias_ibfk_2` FOREIGN KEY (`idMemorias`) REFERENCES `memorias` (`idMemorias`);

--
-- Filtros para la tabla `cvunoconacyt`
--
ALTER TABLE `cvunoconacyt`
  ADD CONSTRAINT `cvunoconacyt_ibfk_1` FOREIGN KEY (`idCvu`) REFERENCES `cvu` (`idCvu`),
  ADD CONSTRAINT `cvunoconacyt_ibfk_2` FOREIGN KEY (`idEvaluacionNoConacyt`) REFERENCES `evaluacionnoconacyt` (`idEvaluacionnoConacyt`);

--
-- Filtros para la tabla `cvuotrosestudios`
--
ALTER TABLE `cvuotrosestudios`
  ADD CONSTRAINT `cvuotrosestudios_ibfk_1` FOREIGN KEY (`idCvu`) REFERENCES `cvu` (`idCvu`),
  ADD CONSTRAINT `cvuotrosestudios_ibfk_2` FOREIGN KEY (`idOtrosEstudios`) REFERENCES `otroestudios` (`idOtrosEstudios`);

--
-- Filtros para la tabla `cvuparticipacionactualizacionprogeducativo`
--
ALTER TABLE `cvuparticipacionactualizacionprogeducativo`
  ADD CONSTRAINT `cvuparticipacionactualizacionprogeducativo_ibfk_1` FOREIGN KEY (`idCvu`) REFERENCES `cvu` (`idCvu`),
  ADD CONSTRAINT `cvuparticipacionactualizacionprogeducativo_ibfk_2` FOREIGN KEY (`idPartiActProgEduc`) REFERENCES `participacionactualizacionprogeducativo` (`idParticipacionActualizacionEducativo`);

--
-- Filtros para la tabla `cvuparticipacioncongreso`
--
ALTER TABLE `cvuparticipacioncongreso`
  ADD CONSTRAINT `cvuparticipacioncongreso_ibfk_1` FOREIGN KEY (`idCvu`) REFERENCES `cvu` (`idCvu`),
  ADD CONSTRAINT `cvuparticipacioncongreso_ibfk_2` FOREIGN KEY (`idPartiCongreso`) REFERENCES `participacioncongreso` (`idParticipacionCongreso`);

--
-- Filtros para la tabla `cvuparticipacioneventos`
--
ALTER TABLE `cvuparticipacioneventos`
  ADD CONSTRAINT `cvuparticipacioneventos_ibfk_1` FOREIGN KEY (`idCvu`) REFERENCES `cvu` (`idCvu`),
  ADD CONSTRAINT `cvuparticipacioneventos_ibfk_2` FOREIGN KEY (`idParticipacionEventos`) REFERENCES `participacioneventos` (`idParticipacionEventos`);

--
-- Filtros para la tabla `cvupatentes`
--
ALTER TABLE `cvupatentes`
  ADD CONSTRAINT `cvupatentes_ibfk_1` FOREIGN KEY (`idCvu`) REFERENCES `cvu` (`idCvu`),
  ADD CONSTRAINT `cvupatentes_ibfk_2` FOREIGN KEY (`idPatentes`) REFERENCES `patentes` (`idPatentes`);

--
-- Filtros para la tabla `cvuproduccionarticulos`
--
ALTER TABLE `cvuproduccionarticulos`
  ADD CONSTRAINT `cvuproduccionarticulos_ibfk_1` FOREIGN KEY (`idCvu`) REFERENCES `cvu` (`idCvu`),
  ADD CONSTRAINT `cvuproduccionarticulos_ibfk_2` FOREIGN KEY (`idProduccionArticulos`) REFERENCES `produccionarticulos` (`idProduccionArticulos`);

--
-- Filtros para la tabla `cvuproyectos`
--
ALTER TABLE `cvuproyectos`
  ADD CONSTRAINT `cvuproyectos_ibfk_1` FOREIGN KEY (`idCvu`) REFERENCES `cvu` (`idCvu`),
  ADD CONSTRAINT `cvuproyectos_ibfk_2` FOREIGN KEY (`idProyectosInvestigacion`) REFERENCES `proyectosinvestigacion` (`idProyectosInvestigacion`);

--
-- Filtros para la tabla `cvupublicaciondivulgacion`
--
ALTER TABLE `cvupublicaciondivulgacion`
  ADD CONSTRAINT `cvupublicaciondivulgacion_ibfk_1` FOREIGN KEY (`idCvu`) REFERENCES `cvu` (`idCvu`),
  ADD CONSTRAINT `cvupublicaciondivulgacion_ibfk_2` FOREIGN KEY (`idPublicacionDivulgacion`) REFERENCES `publicaciondivulgacion` (`idPublicacionDivulgacion`);

--
-- Filtros para la tabla `cvureconocimientos`
--
ALTER TABLE `cvureconocimientos`
  ADD CONSTRAINT `cvureconocimientos_ibfk_1` FOREIGN KEY (`idCvu`) REFERENCES `cvu` (`idCvu`),
  ADD CONSTRAINT `cvureconocimientos_ibfk_2` FOREIGN KEY (`idReconocimientos`) REFERENCES `reconocimientos` (`idReconocimientos`);

--
-- Filtros para la tabla `cvutecnico`
--
ALTER TABLE `cvutecnico`
  ADD CONSTRAINT `cvutecnico_ibfk_1` FOREIGN KEY (`idCvu`) REFERENCES `cvu` (`idCvu`),
  ADD CONSTRAINT `cvutecnico_ibfk_2` FOREIGN KEY (`idReportesTecnicos`) REFERENCES `reportestecnicos` (`idReportesTecnicos`);

--
-- Filtros para la tabla `cvutematicas`
--
ALTER TABLE `cvutematicas`
  ADD CONSTRAINT `cvutematicas_ibfk_1` FOREIGN KEY (`idCvu`) REFERENCES `cvu` (`idCvu`),
  ADD CONSTRAINT `cvutematicas_ibfk_2` FOREIGN KEY (`idRedesTematicas`) REFERENCES `redestematicas` (`idRedesTematicas`);

--
-- Filtros para la tabla `cvutesis`
--
ALTER TABLE `cvutesis`
  ADD CONSTRAINT `cvutesis_ibfk_1` FOREIGN KEY (`idCvu`) REFERENCES `cvu` (`idCvu`),
  ADD CONSTRAINT `cvutesis_ibfk_2` FOREIGN KEY (`idTesisDirigidas`) REFERENCES `tesisdirigidas` (`idTesisDirigidas`);

--
-- Filtros para la tabla `cvututorias`
--
ALTER TABLE `cvututorias`
  ADD CONSTRAINT `cvututorias_ibfk_1` FOREIGN KEY (`idCvu`) REFERENCES `cvu` (`idCvu`),
  ADD CONSTRAINT `cvututorias_ibfk_2` FOREIGN KEY (`idTutorias`) REFERENCES `tutorias` (`idTutorias`);

--
-- Filtros para la tabla `datosgenerales`
--
ALTER TABLE `datosgenerales`
  ADD CONSTRAINT `datosgenerales_ibfk_1` FOREIGN KEY (`idCvu`) REFERENCES `cvu` (`idCvu`),
  ADD CONSTRAINT `datosgenerales_ibfk_2` FOREIGN KEY (`idDomicinio`) REFERENCES `domicinio` (`idDomicinio`),
  ADD CONSTRAINT `datosgenerales_ibfk_3` FOREIGN KEY (`idContacto`) REFERENCES `contacto` (`idContacto`);

--
-- Filtros para la tabla `desarrollologros`
--
ALTER TABLE `desarrollologros`
  ADD CONSTRAINT `desarrollologros_ibfk_1` FOREIGN KEY (`idDesarrollosTecnologicos`) REFERENCES `desarrollostecnologicos` (`idDesarrollosTecnologicos`),
  ADD CONSTRAINT `desarrollologros_ibfk_2` FOREIGN KEY (`idLogros`) REFERENCES `logros` (`idlogros`);

--
-- Filtros para la tabla `desarrollostecnologicos`
--
ALTER TABLE `desarrollostecnologicos`
  ADD CONSTRAINT `desarrollostecnologicos_ibfk_1` FOREIGN KEY (`idAreaDisciplina`) REFERENCES `areadisciplinas` (`idAreaDisciplina`),
  ADD CONSTRAINT `desarrollostecnologicos_ibfk_2` FOREIGN KEY (`idSectorOcde`) REFERENCES `sectorocde` (`idSectorOcde`),
  ADD CONSTRAINT `desarrollostecnologicos_ibfk_3` FOREIGN KEY (`idSectorRama`) REFERENCES `sectorrama` (`idSectorRama`);

--
-- Filtros para la tabla `descripcionproyecto`
--
ALTER TABLE `descripcionproyecto`
  ADD CONSTRAINT `idCampusFK` FOREIGN KEY (`idCampus`) REFERENCES `campus` (`idCampus`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idProtocoloDescFK` FOREIGN KEY (`idProtocoloInvestigacion`) REFERENCES `protocoloinvestigacion` (`idProtocoloInvestigacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `diplomasimpartidos`
--
ALTER TABLE `diplomasimpartidos`
  ADD CONSTRAINT `diplomasimpartidos_ibfk_1` FOREIGN KEY (`idAreaDisciplina`) REFERENCES `areadisciplinas` (`idAreaDisciplina`);

--
-- Filtros para la tabla `divulgacionproductosobtenidos`
--
ALTER TABLE `divulgacionproductosobtenidos`
  ADD CONSTRAINT `divulgacionproductosobtenidos_ibfk_1` FOREIGN KEY (`idPublicacionDivulgacion`) REFERENCES `publicaciondivulgacion` (`idPublicacionDivulgacion`);

--
-- Filtros para la tabla `docenciaactualmaterias`
--
ALTER TABLE `docenciaactualmaterias`
  ADD CONSTRAINT `docenciaactualmaterias_ibfk_1` FOREIGN KEY (`idNivelEstudio`) REFERENCES `niveldeestudio` (`idNivelEstudio`);

--
-- Filtros para la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `documentosUsario` FOREIGN KEY (`idUsuarios`) REFERENCES `usuarios` (`idUsuarios`);

--
-- Filtros para la tabla `documentosproyecto`
--
ALTER TABLE `documentosproyecto`
  ADD CONSTRAINT `idProtocoloFKDP` FOREIGN KEY (`idProtocoloInvestigacion`) REFERENCES `protocoloinvestigacion` (`idProtocoloInvestigacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `domicinio`
--
ALTER TABLE `domicinio`
  ADD CONSTRAINT `domicinio_ibfk_1` FOREIGN KEY (`idNumeroTipo`) REFERENCES `numerotipo` (`idNumeroTipo`);

--
-- Filtros para la tabla `entregables`
--
ALTER TABLE `entregables`
  ADD CONSTRAINT `entregables_ibfk_1` FOREIGN KEY (`idSolicitudApoyo`) REFERENCES `solicitudapoyo` (`idSolicitudApoyo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `estanciasprofesionale`
--
ALTER TABLE `estanciasprofesionale`
  ADD CONSTRAINT `estanciasprofesionale_ibfk_1` FOREIGN KEY (`idAreaDisciplina`) REFERENCES `areadisciplinas` (`idAreaDisciplina`),
  ADD CONSTRAINT `estanciasprofesionale_ibfk_2` FOREIGN KEY (`idTipoInstancia`) REFERENCES `tipoinstancia` (`idTipoInstancia`);

--
-- Filtros para la tabla `estudiorealizados`
--
ALTER TABLE `estudiorealizados`
  ADD CONSTRAINT `estudiorealizados_ibfk_1` FOREIGN KEY (`idAreaDisciplina`) REFERENCES `areadisciplinas` (`idAreaDisciplina`),
  ADD CONSTRAINT `estudiorealizados_ibfk_2` FOREIGN KEY (`idNivelEstudio`) REFERENCES `niveldeestudio` (`idNivelEstudio`),
  ADD CONSTRAINT `estudiorealizados_ibfk_3` FOREIGN KEY (`idTipoInstituto`) REFERENCES `tipoinstituto` (`idTipoInstituto`);

--
-- Filtros para la tabla `etapadesarrollo`
--
ALTER TABLE `etapadesarrollo`
  ADD CONSTRAINT `etapadesarrollo_ibfk_1` FOREIGN KEY (`idOpcionesEtapa`) REFERENCES `opcionesetapa` (`idOpcionesEtapa`);

--
-- Filtros para la tabla `etapadesarrollotecnologicos`
--
ALTER TABLE `etapadesarrollotecnologicos`
  ADD CONSTRAINT `etapadesarrollotecnologicos_ibfk_1` FOREIGN KEY (`idEtapaDesarrollo`) REFERENCES `etapadesarrollo` (`idEtapaDesarrollo`),
  ADD CONSTRAINT `etapadesarrollotecnologicos_ibfk_2` FOREIGN KEY (`idDesarrollosTecnologicos`) REFERENCES `desarrollostecnologicos` (`idDesarrollosTecnologicos`);

--
-- Filtros para la tabla `evaluacionconacyt`
--
ALTER TABLE `evaluacionconacyt`
  ADD CONSTRAINT `evaluacionconacyt_ibfk_1` FOREIGN KEY (`idDictamenConacyt`) REFERENCES `dictamenconacyt` (`idDictamenConacyt`);

--
-- Filtros para la tabla `evaluacionnoconacyt`
--
ALTER TABLE `evaluacionnoconacyt`
  ADD CONSTRAINT `evaluacionnoconacyt_ibfk_1` FOREIGN KEY (`idDictamenConacyt`) REFERENCES `dictamenconacyt` (`idDictamenConacyt`),
  ADD CONSTRAINT `evaluacionnoconacyt_ibfk_2` FOREIGN KEY (`idProductoEvaluado`) REFERENCES `productoevaluado` (`idProductoEvaluado`),
  ADD CONSTRAINT `evaluacionnoconacyt_ibfk_3` FOREIGN KEY (`idTipoEvaluacion`) REFERENCES `tipoevaluacion` (`idTipoEvaluacion`);

--
-- Filtros para la tabla `experienciadocente`
--
ALTER TABLE `experienciadocente`
  ADD CONSTRAINT `experienciadocente_ibfk_1` FOREIGN KEY (`idTipoNivel`) REFERENCES `tiponivel` (`idTipoNivel`);

--
-- Filtros para la tabla `experienciaprofesional`
--
ALTER TABLE `experienciaprofesional`
  ADD CONSTRAINT `experienciaprofesional_ibfk_1` FOREIGN KEY (`idActualAnterior`) REFERENCES `actualanterior` (`idActualAnterior`),
  ADD CONSTRAINT `experienciaprofesional_ibfk_2` FOREIGN KEY (`idEstanciasProfesionale`) REFERENCES `estanciasprofesionale` (`idEstanciasProfesionale`),
  ADD CONSTRAINT `experienciaprofesional_ibfk_3` FOREIGN KEY (`idPuesto`) REFERENCES `tipopuesto` (`idTipoPuesto`);

--
-- Filtros para la tabla `financiamiento`
--
ALTER TABLE `financiamiento`
  ADD CONSTRAINT `financiamiento_ibfk_1` FOREIGN KEY (`idSolicitudApoyo`) REFERENCES `solicitudapoyo` (`idSolicitudApoyo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `gestionacademica`
--
ALTER TABLE `gestionacademica`
  ADD CONSTRAINT `gestionacademica_ibfk_1` FOREIGN KEY (`idGestionAprobado`) REFERENCES `gestionaprobado` (`idGestionAprobado`),
  ADD CONSTRAINT `gestionacademica_ibfk_2` FOREIGN KEY (`idGestionEstados`) REFERENCES `gestionestados` (`idGestionEstados`),
  ADD CONSTRAINT `gestionacademica_ibfk_3` FOREIGN KEY (`idGestionResultadosObte`) REFERENCES `gestionresultadosobtenidos` (`idGestionResultadosObte`),
  ADD CONSTRAINT `gestionacademica_ibfk_4` FOREIGN KEY (`idTipoGestion`) REFERENCES `tipogestion` (`idTipoGestion`);

--
-- Filtros para la tabla `grupoinvestigacion`
--
ALTER TABLE `grupoinvestigacion`
  ADD CONSTRAINT `grupoinvestigacion_ibfk_1` FOREIGN KEY (`idAreaDisciplina`) REFERENCES `areadisciplinas` (`idAreaDisciplina`);

--
-- Filtros para la tabla `grupoinvestigacioncolaboradores`
--
ALTER TABLE `grupoinvestigacioncolaboradores`
  ADD CONSTRAINT `grupoinvestigacionColaboradores1` FOREIGN KEY (`idGrupoInvestigacion`) REFERENCES `grupoinvestigacion` (`idGrupoInvestigacion`),
  ADD CONSTRAINT `grupoinvestigacionColaboradores2` FOREIGN KEY (`idColaboradoresgrupoinvestigacion`) REFERENCES `colaboradoresgrupoinvestigacion` (`idColaboradoresgrupoinvestigacion`);

--
-- Filtros para la tabla `infraestructura`
--
ALTER TABLE `infraestructura`
  ADD CONSTRAINT `infraestructura_ibfk_1` FOREIGN KEY (`idProtocoloInvestigacion`) REFERENCES `protocoloinvestigacion` (`idProtocoloInvestigacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `innovacion`
--
ALTER TABLE `innovacion`
  ADD CONSTRAINT `innovacion_ibfk_1` FOREIGN KEY (`idAreaDisciplina`) REFERENCES `areadisciplinas` (`idAreaDisciplina`),
  ADD CONSTRAINT `innovacion_ibfk_2` FOREIGN KEY (`idSectorOcde`) REFERENCES `sectorocde` (`idSectorOcde`),
  ADD CONSTRAINT `innovacion_ibfk_3` FOREIGN KEY (`idSectorRama`) REFERENCES `sectorrama` (`idSectorRama`);

--
-- Filtros para la tabla `institucionesfeddes`
--
ALTER TABLE `institucionesfeddes`
  ADD CONSTRAINT `institucionesfeddes_ibfk_1` FOREIGN KEY (`idInstirucion`) REFERENCES `instituciones` (`idInstitucion`),
  ADD CONSTRAINT `institucionesfeddes_ibfk_2` FOREIGN KEY (`idFedDes`) REFERENCES `feddes` (`idFedDes`);

--
-- Filtros para la tabla `institucionesprogramas`
--
ALTER TABLE `institucionesprogramas`
  ADD CONSTRAINT `institucionesprogramas_ibfk_1` FOREIGN KEY (`idPrograma`) REFERENCES `programas` (`idPrograma`),
  ADD CONSTRAINT `institucionesprogramas_ibfk_2` FOREIGN KEY (`idInstitucion`) REFERENCES `instituciones` (`idInstitucion`);

--
-- Filtros para la tabla `investigacioncolaboratores`
--
ALTER TABLE `investigacioncolaboratores`
  ADD CONSTRAINT `investigacioncolaboratores_ibfk_1` FOREIGN KEY (`idRedesInvestigacion`) REFERENCES `redesinvestigacion` (`idRedesInvestigacion`),
  ADD CONSTRAINT `investigacioncolaboratores_ibfk_2` FOREIGN KEY (`idColaboratoresInvestigacion`) REFERENCES `colaboratoresinvestigacion` (`idColaboratoresInvestigacion`);

--
-- Filtros para la tabla `ligaconvocatoriaproyecto`
--
ALTER TABLE `ligaconvocatoriaproyecto`
  ADD CONSTRAINT `idConvocatoriaFK` FOREIGN KEY (`idConvocatoria`) REFERENCES `convocatorias` (`idConvocatoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idSolicitudApoyoFKLiga` FOREIGN KEY (`idSolicitudApoyo`) REFERENCES `solicitudapoyo` (`idSolicitudApoyo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `lugardesarrollo`
--
ALTER TABLE `lugardesarrollo`
  ADD CONSTRAINT `idProtocoloInvestigacion` FOREIGN KEY (`idProtocoloInstigacion`) REFERENCES `protocoloinvestigacion` (`idProtocoloInvestigacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mecanismodesarrollostecnologicos`
--
ALTER TABLE `mecanismodesarrollostecnologicos`
  ADD CONSTRAINT `mecanismodesarrollostecnologicos_ibfk_1` FOREIGN KEY (`idDesarrollosTecnologicos`) REFERENCES `desarrollostecnologicos` (`idDesarrollosTecnologicos`),
  ADD CONSTRAINT `mecanismodesarrollostecnologicos_ibfk_2` FOREIGN KEY (`idMecanismoTranferencia`) REFERENCES `mecanismotransferencia` (`idMecanismoTranferencia`);

--
-- Filtros para la tabla `nombredistincionconacyt`
--
ALTER TABLE `nombredistincionconacyt`
  ADD CONSTRAINT `nombredistincionconacyt_ibfk_1` FOREIGN KEY (`idReconocimientos`) REFERENCES `reconocimientos` (`idReconocimientos`);

--
-- Filtros para la tabla `objetivogeneral`
--
ALTER TABLE `objetivogeneral`
  ADD CONSTRAINT `idSolicitudApoyoOG` FOREIGN KEY (`idSolicituApoyo`) REFERENCES `solicitudapoyo` (`idSolicitudApoyo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `objetivosespecificos`
--
ALTER TABLE `objetivosespecificos`
  ADD CONSTRAINT `objetivosespecificos_ibfk_1` FOREIGN KEY (`idSolicitudApoyo`) REFERENCES `solicitudapoyo` (`idSolicitudApoyo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `otroestudios`
--
ALTER TABLE `otroestudios`
  ADD CONSTRAINT `otroestudios_ibfk_1` FOREIGN KEY (`idAreaDisciplina`) REFERENCES `areadisciplinas` (`idAreaDisciplina`),
  ADD CONSTRAINT `otroestudios_ibfk_2` FOREIGN KEY (`idFormacion`) REFERENCES `formacioncontinua` (`idFormacion`);

--
-- Filtros para la tabla `participacioncongresocolaboradores`
--
ALTER TABLE `participacioncongresocolaboradores`
  ADD CONSTRAINT `participacioncongresocolaboradores_ibfk_1` FOREIGN KEY (`idColaboradoresCongreso`) REFERENCES `colaboradorescongreso` (`idColaboradoresCongreso`),
  ADD CONSTRAINT `participacioncongresocolaboradores_ibfk_2` FOREIGN KEY (`idParticipacionCongreso`) REFERENCES `participacioncongreso` (`idParticipacionCongreso`);

--
-- Filtros para la tabla `participantestesis`
--
ALTER TABLE `participantestesis`
  ADD CONSTRAINT `participantestesis_ibfk_1` FOREIGN KEY (`idTesisDirigidas`) REFERENCES `tesisdirigidas` (`idTesisDirigidas`),
  ADD CONSTRAINT `participantestesis_ibfk_2` FOREIGN KEY (`idTesisParticipantes`) REFERENCES `tesisparticipantes` (`idTesisParticipantes`);

--
-- Filtros para la tabla `patenteautor`
--
ALTER TABLE `patenteautor`
  ADD CONSTRAINT `patenteautor_ibfk_1` FOREIGN KEY (`idPatentes`) REFERENCES `patentes` (`idPatentes`),
  ADD CONSTRAINT `patenteautor_ibfk_2` FOREIGN KEY (`idAutorPatente`) REFERENCES `autorpatente` (`idAutorPatente`);

--
-- Filtros para la tabla `plandetrabajo`
--
ALTER TABLE `plandetrabajo`
  ADD CONSTRAINT `idSolicitudApoyoFK7` FOREIGN KEY (`idSolicitudApoyo`) REFERENCES `solicitudapoyo` (`idSolicitudApoyo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `presupuesto`
--
ALTER TABLE `presupuesto`
  ADD CONSTRAINT `presupuesto_ibfk_1` FOREIGN KEY (`idSolicitudApoyo`) REFERENCES `solicitudapoyo` (`idSolicitudApoyo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `prodacademica`
--
ALTER TABLE `prodacademica`
  ADD CONSTRAINT `prodacademica_ibfk_1` FOREIGN KEY (`idEntregables`) REFERENCES `entregables` (`idEntregables`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `produccionarticulos`
--
ALTER TABLE `produccionarticulos`
  ADD CONSTRAINT `produccionarticulos_ibfk_1` FOREIGN KEY (`idAreaDisciplina`) REFERENCES `areadisciplinas` (`idAreaDisciplina`);

--
-- Filtros para la tabla `programalineacuerpoacademico`
--
ALTER TABLE `programalineacuerpoacademico`
  ADD CONSTRAINT `idLineaCuerpo` FOREIGN KEY (`idLineaCuerpoAcademico`) REFERENCES `lineascuerpoacademico` (`idlineasCuerpoAcademico`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idProgramaCuerpo` FOREIGN KEY (`idProgramaCuerpoAcademico`) REFERENCES `programascuerpoacademico` (`idProgramasCuerpoAcademico`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `programalineainvconsolidar`
--
ALTER TABLE `programalineainvconsolidar`
  ADD CONSTRAINT `idLineaInv` FOREIGN KEY (`idLineaInvConsolidar`) REFERENCES `lineasinvconsolidar` (`idLineasInvConsolidar`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idProgramaInv` FOREIGN KEY (`idProgramaInvConsolidar`) REFERENCES `programainvconsolidar` (`idProgramaInvConsolidar`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `programaorientacion`
--
ALTER TABLE `programaorientacion`
  ADD CONSTRAINT `programaorientacion_ibfk_1` FOREIGN KEY (`idPrograma`) REFERENCES `programas` (`idPrograma`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `programaorientacion_ibfk_2` FOREIGN KEY (`idOrientacion`) REFERENCES `orientacion` (`idOrientacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `programlineas`
--
ALTER TABLE `programlineas`
  ADD CONSTRAINT `programlineas_ibfk_1` FOREIGN KEY (`idPrograma`) REFERENCES `programas` (`idPrograma`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `programlineas_ibfk_2` FOREIGN KEY (`idLinea`) REFERENCES `lineas` (`idLinea`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `protocolodocs`
--
ALTER TABLE `protocolodocs`
  ADD CONSTRAINT `protocolodocs_ibfk_1` FOREIGN KEY (`idDocumentosAdjuntos`) REFERENCES `documentosadjuntos` (`idDocumentosAdjuntos`),
  ADD CONSTRAINT `protocolodocs_ibfk_2` FOREIGN KEY (`idProtocoloInvestigacion`) REFERENCES `protocoloinvestigacion` (`idProtocoloInvestigacion`);

--
-- Filtros para la tabla `protocoloinvestigacion`
--
ALTER TABLE `protocoloinvestigacion`
  ADD CONSTRAINT `idSolicitudApoyo` FOREIGN KEY (`idSolicitudApoyo`) REFERENCES `solicitudapoyo` (`idSolicitudApoyo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `proyectoscolaboradores`
--
ALTER TABLE `proyectoscolaboradores`
  ADD CONSTRAINT `proyectoscolaboradores_ibfk_1` FOREIGN KEY (`idColaboratoresProyectos`) REFERENCES `colaboratoresproyectos` (`idColaboratoresProyectos`),
  ADD CONSTRAINT `proyectoscolaboradores_ibfk_2` FOREIGN KEY (`idProyectosInvestigacion`) REFERENCES `protocoloinvestigacion` (`idProtocoloInvestigacion`);

--
-- Filtros para la tabla `proyectosinvestigacion`
--
ALTER TABLE `proyectosinvestigacion`
  ADD CONSTRAINT `proyectosinvestigacion_ibfk_1` FOREIGN KEY (`idAreaDisciplina`) REFERENCES `areadisciplinas` (`idAreaDisciplina`),
  ADD CONSTRAINT `proyectosinvestigacion_ibfk_2` FOREIGN KEY (`idCurriculumCa`) REFERENCES `curriculumca` (`idCurriculumCa`),
  ADD CONSTRAINT `proyectosinvestigacion_ibfk_3` FOREIGN KEY (`idFuenteFinciamineto`) REFERENCES `fuentefinanciamiento` (`idFuenteFinciamineto`),
  ADD CONSTRAINT `proyectosinvestigacion_ibfk_4` FOREIGN KEY (`idLineaInvestigacion`) REFERENCES `lineainvestigacion` (`idLineaInvestigacion`),
  ADD CONSTRAINT `proyectosinvestigacion_ibfk_5` FOREIGN KEY (`idResultadosInvestigacion`) REFERENCES `resultadosinvestigacion` (`idResultadosInvestigacion`),
  ADD CONSTRAINT `proyectosinvestigacion_ibfk_6` FOREIGN KEY (`idTipoPatrocinador`) REFERENCES `tipopatrocinador` (`idTipoPatrocinador`),
  ADD CONSTRAINT `proyectosinvestigacion_ibfk_7` FOREIGN KEY (`idTipoProyecto`) REFERENCES `tipoproyecto` (`idTipoProyecto`);

--
-- Filtros para la tabla `proyectostrabajados`
--
ALTER TABLE `proyectostrabajados`
  ADD CONSTRAINT `proyectostrabajados_ibfk_1` FOREIGN KEY (`idFuenteFinanciacion`) REFERENCES `fuentefinanciamiento` (`idFuenteFinciamineto`);

--
-- Filtros para la tabla `publicaciondivulgacion`
--
ALTER TABLE `publicaciondivulgacion`
  ADD CONSTRAINT `publicaciondivulgacion_ibfk_1` FOREIGN KEY (`idTipoDivulgacionDifusion`) REFERENCES `tipodivulgaciondifusion` (`idTipoDivulgacionDifusion`),
  ADD CONSTRAINT `publicaciondivulgacion_ibfk_2` FOREIGN KEY (`idTipoEvento`) REFERENCES `tipoevento` (`idTipoEvento`),
  ADD CONSTRAINT `publicaciondivulgacion_ibfk_3` FOREIGN KEY (`idTipoParticipacion`) REFERENCES `tipoparticipacion` (`idTipoParticipacion`);

--
-- Filtros para la tabla `ramasubramascian`
--
ALTER TABLE `ramasubramascian`
  ADD CONSTRAINT `ramasubramascian_ibfk_1` FOREIGN KEY (`idClaseScian`) REFERENCES `clasescian` (`idClaseScian`),
  ADD CONSTRAINT `ramasubramascian_ibfk_2` FOREIGN KEY (`idRamaScian`) REFERENCES `ramascian` (`idRamaScian`),
  ADD CONSTRAINT `ramasubramascian_ibfk_3` FOREIGN KEY (`idSubramaScian`) REFERENCES `subramascian` (`idSubramaScian`);

--
-- Filtros para la tabla `reconocimientos`
--
ALTER TABLE `reconocimientos`
  ADD CONSTRAINT `reconocimientos_ibfk_1` FOREIGN KEY (`idTipoReconocimiento`) REFERENCES `tiporeconocimiento` (`idTipoReconocimiento`),
  ADD CONSTRAINT `reconocimientos_ibfk_2` FOREIGN KEY (`idRelacionConacyt`) REFERENCES `relacionconacyt` (`idRelacionConacyt`);

--
-- Filtros para la tabla `redescolaboradores`
--
ALTER TABLE `redescolaboradores`
  ADD CONSTRAINT `redescolaboradores_ibfk_1` FOREIGN KEY (`idColaboradoresRedes`) REFERENCES `colaboradoresredes` (`idColaboradoresRedes`),
  ADD CONSTRAINT `redescolaboradores_ibfk_2` FOREIGN KEY (`idRedesTematicas`) REFERENCES `redestematicas` (`idRedesTematicas`);

--
-- Filtros para la tabla `redesinvestigacion`
--
ALTER TABLE `redesinvestigacion`
  ADD CONSTRAINT `redesinvestigacion_ibfk_1` FOREIGN KEY (`idAreaDisciplina`) REFERENCES `areadisciplinas` (`idAreaDisciplina`);

--
-- Filtros para la tabla `redestematicas`
--
ALTER TABLE `redestematicas`
  ADD CONSTRAINT `redestematicas_ibfk_1` FOREIGN KEY (`idTipoTedesTematicas`) REFERENCES `tiporedestematicas` (`idTipoRedesTematicas`);

--
-- Filtros para la tabla `referencias`
--
ALTER TABLE `referencias`
  ADD CONSTRAINT `idprotocoloInvestigacionRef` FOREIGN KEY (`idProtocoloInvestigacion`) REFERENCES `protocoloinvestigacion` (`idProtocoloInvestigacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reportestecnicos`
--
ALTER TABLE `reportestecnicos`
  ADD CONSTRAINT `reportestecnicos_ibfk_1` FOREIGN KEY (`idOrigenReporteTecnico`) REFERENCES `origenreportetecnico` (`idOrigenReporteTecnico`);

--
-- Filtros para la tabla `reportestecnicosautor`
--
ALTER TABLE `reportestecnicosautor`
  ADD CONSTRAINT `reportestecnicosautor_ibfk_1` FOREIGN KEY (`idReportesTecnicos`) REFERENCES `reportestecnicos` (`idReportesTecnicos`);

--
-- Filtros para la tabla `sectorocde`
--
ALTER TABLE `sectorocde`
  ADD CONSTRAINT `sectorocde_ibfk_1` FOREIGN KEY (`idClaseOcde`) REFERENCES `claseocde` (`idClaseOcde`),
  ADD CONSTRAINT `sectorocde_ibfk_2` FOREIGN KEY (`idGrupoOcde`) REFERENCES `grupoocde` (`idGrupoOcde`),
  ADD CONSTRAINT `sectorocde_ibfk_3` FOREIGN KEY (`idDivicionOcde`) REFERENCES `divicionocde` (`idDivicionOcde`);

--
-- Filtros para la tabla `sectorrama`
--
ALTER TABLE `sectorrama`
  ADD CONSTRAINT `sectorrama_ibfk_1` FOREIGN KEY (`idRamaSubramaScian`) REFERENCES `ramasubramascian` (`idRamasubramaScian`),
  ADD CONSTRAINT `sectorrama_ibfk_2` FOREIGN KEY (`idSectorSubsectorScian`) REFERENCES `sectorsubsectorscian` (`idSectorSubsectorScian`);

--
-- Filtros para la tabla `sectorsubsectorscian`
--
ALTER TABLE `sectorsubsectorscian`
  ADD CONSTRAINT `sectorsubsectorscian_ibfk_1` FOREIGN KEY (`idSectorScian`) REFERENCES `sectorscian` (`idSectorScian`),
  ADD CONSTRAINT `sectorsubsectorscian_ibfk_2` FOREIGN KEY (`idSubsectorScian`) REFERENCES `subsectorscian` (`idSubsectorScian`);

--
-- Filtros para la tabla `solicitudapoyo`
--
ALTER TABLE `solicitudapoyo`
  ADD CONSTRAINT `idCuerpoAcademicoFK` FOREIGN KEY (`idCuerpoAcademico`) REFERENCES `cuerpoacademico` (`idcuerpoAcademico`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `idInstitucionFK` FOREIGN KEY (`idInstitucion`) REFERENCES `instituciones` (`idInstitucion`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `idInvestigadorFK` FOREIGN KEY (`idInvestigador`) REFERENCES `usuarios` (`idUsuarios`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `solicitudapoyo_ibfk_1` FOREIGN KEY (`idLinea`) REFERENCES `lineas` (`idLinea`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `solicitudapoyo_ibfk_4` FOREIGN KEY (`idTipoInvestigacion`) REFERENCES `tipoinvestigacion` (`idTipoInvestigacion`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `solicitudapoyo_ibfk_6` FOREIGN KEY (`idProgramaInv`) REFERENCES `programainvconsolidar` (`idProgramaInvConsolidar`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `solicitudapoyo_ibfk_7` FOREIGN KEY (`idLineaInv`) REFERENCES `lineasinvconsolidar` (`idLineasInvConsolidar`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `solicitudapoyo_ibfk_8` FOREIGN KEY (`idProgramaCuerpo`) REFERENCES `programalineacuerpoacademico` (`idProgramaLineaCuerpoAcademico`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `solicitudapoyo_ibfk_9` FOREIGN KEY (`idLineaCuerpo`) REFERENCES `lineascuerpoacademico` (`idlineasCuerpoAcademico`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `tecnicoautor`
--
ALTER TABLE `tecnicoautor`
  ADD CONSTRAINT `tecnicoautor_ibfk_1` FOREIGN KEY (`idReportesTecnicos`) REFERENCES `reportestecnicos` (`idReportesTecnicos`);

--
-- Filtros para la tabla `tesisdirigidas`
--
ALTER TABLE `tesisdirigidas`
  ADD CONSTRAINT `tesisdirigidas_ibfk_1` FOREIGN KEY (`idAreaDisciplina`) REFERENCES `areadisciplinas` (`idAreaDisciplina`),
  ADD CONSTRAINT `tesisdirigidas_ibfk_2` FOREIGN KEY (`idgradoTesis`) REFERENCES `gradotesis` (`idGradoTesis`),
  ADD CONSTRAINT `tesisdirigidas_ibfk_3` FOREIGN KEY (`idTipoProgramaPnpc`) REFERENCES `tipoprogramapnpc` (`idTipoProgramaPnpc`);

--
-- Filtros para la tabla `tutorias`
--
ALTER TABLE `tutorias`
  ADD CONSTRAINT `tutorias_ibfk_1` FOREIGN KEY (`idEstadoTutorias`) REFERENCES `estadotutorias` (`idEstadoTutorias`),
  ADD CONSTRAINT `tutorias_ibfk_2` FOREIGN KEY (`idNivelTutorias`) REFERENCES `niveltutorias` (`idNivelTutorias`),
  ADD CONSTRAINT `tutorias_ibfk_3` FOREIGN KEY (`idTipoTutorias`) REFERENCES `tipotutorias` (`idTipoTutorias`),
  ADD CONSTRAINT `tutorias_ibfk_4` FOREIGN KEY (`idTutoriasGrupanIndi`) REFERENCES `tutoriasgrupanindi` (`idTutoriasGrupanIndi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
