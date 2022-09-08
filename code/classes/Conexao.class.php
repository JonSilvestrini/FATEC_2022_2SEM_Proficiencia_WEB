<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

require_once 'config.php';

final class Conexao {

	private static $instancia;

	public static function Open() {
		$instancia = new PDO('mysql:host=' . HOST . ';dbname=' . DB . '', '' . USER . '', '' . PASS . '', array(PDO::ATTR_PERSISTENT => true));
		$instancia->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $instancia;
	}

}

?>