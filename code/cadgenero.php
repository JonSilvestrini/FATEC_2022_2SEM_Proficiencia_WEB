<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

require "autoload.php";

$form = new Element("form");
$form->action="gravagenero.php?codigo=0";
$form->name = "f1";
$form->method = "post";
$form->class = "form-inline";

$label1 = new Element("label");
$label1->add("Genero: ");

$genero = new Element("input");
$genero->type = "text";
$genero->name = "txtgenero";
$genero->size = "100";
$genero->maxlenght = "100";
$genero->class = "form-control";



$bt1 = new Element("input");
$bt1->type = "submit";
$bt1->value = "Gravar";
$bt1->class = "btn btn-primary";

$bt2 = new Element("input");
$bt2->type = "reset";
$bt2->value = "Limpar";
$bt2->class = "btn btn-danger";


$form->add("<br>");
$form->add($label1);
$form->add("<br>");
$form->add($genero);
$form->add("<br><br><br>");
$form->add($bt1);
$form->add($bt2);
$form->add("<br><br>");

$conteudo = $form->show();

$con= Conexao::Open();
$generoConn =new Registro("genero",$con);

$tab = new Table();
$tab->class='table table-hover';
$tab->border='1';
$tab->style='background: #fff';
$linha=$tab->addRow();
$linha->style='background: #ccc';
$linha->addCell('Código');
$linha->addCell('Gênero');
$linha->addCell('Opções');

foreach ($generoConn->findAll() as $key => $dados) {
	$linha=$tab->addRow();
	$linha->addCell($dados[0]);
	$linha->addCell($dados[1]);
	
	$link = new Element("a");
	$link->href="alterargenero.php?codigo=$dados[0]";
	$link->class="btn btn-success btn-xs";
	$link->add("Alterar");
	
	$link2 = new Element("a");
	$link2->href="excluirgenero.php?codigo=$dados[0]\" onclick=\"return confirm('Confirma exclusão do registro?')";
	$link2->class="btn btn-danger btn-xs";
	$link2->add("Excluir");
	
	$linha->addCell($link.$link2);
}

$conteudo.=$tab->show();

$pagina = new Template("template.html");
$pagina->set("titulo", "Cadastro Gênero");
$pagina->set("conteudo", $conteudo);
$pagina->set("rodape", "Cadastro Gênero");
echo $pagina->show();
?>