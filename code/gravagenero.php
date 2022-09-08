<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);
require "autoload.php";

$id=$_GET['codigo'];

$con = Conexao::Open();
$genero = new Registro("genero", $con);
$genero->genero_id = $id;
$genero->titulo = $_POST['txtgenero'];



if ($genero->save($genero->genero_id)) {
	$pagina = new Template("template.html");
	$pagina->set("titulo", "Obrigado.");
	$pagina->set("conteudo", new Msg("Gênero Cadastrado com sucesso!"));
	$pagina->set("rodape", "Gravação de Gênero");
	echo $pagina->show();
	header("Refresh: 3; URL=cadgenero.php");
}
?>