<?php
	class TableCell extends Element{
		public function __construct($valor) {
			parent::__construct("td");
			parent::add($valor);
		}
	}
?>