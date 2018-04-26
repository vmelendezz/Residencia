<?php
/**
 * 
 */
 class Rutes
 {
 	//variables globales
 	public $page = null;
 	public $infoPage = null;
 	
 	function __construct()
 	{	//3.- se ejecuta el metodo request
 		$this->request();
 		//4.- se ejecuta el metodo files
 		$this->files();
 	}

 	function request()
 	{
 		//3.1 variables superglobales en php 
 			//_globals, _server, _get, _post, __files, _cookie, _session, _request, _env (en mayusculas)
 			// El metodo get se pasa a travez de la URL   ejemplo.com?page=inicio
 			//existe la variable page de tipo get, si existe entonces 
 		$this->page = ( isset($_GET['page']) )? $_GET['page'] : 'index';
 	}

 	function files()
 	{
 		//
 		switch ($this->page) {
 			case 'SolicitudApoyo':
 				$this->infoPage['title']='Solicitud de Apoyo';
 				$this->infoPage['rute']='./public/pages/SolicitudApoyo.php';
 				$this->infoPage['files'] = array(
 												'./public/js/forms/info-general.html',
 												'./public/js/forms/Modalidad-proyecto.html',
 												'./public/js/forms/ColaboradoresP.html',
 												'./public/js/forms/ProgramaActividades.html'
 											);
 				$this->infoPage['footer'] = array(
 												'./public/js/CapturarNewProject.js?ver=0.0.2'
 											);
 				return $this->infoPage;
 			case 'Protocolo':
 				$this->infoPage['title']='Protocolo';
 				$this->infoPage['rute']='./public/pages/Protocolo.php';
 				return $this->infoPage;
 				break;
 			default:
 				$this->infoPage['title']='not fund';
 				$this->infoPage['rute']='./public/pages/404.php';
 				return $this->infoPage;
 		}
 	}

 	function getFile()
 	{
 		return $this->infoPage;
 	}
 } 
 ?>