<?php

require 'autoload.php';


$con = Conexao::Open();
$enquete = new Registro("genero",$con);

if($enquete->delete($_GET['codigo'])){
	$pagina = new Template('template.html');
	$pagina->set("titulo", "Exclusão de Gênero");
	$pagina->set("conteudo", new Msg("Gênero deletado!"));
	$pagina->set("rodape", "Exclusão de gênero");
	echo $pagina->show();
	header("Refresh: 3; URL=cadgenero.php");
}