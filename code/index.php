<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);


require "autoload.php";

$con= Conexao::Open();
$form = new Element("form");
$form->action="gravafilme.php?codigo=0";
$form->name = "f1";
$form->method = "post";
$form->class = "form-inline";

$label1 = new Element("label");
$label1->add("Título: ");

$titulo = new Element("input");
$titulo->type = "text";
$titulo->name = "txttitulo";
$titulo->size = "100";
$titulo->maxlenght = "100";
$titulo->class = "form-control";

$label2 = new Element("label");
$label2->add("Sinopse: ");

$sinopse = new Element("input");
$sinopse->type = "text";
$sinopse->name = "txtsinopse";
$sinopse->size = "100";
$sinopse->maxlenght = "100";
$sinopse->class = "form-control";

$label3 = new Element("label");
$label3->add("Gênero: ");

$select = new Element("select");
$select->name="codgenero";
$select->class="form-control";

$generoConn =new Registro("genero",$con);
$generoList = $generoConn->findAll();
foreach ($generoList as $key => $dados) {
	$option = new Element("option");
	$option->value=$dados[0];
	$option->add($dados[1]);

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

$filmeConn =new Registro("filme",$con);

$tab = new Table();
$tab->class='table table-hover';
$tab->border='1';
$tab->style='background: #fff';
$linha=$tab->addRow();
$linha->style='background: #ccc';
$linha->addCell('Código');
$linha->addCell('Título');
$linha->addCell('Sinopse');
$linha->addCell('Gênero');
$linha->addCell('Opções');

foreach ($filmeConn->findAll() as $key => $dados) {
	$linha=$tab->addRow();
	$linha->addCell($dados[0]);
	$linha->addCell($dados[1]);
	$linha->addCell($dados[2]);

	foreach ($generoList as $keyGen => $dadosGen) {

		if ($dadosGen[0]==$dados[3]) 
			$linha->addCell($dadosGen[1]);
		
	}
	
	
	$link = new Element("a");
	$link->href="alterarfilme.php?codigo=$dados[0]";
	$link->class="btn btn-success btn-xs";
	$link->add("Alterar");
	
	$link2 = new Element("a");
	$link2->href="excluirfilme.php?codigo=$dados[0]\" onclick=\"return confirm('Confirma exclusão do registro?')";
	$link2->class="btn btn-danger btn-xs";
	$link2->add("Excluir");
	
	$linha->addCell($link.$link2);
}

$conteudo.=$tab->show();

$pagina = new Template("template.html");
$pagina->set("titulo", "Cadastro Filme");
$pagina->set("conteudo", $conteudo);
$pagina->set("rodape", "Cadastro Filme");
echo $pagina->show();
?>