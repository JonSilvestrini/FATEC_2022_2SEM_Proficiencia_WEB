<?php
class Msg{
	private $msg;
	private $estilo;
	private $data;
	
	public function __construct($msg) {
		$this->estilo="alert alert-info";
		$this->msg=$msg;
		$this->show();
	}
	
	public function show() {
		return "<div class=\"{$this->estilo}\">{$this->msg}</div>";
	}
	
	public function setEstilo($estilo) {
		$this->estilo = "alert alert-$estilo";
	}
	
	public function __toString() {
		return $this->show();
	}
}
?>