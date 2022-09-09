<?php

require 'autoload.php';


$con = Conexao::Open();
$enquete = new Registro("filme",$con);

if($enquete->delete($_GET['codigo'])){
	$pagina = new Template('template.html');
	$pagina->set("titulo", "Exclusão de Filme");
	$pagina->set("conteudo", new Msg("Filme deletado!"));
	$pagina->set("rodape", "Exclusão de Filme");
	echo $pagina->show();
	header("Refresh: 3; URL=index.php");
}