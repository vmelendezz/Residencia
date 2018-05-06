<?php
/**
 * 
 */
 class Rutes
 {
 	//variables globales
 	public $page = "";
 	public $infoPage = [];
 	
 	function __construct()
 	{	//3.- se ejecuta el metodo request
 		//3.2 - se retorna
 		$this->request();
 		//4.- se ejecuta el metodo files
 		//4.5- se retorna
 		$this->files();
 	}

 	function request()
 	{
 		//3.1 variables superglobales en php 
 			//_globals, _server, _get, _post, __files, _cookie, _session, _request, _env (en mayusculas)
 			// El metodo get se pasa a travez de la URL   ejemplo.com?page=inicio
 			//existe la variable page de tipo get, si existe entonces se guarda en la variable page si no existe guarda la cadena index
 		$this->page = ( isset($_GET['page']) )? $_GET['page'] : 'index';
 	}

 	function files()
 	{
 		//4.1 Evaluamos en el switch la cadena que se guardo en la variable page
 		switch ($this->page) {
 			// 4.2 si se guardo la cadena SolicitudApoyo entonces
 			case 'SolicitudApoyo':
 				//4.3 infoPage es una variable global de tipo array la cual almacenará en el espacio title en decir posicion 0 la cadena Solicitud de Apoyo y así sucesivamente con la demas informacion.
 				$this->infoPage['title']='Solicitud de Apoyo';
 				$this->infoPage['rute']='./public/pages/SolicitudApoyo.php';
 				$this->infoPage['files'] = array(
 												'./public/js/forms/info-general.html',
 												'./public/js/forms/Modalidad-proyecto.html',
 												'./public/js/forms/ColaboradoresP.html',
 												'./public/js/forms/ProgramaActividades.html',
 												'./public/js/forms/PlanDeTrabajo.html'
 											);
 				$this->infoPage['footer'] = array(
 												'./public/js/CapturarNewProject.js?ver=0.0.0'
 											);
 				return $this->infoPage;
 			case 'Protocolo':
 				$this->infoPage['title']='Protocolo';
 				$this->infoPage['rute']='./public/pages/Protocolo.php';
 				// o 4.4
 				return $this->infoPage;
 				break;
 			default:
 				$this->infoPage['title']='not fund';
 				$this->infoPage['rute']='./public/pages/404.php';
 				// o 4.4
 				return $this->infoPage;
 		}
 	}

 	function getFile()
 	{
 		return $this->infoPage;
 	}
 } 
 ?>