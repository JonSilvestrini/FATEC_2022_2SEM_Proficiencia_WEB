<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);
require "autoload.php";

$id=$_GET['codigo'];

$con = Conexao::Open();
$filme = new Registro("filme", $con);
$filme->filme_id = $id;
$filme->titulo = $_POST['txttitulo'];
$filme->sinopse = $_POST['txtsinopse'];
$filme->fk_genero_id = $_POST['codgenero'];



if ($filme->save($filme->filme_id)) {
	$pagina = new Template("template.html");
	$pagina->set("titulo", "Obrigado.");
	$pagina->set("conteudo", new Msg("Filme Cadastrado com sucesso!"));
	$pagina->set("rodape", "Gravação de Filme");
	echo $pagina->show();
	header("Refresh: 3; URL=index.php");
}
?>