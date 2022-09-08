<?php
	class TableRow extends Element{
		public function __construct() {
			parent::__construct("tr");
		}
		
		public function addCell($valor){
			//instancia objeto célula
			$cell=new TableCell($valor);
			//armazena array de linhas
			parent::add($cell);
			return $cell;
		}
	}
?>