<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

require "autoload.php";

$id=$_GET['codigo'];

$con = Conexao::Open();
$acesso = new Registro("filme", $con);
$row=$acesso->find($id);

$form = new Element("form");
$form->action="gravafilme.php?codigo=" . $id;
$form->name = "f1";
$form->method = "post";
$form->class = "form-inline";

$codigo = new Element("input");
$codigo->type = "hidden";
$codigo->name = "codigo";
$codigo->value = $id;

$label1 = new Element("label");
$label1->add("Título: ");

$titulo = new Element("input");
$titulo->type = "text";
$titulo->name = "txttitulo";
$titulo->size = "100";
$titulo->maxlenght = "100";
$titulo->class = "form-control";
$titulo->value = "$row[titulo]";

$label2 = new Element("label");
$label2->add("Sinopse: ");

$sinopse = new Element("input");
$sinopse->type = "text";
$sinopse->name = "txtsinopse";
$sinopse->size = "100";
$sinopse->maxlenght = "100";
$sinopse->class = "form-control";
$sinopse->value = "$row[sinopse]";

$label3 = new Element("label");
$label3->add("Gênero: ");

$select = new Element("select");
$select->name="codgenero";
$select->class="form-control";

$generoConn =new Registro("genero",$con);
foreach ($generoConn->findAll() as $key => $dados) {
	$option = new Element("option");
	$option->value=$dados[0];
	$option->add($dados[1]);
	if ($dados[0] == "$row[fk_genero_id]"){
		$option->selected="selected";
	}

	$select->add($option);
	
}


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
$form->add($titulo);
$form->add("<br><br><br>");
$form->add($label2);
$form->add("<br>");
$form->add($sinopse);
$form->add("<br><br><br>");
$form->add($label3);
$form->add("<br>");
$form->add($select);
$form->add("<br><br><br>");
$form->add($bt1);
$form->add($bt2);
$form->add("<br><br>");

$conteudo = $form->show();



$pagina = new Template("template.html");
$pagina->set("titulo", "Cadastro de Filme");
$pagina->set("conteudo", $conteudo);
$pagina->set("rodape", "Alterar Filme");
echo $pagina->show();

?>