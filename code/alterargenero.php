<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

require "autoload.php";

$id=$_GET['codigo'];

$con = Conexao::Open();
$acesso = new Registro("genero", $con);
$row=$acesso->find($id);

$form = new Element("form");
$form->action="gravagenero.php?codigo=" . $id;
$form->name = "f1";
$form->method = "post";
$form->class = "form-inline";

$codigo = new Element("input");
$codigo->type = "hidden";
$codigo->name = "codigo";
$codigo->value = $id;

$label1 = new Element("label");
$label1->add("Gênero: ");

$genero = new Element("input");
$genero->type = "text";
$genero->name = "txtgenero";
$genero->size = "100";
$genero->maxlenght = "100";
$genero->class = "form-control";
$genero->value = "$row[titulo]";


$bt1 = new Element("input");
$bt1->type = "submit";
$bt1->value = "Gravar";
$bt1->class = "btn btn-primary";

$bt2 = new Element("input");
$bt2->type = "reset";
$bt2->value = "Limpar";
$bt2->class = "btn btn-danger";

$form->add($codigo);
$form->add("<br>");
$form->add($label1);
$form->add("<br>");
$form->add($genero);
$form->add("<br><br><br>");
$form->add($bt1);
$form->add($bt2);
$form->add("<br><br>");

$conteudo = $form->show();



$pagina = new Template("template.html");
$pagina->set("titulo", "Cadastro de Gênero");
$pagina->set("conteudo", $conteudo);
$pagina->set("rodape", "Alterar Gênero");
echo $pagina->show();

?>