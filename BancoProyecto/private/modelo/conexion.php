<?php

class Conexion extends PDO{
	public function __construct(){
		try {
			parent::__construct('mysql:dbname=pcicz;host=127.0.0.1', 'root', '');
			$this->exec("set names utf8");
		} catch (PDOException $e) {
			unset($e);
		}
	}	

}
?>